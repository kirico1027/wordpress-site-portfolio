<?php
/**
 * News archive list body (filter + items).
 *
 * Shared by archive-news.php and taxonomy-news_category.php.
 *
 * @package BizLife
 */
?>
<section class="news-archive" aria-label="お知らせ一覧">
  <div class="container news-archive__inner">
    <?php get_template_part('template-parts/news-filter'); ?>

    <?php if (have_posts()) : ?>
      <ul class="news-archive__list">
        <?php while (have_posts()) : ?>
          <?php
          the_post();
          get_template_part(
            'template-parts/cards/news-item',
            null,
            bizlife_get_news_item_args(get_post())
          );
          ?>
        <?php endwhile; ?>
      </ul>
    <?php else : ?>
      <p class="news-archive__empty"><?php esc_html_e('現在、お知らせはありません。', 'bizlife'); ?></p>
    <?php endif; ?>
  </div>
</section>
