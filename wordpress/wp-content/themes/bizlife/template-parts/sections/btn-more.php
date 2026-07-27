<?php
/**
 * More button link.
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $href     Link URL.
 *   @type string $label    Button label.
 *   @type string $modifier Extra classes.
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'href'     => '',
    'label'    => '',
    'modifier' => '',
  )
);

$classes = trim('btn-more ' . $args['modifier']);
?>
<a class="<?php echo esc_attr($classes); ?>" href="<?php echo esc_url($args['href']); ?>"><span class="btn-more__label"><?php echo esc_html($args['label']); ?></span><span class="btn-more__icon" aria-hidden="true"><span class="material-icons">keyboard_arrow_right</span></span></a>
