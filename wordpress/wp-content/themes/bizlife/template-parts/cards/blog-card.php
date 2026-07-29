<?php
/**
 * Blog card.
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $href      Detail link.
 *   @type string $thumbnail Image URL (empty = placeholder).
 *   @type array  $tags      Category labels.
 *   @type string $title     Card title.
 *   @type string $datetime  datetime attribute (Y-m-d).
 *   @type string $date      Display date (Y/n/j).
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'href'      => '',
    'thumbnail' => '',
    'tags'      => array(),
    'title'     => '',
    'datetime'  => '',
    'date'      => '',
  )
);

if (!is_array($args['tags'])) {
  $args['tags'] = array();
}

if (empty($args['tags'])) {
  $args['tags'][] = 'お役立ち情報';
}
?>
<article class="blog-card">
  <a class="blog-card__link" href="<?php echo esc_url($args['href']); ?>">
    <figure class="blog-card__figure">
      <?php if ($args['thumbnail']) : ?>
      <img src="<?php echo esc_url($args['thumbnail']); ?>" alt="" width="328" height="197" />
      <?php else : ?>
      <span class="blog-card__placeholder" aria-hidden="true"></span>
      <?php endif; ?>
      <span class="blog-card__dim" aria-hidden="true"></span>
      <span class="blog-card__more" aria-hidden="true">Read more</span>
    </figure>
    <div class="blog-card__body">
      <ul class="blog-card__tags">
        <?php foreach ($args['tags'] as $tag) : ?>
        <li class="blog-card__tag"><?php echo esc_html($tag); ?></li>
        <?php endforeach; ?>
      </ul>
      <h3 class="blog-card__title"><?php echo esc_html($args['title']); ?></h3>
      <time class="blog-card__date" datetime="<?php echo esc_attr($args['datetime']); ?>">
        <?php echo esc_html($args['date']); ?>
      </time>
    </div>
  </a>
</article>
