<?php
get_header();
?>

<main id="main-content" class="search-page">
    <div class="container">
        <header class="search-header">
            <h1 class="search-title">搜索结果: <?php echo get_search_query(); ?></h1>
        </header>
        
        <div class="search-results">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('search-item'); ?>>
                    <h2 class="search-item-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    
                    <div class="search-item-meta">
                        <span class="post-type"><?php echo get_post_type(); ?></span>
                        <span class="post-date"><?php echo get_the_date(); ?></span>
                    </div>
                    
                    <div class="search-item-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php
                endwhile;
            ?>
            
                <div class="pagination">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '← 上一页',
                        'next_text' => '下一页 →',
                    ));
                    ?>
                </div>
            <?php
            else :
            ?>
                <div class="no-results">
                    <p>未找到相关内容，请尝试其他关键词。</p>
                    <?php get_search_form(); ?>
                </div>
            <?php
            endif;
            ?>
        </div>
    </div>
</main>

<style>
.search-page {
    padding-top: 120px;
    padding-bottom: 80px;
    min-height: 60vh;
}

.search-header {
    margin-bottom: 60px;
}

.search-title {
    font-size: 36px;
    font-weight: 700;
    color: var(--text-dark);
}

.search-results {
    max-width: 800px;
}

.search-item {
    padding: 30px 0;
    border-bottom: 1px solid var(--accent-color);
}

.search-item-title {
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 10px;
}

.search-item-title a {
    color: var(--text-dark);
    text-decoration: none;
}

.search-item-title a:hover {
    color: var(--primary-color);
}

.search-item-meta {
    font-size: 13px;
    color: var(--text-light);
    margin-bottom: 15px;
}

.search-item-meta span {
    margin-right: 15px;
}

.search-item-excerpt {
    font-size: 15px;
    color: var(--text-light);
    line-height: 1.6;
}

.no-results {
    text-align: center;
    padding: 60px;
    color: var(--text-light);
}

.no-results p {
    margin-bottom: 30px;
}
</style>

<?php
get_footer();
