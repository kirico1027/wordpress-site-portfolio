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

  // search.php renders Blog cards only — always limit front-end search to posts.
  if ($query->is_search()) {
    $query->set('post_type', 'post');
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

/**
 * Append a BEM class to matching HTML tags in post content.
 *
 * @param string $content HTML.
 * @param string $tag     Tag name (e.g. p, h2).
 * @param string $class   Class to ensure.
 * @return string
 */
function bizlife_blog_content_ensure_tag_class($content, $tag, $class) {
  if (false === strpos($content, '<' . $tag)) {
    return $content;
  }

  $pattern = '/<' . preg_quote($tag, '/') . '(\s[^>]*)?>/i';

  return preg_replace_callback(
    $pattern,
    function ($matches) use ($tag, $class) {
      $attrs = isset($matches[1]) ? $matches[1] : '';

      if (false !== strpos($attrs, $class)) {
        return $matches[0];
      }

      if (preg_match('/\sclass=(["\'])(.*?)\1/i', $attrs, $class_match)) {
        $quote   = $class_match[1];
        $classes = trim($class_match[2] . ' ' . $class);
        $attrs   = preg_replace(
          '/\sclass=(["\']).*?\1/i',
          ' class=' . $quote . $classes . $quote,
          $attrs,
          1
        );
        return '<' . $tag . $attrs . '>';
      }

      return '<' . $tag . ' class="' . $class . '"' . $attrs . '>';
    },
    $content
  );
}

/**
 * Map the_content() markup to Blog single BEM classes (static template parity).
 *
 * Mirrors news single paragraph class injection for CSS / scroll-reveal selectors.
 *
 * @param string $content Post content HTML.
 * @return string
 */
function bizlife_blog_content_element_classes($content) {
  if (!is_singular('post') || !in_the_loop() || !is_main_query()) {
    return $content;
  }

  $map = array(
    'p'      => 'blog-single__paragraph',
    'h2'     => 'blog-single__heading',
    'h3'     => 'blog-single__subheading',
    'figure' => 'blog-single__figure',
  );

  foreach ($map as $tag => $class) {
    $content = bizlife_blog_content_ensure_tag_class($content, $tag, $class);
  }

  return $content;
}
add_filter('the_content', 'bizlife_blog_content_element_classes', 12);

/**
 * Insert featured-image column and drop unused columns on Blog (post) list.
 *
 * Order: checkbox → image → title → categories → date.
 *
 * @param array<string, string> $columns List table columns.
 * @return array<string, string>
 */
function bizlife_blog_admin_columns($columns) {
  unset($columns['author'], $columns['tags'], $columns['comments']);

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
add_filter('manage_posts_columns', 'bizlife_blog_admin_columns');

/**
 * Render Blog featured-image column cell.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function bizlife_blog_admin_custom_column($column, $post_id) {
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
add_action('manage_posts_custom_column', 'bizlife_blog_admin_custom_column', 10, 2);

/**
 * Enqueue admin list CSS for Blog (post) screen.
 *
 * Reuses shared thumbnail styles in admin-works.css.
 *
 * @param string $hook_suffix Current admin page hook.
 */
function bizlife_blog_admin_assets($hook_suffix) {
  if ('edit.php' !== $hook_suffix) {
    return;
  }

  $screen = function_exists('get_current_screen') ? get_current_screen() : null;

  if (!$screen || 'post' !== $screen->post_type) {
    return;
  }

  wp_enqueue_style(
    'bizlife-admin-blog',
    get_theme_file_uri('assets/css/admin-works.css'),
    array(),
    bizlife_asset_version('assets/css/admin-works.css')
  );
}
add_action('admin_enqueue_scripts', 'bizlife_blog_admin_assets');

