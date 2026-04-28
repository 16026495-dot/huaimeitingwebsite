<aside id="secondary" class="widget-area">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <div class="widget">
            <h3 class="widget-title">关于我们</h3>
            <p>华美婷专注医用塑身衣研发与生产，为术后、产后人群提供安全有效的康复解决方案。</p>
        </div>
        
        <div class="widget">
            <h3 class="widget-title">联系方式</h3>
            <p>电话: 400-XXX-XXXX</p>
            <p>邮箱: contact@huaimeiting.com</p>
        </div>
    <?php endif; ?>
</aside>

<style>
.widget-area {
    padding: 20px;
    background: var(--accent-color);
    border-radius: 16px;
}

.widget {
    margin-bottom: 30px;
}

.widget:last-child {
    margin-bottom: 0;
}

.widget-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--primary-color);
}

.widget p {
    font-size: 14px;
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 10px;
}

.widget ul {
    list-style: none;
}

.widget li {
    padding: 8px 0;
    border-bottom: 1px solid rgba(44, 95, 124, 0.1);
}

.widget li:last-child {
    border-bottom: none;
}

.widget a {
    color: var(--text-dark);
    text-decoration: none;
    transition: var(--transition);
}

.widget a:hover {
    color: var(--primary-color);
}
</style>
