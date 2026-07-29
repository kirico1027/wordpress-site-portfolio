<?php
/**
 * News category taxonomy archive (taxonomy: news_category).
 *
 * Same layout as archive-news.php; main query is limited to the current term.
 *
 * @package BizLife
 */

get_header();
?>
<main class="news-archive-page">
  <?php
  get_template_part(
    'template-parts/page-hero',
    null,
    array(
      'heroModifier'  => 'page-hero--light',
      'heroHeadingId' => 'news-hero-heading',
      'heroTitleEn'   => 'News',
      'heroTitleJa'   => 'お知らせ',
      'heroImgSrc'    => '',
    )
  );

  get_template_part('template-parts/sections/news-archive');
  get_template_part('template-parts/sections/cta-contact');
  ?>
</main>
<?php
get_footer();
