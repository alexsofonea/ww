import SwiftUI
import WebKit

struct MacContentView: View {
    @State private var isLoading = true
    @State private var errorMessage: String?
    
    var body: some View {
        VStack {
            /*if isLoading {
                ProgressView()
                    .progressViewStyle(CircularProgressViewStyle())
                    .scaleEffect(2)
            } else {*/
                if let errorMessage = errorMessage {
                    VStack {
                        Image(systemName: "network.slash")
                            .resizable()
                            .aspectRatio(contentMode: .fit)
                            .frame(width: 100, height: 100)
                            .foregroundColor(.red)

                        Text(errorMessage)
                            .multilineTextAlignment(.center)
                            .padding()
                    }
                    .padding()
                } else {
                    WebView(request: URLRequest(url: URL(string: "https://studio.alexsofonea.com/?v=1.1&platform=macOS&deviceId=" + UUID().uuidString + "&tooken=" +  (UserDefaults.standard.string(forKey: "pushNotificationDeviceToken") ?? ""))!), isLoading: $isLoading, errorMessage: $errorMessage)
                        .ignoresSafeArea()
                }
            //}
        }
    }
}
