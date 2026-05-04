#!/usr/bin/env python3
"""
SIMPLE: Save user's REAL WeChat QR code to replace the ugly placeholder

User wants to replace the purple box (with "微信 Anne1413191" text)
with their ACTUAL WeChat QR code image they provided before.
"""
import os
import shutil

def save_user_real_qr():
    # The file where we need the real QR code
    target_path = os.path.join(
        os.path.dirname(os.path.abspath(__file__)),
        'assets',
        'wechat-qr-user-real.png'
    )

    # Check if user has saved their QR code on desktop
    desktop_qr = os.path.expanduser('~/Desktop/wechat-qr.png')
    desktop_qr2 = os.path.expanduser('~/Desktop/微信二维码.png')
    desktop_qr3 = os.path.expanduser('~/Desktop/qr-code.png')

    # Try to find and copy from common locations
    source = None
    for possible_source in [desktop_qr, desktop_qr2, desktop_qr3]:
        if os.path.exists(possible_source):
            source = possible_source
            break

    if source:
        shutil.copy2(source, target_path)
        print(f"✅ SUCCESS! Copied your QR code from: {source}")
        print(f"✅ Saved to: {target_path}")
        print("")
        print("🎉 Your REAL WeChat QR code is now in place!")
        print("📱 It will show in the modal when customers click the green WeChat button")
        return True
    else:
        print("⚠️  Could not find your QR code on Desktop automatically.")
        print("")
        print("📋 PLEASE DO THIS MANUALLY (takes 10 seconds):")
        print("")
        print(f"Step 1: Save your WeChat QR code image to Desktop as: wechat-qr.png")
        print(f"Step 2: Run this script again, OR manually copy it to:")
        print(f"       {target_path}")
        print("")
        print("💡 OR use Finder:")
        print(f"   1. Open: /Users/chenting/Desktop/huaimeitingwebsite/assets/")
        print("   2. Paste your real WeChat QR code image there")
        print("   3. Rename it to: wechat-qr-user-real.png")
        print("")
        return False

if __name__ == "__main__":
    success = save_user_real_qr()
    if not success:
        print("❌ Waiting for you to add your real QR code image...")
