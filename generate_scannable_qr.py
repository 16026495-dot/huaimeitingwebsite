#!/usr/bin/env python3
"""
Generate a REAL scannable WeChat QR code for Anne1413191
"""
import os
import sys

try:
    import qrcode
except ImportError:
    print("Installing qrcode library...")
    os.system('pip3 install qrcode[pil]')
    import qrcode

from PIL import Image, ImageDraw

def create_wechat_qr():
    wechat_id = "Anne1413191"

    qr = qrcode.QRCode(
        version=1,
        error_correction=qrcode.constants.ERROR_CORRECT_H,
        box_size=10,
        border=4,
    )
    qr.add_data(wechat_id)
    qr.make(fit=True)

    img = qr.make_image(fill_color="#7c3aed", back_color="white")

    output_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'assets', 'wechat-qr-scannable.png')
    os.makedirs(os.path.dirname(output_path), exist_ok=True)

    img.save(output_path)
    print(f"✅ Scannable QR code saved to: {output_path}")
    return output_path

if __name__ == "__main__":
    create_wechat_qr()
