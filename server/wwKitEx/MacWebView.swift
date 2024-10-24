import SwiftUI
import WebKit
import UserNotifications
import StoreKit
import AppKit

struct WebView: NSViewRepresentable {
    let request: URLRequest
    @Binding var isLoading: Bool
    @Binding var errorMessage: String?

    func makeCoordinator() -> Coordinator {
        return Coordinator(self, isLoading: $isLoading, errorMessage: $errorMessage)
    }

    func makeNSView(context: Context) -> WKWebView {
        let webView = WKWebView()
        webView.navigationDelegate = context.coordinator

        // Configure the user content controller
        let contentController = webView.configuration.userContentController
        contentController.add(context.coordinator, name: "callbackHandler")

        // Request push notification permissions
        requestPushNotificationPermissions()

        return webView
    }

    func updateNSView(_ nsView: WKWebView, context: Context) {
        nsView.allowsBackForwardNavigationGestures = true
        nsView.load(request)
    }

    func requestPushNotificationPermissions() {
        UNUserNotificationCenter.current().requestAuthorization(options: [.alert, .sound, .badge]) { granted, error in
            if granted {
                DispatchQueue.main.async {
                    NSApplication.shared.registerForRemoteNotifications(matching: [.alert, .sound, .badge])
                }
            }
        }
    }

    class Coordinator: NSObject, WKNavigationDelegate, WKScriptMessageHandler {
        var parent: WebView
        var webView: WKWebView?
        @Binding var isLoading: Bool
        @Binding var errorMessage: String?

