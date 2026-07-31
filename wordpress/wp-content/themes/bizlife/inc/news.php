<?php
/**
 * News archive helpers (query size, card args, category labels).
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Posts per page for News archives.
 *
 * Static design has no pagination / load-more, so archives show all published posts.
 */
define('BIZLIFE_NEWS_PER_PAGE', -1);

/**
 * Preferred news_category term order (static archive filters).
 *
 * @return string[]
 */
function bizlife_news_category_term_order() {
  return array(
    'information',
    'event',
    'media',
    'recruit',
    'service',
    'other',
  );
}

/**
 * Show all posts on News archive and news_category taxonomies.
 *
 * @param WP_Query $query Main query.
 */
function bizlife_news_archive_posts_per_page($query) {
  if (is_admin() || !$query->is_main_query()) {
    return;
  }

  if ($query->is_post_type_archive('news') || $query->is_tax('news_category')) {
    $query->set('posts_per_page', BIZLIFE_NEWS_PER_PAGE);
    $query->set('orderby', 'date');
    $query->set('order', 'DESC');
  }
}
add_action('pre_get_posts', 'bizlife_news_archive_posts_per_page');

/**
 * Primary news_category term for a News post (filter order preferred).
 *
 * @param int|WP_Post|null $post Post object, ID, or null for global post.
 * @return WP_Term|null
 */
function bizlife_get_news_primary_term($post = null) {
  $post = get_post($post);

  if (!$post || 'news' !== $post->post_type) {
    return null;
  }

  $terms = get_the_terms($post, 'news_category');

  if (!$terms || is_wp_error($terms)) {
    return null;
  }

  $by_slug = array();
  foreach ($terms as $term) {
    $by_slug[$term->slug] = $term;
  }

  foreach (bizlife_news_category_term_order() as $slug) {
    if (isset($by_slug[$slug])) {
      return $by_slug[$slug];
    }
  }

  return $terms[0];
}

/**
 * Build args for template-parts/cards/news-item.php from a News post.
 *
 * @param int|WP_Post|null $post         Post object, ID, or null for global post.
 * @param string           $date_format  Display date format (archive: Y.n.j / front: Y/n/j).
 * @return array<string, string>
 */
function bizlife_get_news_item_args($post = null, $date_format = 'Y.n.j') {
  $post = get_post($post);

  if (!$post || 'news' !== $post->post_type) {
    return array(
      'href'     => '',
      'datetime' => '',
      'date'     => '',
      'tag'      => '',
      'title'    => '',
    );
  }

  $term = bizlife_get_news_primary_term($post);

  return array(
    'href'     => get_permalink($post),
    'datetime' => get_the_date('Y-m-d', $post),
    'date'     => get_the_date($date_format, $post),
    'tag'      => $term ? $term->name : '',
    'title'    => get_the_title($post),
  );
}

/**
 * News archive URL (with home_url fallback).
 *
 * @return string
 */
function bizlife_get_news_archive_url() {
  $url = get_post_type_archive_link('news');
  return $url ? $url : home_url('/news/');
}

/**
 * Query published News posts for front-page sections.
 *
 * @param int $posts_per_page Number of posts (5 for top News, 1 for hero-news).
 * @return WP_Query
 */
function bizlife_get_news_query($posts_per_page) {
  return new WP_Query(
    array(
      'post_type'           => 'news',
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
 * Add news-single__paragraph class so existing CSS / reveal JS keep working with the_content().
 *
 * @param string $content Post content HTML.
 * @return string
 */
function bizlife_news_content_paragraph_class($content) {
  if (!is_singular('news') || !in_the_loop() || !is_main_query()) {
    return $content;
  }

  if (false === strpos($content, '<p')) {
    return $content;
  }

  return preg_replace_callback(
    '/<p(\s[^>]*)?>/i',
    function ($matches) {
      $attrs = isset($matches[1]) ? $matches[1] : '';

      if (false !== strpos($attrs, 'news-single__paragraph')) {
        return $matches[0];
      }

      if (preg_match('/\sclass=(["\'])(.*?)\1/i', $attrs, $class_match)) {
        $quote   = $class_match[1];
        $classes = trim($class_match[2] . ' news-single__paragraph');
        $attrs   = preg_replace(
          '/\sclass=(["\']).*?\1/i',
          ' class=' . $quote . $classes . $quote,
          $attrs,
          1
        );
        return '<p' . $attrs . '>';
      }

      return '<p class="news-single__paragraph"' . $attrs . '>';
    },
    $content
  );
}
add_filter('the_content', 'bizlife_news_content_paragraph_class', 12);

/**
 * Insert featured-image column and drop author on News list.
 *
 * Order: checkbox → image → title → news_category → date.
 *
 * @param array<string, string> $columns List table columns.
 * @return array<string, string>
 */
function bizlife_news_admin_columns($columns) {
  unset($columns['author']);

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
add_filter('manage_news_posts_columns', 'bizlife_news_admin_columns');

/**
 * Render News featured-image column cell.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function bizlife_news_admin_custom_column($column, $post_id) {
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
add_action('manage_news_posts_custom_column', 'bizlife_news_admin_custom_column', 10, 2);

/**
 * Enqueue admin list CSS for News screen (shared thumbnail styles with Works).
 *
 * @param string $hook_suffix Current admin page hook.
 */
function bizlife_news_admin_assets($hook_suffix) {
  if ('edit.php' !== $hook_suffix) {
    return;
  }

  $screen = function_exists('get_current_screen') ? get_current_screen() : null;

  if (!$screen || 'news' !== $screen->post_type) {
    return;
  }

  wp_enqueue_style(
    'bizlife-admin-news',
    get_theme_file_uri('assets/css/admin-works.css'),
    array(),
    bizlife_asset_version('assets/css/admin-works.css')
  );
}
add_action('admin_enqueue_scripts', 'bizlife_news_admin_assets');

