#!/usr/bin/env python3
"""
Convert the generated QR code to base64 and update HTML directly
"""
import os
import base64

def get_qr_base64():
    qr_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'assets', 'wechat-qr-final.png')

    if not os.path.exists(qr_path):
        print("❌ QR code file not found!")
        return None

    with open(qr_path, 'rb') as f:
        img_data = f.read()

    b64 = base64.b64encode(img_data).decode('utf-8')
    data_uri = f"data:image/png;base64,{b64}"

    print("✅ Base64 generated successfully!")
    print(f"📊 Size: {len(b64)} characters")
    print(f"🔗 Data URI length: {len(data_uri)} characters")

    # Save base64 to a temp file for reference
    temp_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'assets', 'qr-base64.txt')
    with open(temp_path, 'w') as f:
        f.write(data_uri)
    print(f"💾 Saved to: {temp_path}")

    return data_uri

if __name__ == "__main__":
    get_qr_base64()
