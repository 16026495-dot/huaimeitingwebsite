#!/usr/bin/env python3
"""
Generate WeChat QR code with protocol for direct add friend functionality
Supports: weixin:// protocol to open WeChat and show add friend page
"""
import os
import qrcode
from PIL import Image

def create_wechat_add_friend_qr():
    wechat_id = "Anne1413191"

    # Method 1: Use weixin:// protocol (most reliable for direct add friend)
    wechat_protocol = f"weixin://dl/profile/{wechat_id}"

    # Create QR code with high error correction
    qr = qrcode.QRCode(
        version=None,  # Auto-determine version
        error_correction=qrcode.constants.ERROR_CORRECT_H,
        box_size=12,
        border=4,
    )
    qr.add_data(wechat_protocol)
    qr.make(fit=True)

    # Create image with purple color (brand color)
    img = qr.make_image(fill_color="#7c3aed", back_color="white")

    output_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'assets', 'wechat-qr-addfriend.png')
    os.makedirs(os.path.dirname(output_path), exist_ok=True)

    img.save(output_path, quality=95)
    print(f"✅ WeChat Add-Friend QR Code saved: {output_path}")
    print(f"📱 Protocol: {wechat_protocol}")
    print(f"🔗 Scan result: Opens WeChat → Shows profile → 'Add Friend' button")
    return output_path

if __name__ == "__main__":
    create_wechat_add_friend_qr()
