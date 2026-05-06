<?php
/**
 * The footer template
 *
 * @package huaimeiting
 */
?>

    </div><!-- #content -->

    <!-- 页脚 Footer -->
    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
                <div class="footer-col">
                    <?php dynamic_sidebar('footer-2'); ?>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All Rights Reserved.', 'huaimeiting'); ?></p>
                <p><?php printf(__('Powered by %s', 'huaimeiting'), '<a href="https://wordpress.org">WordPress</a>'); ?></p>
            </div>
        </div>
    </footer>

</div><!-- #page -->

<!-- 浮动按钮 Floating Buttons -->
<div class="floating-buttons">
    <a href="https://wa.me/861921341333?text=Hi, I'm interested in your products"
       target="_blank"
       class="float-btn float-btn-whatsapp"
       title="<?php esc_attr_e('WhatsApp咨询 WhatsApp Inquiry', 'huaimeiting'); ?>">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="javascript:void(0)"
       onclick="openWechatModal()"
       class="float-btn float-btn-wechat"
       title="<?php esc_attr_e('微信咨询 WeChat Inquiry', 'huaimeiting'); ?>">
        <i class="fab fa-weixin"></i>
    </a>
    <a href="#" class="float-btn float-btn-top" onclick="scrollToTop()" title="<?php esc_attr_e('回到顶部 Back to Top', 'huaimeiting'); ?>">
        <i class="fas fa-chevron-up"></i>
    </a>
</div>

<?php wp_footer(); ?>

</body>
</html>
