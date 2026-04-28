<?php
get_header();
?>

<main id="main-content" class="error-404">
    <div class="container">
        <div class="error-content">
            <div class="error-number">404</div>
            <h1 class="error-title">页面未找到</h1>
            <p class="error-description">抱歉，您访问的页面不存在或已被移除。</p>
            <div class="error-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">返回首页</a>
            </div>
        </div>
    </div>
</main>

<style>
.error-404 {
    min-height: 60vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding-top: 80px;
}

.error-content {
    text-align: center;
    padding: 60px 20px;
}

.error-number {
    font-size: 120px;
    font-weight: 800;
    color: var(--accent-color);
    line-height: 1;
    margin-bottom: 20px;
}

.error-title {
    font-size: 36px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 20px;
}

.error-description {
    font-size: 18px;
    color: var(--text-light);
    margin-bottom: 40px;
}
</style>

<?php
get_footer();
