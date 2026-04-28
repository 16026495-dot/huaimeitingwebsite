#!/bin/bash

# ============================================================
# 🏃 怀美婷医疗 - 一键自动化部署脚本
# Huaimeiting Medical - One-Click Deployment Script
# ============================================================
# 功能：自动部署网站到 GitHub Pages，生成 WordPress 嵌入代码
# 使用方法：./deploy-auto.sh
# ============================================================

set -e

# 颜色定义
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
NC='\033[0m' # No Color

# 打印函数
print_status() { echo -e "${GREEN}✅ $1${NC}"; }
print_warning() { echo -e "${YELLOW}⚠️  $1${NC}"; }
print_error() { echo -e "${RED}❌ $1${NC}"; }
print_info() { echo -e "${BLUE}ℹ️  $1${NC}"; }
print_step() { echo -e "\n${PURPLE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"; echo -e "${PURPLE}🚀 $1${NC}"; }

# 获取配置
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
REPO_NAME="huaimeitingwebsite"
REPO_OWNER="16026495-dot"
GITHUB_PAGES_URL="https://${REPO_OWNER}.github.io/${REPO_NAME}/preview.html"
WP_DOMAIN="XXX.wordpress.com"

echo ""
echo "============================================================"
echo "🏃 怀美婷医疗 - 一键自动化部署脚本"
echo "   Huaimeiting Medical - One-Click Deployment"
echo "============================================================"
echo ""

# ============================================================
# 步骤1: 检查环境
# ============================================================
print_step "步骤1: 检查环境配置"

# 检查 git 是否安装
if ! command -v git &> /dev/null; then
    print_error "❌ Git 未安装！请先安装 Git。"
    exit 1
fi
print_status "✅ Git 已安装"

# 检查当前目录是否为 git 仓库
if [ ! -d ".git" ]; then
    print_error "❌ 当前目录不是 Git 仓库！"
    exit 1
fi
print_status "✅ 当前目录是 Git 仓库"

# 检查远程仓库配置
REMOTE_URL=$(git config --get remote.origin.url)
if [[ ! "$REMOTE_URL" == *"${REPO_OWNER}/${REPO_NAME}"* ]]; then
    print_error "❌ 远程仓库配置不正确！"
    print_info "   当前远程: $REMOTE_URL"
    print_info "   期望: git@github.com:${REPO_OWNER}/${REPO_NAME}.git"
    exit 1
fi
print_status "✅ 远程仓库配置正确: ${REPO_OWNER}/${REPO_NAME}"

# ============================================================
# 步骤2: 创建 GitHub Actions 配置
# ============================================================
print_step "步骤2: 创建自动部署配置"

# 创建 .github/workflows 目录
mkdir -p ".github/workflows"

# 检查 deploy.yml 是否存在
if [ -f ".github/workflows/deploy.yml" ]; then
    print_status "✅ GitHub Actions 配置文件已存在"
else
    # 创建 deploy.yml
    cat > ".github/workflows/deploy.yml" << 'EOF'
name: Deploy to GitHub Pages

on:
  push:
    branches: [ main ]
  workflow_dispatch:

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - name: Checkout repository
        uses: actions/checkout@v4
        with:
          fetch-depth: 0

      - name: Configure Git
        run: |
          git config user.name "GitHub Actions"
          git config user.email "actions@github.com"

      - name: Deploy to GitHub Pages
        uses: peaceiris/actions-gh-pages@v4
        with:
          github_token: ${{ secrets.GITHUB_TOKEN }}
          publish_dir: ./
          publish_branch: gh-pages
          force_orphan: true
          commit_message: "Deploy: ${{ github.sha }}"

      - name: Output deployment info
        run: |
          echo "✅ Deployed successfully!"
          echo "🌐 URL: https://${{ github.repository_owner }}.github.io/${{ github.event.repository.name }}/preview.html"
EOF
    print_status "✅ GitHub Actions 配置文件已创建"
fi

