<?php
get_header();
?>

<main id="main-content" class="archive-page">
    <div class="container">
        <header class="archive-header">
            <h1 class="archive-title"><?php the_archive_title(); ?></h1>
            <?php if (the_archive_description()) : ?>
                <div class="archive-description"><?php the_archive_description(); ?></div>
            <?php endif; ?>
        </header>
        
        <div class="posts-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-card-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="post-card-content">
                        <h2 class="post-card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        
                        <div class="post-card-meta">
                            <span class="post-date"><?php echo get_the_date(); ?></span>
                        </div>
                        
                        <div class="post-card-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                        
                        <a href="<?php the_permalink(); ?>" class="btn btn-secondary">阅读更多</a>
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
                <p class="no-posts">暂无内容</p>
            <?php
            endif;
            ?>
        </div>
    </div>
</main>

<style>
.archive-page {
    padding-top: 120px;
    padding-bottom: 80px;
    min-height: 60vh;
}

.archive-header {
    margin-bottom: 60px;
    text-align: center;
}

.archive-title {
    font-size: 36px;
    font-weight: 700;
    color: var(--text-dark);
}

.archive-description {
    margin-top: 15px;
    color: var(--text-light);
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.post-card {
    background: var(--white);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
}

.post-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
}

.post-card-image {
    height: 200px;
    overflow: hidden;
}

.post-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.post-card:hover .post-card-image img {
    transform: scale(1.05);
}

.post-card-content {
    padding: 25px;
}

.post-card-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 10px;
}

.post-card-title a {
    color: var(--text-dark);
    text-decoration: none;
}

.post-card-title a:hover {
    color: var(--primary-color);
}

.post-card-meta {
    font-size: 13px;
    color: var(--text-light);
    margin-bottom: 15px;
}

.post-card-excerpt {
    font-size: 14px;
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 20px;
}

.pagination {
    grid-column: 1 / -1;
    text-align: center;
    margin-top: 40px;
}

.pagination .nav-links {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.pagination a, .pagination span {
    padding: 10px 15px;
    border: 1px solid var(--accent-color);
    border-radius: 8px;
    text-decoration: none;
    color: var(--text-dark);
}

.pagination a:hover {
    background: var(--primary-color);
    color: var(--white);
    border-color: var(--primary-color);
}

.pagination .current {
    background: var(--primary-color);
    color: var(--white);
    border-color: var(--primary-color);
}

.no-posts {
    grid-column: 1 / -1;
    text-align: center;
    padding: 60px;
    color: var(--text-light);
}

@media (max-width: 1024px) {
    .posts-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .posts-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php
get_footer();
