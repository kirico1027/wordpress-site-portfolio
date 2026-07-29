<?php
/**
 * Blog sidebar pickup card.
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $href      Detail link.
 *   @type string $thumbnail Image URL.
 *   @type string $title     Card title.
 *   @type string $category  Category label.
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'href'      => '',
    'thumbnail' => '',
    'title'     => '',
    'category'  => '',
  )
);

if ('' === $args['category']) {
  $args['category'] = 'お役立ち情報';
}
?>
<a class="blog-pickup" href="<?php echo esc_url($args['href']); ?>">
  <figure class="blog-pickup__figure">
    <?php if ($args['thumbnail']) : ?>
    <img src="<?php echo esc_url($args['thumbnail']); ?>" alt="" width="272" height="163" />
    <?php else : ?>
    <span class="blog-pickup__placeholder" aria-hidden="true"></span>
    <?php endif; ?>
    <span class="blog-pickup__dim" aria-hidden="true"></span>
    <span class="blog-pickup__more" aria-hidden="true">Read more</span>
  </figure>
  <div class="blog-pickup__body">
    <p class="blog-pickup__title"><?php echo esc_html($args['title']); ?></p>
    <p class="blog-pickup__category">
      <span class="blog-pickup__dot" aria-hidden="true"></span><?php echo esc_html($args['category']); ?>
    </p>
  </div>
</a>
