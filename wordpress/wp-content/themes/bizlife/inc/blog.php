<?php
/**
 * Blog (standard post) helpers for archive, sidebar, cards, and pickup.
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Posts shown in the Blog archive grid / load-more batch (static template: 6).
 */
define('BIZLIFE_BLOG_PER_PAGE', 6);

/**
 * Featured slider slide count (static template: 5).
 */
define('BIZLIFE_BLOG_FEATURED_COUNT', 5);

/**
 * Pick up cards on Blog single / sidebar (static template: 3).
 */
define('BIZLIFE_BLOG_PICKUP_COUNT', 3);

/**
 * Fallback category label when a post has no category.
 */
define('BIZLIFE_BLOG_CATEGORY_FALLBACK', 'お役立ち情報');

/**
 * Limit main query on the Posts page (Blog archive) only.
 *
 * Does not affect category archives, search, or admin.
 *
 * @param WP_Query $query Main query.
 */
function bizlife_blog_archive_posts_per_page($query) {
  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  if ($query->is_home()) {
    $query->set('posts_per_page', BIZLIFE_BLOG_PER_PAGE);
  }

  // Blog sidebar search sends post_type=post; keep results to standard posts.
  if ($query->is_search()) {
    $post_type = isset($_GET['post_type']) ? sanitize_key(wp_unslash($_GET['post_type'])) : '';
    if ('post' === $post_type) {
      $query->set('post_type', 'post');
    }
  }
}
add_action('pre_get_posts', 'bizlife_blog_archive_posts_per_page');

/**
 * Whether the Blog home main query has additional pages.
 *
 * @return bool
 */
function bizlife_blog_archive_has_more() {
  global $wp_query;

  if (!$wp_query instanceof WP_Query) {
    return false;
  }

  return (int) $wp_query->max_num_pages > 1;
}

/**
 * Fallback thumbnail URL for Blog cards / featured slides.
 *
 * @return string
 */
function bizlife_blog_fallback_thumbnail_url() {
  return get_theme_file_uri('assets/img/blog/blog-featured_01.png');
}

/**
 * Fallback hero image URL for Blog single.
 *
 * @return string
 */
function bizlife_blog_single_hero_fallback_url() {
  return get_theme_file_uri('assets/img/blog/blog-single_hero.png');
}

/**
 * Category names for a post (fallback when empty).
 *
 * @param int|WP_Post|null $post Post object, ID, or null for global post.
 * @return array<int, string>
 */
function bizlife_get_blog_category_names($post = null) {
  $post = get_post($post);
  $names = array();

  if ($post) {
    $categories = get_the_category($post->ID);
    if ($categories) {
      foreach ($categories as $category) {
        $names[] = $category->name;
      }
    }
  }

  if (!$names) {
    $names[] = BIZLIFE_BLOG_CATEGORY_FALLBACK;
  }

  return $names;
}

/**
 * Categories for the Blog sidebar (hide empty).
 *
 * Design terms (お役立ち情報 / 導入事例 / 働き方) are listed first when present.
 *
 * @return array<int, WP_Term>
 */
function bizlife_get_blog_sidebar_categories() {
  $categories = get_categories(
    array(
      'taxonomy'   => 'category',
      'hide_empty' => true,
    )
  );

  if (!$categories || is_wp_error($categories)) {
    return array();
  }

  $priority = array(
    'useful-info' => 1,
    'case-study'  => 2,
    'work-style'  => 3,
  );

  usort(
    $categories,
    function ($a, $b) use ($priority) {
      $pa = isset($priority[$a->slug]) ? $priority[$a->slug] : 100;
      $pb = isset($priority[$b->slug]) ? $priority[$b->slug] : 100;

      if ($pa !== $pb) {
        return $pa - $pb;
      }

      return strcasecmp($a->name, $b->name);
    }
  );

  return $categories;
}

/**
 * Build args for template-parts/cards/blog-card.php.
 *
 * @param int|WP_Post|null $post Post object, ID, or null for global post.
 * @return array<string, mixed>
 */
function bizlife_get_blog_card_args($post = null) {
  $post = get_post($post);

  if (!$post || 'post' !== $post->post_type) {
    return array(
      'href'      => '',
      'thumbnail' => bizlife_blog_fallback_thumbnail_url(),
      'tags'      => array(BIZLIFE_BLOG_CATEGORY_FALLBACK),
      'title'     => '',
      'datetime'  => '',
      'date'      => '',
    );
  }

  $thumbnail = get_the_post_thumbnail_url($post, 'large');
  if (!$thumbnail) {
    $thumbnail = bizlife_blog_fallback_thumbnail_url();
  }

  return array(
    'href'      => get_permalink($post),
    'thumbnail' => $thumbnail,
    'tags'      => bizlife_get_blog_category_names($post),
    'title'     => get_the_title($post),
    'datetime'  => get_the_date('Y-m-d', $post),
    'date'      => get_the_date('Y/n/j', $post),
  );
}

/**
 * Build args for template-parts/cards/blog-pickup.php.
 *
 * @param int|WP_Post|null $post Post object, ID, or null for global post.
 * @return array<string, mixed>
 */
function bizlife_get_blog_pickup_args($post = null) {
  $post = get_post($post);
  $names = bizlife_get_blog_category_names($post);

  if (!$post || 'post' !== $post->post_type) {
    return array(
      'href'      => '',
      'thumbnail' => bizlife_blog_fallback_thumbnail_url(),
      'title'     => '',
      'category'  => $names[0],
    );
  }

  $thumbnail = get_the_post_thumbnail_url($post, 'medium_large');
  if (!$thumbnail) {
    $thumbnail = bizlife_blog_fallback_thumbnail_url();
  }

  return array(
    'href'      => get_permalink($post),
    'thumbnail' => $thumbnail,
    'title'     => get_the_title($post),
    'category'  => $names[0],
  );
}

/**
 * Query latest posts for the Blog featured slider.
 *
 * @return WP_Query
 */
function bizlife_get_blog_featured_query() {
  return new WP_Query(
    array(
      'post_type'           => 'post',
      'post_status'         => 'publish',
      'posts_per_page'      => BIZLIFE_BLOG_FEATURED_COUNT,
      'orderby'             => 'date',
      'order'               => 'DESC',
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
    )
  );
}

/**
 * Query Pick up posts (latest).
 *
 * Used by Blog single (excludes current) and archive sidebar (no exclude).
 * Returns null when there are no posts to show.
 *
 * @param int|WP_Post|null $exclude_post Post to exclude, or null.
 * @return WP_Query|null
 */
function bizlife_get_blog_pickup_query($exclude_post = null) {
  $query_args = array(
    'post_type'           => 'post',
    'post_status'         => 'publish',
    'posts_per_page'      => BIZLIFE_BLOG_PICKUP_COUNT,
    'orderby'             => 'date',
    'order'               => 'DESC',
    'ignore_sticky_posts' => true,
    'no_found_rows'       => true,
  );

  $exclude = get_post($exclude_post);
  if ($exclude && 'post' === $exclude->post_type) {
    $query_args['post__not_in'] = array((int) $exclude->ID);
  }

  $query = new WP_Query($query_args);

  if (!$query->have_posts()) {
    return null;
  }

  return $query;
}
