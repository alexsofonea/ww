import Cocoa
import UserNotifications

class MacAppDelegate: NSObject, NSApplicationDelegate, UNUserNotificationCenterDelegate {
    var deviceToken: String?

    func applicationDidFinishLaunching(_ notification: Notification) {
        // Request push notification permissions and register for remote notifications
        UNUserNotificationCenter.current().delegate = self
        UNUserNotificationCenter.current().requestAuthorization(options: [.alert, .sound, .badge]) { granted, error in
            if granted {
                DispatchQueue.main.async {
                    NSApplication.shared.registerForRemoteNotifications(matching: [.alert, .sound, .badge])
                }
            }
        }
        
        // Update the device token from UserDefaults
        if let storedToken = UserDefaults.standard.string(forKey: "pushNotificationDeviceToken") {
            deviceToken = storedToken
        }
    }

    func application(_ application: NSApplication, didRegisterForRemoteNotificationsWithDeviceToken deviceToken: Data) {
        let tokenParts = deviceToken.map { data in String(format: "%02.2hhx", data) }
        let token = tokenParts.joined()
        self.deviceToken = token
        print("Device token: \(token)")

        UserDefaults.standard.set(token, forKey: "pushNotificationDeviceToken")
    }

    func application(_ application: NSApplication, didFailToRegisterForRemoteNotificationsWithError error: Error) {
        print("Failed to register for remote notifications: \(error.localizedDescription)")
        UserDefaults.standard.set("error", forKey: "pushNotificationDeviceToken")
    }
}
