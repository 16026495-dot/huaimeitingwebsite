#!/usr/bin/expect -f

# ============================================================
# 🔧 完全重置 + 修复脚本
# Complete Reset & Fix Script
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

puts "\n🗑️  删除旧的 index.html..."
send "rm index.html\r"
expect "sftp>"

puts "\n📤 重新上传 index.html (新副本)..."
send "put /Users/chenting/Desktop/huaimeitingwebsite/index.html\r"
expect "sftp>"

puts "\n🔐 设置权限为 755 (目录) 和 644 (文件)..."
send "chmod 755 .\r"
expect "sftp>"
send "chmod 644 index.html\r"
expect "sftp>"
send "chmod 644 preview.html\r"
expect "sftp>"

puts "\n📋 查看当前文件列表和权限..."
send "ls -la\r"
expect "sftp>"

puts "\n✅ 完成! 退出..."
send "bye\r"
expect eof

puts "\n🎉 重置完成! 请等待1分钟后访问 http://huaimeiting.cn\n"
