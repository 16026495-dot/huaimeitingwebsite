<?php
/**
 * The header template
 *
 * @package huaimeiting
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <!-- 怀美婷特定头部信息 -->
    <?php echo self.head_content; ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'huaimeiting'); ?></a>

    <!-- 导航栏 Navigation -->
    <nav id="site-navigation" class="main-navigation">
        <div class="container">
            <div class="logo-area">
                <?php huaimeiting_logo(); ?>
            </div>

            <button class="mobile-toggle" aria-label="<?php esc_attr_e('Menu', 'huaimeiting'); ?>">
                <span></span><span></span><span></span>
            </button>

            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id'        => 'primary-menu',
                'container_class'=> 'nav-menu',
                'fallback_cb'    => false,
            ));
            ?>
        </div>
    </nav>

    <!-- Hero Section -->
    <?php if (is_front_page()) : ?>
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title"><?php bloginfo('name'); ?></h1>
                <p class="hero-subtitle"><?php bloginfo('description'); ?></p>
                <div class="hero-actions">
                    <a href="#products" class="btn-hero-primary">
                        <i class="fas fa-th-large"></i> <?php _e('浏览全部产品 Browse Products', 'huaimeiting'); ?>
                    </a>
                    <a href="#contact" class="btn-hero-outline">
                        <i class="fab fa-whatsapp"></i> <?php _e('WhatsApp咨询 Contact Us', 'huaimeiting'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <div id="content" class="site-content">
