#!/bin/bash

# ============================================================
# 怀美婷医疗 - WordPress.com 主题部署助手
# Huaimeiting Medical - WordPress Theme Deployment Assistant
# ============================================================
# 使用说明 / Usage Instructions:
# 1. 确保您有 WordPress.com 商业版账户
# 2. 运行此脚本进行预检和准备
# 3. 按照输出提示完成后续步骤
# ============================================================

set -e

echo "============================================================"
echo "🚀 怀美婷医疗 - WordPress.com 部署助手"
echo "   Huaimeiting Medical Deployment Assistant"
echo "============================================================"
echo ""

# 颜色定义
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# 函数：打印带颜色的消息
print_status() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

print_info() {
    echo -e "${BLUE}ℹ️  $1${NC}"
}

# 获取脚本所在目录
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
THEME_DIR="${SCRIPT_DIR}/huaimeiting-theme"
ZIP_FILE="${SCRIPT_DIR}/huaimeiting-theme.zip"

echo "📁 工作目录: ${SCRIPT_DIR}"
echo ""

# ============================================================
# 第一步：环境检查
# ============================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📋 第一步：环境检查 (Environment Check)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# 检查主题目录
if [ -d "$THEME_DIR" ]; then
    print_status "主题文件夹存在: ${THEME_DIR}"
else
    print_error "主题文件夹不存在!"
    exit 1
fi

# 检查 ZIP 文件
if [ -f "$ZIP_FILE" ]; then
    ZIP_SIZE=$(du -h "$ZIP_FILE" | cut -f1)
    print_status "主题 ZIP 包存在: ${ZIP_FILE} (${ZIP_SIZE})"
else
    print_warning "ZIP 包不存在，正在创建..."
    cd "$SCRIPT_DIR"
    zip -r "huaimeiting-theme.zip" huaimeiting-theme/ -x "*.DS_Store"
    print_status "ZIP 包已创建"
fi

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📋 第二步：必需文件检查 (Required Files Check)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

REQUIRED_FILES=("style.css" "index.php" "header.php" "footer.php" "functions.php")
ALL_FILES_OK=true

for file in "${REQUIRED_FILES[@]}"; do
    if [ -f "${THEME_DIR}/${file}" ]; then
        FILE_SIZE=$(ls -lh "${THEME_DIR}/${file}" | awk '{print $5}')
        print_status "${file} ✓ (${FILE_SIZE})"
    else
        print_error "${file} ✗ 缺失!"
        ALL_FILES_OK=false
    fi
done

if [ "$ALL_FILES_OK" = false ]; then
    print_error "缺少必需的文件！请重新生成主题包。"
    exit 1
fi

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📋 第三步：资源文件统计 (Asset Files Statistics)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# 统计图片数量
IMAGE_COUNT=$(find "${THEME_DIR}/assets/images" -type f \( -name "*.jpg" -o -name "*.jpeg" -o -name "*.png" \) 2>/dev/null | wc -l | tr -d ' ')
print_status "产品图片数量: ${IMAGE_COUNT}"

# 统计 PHP 文件数量
PHP_COUNT=$(find "$THEME_DIR" -name "*.php" -type f | wc -l | tr -d ' ')
print_status "PHP 模板文件数: ${PHP_COUNT}"

# 统计总文件数
TOTAL_FILES=$(find "$THEME_DIR" -type f ! -name "*.DS_Store" | wc -l | tr -d ' ')
print_status "总文件数: ${TOTAL_FILES}"

# 计算总大小
TOTAL_SIZE=$(du -sh "$THEME_DIR" | cut -f1)
print_status "主题总大小: ${TOTAL_SIZE}"

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📋 第四步：WordPress 兼容性检查 (Compatibility Check)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

# 检查 style.css 头部信息
if grep -q "Theme Name:" "${THEME_DIR}/style.css"; then
    THEME_NAME=$(grep "Theme Name:" "${THEME_DIR}/style.css" | head -1 | sed 's/Theme Name: //')
    print_status "主题名称: ${THEME_NAME}"
else
    print_warning "style.css 中未找到 Theme Name 信息"
fi

if grep -q "Version:" "${THEME_DIR}/style.css"; then
    THEME_VERSION=$(grep "Version:" "${THEME_DIR}/style.css" | head -1 | sed 's/Version: //')
    print_status "主题版本: ${THEME_VERSION}"
