<?php
/**
 * Blog archive Ajax (load more).
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Handle Blog home load-more Ajax.
 */
function bizlife_ajax_load_more_blog() {
  if (!check_ajax_referer('bizlife_blog_load_more', 'nonce', false)) {
    wp_send_json_error(
      array(
        'message' => __('セキュリティ検証に失敗しました。', 'bizlife'),
      ),
      403
    );
  }

  $page = isset($_POST['page']) ? absint(wp_unslash($_POST['page'])) : 0;
  if ($page < 2) {
    wp_send_json_error(
      array(
        'message' => __('不正なリクエストです。', 'bizlife'),
      ),
      400
    );
  }

  $query = new WP_Query(
    array(
      'post_type'           => 'post',
      'post_status'         => 'publish',
      'posts_per_page'      => BIZLIFE_BLOG_PER_PAGE,
      'paged'               => $page,
      'orderby'             => 'date',
      'order'               => 'DESC',
      'ignore_sticky_posts' => true,
      'no_found_rows'       => false,
    )
  );

  ob_start();

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      get_template_part(
        'template-parts/cards/blog-card',
        null,
        bizlife_get_blog_card_args(get_post())
      );
    }
    wp_reset_postdata();
  }

  $html = ob_get_clean();

  $current_page = max(1, (int) $page);
  $max_pages    = (int) $query->max_num_pages;
  $has_more     = $max_pages > 0 && $current_page < $max_pages;

  wp_send_json_success(
    array(
      'html'      => $html,
      'has_more'  => (bool) $has_more,
      'page'      => $current_page,
      'max_pages' => $max_pages,
    )
  );
}
add_action('wp_ajax_bizlife_load_more_blog', 'bizlife_ajax_load_more_blog');
add_action('wp_ajax_nopriv_bizlife_load_more_blog', 'bizlife_ajax_load_more_blog');
