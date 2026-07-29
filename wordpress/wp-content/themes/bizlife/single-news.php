<?php
/**
 * Single News template (CPT: news).
 *
 * Static reference: src/templates/news-single.html
 * No page hero, CTA, category, thumbnail, related, or prev/next.
 *
 * @package BizLife
 */

get_header();

$news_archive_href = get_post_type_archive_link('news');
if (!$news_archive_href) {
  $news_archive_href = home_url('/news/');
}
?>
<main class="news-single-page news-single">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
      <?php the_post(); ?>
  <div class="news-single__breadcrumb-area">
    <div class="container news-single__breadcrumb-inner">
      <nav class="news-single__breadcrumb" aria-label="パンくずリスト">
        <a class="news-single__breadcrumb-parent" href="<?php echo esc_url($news_archive_href); ?>">
          <span class="news-single__breadcrumb-en">News</span>
          <span class="news-single__breadcrumb-ja">お知らせ</span>
        </a>
        <span class="news-single__breadcrumb-sep" aria-hidden="true">
          <span class="material-icons">chevron_right</span>
        </span>
        <span class="news-single__breadcrumb-current" aria-current="page"><?php echo esc_html(get_the_title()); ?></span>
      </nav>
    </div>
  </div>

      <article class="news-single__article" aria-labelledby="news-single-heading">
        <div class="container news-single__inner">
          <div class="news-single__card">
            <time class="news-single__date" datetime="<?php echo esc_attr(get_the_date('Y-m-d\TH:i')); ?>"><?php echo esc_html(get_the_date('Y/n/j H:i')); ?></time>
            <h1 id="news-single-heading" class="news-single__title"><?php echo esc_html(get_the_title()); ?></h1>
            <div class="news-single__body">
              <?php the_content(); ?>
            </div>
          </div>

          <div class="news-single__back">
            <?php
            get_template_part(
              'template-parts/sections/btn-more',
              null,
              array(
                'modifier' => '',
                'href'     => $news_archive_href,
                'label'    => '一覧ページに戻る',
              )
            );
            ?>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>
</main>
<?php
get_footer();