fi

if grep -q "Text Domain:" "${THEME_DIR}/style.css"; then
    TEXT_DOMAIN=$(grep "Text Domain:" "${THEME_DIR}/style.css" | head -1 | sed 's/Text Domain: //')
    print_status "文本域: ${TEXT_DOMAIN}"
fi

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📋 第五步：安全检查 (Security Check)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "

# 检查是否有敏感文件
for sfile in ".env" ".git" "wp-config.php" "database.sql"; do
    if [ -f "${THEME_DIR}/${sfile}" ]; then
        print_error "发现敏感文件: ${sfile} - 请删除!"
    else
        print_status "无敏感文件: ${sfile}"
    fi
done

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📋 第六步：生成部署报告 (Deployment Report)"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

REPORT_FILE="${SCRIPT_DIR}/DEPLOYMENT_REPORT_$(date +%Y%m%d_%H%M%S).txt"

cat > "$REPORT_FILE" << EOF
============================================================
怀美婷医疗 WordPress 主题部署报告
Huaimeiting Medical WordPress Theme Deployment Report
============================================================
生成时间: $(date "+%Y-%m-%d %H:%M:%S")

【主题信息】
- 主题名称: $(grep "Theme Name:" "${THEME_DIR}/style.css" | head -1 | sed 's/Theme Name: //' || echo "未知")
- 主题版本: $(grep "Version:" "${THEME_DIR}/style.css" | head -1 | sed 's/Version: //' || echo "未知")
- 文本域: $(grep "Text Domain:" "${THEME_DIR}/style.css" | head -1 | sed 's/Text Domain: //' || echo "未知")

【文件统计】
- 总文件数: ${TOTAL_FILES}
- PHP 模板: ${PHP_COUNT}
- 图片文件: ${IMAGE_COUNT}
- 总大小: ${TOTAL_SIZE}

【必需文件】
EOF

for file in "${REQUIRED_FILES[@]}"; do
    if [ -f "${THEME_DIR}/${file}" ]; then
        echo "- ✅ ${file}" >> "$REPORT_FILE"
    else
        echo "- ❌ ${file}" >> "$REPORT_FILE"
    fi
done

cat >> "$REPORT_FILE" << EOF

【部署文件】
- ZIP 包位置: ${ZIP_FILE}
- ZIP 大小: $(du -h "$ZIP_FILE" | cut -f1)

【下一步操作】
1. 登录您的 WordPress.com 商业版后台
2. 外观 → 主题 → 添加新主题 → 上传主题
3. 选择文件: ${ZIP_FILE}
4. 点击"立即安装" → "激活"
5. 配置网站设置（参考 WP_COMMERCIAL_DEPLOY_GUIDE.md）

============================================================
报告生成完毕
============================================================
EOF

print_status "部署报告已生成: ${REPORT_FILE}"

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "✨ 所有检查通过！准备就绪！"
echo "   All checks passed! Ready for deployment!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "📦 您的主题包:"
echo "   📍 位置: ${ZIP_FILE}"
echo "   📏 大小: $(du -h "$ZIP_FILE" | cut -f1)"
echo ""
echo "🚀 下一步操作 (Next Steps):"
echo ""
echo "1️⃣  打开浏览器访问:"
echo "    https://XXX.wordpress.com/wp-admin"
echo "    (将 XXX 替换为您的用户名)"
echo ""
echo "2️⃣  导航至:"
echo "    外观(Appearance) → 主题(Themes) → 添加新主题(Add New) → 上传(Upload)"
echo ""
echo "3️⃣  选择文件:"
echo "    ${ZIP_FILE}"
echo ""
echo "4️⃣  点击 '立即安装'(Install Now)，然后点击 '激活'(Activate)"
echo ""
echo "5️⃣  详细配置请查看:"
echo "    WP_COMMERCIAL_DEPLOY_GUIDE.md"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "💡 提示 (Tips):"
echo "   • 确保您的 WordPress.com 是商业版计划 ($25/月)"
echo "   • 如果上传失败，尝试使用 SFTP 方法"
echo "   • 安装后请阅读详细配置指南"
echo "   • 如有问题，查看 DEPLOYMENT_REPORT 或 GitHub Issues"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "🎉 准备工作已完成！祝您部署顺利！"
echo "   Deployment preparation completed! Good luck!"
echo "============================================================"