        init(_ parent: WebView, isLoading: Binding<Bool>, errorMessage: Binding<String?>) {
            self.parent = parent
            self._isLoading = isLoading
            self._errorMessage = errorMessage
            super.init()
            Task {
                await listenForTransactions()
                await checkExistingTransactions()
            }
            NotificationCenter.default.addObserver(self, selector: #selector(newStudio), name: NSNotification.Name("newStudio"), object: nil)
            NotificationCenter.default.addObserver(self, selector: #selector(save), name: NSNotification.Name("save"), object: nil)
            NotificationCenter.default.addObserver(self, selector: #selector(help), name: NSNotification.Name("help"), object: nil)
            NotificationCenter.default.addObserver(self, selector: #selector(home), name: NSNotification.Name("home"), object: nil)
            NotificationCenter.default.addObserver(self, selector: #selector(openDesigner), name: NSNotification.Name("openDesigner"), object: nil)
            NotificationCenter.default.addObserver(self, selector: #selector(openShotlist), name: NSNotification.Name("openShotlist"), object: nil)
            NotificationCenter.default.addObserver(self, selector: #selector(openChat), name: NSNotification.Name("openChat"), object: nil)
        }

        @objc func newStudio() {
            callJavaScriptFunction(functionName: "newStudio", parameters: [:])
        }
        @objc func save() {
            callJavaScriptFunction(functionName: "save", parameters: [:])
        }
        @objc func help() {
            callJavaScriptFunction(functionName: "help", parameters: [:])
        }
        @objc func home() {
            callJavaScriptFunction(functionName: "home", parameters: [:])
        }
        @objc func openDesigner() {
            callJavaScriptFunction(functionName: "openDesigner", parameters: [:])
        }
        @objc func openShotlist() {
            callJavaScriptFunction(functionName: "openShotlist", parameters: [:])
        }
        @objc func openChat() {
            callJavaScriptFunction(functionName: "openChat", parameters: [:])
        }

        deinit {
            NotificationCenter.default.removeObserver(self)
        }

        func webView(_ webView: WKWebView, didStartProvisionalNavigation navigation: WKNavigation!) {
            isLoading = true
            errorMessage = nil
        }

        func webView(_ webView: WKWebView, didFail navigation: WKNavigation!, withError error: Error) {
            isLoading = false
            errorMessage = "We are sorry, but our servers are down. Please hang on while we expand our infrastructure."
        }

        func webView(_ webView: WKWebView, didFailProvisionalNavigation navigation: WKNavigation!, withError error: Error) {
            isLoading = false
            errorMessage = "You are not connected to the internet. Please check your connection and try again."
        }

        func userContentController(_ userContentController: WKUserContentController, didReceive message: WKScriptMessage) {
            if message.name == "callbackHandler" {
                if let messageBody = message.body as? [String: Any],
                   let action = messageBody["action"] as? String {

                    switch action {
                    case "purchase":
                        Task {
                            await handleOneTimePurchase(productId: (messageBody["data"] as? String)!)
                        }
                    case "restorePurchase":
                        Task {
                            await restorePurchases()
                        }
                    case "handoff":
                        handleHandoff()
                    case "universalLink":
                        handleUniversalLink()
                    case "shareImage":
                        if let imageDataString = messageBody["data"] as? String {
                            print("Received Image Data String: \(imageDataString)") // Debugging statement
                            
                            // Remove the prefix if it exists
                            let prefix = "data:image/octet-stream;base64,"
                            if imageDataString.hasPrefix(prefix) {
                                let base64String = imageDataString.replacingOccurrences(of: prefix, with: "")
                                if let imageData = Data(base64Encoded: base64String) {
                                    print("Image Data Decoded Successfully") // Debugging statement
                                    shareImage(imageData, name: messageBody["name"] as? String ?? "")
                                } else {
                                    print("Failed to decode image data") // Debugging statement
                                }
                            } else {
                                print("Image Data String does not have expected prefix") // Debugging statement
                            }
                        } else {
                            print("Image Data String is nil") // Debugging statement
                        }
                    case "sharePDF":
                        print("Received sharePDF action") // Debugging statement
                        if let pdfDataString = messageBody["data"] as? String {
                            let prefix = "data:application/pdf;base64,"
                            if pdfDataString.hasPrefix(prefix) {
                                let base64String = pdfDataString.replacingOccurrences(of: prefix, with: "")
                                if let pdfData = Data(base64Encoded: base64String) {
                                    print("PDF Data Decoded Successfully") // Debugging statement
                                    sharePDF(pdfData, name: messageBody["name"] as? String ?? "")
                                } else {
                                    print("Failed to decode PDF data") // Debugging statement
                                }
                            } else {
                                print("PDF Data String does not have expected prefix") // Debugging statement
                            }
                        } else {
                            print("PDF Data String is nil") // Debugging statement
                        }
                    case "openURL":
                        if let urlString = messageBody["url"] as? String {
                            openURLInBrowser(urlString)
                        }
                        break
                    case "dragfeedback":
                        triggerLiteHapticFeedback()
                        break
                    default:
                        break
                    }
                }
            }
        }
        
        func triggerHapticFeedback() {
            NSHapticFeedbackManager.defaultPerformer.perform(.generic, performanceTime: .default)
        }
        func triggerLiteHapticFeedback() {
            NSHapticFeedbackManager.defaultPerformer.perform(.alignment, performanceTime: .default)
        }
        
        private func handleOneTimePurchase(productId: String) async {
            do {
                let storeProducts = try await Product.products(for: [productId])
                guard let product = storeProducts.first else {
                    print("Product not found.")
                    callJavaScriptFunction(functionName: "onPurchase", parameters: ["success": false, "error": "Product not found"])
                    return
                }

                print("Product found: \(product.id)")

                let result = try await product.purchase()

                switch result {
                case .success(let verificationResult):
                    print("Purchase successful, verifying transaction...")
                    handleTransactionVerification(verificationResult)
                case .userCancelled:
                    print("Purchase cancelled by user.")
                    callJavaScriptFunction(functionName: "onPurchase", parameters: ["success": false, "error": "User cancelled"])
                case .pending:
                    print("Purchase pending.")
                    callJavaScriptFunction(functionName: "onPurchase", parameters: ["success": false, "error": "Purchase pending"])
                @unknown default:
                    print("Unknown purchase result.")
                    callJavaScriptFunction(functionName: "onPurchase", parameters: ["success": false, "error": "Unknown result"])
                }
            } catch {
                print("Failed to purchase product: \(error.localizedDescription)")
                callJavaScriptFunction(functionName: "onPurchase", parameters: ["success": false, "error": error.localizedDescription])
            }
        }

        private func listenForTransactions() async {
            for await verificationResult in Transaction.updates {
                handleTransactionVerification(verificationResult)
            }
        }

        private func checkExistingTransactions() async {
            for await verificationResult in Transaction.currentEntitlements {
                handleTransactionVerification(verificationResult)
            }
        }

        private func handleTransactionVerification(_ verificationResult: VerificationResult<StoreKit.Transaction>) {
            switch verificationResult {
            case .verified(let transaction):
                print("Subscription transaction successful: \(transaction.id)")
                Task {
                    await transaction.finish()
                    callJavaScriptFunction(functionName: "onPurchase", parameters: ["success": true, "transactionId": transaction.id])
                }
            case .unverified(_, let error):
                print("Subscription transaction unverified: \(error.localizedDescription)")
                callJavaScriptFunction(functionName: "onPurchase", parameters: ["success": false, "error": error.localizedDescription])
            }
        }

        private func handleSubscriptionCancellation() {
            if let url = URL(string: "https://apps.apple.com/account/subscriptions") {
                NSWorkspace.shared.open(url)
            }
        }

        private func handleHandoff() {
            // Implement your Handoff logic here
            callJavaScriptFunction(functionName: "onHandoff", parameters: ["status": "started"])
        }

        private func handleUniversalLink() {
            // Implement your Universal Link logic here
            callJavaScriptFunction(functionName: "onUniversalLink", parameters: ["url": "https://example.com"])
        }
        
        private func restorePurchases() async {
            do {
                try await AppStore.sync()
                await checkExistingTransactions() // Call this to process new transactions after syncing
                callJavaScriptFunction(functionName: "onRestorePurchase", parameters: ["success": true])
            } catch {
                callJavaScriptFunction(functionName: "onRestorePurchase", parameters: ["success": false, "error": error.localizedDescription])
            }
        }

        func callJavaScriptFunction(functionName: String, parameters: [String: Any]) {
            guard let webView = webView else { return }
            let jsonData = try! JSONSerialization.data(withJSONObject: parameters, options: [])
            let jsonString = String(data: jsonData, encoding: .utf8)!
            let jsCode = "\(functionName)(\(jsonString));"
            print(jsCode)
            webView.evaluateJavaScript(jsCode) { (result, error) in
                if let error = error {
                    print("Error calling JavaScript: \(error.localizedDescription)")
                }
                if let result = result {
                    print("JavaScript result: \(result)")
                }
            }
        }

        func webView(_ webView: WKWebView, didFinish navigation: WKNavigation!) {
            self.webView = webView
            isLoading = false

            // Check and update the device token in UserDefaults on app launch
            if let appDelegate = NSApplication.shared.delegate as? MacAppDelegate {
                if let token = appDelegate.deviceToken {
                    UserDefaults.standard.set(token, forKey: "pushNotificationDeviceToken")
                }
            }
        }

        func webViewWebContentProcessDidTerminate(_ webView: WKWebView) {
            print("Web content process terminated, attempting reload...")
            // webView.reload()
        }
        
        private func shareImage(_ imageData: Data, name: String) {
            let savePanel = NSSavePanel()
            savePanel.nameFieldStringValue = name.isEmpty ? "image.png" : name
            
            if #available(macOS 12.0, *) {
                savePanel.allowedContentTypes = [.png]
            } else {
                savePanel.allowedFileTypes = ["png"]
            }
            
            savePanel.begin { response in
                if response == .OK, let url = savePanel.url {
                    do {
                        try imageData.write(to: url)
                        print("Image saved successfully at \(url.path)")
                    } catch {
                        print("Failed to save image: \(error.localizedDescription)")
                    }
                } else {
                    print("Save panel was cancelled")
                }
            }
        }
        private func sharePDF(_ imageData: Data, name: String) {
            let savePanel = NSSavePanel()
            savePanel.nameFieldStringValue = name.isEmpty ? "shotlist.pdf" : name
            
            if #available(macOS 12.0, *) {
                savePanel.allowedContentTypes = [.pdf]
            } else {
                savePanel.allowedFileTypes = ["pdf"]
            }
            
            savePanel.begin { response in
                if response == .OK, let url = savePanel.url {
                    do {
                        try imageData.write(to: url)
                        print("Image saved successfully at \(url.path)")
                    } catch {
                        print("Failed to save image: \(error.localizedDescription)")
                    }
                } else {
                    print("Save panel was cancelled")
                }
            }
        }
        
        private func openURLInBrowser(_ urlString: String) {
            if let url = URL(string: urlString) {
                NSWorkspace.shared.open(url)
            }
        }
    }
}
