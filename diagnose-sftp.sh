#!/usr/bin/expect -f

# ============================================================
# 🔍 SFTP诊断脚本 - 查看目录结构和权限
# SFTP Diagnostic Script
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

puts "\n📁 === 查看根目录 ==="
send "ls -la\r"
expect "sftp>"

puts "\n📁 === 查看 huaimeiting.cn 目录详情 ==="
send "ls -la huaimeiting.cn/\r"
expect "sftp>"

puts "\n📄 === 检查 index.html 是否存在 ==="
send "ls -la huaimeiting.cn/index.html\r"
expect "sftp>"

puts "\n📂 === 检查是否有 .htaccess 文件 ==="
send "ls -la huaimeiting.cn/.htaccess\r"
expect "sftp>"

puts "\n✅ 诊断完成!"
send "bye\r"
expect eof
