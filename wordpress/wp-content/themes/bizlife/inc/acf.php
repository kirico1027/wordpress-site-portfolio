<?php
/**
 * ACF field groups.
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Register local ACF field groups.
 */
function bizlife_register_acf_field_groups() {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(
    array(
      'key'                   => 'group_works_company',
      'title'                 => 'Works Company',
      'fields'                => array(
        array(
          'key'           => 'field_works_company_name',
          'label'         => '会社名',
          'name'          => 'company_name',
          'type'          => 'text',
          'instructions'  => '',
          'required'      => 0,
          'default_value' => '',
          'placeholder'   => '',
          'maxlength'     => '',
        ),
        array(
          'key'           => 'field_works_company_description',
          'label'         => '会社紹介',
          'name'          => 'company_description',
          'type'          => 'textarea',
          'instructions'  => '',
          'required'      => 0,
          'default_value' => '',
          'placeholder'   => '',
          'maxlength'     => '',
          'rows'          => 4,
          'new_lines'     => '',
        ),
      ),
      'location'              => array(
        array(
          array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'works',
          ),
        ),
      ),
      'menu_order'            => 0,
      'position'              => 'normal',
      'style'                 => 'default',
      'label_placement'       => 'top',
      'instruction_placement' => 'label',
      'active'                => true,
    )
  );
}
add_action('acf/init', 'bizlife_register_acf_field_groups');
