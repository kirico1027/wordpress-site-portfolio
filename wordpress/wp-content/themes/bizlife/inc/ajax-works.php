<?php
/**
 * Works archive Ajax (load more).
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Handle Works load-more Ajax for archive and taxonomy listings.
 */
function bizlife_ajax_load_more_works() {
  if (!check_ajax_referer('bizlife_works_load_more', 'nonce', false)) {
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

  $category_slug = '';
  if (isset($_POST['category'])) {
    $category_slug = sanitize_title(wp_unslash($_POST['category']));
  }

  $query_args = array(
    'post_type'           => 'works',
    'post_status'         => 'publish',
    'posts_per_page'      => BIZLIFE_WORKS_PER_PAGE,
    'paged'               => $page,
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true,
    'no_found_rows'       => false,
  );

  if ('' !== $category_slug) {
    $term = get_term_by('slug', $category_slug, 'works_category');

    if (!$term || is_wp_error($term)) {
      wp_send_json_error(
        array(
          'message' => __('カテゴリーが見つかりません。', 'bizlife'),
        ),
        400
      );
    }

    $query_args['tax_query'] = array(
      array(
        'taxonomy' => 'works_category',
        'field'    => 'slug',
        'terms'    => $term->slug,
      ),
    );
  }

  $query = new WP_Query($query_args);

  ob_start();

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      get_template_part(
        'template-parts/cards/works-card',
        null,
        bizlife_get_works_card_args(get_post())
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
      'html'     => $html,
      'has_more' => (bool) $has_more,
      'page'     => $current_page,
      'max_pages'=> $max_pages,
    )
  );
}
add_action('wp_ajax_bizlife_load_more_works', 'bizlife_ajax_load_more_works');
add_action('wp_ajax_nopriv_bizlife_load_more_works', 'bizlife_ajax_load_more_works');
