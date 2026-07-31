<?php
/**
 * Theme setup.
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Register theme supports and menus.
 */
function bizlife_setup() {
  load_theme_textdomain('bizlife', get_template_directory() . '/languages');

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script',
    )
  );

  register_nav_menus(
    array(
      'primary' => __('Primary Menu', 'bizlife'),
      'footer'  => __('Footer Menu', 'bizlife'),
    )
  );
}
add_action('after_setup_theme', 'bizlife_setup');

/**
 * Strip trailing full-width English suffix from page titles on the front.
 *
 * Admin titles use bilingual labels like「ホーム（Home）」for operators.
 * Front headings / document titles keep the Japanese label only.
 *
 * @param string $title   Title text.
 * @param int    $post_id Post ID when available.
 * @return string
 */
function bizlife_strip_page_title_english_suffix($title, $post_id = 0) {
  if (is_admin()) {
    return $title;
  }

  $post_id = (int) $post_id;
  if ($post_id <= 0) {
    return $title;
  }

  $post = get_post($post_id);
  if (!$post || 'page' !== $post->post_type) {
    return $title;
  }

  return trim(preg_replace('/（[^）]+）\s*$/u', '', (string) $title));
}
add_filter('the_title', 'bizlife_strip_page_title_english_suffix', 10, 2);

/**
 * Keep document <title> free of admin bilingual suffixes.
 *
 * @param array<string, string> $parts Document title parts.
 * @return array<string, string>
 */
function bizlife_front_document_title_parts($parts) {
  if (!empty($parts['title'])) {
    $parts['title'] = trim(preg_replace('/（[^）]+）\s*$/u', '', (string) $parts['title']));
  }

  return $parts;
}
add_filter('document_title_parts', 'bizlife_front_document_title_parts');
