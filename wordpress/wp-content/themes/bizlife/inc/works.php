<?php
/**
 * Works archive helpers (query size, card args).
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Posts per page / load-more batch size for Works archives.
 */
define('BIZLIFE_WORKS_PER_PAGE', 4);

/**
 * Front-page Works slider card count.
 */
define('BIZLIFE_WORKS_FRONT_COUNT', 5);

/**
 * Limit main query on Works archive and works_category taxonomies.
 *
 * @param WP_Query $query Main query.
 */
function bizlife_works_archive_posts_per_page($query) {
  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  if ($query->is_post_type_archive('works') || $query->is_tax('works_category')) {
    $query->set('posts_per_page', BIZLIFE_WORKS_PER_PAGE);
  }
}
add_action('pre_get_posts', 'bizlife_works_archive_posts_per_page');

/**
 * Build args for template-parts/cards/works-card.php from a Works post.
 *
 * @param int|WP_Post|null $post Post object, ID, or null for global post.
 * @return array<string, mixed>
 */
function bizlife_get_works_card_args($post = null) {
  $post = get_post($post);

  if (!$post || 'works' !== $post->post_type) {
    return array(
      'href'      => '',
      'thumbnail' => get_theme_file_uri('assets/img/works/works_01.png'),
      'tags'      => array('つながるワークフロー'),
      'title'     => '',
      'company'   => '株式会社サンプル',
    );
  }

  $tags = array();
  $terms = get_the_terms($post, 'works_category');

  if ($terms && !is_wp_error($terms)) {
    foreach ($terms as $term) {
      $tags[] = $term->name;
    }
  }

  if (!$tags) {
    $tags[] = 'つながるワークフロー';
  }

  $company_name = '';
  if (function_exists('get_field')) {
    $company_name = (string) get_field('company_name', $post->ID);
  }

  if ('' === $company_name) {
    $company_name = '株式会社サンプル';
  }

  $thumbnail = get_the_post_thumbnail_url($post, 'large');
  if (!$thumbnail) {
    $thumbnail = get_theme_file_uri('assets/img/works/works_01.png');
  }

  return array(
    'href'      => get_permalink($post),
    'thumbnail' => $thumbnail,
    'tags'      => $tags,
    'title'     => get_the_title($post),
    'company'   => $company_name,
  );
}

/**
 * Works archive URL (with home_url fallback).
 *
 * @return string
 */
function bizlife_get_works_archive_url() {
  $url = get_post_type_archive_link('works');
  return $url ? $url : home_url('/works/');
}

/**
 * Query published Works posts for the front-page slider.
 *
 * @param int $posts_per_page Number of posts (default: BIZLIFE_WORKS_FRONT_COUNT).
 * @return WP_Query
 */
function bizlife_get_works_query($posts_per_page = BIZLIFE_WORKS_FRONT_COUNT) {
  return new WP_Query(
    array(
      'post_type'           => 'works',
      'post_status'         => 'publish',
      'posts_per_page'      => (int) $posts_per_page,
      'orderby'             => 'date',
      'order'               => 'DESC',
      'no_found_rows'       => true,
      'ignore_sticky_posts' => true,
    )
  );
}

/**
 * Whether the current Works main query has additional pages.
 *
 * @return bool
 */
function bizlife_works_archive_has_more() {
  global $wp_query;

  return isset($wp_query->max_num_pages) && (int) $wp_query->max_num_pages > 1;
}

/**
 * Current works_category slug on taxonomy archives, else empty string.
 *
 * @return string
 */
function bizlife_works_archive_category_slug() {
  if (!is_tax('works_category')) {
    return '';
  }

  $term = get_queried_object();

  if (!$term || is_wp_error($term) || empty($term->slug)) {
    return '';
  }

  return sanitize_title($term->slug);
}

/**
 * Term IDs of works_category assigned to a Works post.
 *
 * @param int|WP_Post|null $post Post object, ID, or null for global post.
 * @return int[]
 */
function bizlife_get_works_category_ids($post = null) {
  $post = get_post($post);

  if (!$post || 'works' !== $post->post_type) {
    return array();
  }

  $terms = get_the_terms($post, 'works_category');

  if (!$terms || is_wp_error($terms)) {
    return array();
  }

  return array_map('intval', wp_list_pluck($terms, 'term_id'));
}

/**
 * Query related Works sharing any works_category with the given post.
 *
 * Returns null when the post has no categories or no related posts exist.
 *
 * @param int|WP_Post|null $post Post object, ID, or null for global post.
 * @return WP_Query|null
 */
function bizlife_get_related_works_query($post = null) {
  $post = get_post($post);

  if (!$post || 'works' !== $post->post_type) {
    return null;
  }

  $term_ids = bizlife_get_works_category_ids($post);

  if (!$term_ids) {
    return null;
  }

  $query = new WP_Query(
    array(
      'post_type'           => 'works',
      'post_status'         => 'publish',
      'posts_per_page'      => 3,
      'post__not_in'        => array((int) $post->ID),
      'tax_query'           => array(
        array(
          'taxonomy' => 'works_category',
          'field'    => 'term_id',
          'terms'    => $term_ids,
          'operator' => 'IN',
        ),
      ),
      'orderby'             => 'date',
      'order'               => 'DESC',
      'no_found_rows'       => true,
      'ignore_sticky_posts' => true,
    )
  );

  if (!$query->have_posts()) {
    return null;
  }

  return $query;
}

/**
 * Insert featured-image column after the checkbox on Works list.
 *
 * @param array<string, string> $columns List table columns.
 * @return array<string, string>
 */
function bizlife_works_admin_columns($columns) {
  $new_columns = array();

  foreach ($columns as $key => $label) {
    $new_columns[$key] = $label;

    if ('cb' === $key) {
      $new_columns['bizlife_thumbnail'] = __('画像', 'bizlife');
    }
  }

  if (!isset($new_columns['bizlife_thumbnail'])) {
    $new_columns = array_merge(
      array(
        'bizlife_thumbnail' => __('画像', 'bizlife'),
      ),
      $new_columns
    );
  }

  return $new_columns;
}
add_filter('manage_works_posts_columns', 'bizlife_works_admin_columns');

/**
 * Render Works featured-image column cell.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function bizlife_works_admin_custom_column($column, $post_id) {
  if ('bizlife_thumbnail' !== $column) {
    return;
  }

  $post_id = (int) $post_id;

  if (has_post_thumbnail($post_id)) {
    echo get_the_post_thumbnail(
      $post_id,
      array(80, 48),
      array(
        'class' => 'bizlife-admin-thumb',
        'alt'   => '',
      )
    );
    return;
  }

  echo '<span class="bizlife-admin-thumb-empty">' . esc_html__('—', 'bizlife') . '</span>';
}
add_action('manage_works_posts_custom_column', 'bizlife_works_admin_custom_column', 10, 2);

/**
 * Enqueue admin CSS for Works list screen only.
 *
 * @param string $hook_suffix Current admin page hook.
 */
function bizlife_works_admin_assets($hook_suffix) {
  if ('edit.php' !== $hook_suffix) {
    return;
  }

  $screen = function_exists('get_current_screen') ? get_current_screen() : null;

  if (!$screen || 'works' !== $screen->post_type) {
    return;
  }

  wp_enqueue_style(
    'bizlife-admin-works',
    get_theme_file_uri('assets/css/admin-works.css'),
    array(),
    bizlife_asset_version('assets/css/admin-works.css')
  );
}
add_action('admin_enqueue_scripts', 'bizlife_works_admin_assets');
