<?php

function huaimeiting_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'huaimeiting-medical'),
        'footer' => __('Footer Menu', 'huaimeiting-medical'),
    ));
}
add_action('after_setup_theme', 'huaimeiting_setup');

function huaimeiting_scripts() {
    wp_enqueue_style('huaimeiting-style', get_stylesheet_uri(), array(), '1.0');
    wp_enqueue_script('huaimeiting-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'huaimeiting_scripts');

function huaimeiting_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'huaimeiting-medical'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in your footer.', 'huaimeiting-medical'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'huaimeiting_widgets_init');

function huaimeiting_custom_post_types() {
    register_post_type('product', array(
        'labels' => array(
            'name'          => __('Products', 'huaimeiting-medical'),
            'singular_name' => __('Product', 'huaimeiting-medical'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'supports'     => array('title', 'editor', 'thumbnail'),
        'menu_icon'    => 'dashicons-products',
    ));
}
add_action('init', 'huaimeiting_custom_post_types');
