<?php
get_header();
?>

<main id="main-content" class="single-post">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                
                <header class="post-header">
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    <div class="post-meta">
                        <span class="post-date"><?php echo get_the_date(); ?></span>
                        <span class="post-author">by <?php the_author(); ?></span>
                    </div>
                </header>
                
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                
                <div class="post-navigation">
                    <?php
                    the_post_navigation(array(
                        'prev_text' => '<span class="nav-label">← 上一篇</span> %title',
                        'next_text' => '<span class="nav-label">下一篇 →</span> %title',
                    ));
                    ?>
                </div>
            </article>
        <?php
        endwhile;
        ?>
    </div>
</main>

<style>
.single-post {
    padding-top: 120px;
    padding-bottom: 80px;
    min-height: 60vh;
}

.post-thumbnail {
    margin-bottom: 40px;
    border-radius: 16px;
    overflow: hidden;
}

.post-thumbnail img {
    width: 100%;
    height: auto;
    display: block;
}

.post-header {
    margin-bottom: 40px;
}

.post-title {
    font-size: 36px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 15px;
}

.post-meta {
    font-size: 14px;
    color: var(--text-light);
}

.post-meta span {
    margin-right: 20px;
}

.post-content {
    font-size: 16px;
    line-height: 1.8;
    color: var(--text-dark);
    margin-bottom: 60px;
}

.post-content h2 {
    font-size: 28px;
    margin-top: 40px;
    margin-bottom: 20px;
}

.post-content h3 {
    font-size: 22px;
    margin-top: 30px;
    margin-bottom: 15px;
}

.post-content p {
    margin-bottom: 20px;
}

.post-navigation {
    padding-top: 40px;
    border-top: 1px solid var(--accent-color);
}

.post-navigation a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.post-navigation a:hover {
    text-decoration: underline;
}

.nav-label {
    font-size: 14px;
    color: var(--text-light);
    display: block;
    margin-bottom: 5px;
}
</style>

<?php
get_footer();
