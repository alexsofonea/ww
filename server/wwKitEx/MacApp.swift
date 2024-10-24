import SwiftUI

@main
struct studioMac: App {
    @NSApplicationDelegateAdaptor(MacAppDelegate.self) var appDelegate
    
    var body: some Scene {
        WindowGroup {
            MacContentView()
                .frame(maxWidth: .infinity, maxHeight: .infinity)
                .onAppear {
                    if let window = NSApplication.shared.windows.first {
                        // Get screen size
                        if let screen = NSScreen.main {
                            let screenRect = screen.visibleFrame
                            
                            // Set window size and position
                            window.setFrame(screenRect, display: true)
                            window.level = .normal
                            window.styleMask = [.resizable, .titled, .fullSizeContentView, .closable, .miniaturizable]
                           // window.titlebarAppearsTransparent = true
                            //window.titleVisibility = .hidden
                        }
                    }
                }
        }
        //.windowStyle(.hiddenTitleBar)
        .commands {
            CommandGroup(replacing: CommandGroupPlacement.newItem) {
                Button("New Studio") {
                    NotificationCenter.default.post(name: NSNotification.Name("newStudio"), object: nil)
                }
            }
            CommandGroup(replacing: CommandGroupPlacement.saveItem) {
                Button("Save") {
                    NotificationCenter.default.post(name: NSNotification.Name("save"), object: nil)
                }
            }
            CommandGroup(replacing: CommandGroupPlacement.undoRedo) {}
            CommandGroup(replacing: .help) {
                Button("Studio Help") {
                    NotificationCenter.default.post(name: NSNotification.Name("help"), object: nil)
                }
            }
            CommandMenu("Document") {
                Button("Studio Home") {
                    NotificationCenter.default.post(name: NSNotification.Name("home"), object: nil)
                }
                Button("Designer") {
                    NotificationCenter.default.post(name: NSNotification.Name("openDesigner"), object: nil)
                }
                Button("Shotlits") {
                    NotificationCenter.default.post(name: NSNotification.Name("openShotlist"), object: nil)
                }
                Button("Chat") {
                    NotificationCenter.default.post(name: NSNotification.Name("openChat"), object: nil)
                }
            }
        }
    }
}
