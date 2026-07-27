<?php
/**
 * News list item.
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $href     Detail link.
 *   @type string $datetime datetime attribute (Y-m-d).
 *   @type string $date     Display date.
 *   @type string $tag      Category label.
 *   @type string $title    News title.
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'href'     => '',
    'datetime' => '',
    'date'     => '',
    'tag'      => '',
    'title'    => '',
  )
);
?>
<li class="news-item js-scroll-reveal">
  <a class="news-item__link" href="<?php echo esc_url($args['href']); ?>">
    <div class="news-item__meta">
      <time class="news-item__date" datetime="<?php echo esc_attr($args['datetime']); ?>"><?php echo esc_html($args['date']); ?></time>
      <span class="news-item__tag"><?php echo esc_html($args['tag']); ?></span>
    </div>
    <p class="news-item__title"><?php echo esc_html($args['title']); ?></p>
  </a>
</li>
