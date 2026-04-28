<?php
get_header();
?>

<main id="main-content" class="page-content">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="page-header">
                    <h1 class="page-title"><?php the_title(); ?></h1>
                </header>
                
                <div class="page-body">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php
        endwhile;
        ?>
    </div>
</main>

<style>
.page-content {
    padding-top: 120px;
    padding-bottom: 80px;
    min-height: 60vh;
}

.page-header {
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--accent-color);
}

.page-title {
    font-size: 36px;
    font-weight: 700;
    color: var(--text-dark);
}

.page-body {
    font-size: 16px;
    line-height: 1.8;
    color: var(--text-dark);
}

.page-body h2 {
    font-size: 28px;
    margin-top: 40px;
    margin-bottom: 20px;
}

.page-body h3 {
    font-size: 22px;
    margin-top: 30px;
    margin-bottom: 15px;
}

.page-body p {
    margin-bottom: 20px;
}

.page-body ul, .page-body ol {
    margin-bottom: 20px;
    padding-left: 30px;
}

.page-body li {
    margin-bottom: 10px;
}
</style>

<?php
get_footer();
