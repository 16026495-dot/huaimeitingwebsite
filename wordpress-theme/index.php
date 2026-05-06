<?php
/**
 * The main template file
 *
 * @package huaimeiting
 */

get_header();
?>

<main id="primary" class="site-main">

<?php if (is_front_page()) : ?>

    <!-- 产品展示区 Products Section -->
    <section id="products" class="products-section section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php _e('四大产品系列 Four Product Categories', 'huaimeiting'); ?></h2>
            </div>

            <div class="products-grid" id="productsGrid">
                <?php
                $categories = huaimeiting_get_product_categories();
                foreach ($categories as $cat_id => $cat) :
                    $query = new WP_Query(array(
                        'post_type'      => 'product',
                        'posts_per_page' => -1,
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'product_category',
                                'field'    => 'slug',
                                'terms'    => $cat_id,
                            ),
                        ),
                    ));
                    ?>
                    <div class="category-card">
                        <div class="card-top">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/category-<?php echo $cat_id; ?>.jpg"
                                 alt="<?php echo esc_attr($cat['name']); ?>"
                                 loading="lazy">
                            <div class="card-top-overlay">
                                <div class="card-icon"><i class="<?php echo $cat['icon']; ?>"></i></div>
                                <div class="card-title"><?php echo $cat['name']; ?></div>
                                <div class="card-subtitle"><?php echo $cat['desc']; ?></div>
                            </div>
                            <div class="card-badge"><?php echo $query->found_posts; ?></div>
                        </div>
                        <div class="card-body">
                            <div class="card-desc"><?php echo $cat['desc']; ?></div>
                            <div class="card-expand-hint">
                                <i class="fas fa-chevron-down"></i>
                                <?php printf(__('点击展开查看 %d 款产品 Click to expand', 'huaimeiting'), $query->found_posts); ?>
                            </div>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 关于我们 About Section -->
    <section id="about" class="about-section section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php _e('关于我们 About Us', 'huaimeiting'); ?></h2>
            </div>
            <div class="about-content">
                <?php
                $about_page = get_page_by_path('about-us');
                if ($about_page) {
                    echo apply_filters('the_content', $about_page->post_content);
                } else {
                    echo '<p>' . get_bloginfo('description') . '</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- 联系我们 Contact Section -->
    <section id="contact" class="contact-section section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title"><?php _e('联系我们 Contact Us', 'huaimeiting'); ?></h2>
            </div>

            <div class="contact-grid">
                <div class="contact-info-cards">
                    <?php huaimeiting_contact_info(); ?>
                </div>

                <div class="contact-form-wrapper">
                    <h3><?php _e('在线询价 Inquiry Form', 'huaimeiting'); ?></h3>
                    <?php echo do_shortcode('[contact-form-7 id="123" title="Inquiry Form"]'); ?>
                    <!-- 或使用WPForms/Ninja Forms短代码 -->
                </div>
            </div>
        </div>
    </section>

<?php else : ?>

    <!-- 标准文章循环 Standard Loop -->
    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>

                    <?php if ('post' === get_post_type()) : ?>
                    <div class="entry-meta">
                        <span class="posted-on"><?php huaimeiting_posted_on(); ?></span>
                        <span class="byline"><?php huaimeiting_posted_by(); ?></span>
                    </div><!-- .entry-meta -->
                    <?php endif; ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content(sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'huaimeiting'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ));

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'huaimeiting'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div><!-- .entry-content -->
            </article>

        <?php endwhile; ?>

        <!-- 分页 Pagination -->
        <div class="pagination">
            <?php
            the_posts_pagination(array(
                'mid_size'           => 2,
                'prev_text'          => __('Previous', 'huaimeiting'),
                'next_text'          => __('Next', 'huaimeiting'),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . sprintf(__('Page %s', 'huaimeiting'), '%') . ' </span>',
            ));
            ?>

        <?php else : ?>

            <p><?php _e('没有找到内容 No content found', 'huaimeiting'); ?></p>

        <?php endif; ?>

<?php endif; ?>

</main><!-- #main -->

<?php
get_footer();
