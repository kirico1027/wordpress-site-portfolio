<?php
/**
 * Front page — News section.
 *
 * Latest 5 published news posts (static: top-news.html).
 *
 * @package BizLife
 */

$news_archive_href = bizlife_get_news_archive_url();
$news_query        = bizlife_get_news_query(5);
?>
<section class="section news">
  <div class="container news__inner">
    <div class="news__sidebar">
      <?php
      get_template_part(
        'template-parts/sections/section-heading',
        null,
        array(
          'en'    => 'News',
          'title' => 'お知らせ',
        )
      );
      ?>
      <div class="news__deco" aria-hidden="true">
        <div class="news__deco-row news__deco-row--top">
          <span class="news__deco-block news__deco-block--orange js-scroll-reveal"></span>
          <span class="news__deco-block news__deco-block--peach js-scroll-reveal"></span>
        </div>
        <div class="news__deco-row news__deco-row--bottom">
          <span class="news__deco-block news__deco-block--green js-scroll-reveal"></span>
          <span class="news__deco-block news__deco-block--blue js-scroll-reveal"></span>
        </div>
      </div>
    </div>
    <div class="news__main">
      <?php if ($news_query->have_posts()) : ?>
        <ul class="news__list">
          <?php while ($news_query->have_posts()) : ?>
            <?php
            $news_query->the_post();
            get_template_part(
              'template-parts/cards/news-item',
              null,
              bizlife_get_news_item_args(get_post(), 'Y/n/j')
            );
            ?>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        </ul>
      <?php else : ?>
        <?php wp_reset_postdata(); ?>
        <p class="news__empty"><?php esc_html_e('現在、お知らせはありません。', 'bizlife'); ?></p>
      <?php endif; ?>
      <?php
      get_template_part(
        'template-parts/sections/btn-more',
        null,
        array(
          'href'     => $news_archive_href,
          'label'    => '一覧をみる',
          'modifier' => 'btn-more--center js-scroll-reveal',
        )
      );
      ?>
    </div>
  </div>
</section>
