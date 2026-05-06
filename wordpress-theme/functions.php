<?php
/**
 * 怀美婷医疗 Huaimeiting Medical - 功能文件
 * Theme Functions
 *
 * @package huaimeiting
 * @version 2.5.0
 */

if (!defined('ABSPATH')) {
    exit; // 防止直接访问
}

// ============================================
// 🎯 主题设置
// Theme Setup
// ============================================

function huaimeiting_setup() {
    // 添加主题支持
    add_theme_support('post-thumbnails'); // 特色图片
    add_theme_support('title-tag'); // 标签支持
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ));
    add_theme_support('customize-selective-refresh-widgets');

    // 注册导航菜单
    register_nav_menus(array(
        'primary'   => __('主导航菜单 Primary Menu', 'huaimeiting'),
        'footer'    => __('页脚菜单 Footer Menu', 'huaimeiting'),
        'mobile'    => __('移动端菜单 Mobile Menu', 'huaimeiting'),
    ));

    // 加载文本域 (多语言)
    load_theme_textdomain('huaimeiting', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'huaimeiting_setup');

// ============================================
// 📦 样式和脚本加载
// Enqueue Styles & Scripts
// ============================================

function huaimeiting_scripts() {
    // 主样式表
    wp_enqueue_style(
        'huaimeiting-style',
        get_stylesheet_uri(),
        array(),
        '2.5.0'
    );

    // Google Fonts
    wp_enqueue_style(
        'huaimeiting-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Noto+Sans+SC:wght@400;500;600;700;900&display=swap',
        array(),
        null
    );

    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
    );

    // EmailJS
    wp_enqueue_script(
        'emailjs',
        'https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js',
        array(),
        '3.2.0',
        true
    );

    // 主脚本
    wp_enqueue_script(
        'huaimeiting-main',
        get_template_directory_uri() . '/js/main.js',
        array(),
        '2.5.0',
        true
    );

    // 评论回复脚本
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'huaimeiting_scripts');

// ============================================
// 🎨 小部件区域
// Widget Areas
// ============================================

function huaimeiting_widgets_init() {
    register_sidebar(array(
        'name'          => __('侧边栏 Sidebar', 'huaimeiting'),
        'id'            => 'sidebar-1',
        'description'   => __('添加小部件到这里 Add widgets here', 'huaimeiting'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('页脚第1栏 Footer Column 1', 'huaimeiting'),
        'id'            => 'footer-1',
        'description'   => __('页脚第一列 Footer first column', 'huaimeiting'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('页脚第2栏 Footer Column 2', 'huaimeiting'),
        'id'            => 'footer-2',
        'description'   => __('页脚第二列 Footer second column', 'huaimeiting'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'huaimeiting_widgets_init');

// ============================================
// 🔧 自定义功能
// Custom Functions
// ============================================

/**
 * 获取产品分类
 * Get Product Categories
 */
function huaimeiting_get_product_categories() {
    $categories = array(
        'medical'     => array(
            'name' => '医美术后修复 Post-Surgery Recovery',
            'icon' => 'fa-hospital-user',
            'desc' => '吸脂术后恢复、隆胸修复等专用压力产品',
        ),
        'postpartum'  => array(
            'name' => '产后修复 Postpartum Repair',
            'icon' => 'fa-baby-carriage',
            'desc' => '产后身材恢复、盆底肌修复等专业方案',
        ),
        'scar'        => array(
            'name' => '疤痕修复 Scar Treatment',
            'icon' => 'fa-band-aid',
            'desc' => '疤痕管理、增生预防及修复护理',
        ),
        'health'      => array(
            'name' => '伦美大健康 Lummore Health',
            'icon' => 'fa-heart-pulse',
            'desc' => '科学营养补充、内调外养健康管理',
        ),
    );
    return apply_filters('huaimeiting_product_categories', $categories);
}

/**
 * 显示联系信息
 * Display Contact Info
 */
function huaimeiting_contact_info() {
    ?>
    <div class="contact-info">
        <div class="contact-item">
            <i class="fab fa-weixin"></i>
            <span>WeChat: Anne1413191</span>
        </div>
        <div class="contact-item">
            <i class="fab fa-whatsapp"></i>
            <span>WhatsApp: +86 191-2134-1333</span>
        </div>
        <div class="contact-item">
            <i class="fas fa-envelope"></i>
            <span>Email: huaimeiting@gmail.com</span>
        </div>
        <div class="contact-item">
            <i class="fas fa-phone"></i>
            <span>Tel: +86 191-2134-1333</span>
        </div>
    </div>
    <?php
}

/**
 * 自定义Logo输出
 * Custom Logo Output
 */
function huaimeiting_logo() {
    if (has_custom_logo()) {
        the_custom_logo();
    } else {
        echo '<h1 class="site-title">' . get_bloginfo('name') . '</h1>';
    }
}

// ============================================
// 🔒 安全增强
// Security Enhancements
// ============================================

// 移除WordPress版本号 (安全)
remove_action('wp_head', 'wp_generator');

// 禁止XML-RPC (防止暴力破解)
add_filter('xmlrpc_enabled', '__return_false');

// ============================================
// 📊 性能优化
// Performance Optimization
// ============================================

// 禁用emoji (加速)
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// 移除REST API链接 (如果不需要)
remove_action('wp_head', 'rest_output_link_wp_head', 10);

// ============================================
// 🌐 多语言支持准备
// i18n Preparation
// ============================================

/**
 * 翻译辅助函数
 * Translation Helper
 *
 * Usage: _t('Hello World')
 */
function _t($text) {
    return __($text, 'huaimeiting');
}

// END of functions.php
