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
