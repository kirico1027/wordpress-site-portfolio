<?php
/**
 * Section body paragraph.
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $blockClass Extra classes on the paragraph.
 *   @type string $modifier   Modifier class (e.g. section-body--about).
 *   @type string $text       Body text (may include allowed HTML like br).
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'blockClass' => '',
    'modifier'   => '',
    'text'       => '',
  )
);

$classes = trim($args['blockClass'] . ' section-body ' . $args['modifier']);
?>
<p class="<?php echo esc_attr($classes); ?>"><?php echo wp_kses_post($args['text']); ?></p>
