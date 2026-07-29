<?php
/**
 * Enqueue theme assets.
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Return filemtime-based version for cache busting.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string|bool
 */
function bizlife_asset_version($relative_path) {
  $file = get_template_directory() . '/' . ltrim($relative_path, '/');

  return file_exists($file) ? (string) filemtime($file) : false;
}

/**
 * Enqueue CSS, JS, and third-party fonts/icons used by the static site.
 */
function bizlife_enqueue_assets() {
  $theme_uri = get_template_directory_uri();

  wp_enqueue_style(
    'bizlife-fonts-poppins',
    'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap',
    array(),
    null
  );

  wp_enqueue_style(
    'bizlife-material-icons',
    'https://fonts.googleapis.com/icon?family=Material+Icons',
    array(),
    null
  );

  wp_enqueue_style(
    'bizlife-fontawesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/fontawesome.min.css',
    array(),
    '6.5.1'
  );

  wp_enqueue_style(
    'bizlife-fontawesome-brands',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/brands.min.css',
    array('bizlife-fontawesome'),
    '6.5.1'
  );

  wp_enqueue_style(
    'bizlife-main',
    $theme_uri . '/assets/css/main.css',
    array(
      'bizlife-fonts-poppins',
      'bizlife-material-icons',
      'bizlife-fontawesome-brands',
    ),
    bizlife_asset_version('assets/css/main.css')
  );

  wp_enqueue_script(
    'bizlife-script',
    $theme_uri . '/assets/js/script.js',
    array(),
    bizlife_asset_version('assets/js/script.js'),
    true
  );

  if (is_post_type_archive('works') || is_tax('works_category')) {
    wp_localize_script(
      'bizlife-script',
      'bizlifeWorksLoadMore',
      array(
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'action'  => 'bizlife_load_more_works',
        'nonce'   => wp_create_nonce('bizlife_works_load_more'),
        'i18n'    => array(
          'loading' => __('読み込み中…', 'bizlife'),
          'error'   => __('読み込みに失敗しました。もう一度お試しください。', 'bizlife'),
        ),
      )
    );
  }
}
add_action('wp_enqueue_scripts', 'bizlife_enqueue_assets');

/**
 * Add preconnect hints for Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function bizlife_resource_hints($urls, $relation_type) {
  if ('preconnect' === $relation_type) {
    $urls[] = array(
      'href' => 'https://fonts.googleapis.com',
    );
    $urls[] = array(
      'href'        => 'https://fonts.gstatic.com',
      'crossorigin' => 'anonymous',
    );
  }

  return $urls;
}
add_filter('wp_resource_hints', 'bizlife_resource_hints', 10, 2);
