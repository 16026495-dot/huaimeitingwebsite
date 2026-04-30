#!/bin/bash

# ============================================================
# 🚀 怀美婷医疗 - 一键自动备份+部署脚本
# Huaimeiting Medical - Auto Backup & Deploy Script
# ============================================================
# 功能: Git commit → GitHub push → Netlify deploy 一键完成
# 使用: ./deploy.sh "你的提交信息"  (不填则自动生成)
# ============================================================

set -e

RED='\033[0;31m'; GREEN='\033[0;32m'; YELLOW='\033[1;33m'
BLUE='\033[0;34m'; PURPLE='\033[0;35m'; CYAN='\033[0;36m'
NC='\033[0m'

print_ok() { echo -e "${GREEN}✅ $1${NC}"; }
print_warn() { echo -e "${YELLOW}⚠️  $1${NC}"; }
print_err() { echo -e "${RED}❌ $1${NC}"; }
print_info() { echo -e "${BLUE}ℹ️  $1${NC}"; }
step() { echo -e "\n${PURPLE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"; echo -e "${CYAN}🔹 $1${NC}"; }

SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
REPO_OWNER="16026495-dot"
REPO_NAME="huaimeitingwebsite"
GITHUB_URL="https://${REPO_OWNER}.github.io/${REPO_NAME}/preview.html"
TIMESTAMP=$(date '+%Y-%m-%d %H:%M:%S')
MSG="${1:-auto: 网站更新 ${TIMESTAMP}}"

echo ""
echo "╔══════════════════════════════════════════════════╗"
echo "║     🏥 怀美婷医疗 - 一键自动部署系统 🚀          ║"
echo "║   Huaimeiting Medical - Auto Deploy System       ║"
echo "╚══════════════════════════════════════════════════╝"
echo ""

cd "$SCRIPT_DIR"

# ============================================================
# STEP 1: Git 备份到 GitHub
# ============================================================
step "STEP 1/3: 备份到 GitHub"

if [ ! -d ".git" ]; then
    print_err "不是Git仓库"
    exit 1
fi

CHANGED=$(git status --porcelain | wc -l | tr -d ' ')
if [ "$CHANGED" -eq 0 ]; then
    print_warn "没有变更，跳过提交"
else
    print_info "发现 ${CHANGED} 个文件变更，正在提交..."
    git add -A
    git commit -m "${MSG}"
    git push origin main
    print_ok "✅ GitHub 备份完成！"
fi

# ============================================================
# STEP 2: 部署到 Netlify
# ============================================================
step "STEP 2/3: 部署到 Netlify"

if ! command -v netlify &> /dev/null; then
    print_warn "Netlify CLI未安装，正在安装..."
    npm install -g netlify-cli 2>/dev/null
fi

NETLIFY_STATUS=$(netlify status 2>&1 || true)
if echo "$NETLIFY_STATUS" | grep -q "Not logged in"; then
    print_warn "需要登录Netlify..."
    netlify login 2>&1 || true
fi

DEPLOY_RESULT=$(netlify deploy --prod --dir=. 2>&1) && {
    NETLIFY_URL=$(echo "$DEPLOY_RESULT" | grep -oE 'https://[^ ]+\.netlify\.app' | head -1)
    if [ -z "$NETLIFY_URL" ]; then
        NETLIFY_URL=$(echo "$DEPLOY_RESULT" | grep -oE 'https://[^ ]+' | grep netlify | head -1)
    fi
    print_ok "✅ Netlify 部署成功！"
    print_info "🌐 ${NETLIFY_URL:-请查看上面的部署URL}"
} || {
    print_warn "Netlify部署可能失败，请检查上面的输出"
}

# ============================================================
# STEP 3: 显示结果
# ============================================================
step "STEP 3/3: 完成 ✅"

echo ""
echo "┌──────────────────────────────────────────────┐"
echo "│  📦 GitHub:  https://github.com/${REPO_OWNER}/${REPO_NAME}  │"
echo "│  🌐 Pages:    ${GITHUB_URL}  │"
if [ -n "$NETLIFY_URL" ]; then
    echo "│  🚀 Netlify:  ${NETLIFY_URL}  │"
fi
echo "│  ⏰ 时间:    ${TIMESTAMP}              │"
echo "└──────────────────────────────────────────────┘"
echo ""
echo "💡 下次只需运行:  ./deploy.sh \"你的说明\""
echo ""