# ============================================================
# 步骤3: 更新预览页面配置
# ============================================================
print_step "步骤3: 更新网站配置"

# 更新 preview.html 中的绝对路径为相对路径（确保 GitHub Pages 正常工作）
if [ -f "preview.html" ]; then
    # 移除可能的绝对路径前缀
    sed -i.bak 's|/Users/chenting/Desktop/huaimeitingwebsite/||g' preview.html
    rm -f preview.html.bak
    print_status "✅ 预览页面路径已更新为相对路径"
else
    print_error "❌ preview.html 不存在！"
    exit 1
fi

# ============================================================
# 步骤4: 推送代码触发自动部署
# ============================================================
print_step "步骤4: 推送代码触发自动部署"

echo ""
print_info "正在添加所有更改..."
git add .

echo ""
print_info "正在提交更改..."
COMMIT_MSG="feat: 自动部署 - 更新网站配置 $(date '+%Y-%m-%d %H:%M:%S')"
git commit -m "$COMMIT_MSG"

echo ""
print_info "正在推送到 GitHub..."
git push origin main

print_status "✅ 代码已推送！"
print_info "GitHub Actions 正在自动部署，请等待约1-2分钟..."

# ============================================================
# 步骤5: 等待部署完成并验证
# ============================================================
print_step "步骤5: 验证部署状态"

echo ""
print_info "等待 GitHub Pages 部署完成..."
sleep 15  # 等待15秒让 GitHub Actions 开始运行

# 检查 GitHub Pages URL 是否可访问
echo ""
print_info "检查网站是否可访问..."
if curl -s --head --request GET "$GITHUB_PAGES_URL" | grep "200 OK" > /dev/null; then
    print_status "✅ 网站部署成功！"
else
    print_warning "⚠️  网站可能还在部署中，请稍后手动检查"
fi

# ============================================================
# 步骤6: 生成 WordPress 嵌入代码
# ============================================================
print_step "步骤6: 生成 WordPress 嵌入代码"

# 创建 WordPress 嵌入代码文件
WP_EMBED_FILE="${SCRIPT_DIR}/WORDPRESS_EMBED_CODE.txt"

cat > "$WP_EMBED_FILE" << EOF
============================================================
                    WordPress 嵌入代码
============================================================

📋 复制以下代码到 WordPress 自定义 HTML 块中：

------------------------------------------------------------
方案1: 标准嵌入（推荐）
------------------------------------------------------------
<iframe 
    src="${GITHUB_PAGES_URL}" 
    width="100%" 
    height="1500px" 
    frameborder="0" 
    style="border: none; overflow: hidden;"
    scrolling="yes">
</iframe>
<p style="text-align: center; margin-top: 20px;">
    <a href="${GITHUB_PAGES_URL}" 
       target="_blank" 
       rel="noopener noreferrer"
       style="background-color: #7B2D8E; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
        全屏查看网站 →
    </a>
</p>

------------------------------------------------------------
方案2: 自适应高度
------------------------------------------------------------
<div style="position: relative; padding-bottom: 180%; height: 0; overflow: hidden;">
    <iframe 
        src="${GITHUB_PAGES_URL}" 
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" 
        frameborder="0" 
        scrolling="yes">
    </iframe>
</div>
<p style="text-align: center; margin-top: 20px;">
    <a href="${GITHUB_PAGES_URL}" 
       target="_blank" 
       rel="noopener noreferrer"
       style="background-color: #7B2D8E; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
        全屏查看网站 →
    </a>
</p>

------------------------------------------------------------
方案3: SEO 优化版（含 meta 标签）
------------------------------------------------------------
<!-- SEO Meta Tags -->
<meta name="description" content="怀美婷医疗 - 专业医用塑身衣品牌，联合三甲医院临床医师共同研发，提供吸脂术后恢复、产后修复等塑身解决方案。">
<meta name="keywords" content="医用塑身衣,怀美婷,吸脂术后,产后修复,塑身衣定制">

