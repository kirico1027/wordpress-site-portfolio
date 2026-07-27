<?php
/**
 * Works card.
 *
 * @package BizLife
 *
 * @param array $args {
 *   @type string $href      Detail link.
 *   @type string $thumbnail Image URL (empty = placeholder).
 *   @type array  $tags      Tag labels.
 *   @type string $title     Card title.
 *   @type string $company   Client name.
 * }
 */

$args = wp_parse_args(
  isset($args) ? $args : array(),
  array(
    'href'      => '',
    'thumbnail' => '',
    'tags'      => array(),
    'title'     => '',
    'company'   => '',
  )
);

if (!is_array($args['tags'])) {
  $args['tags'] = array();
}
?>
<article class="works-card">
  <a class="works-card__link" href="<?php echo esc_url($args['href']); ?>">
    <figure class="works-card__figure">
      <?php if ($args['thumbnail']) : ?>
      <img src="<?php echo esc_url($args['thumbnail']); ?>" alt="" width="432" height="259" />
      <?php else : ?>
      <span class="works-card__placeholder" aria-hidden="true"></span>
      <?php endif; ?>
      <span class="works-card__dim" aria-hidden="true"></span>
      <span class="works-card__more" aria-hidden="true">Read more</span>
    </figure>
    <div class="works-card__body">
      <ul class="works-card__tags">
        <?php foreach ($args['tags'] as $tag) : ?>
        <li class="works-card__tag"># <?php echo esc_html($tag); ?></li>
        <?php endforeach; ?>
      </ul>
      <h3 class="works-card__title"><?php echo esc_html($args['title']); ?></h3>
      <p class="works-card__company"><?php echo esc_html($args['company']); ?></p>
    </div>
  </a>
</article>
