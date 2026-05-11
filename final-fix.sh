#!/usr/bin/expect -f

# ============================================================
# 🔧 最终修复脚本 - 创建 .htaccess + 修复所有权限
# Final Fix Script
# ============================================================

set timeout 30
set host "f31-preview.biz.nf"
set port "221"
set user "4757594"
set pass "Vgbzg92x"

spawn sftp -oPort=$port -oStrictHostKeyChecking=no $user@$host

expect "password:"
send "$pass\r"
expect "sftp>"

puts "\n📁 进入 huaimeiting.cn 目录..."
send "cd huaimeiting.cn\r"
expect "sftp>"

puts "\n🔐 修复 index.html 权限为 644..."
send "chmod 644 index.html\r"
expect "sftp>"

puts "\n🔧 创建 .htaccess 文件..."

# 使用 printf 创建 .htaccess 内容
send "printf 'Options +Indexes\\nDirectoryIndex index.html preview.html\\n<FilesMatch \"\\\\.(html|htm|css|js|jpg|jpeg|png|gif|ico|pdf)$\">\\nOrder Allow,Deny\\nAllow from all\\n</FilesMatch>' .htaccess\r"
expect "sftp>"

puts "\n✅ 查看 .htaccess 是否创建成功..."
send "ls -la .htaccess\r"
expect "sftp>"

puts "\n📄 显示 .htaccess 内容..."
send "get .htaccess /tmp/check_htaccess.txt\r"
expect "sftp>"

puts "\n👋 退出..."
send "bye\r"
expect eof

puts "\n🎉 修复完成!"
