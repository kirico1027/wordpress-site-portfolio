<?php
/**
 * Section label (EN with dot).
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $text     Label text.
 *   @type string $modifier Extra class (e.g. section-label--orange).
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'text'     => '',
    'modifier' => '',
  )
);

$classes = trim('section-label ' . $args['modifier']);
?>
<p class="<?php echo esc_attr($classes); ?>">
  <span class="section-label__dot" aria-hidden="true"></span>
  <span class="section-label__text"><?php echo esc_html($args['text']); ?></span>
</p>
