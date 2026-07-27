<?php
/**
 * Subpage hero (shared).
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $heroModifier   Extra class (e.g. page-hero--light).
 *   @type string $heroHeadingId  h1 id.
 *   @type string $heroTitleEn    English title.
 *   @type string $heroTitleJa    Japanese lead.
 *   @type string $heroImgSrc     Optional background image URL.
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'heroModifier'  => '',
    'heroHeadingId' => 'page-hero-heading',
    'heroTitleEn'   => '',
    'heroTitleJa'   => '',
    'heroImgSrc'    => '',
  )
);

$section_class = trim('page-hero ' . $args['heroModifier']);
?>
<section class="<?php echo esc_attr($section_class); ?>" aria-labelledby="<?php echo esc_attr($args['heroHeadingId']); ?>">
  <?php if ($args['heroImgSrc']) : ?>
  <div class="page-hero__media" aria-hidden="true">
    <img src="<?php echo esc_url($args['heroImgSrc']); ?>" alt="" />
  </div>
  <?php endif; ?>
  <div class="page-hero__inner container">
    <h1 id="<?php echo esc_attr($args['heroHeadingId']); ?>" class="page-hero__title"><?php echo esc_html($args['heroTitleEn']); ?></h1>
    <p class="page-hero__lead"><?php echo esc_html($args['heroTitleJa']); ?></p>
  </div>
</section>
