<?php
/**
 * Section heading (EN + JA title).
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $en    English label.
 *   @type string $title Japanese heading.
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'en'    => '',
    'title' => '',
  )
);
?>
<div class="section-heading js-section-heading-reveal">
  <p class="section-heading__en">
    <span class="section-heading__dot" aria-hidden="true"></span>
    <span class="section-heading__en-text"><?php echo esc_html($args['en']); ?></span>
  </p>
  <h2 class="section-heading__title"><?php echo esc_html($args['title']); ?></h2>
</div>
