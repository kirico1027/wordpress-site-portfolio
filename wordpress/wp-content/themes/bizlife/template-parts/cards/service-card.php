<?php
/**
 * Service card.
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $num   Number label (01 / 02 / 03).
 *   @type string $title Japanese title.
 *   @type string $en    English title.
 *   @type string $desc  Description.
 *   @type string $href  Detail link.
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'num'   => '',
    'title' => '',
    'en'    => '',
    'desc'  => '',
    'href'  => '',
  )
);
?>
<li class="service-card js-scroll-reveal">
  <div class="service-card__head">
    <p class="service-card__num"><?php echo esc_html($args['num']); ?></p>
    <h3 class="service-card__title"><?php echo esc_html($args['title']); ?></h3>
    <p class="service-card__en"><?php echo esc_html($args['en']); ?></p>
  </div>
  <p class="service-card__desc"><?php echo esc_html($args['desc']); ?></p>
  <a class="service-card__link" href="<?php echo esc_url($args['href']); ?>">詳しくはこちら<span class="material-icons" aria-hidden="true">keyboard_arrow_right</span></a>
</li>
