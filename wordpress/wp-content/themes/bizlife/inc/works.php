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
