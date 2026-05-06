<?php
/**
 * Template for displaying all single posts
 *
 * @package huaimeiting
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

                <div class="entry-meta">
                    <span class="posted-on"><?php huaimeiting_posted_on(); ?></span>
                    <span class="byline"><?php huaimeiting_posted_by(); ?></span>
                </div>
            </header>

            <?php huaimeiting_post_thumbnail(); ?>

            <div class="entry-content">
                <?php
                the_content(
                    sprintf(
                        wp_kses(
                            __(
                                'Continue reading<span class="screen-reader-text"> "%s"</span>',
                                'huaimeiting'
                            ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    )
                );

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'huaimeiting'),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div>

            <footer class="entry-footer">
                <?php huaimeiting_entry_footer(); ?>
            </footer>
        </article>

        <?php huaimeiting_post_navigation(); ?>

        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>

</main>

<?php
get_footer();
