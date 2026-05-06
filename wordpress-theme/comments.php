<?php
/**
 * The template for displaying comments
 *
 * @package huaimeiting
 */

if (post_password_required()) {{
    return;
}}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {{
                printf(
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'huaimeiting'),
                    '<span>' . wp_kses(get_the_title(), array()) . '</span>'
                );
            }} else {{
                printf(
                    esc_html(
                        _nx(
                            '%1$s thought on &ldquo;%2$s&rdquo;',
                            '%1$s thoughts on &ldquo;%2$s&rdquo;',
                            $comment_count,
                            'comments title',
                            'huaimeiting'
                        )
                    ),
                    number_format_i18n($comment_count),
                    '<span>' . wp_kses(get_the_title(), array()) . '</span>'
                );
            }}
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol>

    <?php endif; ?>

    <?php
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
        ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'huaimeiting'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'logged_in_as' => null,
        'title_reply'  => __('Leave a Comment', 'huaimeiting'),
    ));
    ?>
</div>
