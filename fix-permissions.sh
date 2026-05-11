#!/usr/bin/expect -f

# ============================================================
# 🔧 SFTP权限修复脚本
# Fix file permissions on free hosting via SFTP
# ============================================================

set timeout 30
set host "f31-preview.biz.nf"
set port "221"
set user "4757594"
set pass "Vgbzg92x"

puts "\n🔧 连接SFTP服务器..."

spawn sftp -oPort=$port -oStrictHostKeyChecking=no $user@$host

expect {
    "password:" {
        send "$pass\r"
    }
    timeout {
        puts "❌ 连接超时"
        exit 1
    }
}

expect {
    "sftp>" {
        puts "\n✅ 登录成功!"
    }
    timeout {
        puts "❌ 登录超时"
        exit 1
    }
}

puts "\n📁 进入 huaimeiting.cn 目录..."
send "cd huaimeiting.cn\r"
expect "sftp>"

puts "\n🔐 修改目录权限为 755..."
send "chmod 755 .\r"
expect "sftp>"

puts "\n📄 修改 index.html 权限为 644..."
send "chmod 644 index.html\r"
expect "sftp>"

puts "\n📄 修改 preview.html 权限为 644..."
send "chmod 644 preview.html\r"
expect "sftp>"

puts "\n🖼️  修改所有图片文件权限..."
send "chmod 644 *.jpg *.jpeg *.JPG *.JPEG *.png *.gif\r"
expect "sftp>"

puts "\n📂 修改子目录权限..."
send "chmod 755 医美术后修复类 产后修复类 疤痕修复类 伦美大健康 wordpress-theme wordpress assets\r"
expect "sftp>"

puts "\n✅ 权限修复完成! 退出..."
send "bye\r"
expect eof

puts "\n🎉 所有文件权限已修复!"
puts "🌐 现在可以访问 http://huaimeiting.cn 了!\n"
