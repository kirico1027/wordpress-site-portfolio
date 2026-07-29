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
 * @param int|WP_Post|null $post Post object, ID, or null for global post.
 * @return array<string, string>
 */
function bizlife_get_news_item_args($post = null) {
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
    'date'     => get_the_date('Y.n.j', $post),
    'tag'      => $term ? $term->name : '',
    'title'    => get_the_title($post),
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
