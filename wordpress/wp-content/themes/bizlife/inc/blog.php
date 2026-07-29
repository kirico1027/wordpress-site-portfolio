<?php
/**
 * Blog (standard post) helpers for archive featured slider and cards.
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Posts shown in the Blog archive grid (static template: 6).
 */
define('BIZLIFE_BLOG_PER_PAGE', 6);

/**
 * Featured slider slide count (static template: 5).
 */
define('BIZLIFE_BLOG_FEATURED_COUNT', 5);

/**
 * Pick up cards on Blog single (static template: 3).
 */
define('BIZLIFE_BLOG_PICKUP_COUNT', 3);

/**
 * Fallback category label when a post has no category.
 */
define('BIZLIFE_BLOG_CATEGORY_FALLBACK', 'お役立ち情報');
/**
 * Limit main query on the Posts page (Blog archive).
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
}
add_action('pre_get_posts', 'bizlife_blog_archive_posts_per_page');

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
 * Query Pick up posts for Blog single (latest, excluding current).
 *
 * Returns null when there are no posts to show.
 *
 * @param int|WP_Post|null $post Current post.
 * @return WP_Query|null
 */
function bizlife_get_blog_pickup_query($post = null) {
  $post = get_post($post);

  if (!$post || 'post' !== $post->post_type) {
    return null;
  }

  $query = new WP_Query(
    array(
      'post_type'           => 'post',
      'post_status'         => 'publish',
      'posts_per_page'      => BIZLIFE_BLOG_PICKUP_COUNT,
      'post__not_in'        => array((int) $post->ID),
      'orderby'             => 'date',
      'order'               => 'DESC',
      'ignore_sticky_posts' => true,
      'no_found_rows'       => true,
    )
  );

  if (!$query->have_posts()) {
    return null;
  }

  return $query;
}
