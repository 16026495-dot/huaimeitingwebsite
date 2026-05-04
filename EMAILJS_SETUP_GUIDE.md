# 📧 EmailJS Setup Guide - 怀美婷询价表单邮件配置

## ✅ 问题已修复！

表单提交功能已从 **web3forms（失效）** 升级为 **EmailJS（可靠）**

---

## 🚀 快速配置步骤（5分钟完成）

### **Step 1: 注册 EmailJS (免费)**

1. 访问：https://www.emailjs.com/
2. 点击 **"Sign Up Free"** 或 **"Get Started"**
3. 使用 Gmail / Google 账号注册
4. 登录后进入 Dashboard

---

### **Step 2: 创建 Email Service (邮件服务)**

1. 点击 **"Email Services"** → **"Add New Service"**
2. 选择 **"Gmail"** (推荐，免费)
3. 点击 **"Connect Account"** → 授权 Google 账号
4. **Service ID** 会自动生成（类似：`service_abc123`）
5. 复制这个 **Service ID**

---

### **Step 3: 创建 Email Template (邮件模板)**

1. 点击 **"Email Templates"** → **"Create New Template"**
2. **Template Name**: `inquiry` （必须用这个名字！）
3. 填写以下内容：

#### **Subject (主题):**
```
【怀美婷官网询价】{{from_name}} - {{product}}
```

#### **Body (正文内容):**
```
<html>
<body style="font-family: Arial, sans-serif; padding: 20px; background-color: #f9f5ff;">
<div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(124,58,237,0.15); overflow: hidden;">

<!-- Header -->
<div style="background: linear-gradient(135deg, #7c3aed, #5b21b6); color: white; padding: 30px; text-align: center;">
<h1 style="margin: 0; font-size: 28px;">🎉 新客户询价通知</h1>
<p style="margin: 10px 0 0 0; opacity: 0.9;">New Customer Inquiry from Huaimeiting Website</p>
</div>

<!-- Content -->
<div style="padding: 30px;">

<div style="background: #f8f5ff; border-left: 4px solid #7c3aed; padding: 20px; margin-bottom: 25px; border-radius: 6px;">
<h2 style="margin: 0 0 15px 0; color: #7c3aed;">📋 客户信息 Customer Information</h2>

<table style="width: 100%; border-collapse: collapse;">
<tr>
<td style="padding: 10px; border-bottom: 1px solid #e9d5ff;"><strong>👤 姓名 Name:</strong></td>
<td style="padding: 10px; border-bottom: 1px solid #e9d5ff;">{{from_name}}</td>
</tr>
<tr>
<td style="padding: 10px; border-bottom: 1px solid #e9d5ff;"><strong>📱 联系方式 Contact:</strong></td>
<td style="padding: 10px; border-bottom: 1px solid #e9d5ff;">{{contact}}</td>
</tr>
<tr>
<td style="padding: 10px; border-bottom: 1px solid #e9d5ff;"><strong>📦 感兴趣产品 Product:</strong></td>
<td style="padding: 10px; border-bottom: 1px solid #e9d5ff;">{{product}}</td>
</tr>
<tr>
<td style="padding: 10px;"><strong>💬 留言 Message:</strong></td>
<td style="padding: 10px;">{{message}}</td>
</tr>
</table>
</div>

<div style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; border-radius: 6px; font-size: 14px;">
<strong>⏰ 提交时间 Submit Time:</strong> {{submit_time}}
</div>

</div>

<!-- Footer -->
<div style="background: #f8f5ff; padding: 20px; text-align: center; font-size: 13px; color: #666;">
<p style="margin: 0;">此邮件来自怀美婷官方网站询价表单 | This email is from Huaimeiting Website Inquiry Form</p>
<p style="margin: 5px 0 0 0;">📧 回复邮箱 Reply to: {{reply_to}}</p>
</div>

</div>
</body>
</html>
```

4. **Variables (变量)** - 确保包含这些：
   - `{{from_name}}` - 客户姓名
   - `{{to_name}}` - 收件人名称
   - `{{contact}}` - 联系方式
   - `{{product}}` - 产品名称
   - `{{message}}` - 留言
   - `{{reply_to}}` - 回复邮箱
   - `{{submit_time}}` - 提交时间

5. 点击 **"Save Template"**

---

### **Step 4: 获取 Public Key (公钥)**

1. 点击 **"Account"** → **"General"**
2. 找到 **"Public Key"** 部分
3. 复制你的 **Public Key** (类似：`abc123XYZ_def456`)

---

### **Step 5: 更新网站代码**

打开文件：`preview.html`

找到这一行（约第1465行）：
```javascript
emailjs.send('service_huaimeiting', 'template_inquiry', templateParams, 'YOUR_EMAILJS_PUBLIC_KEY')
```

替换为你的实际信息：
```javascript
emailjs.send('YOUR_SERVICE_ID', 'template_inquiry', templateParams, 'YOUR_PUBLIC_KEY')
```

**示例：**
```javascript
emailjs.send('service_abc123xyz', 'template_inquiry', templateParams, 'AbCdEfGhIjKlMnOpQrStUvWxYz')
```

---

## 🎯 配置完成后：

✅ **客户填写表单** → 点击提交  
✅ **您收到精美HTML邮件** → 包含所有客户信息  
✅ **自动回复确认** → 可选功能  
✅ **备用方案** → 如果EmailJS失败，自动打开邮件客户端  

---

## 💡 高级选项（可选）

### **Option 1: 自动回复客户**

在 EmailJS Template 中添加：

**To Email:** `{{reply_to}}` (如果客户留了邮箱)

这样客户也会收到确认邮件！

---

### **Option 2: 多人接收**

创建多个 Service，或使用邮箱转发规则。

---

## ❓ 常见问题

**Q: 免费额度够用吗？**  
A: EmailJS 免费版每月 **200封邮件**，足够小型业务使用。

**Q: 需要信用卡吗？**  
A: 不需要！完全免费。

**Q: 安全吗？**  
A: 很安全。Public Key 只能发送邮件，不能读取。

**Q: 可以自定义发件人吗？**  
A: 可以，在 Template 设置中修改 "From" 字段。

---

## 🔧 技术支持

- **EmailJS 文档**: https://www.emailjs.com/docs/
- **EmailJS 支持**: support@emailjs.com
- **本项目文件**: `/Users/chenting/Desktop/huaimeitingwebsite/preview.html`

---

## ✨ 完成！

配置好 EmailJS 后，您的询价表单就能正常工作了！

**测试方法：**
1. 打开网页
2. 填写表单
3. 点击 "提交咨询"
4. 检查收件箱（包括垃圾邮件文件夹）

祝生意兴隆！🚀

---

*最后更新: 2026-05-05*
*版本: v2.0 - EmailJS Integration*
