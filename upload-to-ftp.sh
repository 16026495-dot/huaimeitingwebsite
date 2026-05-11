#!/bin/bash

# ============================================================
# 🚀 怀美婷医疗 - FTP一键上传脚本
# Huaimeiting Medical - Auto Upload to Free Hosting
# ============================================================

FTP_HOST="f31-preview.biz.nf"
FTP_USER="4757594"
FTP_PASS="Vgbzg92x"
FTP_DIR="huaimeiting.cn"
REMOTE_BASE="ftp://${FTP_USER}:${FTP_PASS}@${FTP_HOST}:21/${FTP_DIR}"

echo "🎀 开始上传怀美婷网站到免费主机..."

# 1. 上传主HTML文件
echo "📄 上传 preview.html..."
curl -s -T "../preview.html" "${REMOTE_BASE}/" --connect-timeout 30
if [ $? -eq 0 ]; then
    echo "✅ preview.html 上传成功"
else
    echo "❌ preview.html 上传失败"
fi

# 2. 上传微信二维码
echo "🖼️  上传图片资源..."
curl -s -T "correct_wechat_qr_optimized.jpg" "${REMOTE_BASE}/" --connect-timeout 30
curl -s -T "correct_wechat_qr.jpg" "${REMOTE_BASE}/" --connect-timeout 30

# 3. 上传所有产品图片 (医美术后修复类)
echo "📦 上传医美术后修复类图片..."
for img in 医美术后修复类/*_optimized.*; do
    if [ -f "$img" ]; then
        echo "   ↑ $(basename "$img")"
        curl -s -T "$img" "${REMOTE_BASE}/" --connect-timeout 15
    fi
done

# 4. 上传产后修复类
echo "📦 上传产后修复类图片..."
for img in 产后修复类/*_optimized.*; do
    if [ -f "$img" ]; then
        echo "   ↑ $(basename "$img")"
        curl -s -T "$img" "${REMOTE_BASE}/" --connect-timeout 15
    fi
done

# 5. 上传疤痕修复类
echo "📦 上传疤痕修复类图片..."
for img in 疤痕修复类/*_optimized.*; do
    if [ -f "$img" ]; then
        echo "   ↑ $(basename "$img")"
        curl -s -T "$img" "${REMOTE_BASE}/" --connect-timeout 15
    fi
done

# 6. 上传伦美大健康
echo "📦 上传伦美大健康图片..."
for img in 伦美大健康/*_optimized.*; do
    if [ -f "$img" ]; then
        echo "   ↑ $(basename "$img")"
        curl -s -T "$img" "${REMOTE_BASE}/" --connect-timeout 15
    fi
done

echo ""
echo "✅ 所有文件上传完成!"
echo "🌐 访问: http://huaimeiting.cn"
echo "🌐 或: https://www.huameiting.cn"
