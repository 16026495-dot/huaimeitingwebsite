# 怀美婷医疗 - WordPress 主题安装指南

## 🚀 快速开始

### 前提条件
- WordPress.com 商业版账户（需要自定义主题功能）
- 您的域名：XXX.wordpress.com
- FTP 访问权限或 WordPress.com SFTP 凭证

### 安装步骤

#### 步骤 1：准备主题文件

您的项目已经包含完整的 WordPress 主题文件：
```
huaimeitingwebsite/
├── style.css          # 主题样式
├── header.php         # 头部模板
├── footer.php         # 底部模板
├── index.php          # 首页
├── page.php           # 页面模板
├── single.php         # 文章模板
├── functions.php      # 主题功能
├── preview.html       # 预览页面（参考）
├── assets/            # 静态资源
│   ├── images/        # 图片
│   └── js/            # JavaScript
└── reference/         # 参考资料
```

#### 步骤 2：压缩主题文件夹

1. 在本地创建一个新文件夹 `huaimeiting-theme`
2. 复制以下文件到该文件夹：
   - 所有 `.php` 文件
   - `style.css`
   - `assets/` 文件夹
3. 将整个文件夹压缩为 `huaimeiting-theme.zip`

#### 步骤 3：通过 WordPress.com 后台上传

**方法 A：WordPress.com 仪表盘上传**

1. 登录 XXX.wordpress.com/wp-admin
2. 进入 **外观 → 主题**
3. 点击 **添加新主题** → **上传主题**
4. 选择 `huaimeiting-theme.zip` 文件
5. 点击 **立即安装** → **激活**

**方法 B：SFTP 上传（推荐用于商业版）**

1. 登录 WordPress.com 仪表盘
2. 进入 **设置 → 托管配置** 或 **托管 → SFTP**
3. 下载 SFTP 凭证
4. 使用 FileZilla 或其他 FTP 客户端连接：
   ```
   主机：sftp://XXX.wordpress.com
   用户名：（从 WordPress.com 获取）
   密码：（从 WordPress.com 获取）
   端口：22
   ```
5. 导航到 `/wp-content/themes/`
6. 上传解压后的 `huaimeiting-theme` 文件夹

#### 步骤 4：激活并配置主题

1. 在 **外观 → 主题** 中找到"怀美婷医疗"主题
2. 点击 **激活**
3. 进入 **自定义** 进行以下配置：

### 配置清单

#### 1. 网站基本信息
- **设置 → 常规**
  - 网站标题：怀美婷医疗
  - 副标题：医用塑身衣全生命周期解决方案
  - WordPress 地址 (URL)：https://XXX.wordpress.com
  - 网站地址 (URL)：https://XXX.wordpress.com

#### 2. 导航菜单
- **外观 → 菜单**
- 创建菜单名称："主导航"
- 添加菜单项：
  - 首页 (#home)
  - 产品中心 (#products)
  - 尺码表 (#size-chart)
  - 合作计划 (#partners)
  - 联系我们 (#contact)
- 保存菜单并分配到"主导航"位置

#### 3. 上传媒体文件
- **媒体 → 添加新媒体**
- 上传以下文件夹中的所有图片：
  - `assets/images/model.jpg`（模特图片）
  - `assets/images/products/*`（所有产品图片）
- 记录每个图片的 URL 用于后续替换

#### 4. 创建产品页面
- **页面 → 新建页面**
- 页面标题："产品中心"
- 内容：复制 `preview.html` 中产品部分的 HTML 代码
- 或者使用 WordPress 页面构建器重新创建

#### 5. 创建联系表单
- 安装 WPForms 或 Contact Form 7 插件
- 创建表单字段：
  - 姓名（必填）
  - 电话（必填）
  - 邮箱
  - 咨询类型（下拉选择）
  - 留言内容（文本域）

#### 6. SEO 设置
- 安装 Yoast SEO 或 Rank Math 插件
- 设置首页标题和描述
- 为每个产品页面添加元数据

### 方法二：使用预览页面作为落地页

如果您想直接使用 `preview.html` 作为主页：

#### 选项 A：使用 Page Builder 插件

1. 安装 Elementor 或 Beaver Builder
2. 创建新页面，标题为"首页"
3. 使用 Elementor 的 HTML 小部件
4. 将 `preview.html` 的完整代码粘贴进去
5. 设置为静态首页：**设置 → 阅读 → 首页显示 → 选择"首页"**

#### 选项 B：使用 Embed 功能

1. 先将 `preview.html` 上传到 GitHub Pages 或其他托管服务
2. 在 WordPress 页面中使用 iframe 嵌入：
```html
<iframe src="YOUR_PREVIEW_URL" width="100%" height="800px" frameborder="0"></iframe>
```

### 方法三：完全静态化部署（高级）

如果 WordPress.com 不支持自定义主题，可以考虑：

1. **升级到 WordPress.com 商业版**（$25/月）- 支持自定义主题和插件
2. **迁移到自托管的 WordPress.org**
3. **使用 Netlify/Vercel + 自定义域名**（免费方案）

### 重要注意事项

#### WordPress.com 免费版限制
- ❌ 不能上传自定义主题
- ❌ 不能安装第三方插件
- ❌ 不能编辑 PHP 文件
- ✅ 可以使用 WordPress.com 内置主题
- ✅ 可以创建页面和文章
- ✅ 可以使用基础自定义功能

#### 推荐解决方案

**对于完整功能，建议：**
1. 升级到 WordPress.com **商业计划** ($25/月)
2. 或迁移到 **WordPress.org 自托管**（需要购买域名和主机）

### 迁移到自托管 WordPress 详细步骤

#### 1. 购买域名和主机
- 域名注册商：Namecheap, GoDaddy, Cloudflare
- 主机推荐：SiteGround, Bluehost, Hostinger

#### 2. 安装 WordPress
- 大多数主机提供一键 WordPress 安装
- 或手动下载 wordpress.org 最新版本

#### 3. 通过 FTP 上传主题
```bash
# 连接到您的主机
sftp user@yourdomain.com

# 导航到主题目录
cd /public_html/wp-content/themes/

# 上传主题文件夹
put -r huaimeiting-theme/
```

#### 4. 在 WordPress 后台激活
- 登录 http://yourdomain.com/wp-admin
- 外观 → 主题 → 激活"怀美婷医疗"

#### 5. 导入内容
- 工具 → 导入 → 运行 WordPress 导入器
- 或手动创建页面和文章

### 故障排除

#### 常见问题

**Q: 上传主题后显示空白页？**
A: 检查 PHP 错误日志，确保所有函数都已正确定义

**Q: 图片不显示？**
A: 更新图片路径为 WordPress 媒体库 URL 格式：
```
旧路径：assets/images/model.jpg
新路径：https://XXX.wordpress.com/wp-content/uploads/YYYY/MM/model.jpg
```

**Q: 样式丢失？**
A: 确保 `style.css` 文件头包含正确的主题信息注释

**Q: 菜单不显示？**
A: 检查是否在 `functions.php` 中正确注册了菜单位置

### 技术支持资源

- WordPress.com 官方支持：https://wordpress.com/support
- WordPress.org 文档：https://wordpress.org/documentation
- 本项目 GitHub：https://github.com/16026495-dot/huaimeitingwebsite

---

## 📞 需要帮助？

如果在安装过程中遇到任何问题，可以：
1. 查看 WordPress 官方文档
2. 联系 WordPress.com 支持
3. 查看本项目的 GitHub Issues

祝您部署顺利！🎉
