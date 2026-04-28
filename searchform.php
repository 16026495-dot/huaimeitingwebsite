<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="search-field" class="screen-reader-text">搜索</label>
    <input type="search" id="search-field" class="search-field" placeholder="搜索..." value="<?php echo get_search_query(); ?>" name="s">
    <button type="submit" class="search-submit">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <path d="M21 21l-4.35-4.35"/>
        </svg>
    </button>
</form>

<style>
.search-form {
    display: flex;
    align-items: center;
    gap: 10px;
}

.search-field {
    padding: 12px 20px;
    border: 2px solid var(--accent-color);
    border-radius: 8px;
    font-size: 16px;
    width: 300px;
    transition: var(--transition);
}

.search-field:focus {
    outline: none;
    border-color: var(--primary-color);
}

.search-submit {
    padding: 12px 20px;
    background: var(--gradient-primary);
    border: none;
    border-radius: 8px;
    color: var(--white);
    cursor: pointer;
    transition: var(--transition);
}

.search-submit:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.screen-reader-text {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}
</style>