<!-- Open Graph for Social Sharing -->
<meta property="og:title" content="怀美婷医疗 - 医用塑身衣专家">
<meta property="og:description" content="专注医用塑身衣研发与生产，11款专业产品，覆盖连体衣、裤子、束乳、头面等品类">
<meta property="og:url" content="https://${WP_DOMAIN}">

<iframe 
    src="${GITHUB_PAGES_URL}" 
    width="100%" 
    height="1500px" 
    frameborder="0" 
    style="border: none; overflow: hidden;"
    scrolling="yes">
</iframe>
<p style="text-align: center; margin-top: 20px;">
    <a href="${GITHUB_PAGES_URL}" 
       target="_blank" 
       rel="noopener noreferrer"
       style="background-color: #7B2D8E; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
        全屏查看网站 →
    </a>
</p>

============================================================
部署信息
============================================================
🌐 GitHub Pages 地址: ${GITHUB_PAGES_URL}
📅 部署时间: $(date '+%Y-%m-%d %H:%M:%S')
🔄 下次更新: 只需修改代码后运行 ./deploy-auto.sh

============================================================
WordPress 设置指南
============================================================
1. 登录: https://${WP_DOMAIN}/wp-admin
2. 页面 → 新建页面 → 标题: 首页
3. 添加"自定义 HTML"块 → 粘贴上面的代码
4. 设置 → 阅读 → 首页显示 → 静态页面 → 选择"首页"
5. 完成！🎉

============================================================
EOF

print_status "✅ WordPress 嵌入代码已生成: ${WP_EMBED_FILE}"

# ============================================================
# 步骤7: 显示最终结果
# ============================================================
print_step "步骤7: 部署完成！"

echo ""
echo "============================================================"
echo "🎉 一键部署完成！"
echo "============================================================"
echo ""
echo "📊 部署结果:"
echo "┌─────────────────────────────────────────────────────────────┐"
echo "│ ✅ GitHub Actions 自动部署已配置                           │"
echo "│ ✅ 代码已推送到 GitHub                                    │"
echo "│ ✅ WordPress 嵌入代码已生成                               │"
echo "└─────────────────────────────────────────────────────────────┘"
echo ""
echo "🌐 网站地址: ${GITHUB_PAGES_URL}"
echo ""
echo "📋 下一步操作:"
echo ""
echo "  1️⃣ 复制嵌入代码:"
echo "     cat ${WP_EMBED_FILE}"
echo ""
echo "  2️⃣ 登录 WordPress:"
echo "     https://${WP_DOMAIN}/wp-admin"
echo ""
echo "  3️⃣ 创建页面并粘贴代码:"
echo "     页面 → 新建页面 → 添加"自定义 HTML"块 → 粘贴代码"
echo ""
echo "  4️⃣ 设置为首页:"
echo "     设置 → 阅读 → 选择静态页面"
echo ""
echo "  5️⃣ 测试网站:"
echo "     https://${WP_DOMAIN}"
echo ""
echo "🔄 未来更新:"
echo "   只需修改代码后运行: ./deploy-auto.sh"
echo "   网站会自动更新！"
echo ""
echo "💡 提示: 如果网站未立即显示，请等待1-2分钟"
echo "============================================================"
echo ""

# 复制嵌入代码到剪贴板（如果可用）
if command -v pbcopy &> /dev/null; then
    # macOS
    cat "$WP_EMBED_FILE" | pbcopy
    print_status "✅ 嵌入代码已复制到剪贴板！"
elif command -v xclip &> /dev/null; then
    # Linux
    cat "$WP_EMBED_FILE" | xclip -selection clipboard
    print_status "✅ 嵌入代码已复制到剪贴板！"
elif command -v clip &> /dev/null; then
    # Windows
    cat "$WP_EMBED_FILE" | clip
    print_status "✅ 嵌入代码已复制到剪贴板！"
else
    print_info "📋 请手动复制嵌入代码: cat ${WP_EMBED_FILE}"
fi

exit 0
