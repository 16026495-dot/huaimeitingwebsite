<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header id="masthead">
    <div class="header-container">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
            <div class="logo-icon">华</div>
            <span>华美婷医疗</span>
        </a>
        
        <nav id="site-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_class'     => '',
                'container'      => false,
                'fallback_cb'    => 'huaimeiting_default_menu',
            ));
            ?>
        </nav>
    </div>
</header>

<?php
function huaimeiting_default_menu() {
    ?>
    <ul>
        <li><a href="#home">首页</a></li>
        <li><a href="#strengths">核心优势</a></li>
        <li><a href="#products">产品服务</a></li>
        <li><a href="#features">特色服务</a></li>
        <li><a href="#contact">联系我们</a></li>
    </ul>
    <?php
}
