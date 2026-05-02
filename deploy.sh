#!/bin/bash

# ============================================================
# 🚀 怀美婷医疗 - 一键自动备份+部署脚本
# Huaimeiting Medical - Auto Backup & Deploy
# ============================================================
# 用法: ./deploy.sh "提交说明"
# 效果: Git Push → 自动触发 GitHub Pages + Netlify 部署
# ============================================================

set -e

RED='\033[0;31m'; GREEN='\033[0;32m'; YELLOW='\033[1;33m'
BLUE='\033[0;34m'; PURPLE='\033[0;35m'; CYAN='\033[0;36m'; NC='\033[0m'

ok() { echo -e "${GREEN}✅ $1${NC}"; }
warn() { echo -e "${YELLOW}⚠️  $1${NC}"; }
err() { echo -e "${RED}❌ $1${NC}"; }
info() { echo -e "${BLUE}ℹ️  $1${NC}"; }
step() { echo -e "\n${PURPLE}━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━${NC}"; echo -e "${CYAN}🔹 $1${NC}"; }

cd "$(dirname "$0")"
MSG="${1:-auto: update $(date '+%Y-%m-%d %H:%M')}"
REPO="16026495-dot/huaimeitingwebsite"
GITHUB_PAGES="https://16026495-dot.github.io/huaimeitingwebsite/preview.html"

echo ""
echo "╔════════════════════════════════════════╗"
echo "║   🏥 怀美婷医疗 一键部署系统 🚀       ║"
echo "╚════════════════════════════════════════╝"
echo ""

step "检查变更"
CHANGED=$(git status --porcelain | wc -l | tr -d ' ')
if [ "$CHANGED" -eq 0 ]; then
    warn "没有变更，无需部署"
    exit 0
fi
info "发现 ${CHANGED} 个文件变更"

step "Git 提交 + 推送"
git add -A
git commit -m "${MSG}"
git push origin main
ok "已推送到 GitHub！"

step "自动部署已触发"
echo ""
echo "┌──────────────────────────────────────────┐"
echo "│  📦 GitHub:   github.com/${REPO}     │"
echo "│  🌐 Pages:    ${GITHUB_PAGES}"
echo "│  🚀 Netlify:  (Actions自动部署)        │"
echo "│  ⏰ 时间:     $(date '+%Y-%m-%d %H:%M:%S')        │"
echo "└──────────────────────────────────────────┘"
echo ""
info "GitHub Actions 正在自动部署到 GitHub Pages 和 Netlify"
info "约1-2分钟后生效，无需任何其他操作 ✅"
echo ""