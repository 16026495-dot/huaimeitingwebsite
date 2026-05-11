#!/usr/bin/env python3
import ftplib
import os
import sys

FTP_HOST = "f31-preview.biz.nf"
FTP_USER = "4757594"
FTP_PASS = "Vgbzg92x"
FTP_PORT = 21
REMOTE_DIR = "huaimeiting.cn"

def upload_files(ftp, local_dir, remote_dir):
    """Upload all files from local_dir to remote_dir"""
    ftp.cwd(remote_dir)
    
    for item in os.listdir(local_dir):
        local_path = os.path.join(local_dir, item)
        remote_path = item
        
        if os.path.isfile(local_path):
            print(f"📤 Uploading: {item}")
            try:
                with open(local_path, 'rb') as file:
                    ftp.storbinary(f'STOR {remote_path}', file)
                print(f"✅ {item} uploaded successfully")
            except Exception as e:
                print(f"❌ Failed to upload {item}: {e}")
        
        elif os.path.isdir(local_path):
            print(f"📂 Creating directory: {item}")
            try:
                ftp.mkd(remote_path)
            except ftplib.error_perm as e:
                if "550" in str(e):
                    print(f"⚠️  Directory {item} already exists")
                else:
                    print(f"❌ Failed to create {item}: {e}")
                    continue
            
            print(f"🔹 Entering directory: {item}")
            upload_files(ftp, local_path, remote_path)
            ftp.cwd("..")

def main():
    print("🚀 Starting FTP upload to huaimeiting.cn...")
    
    try:
        # Connect to FTP server
        print(f"🔌 Connecting to {FTP_HOST}:{FTP_PORT}...")
        ftp = ftplib.FTP()
        ftp.connect(FTP_HOST, FTP_PORT, timeout=30)
        ftp.login(FTP_USER, FTP_PASS)
        print("✅ Connected successfully!")
        
        # Change to target directory
        ftp.cwd(REMOTE_DIR)
        print(f"📁 Working in: {REMOTE_DIR}")
        
        # Upload main files
        print("\n📦 Uploading main files...")
        main_files = ['.htaccess', 'preview.html', 'index.html']
        for file in main_files:
            if os.path.exists(file):
                print(f"📤 Uploading: {file}")
                with open(file, 'rb') as f:
                    ftp.storbinary(f'STOR {file}', f)
                print(f"✅ {file} uploaded")
            else:
                print(f"⚠️  {file} not found, skipping")
        
        # Upload wp-config.php to wordpress directory
        print("\n📦 Uploading WordPress config...")
        if os.path.exists('wp-config.php'):
            ftp.cwd('wordpress')
            with open('wp-config.php', 'rb') as f:
                ftp.storbinary('STOR wp-config.php', f)
            print("✅ wp-config.php uploaded")
            ftp.cwd('..')
        else:
            print("⚠️  wp-config.php not found")
        
        # Upload theme
        print("\n📦 Uploading WordPress theme...")
        theme_dir = 'huaimeiting-theme'
        if os.path.isdir(theme_dir):
            ftp.cwd('wordpress/wp-content/themes')
            try:
                ftp.rmd('huaimeiting-theme')
            except:
                pass
            ftp.mkd('huaimeiting-theme')
            upload_files(ftp, theme_dir, 'huaimeiting-theme')
            ftp.cwd('../../..')
            print("✅ Theme uploaded successfully")
        else:
            print("⚠️  Theme directory not found")
        
        # Upload assets
        print("\n📦 Uploading assets...")
        assets_dir = 'assets'
        if os.path.isdir(assets_dir):
            upload_files(ftp, assets_dir, 'assets')
            print("✅ Assets uploaded successfully")
        else:
            print("⚠️  Assets directory not found")
        
        # Close connection
        ftp.quit()
        print("\n🎉 All files uploaded successfully!")
        print(f"🌐 Website should be accessible at: http://huaimeiting.cn")
        
    except Exception as e:
        print(f"\n❌ Error: {e}")
        sys.exit(1)

if __name__ == "__main__":
    main()
