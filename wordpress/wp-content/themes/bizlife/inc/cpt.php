<?php
/**
 * Custom post types.
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Register Works CPT.
 */
function bizlife_register_works_cpt() {
  $labels = array(
    'name'               => __('Works', 'bizlife'),
    'singular_name'      => __('Work', 'bizlife'),
    'menu_name'          => __('Works', 'bizlife'),
    'name_admin_bar'     => __('Work', 'bizlife'),
    'add_new'            => __('Add New', 'bizlife'),
    'add_new_item'       => __('Add New Work', 'bizlife'),
    'new_item'           => __('New Work', 'bizlife'),
    'edit_item'          => __('Edit Work', 'bizlife'),
    'view_item'          => __('View Work', 'bizlife'),
    'all_items'          => __('All Works', 'bizlife'),
    'search_items'       => __('Search Works', 'bizlife'),
    'not_found'          => __('No works found.', 'bizlife'),
    'not_found_in_trash' => __('No works found in Trash.', 'bizlife'),
  );

  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_rest'        => true,
    'query_var'           => true,
    'rewrite'             => array(
      'slug'       => 'works',
      'with_front' => false,
    ),
    'capability_type'     => 'post',
    'has_archive'         => true,
    'hierarchical'        => false,
    'menu_position'       => 5,
    'menu_icon'           => 'dashicons-portfolio',
    'supports'            => array(
      'title',
      'editor',
      'thumbnail',
    ),
  );

  register_post_type('works', $args);
}
add_action('init', 'bizlife_register_works_cpt');
