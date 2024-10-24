import SwiftUI
import WebKit
import StoreKit
import UserNotifications

 struct WebView: UIViewRepresentable {
     let request: URLRequest
     @Binding var isLoading: Bool
     @Binding var errorMessage: String?
     
     func makeCoordinator() -> Coordinator {
         return Coordinator(self, isLoading: $isLoading, errorMessage: $errorMessage)
     }
     
     func makeUIView(context: Context) -> WKWebView {
         let webView = WKWebView()
         webView.navigationDelegate = context.coordinator
         
         // Configure the user content controller
         let contentController = webView.configuration.userContentController
         contentController.add(context.coordinator, name: "callbackHandler")
         
         // Request push notification permissions
         requestPushNotificationPermissions()
         
         return webView
     }
     
     func updateUIView(_ uiView: WKWebView, context: Context) {
         uiView.allowsBackForwardNavigationGestures = true
         uiView.load(request)
     }
     
     func requestPushNotificationPermissions() {
         UNUserNotificationCenter.current().requestAuthorization(options: [.alert, .sound, .badge]) { granted, error in
             if granted {
                 DispatchQueue.main.async {
                     UIApplication.shared.registerForRemoteNotifications()
                 }
             }
         }
     }
     
     class Coordinator: NSObject, WKNavigationDelegate, WKScriptMessageHandler, UIDocumentPickerDelegate {
         var parent: WebView
         
         var webView: WKWebView?
         
         @Binding var isLoading: Bool
         @Binding var errorMessage: String?
         
         init(_ parent: WebView, isLoading: Binding<Bool>, errorMessage: Binding<String?>) {
             self.parent = parent
             
             self._isLoading = isLoading
             self._errorMessage = errorMessage
             
             super.init()
             
             // Start listening for transaction updates
             Task {
                 await listenForTransactions()
                 await checkExistingTransactions()
             }
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
                         print("Received shareImage action") // Debugging statement
                         if let imageDataString = messageBody["data"] as? String {
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
                     case "feedback":
                         triggerHapticFeedback()
                         break
                     case "litefeedback":
                         triggerLiteHapticFeedback()
                         break
                     default:
                         break
                     }
                 }
             }
         }
         
         
         func triggerHapticFeedback() {
             //let generator = UIImpactFeedbackGenerator(style: .medium)
             //generator.impactOccurred()
         }
         func triggerLiteHapticFeedback() {
             //let generator = UIImpactFeedbackGenerator(style: .light)
             //generator.impactOccurred()
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
                 print("Failed to purchase: \(error.localizedDescription)")
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
                 print("Transaction successful: \(transaction.id)")
                 Task {
                     await transaction.finish()
                     callJavaScriptFunction(functionName: "onPurchase", parameters: ["success": true, "transactionId": transaction.id])
                 }
             case .unverified(_, let error):
                 print("Transaction unverified: \(error.localizedDescription)")
                 callJavaScriptFunction(functionName: "onPurchase", parameters: ["success": false, "error": error.localizedDescription])
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
             if let appDelegate = UIApplication.shared.delegate as? AppDelegate {
                 if let token = appDelegate.deviceToken {
                     UserDefaults.standard.set(token, forKey: "pushNotificationDeviceToken")
                 }
             }
         }
         
         
         func shareImage(_ imageData: Data, name: String) {
             print(name)
             
             let tempDirectory = FileManager.default.temporaryDirectory
             let fileURL = tempDirectory.appendingPathComponent(name).appendingPathExtension("png")
             
             do {
                 try imageData.write(to: fileURL)
             } catch {
                 print("Error writing image data to file: \(error.localizedDescription)")
                 return
             }
             
             let documentPicker = UIDocumentPickerViewController(forExporting: [fileURL], asCopy: true)
             documentPicker.delegate = self
             documentPicker.allowsMultipleSelection = false
             documentPicker.allowsMultipleSelection = false

             // Present the document picker using UIWindowScene.windows
             if let scene = UIApplication.shared.connectedScenes.first as? UIWindowScene,
                let rootViewController = scene.windows.first?.rootViewController {
                 rootViewController.present(documentPicker, animated: true, completion: nil)
             }
         }
         
         func sharePDF(_ pdfData: Data, name: String) {
             print(name)

             let tempDirectory = FileManager.default.temporaryDirectory
             let fileURL = tempDirectory.appendingPathComponent(name).appendingPathExtension("pdf")

             do {
                 try pdfData.write(to: fileURL)
             } catch {
                 print("Error writing PDF data to file: \(error.localizedDescription)")
                 return
             }

             let documentPicker = UIDocumentPickerViewController(forExporting: [fileURL], asCopy: true)
             documentPicker.delegate = self
             documentPicker.allowsMultipleSelection = false

             // Present the document picker using UIWindowScene.windows
             if let scene = UIApplication.shared.connectedScenes.first as? UIWindowScene,
                let rootViewController = scene.windows.first?.rootViewController {
                 rootViewController.present(documentPicker, animated: true, completion: nil)
             }
         }
         
         func documentPicker(_ controller: UIDocumentPickerViewController, didPickDocumentsAt urls: [URL]) {
             guard let selectedURL = urls.first else { return }
             print("Image saved to: \(selectedURL.path)")
             // Optionally, you can notify the JavaScript side about the success
             callJavaScriptFunction(functionName: "onImageShared", parameters: ["success": true, "path": selectedURL.path])
         }

         func documentPickerWasCancelled(_ controller: UIDocumentPickerViewController) {
             print("Document picker was cancelled.")
             // Optionally, you can notify the JavaScript side about the cancellation
             callJavaScriptFunction(functionName: "onImageShared", parameters: ["success": false, "error": "User cancelled"])
         }
         
         private func openURLInBrowser(_ urlString: String) {
             if let url = URL(string: urlString) {
                 UIApplication.shared.open(url)
             }
         }
     }
 }
