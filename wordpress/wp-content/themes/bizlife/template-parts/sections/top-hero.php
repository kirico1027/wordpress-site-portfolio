<?php
/**
 * Front page — Hero section.
 *
 * hero-news shows the latest published News post (1). Hidden when none.
 *
 * @package BizLife
 */

$hero_news_query = bizlife_get_news_query(1);
$hero_news_post  = null;

if ($hero_news_query->have_posts()) {
  $hero_news_query->the_post();
  $hero_news_post = get_post();
  wp_reset_postdata();
} else {
  wp_reset_postdata();
}
?>
<section class="hero">
  <div class="hero__inner container">
    <div class="hero__layout">
      <div class="hero__content">
        <h1 class="hero__title">
          <span class="hero__title-line">社員と企業を</span>
          <span class="hero__title-line hero__title-line--accent">共に育む</span>
          <span class="hero__title-line">新しい福利厚生</span>
        </h1>
        <span class="hero__divider" aria-hidden="true"></span>
        <div class="hero__lead">
          <p class="hero__lead-line">社員の幸せと健康を第一に考えた、</p>
          <p class="hero__lead-line">これからの福利厚生プログラム</p>
        </div>
      </div>
      <div class="hero__visual">
        <div class="hero__collage-scaler">
          <div class="hero__collage">
            <div class="hero__collage-row hero__collage-row--top">
              <figure class="hero__figure hero__figure--main">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/img/top/hero-01.png')); ?>" alt="" width="376" height="231" />
              </figure>
              <span class="hero__shape hero__shape--orange" aria-hidden="true"></span>
            </div>
            <div class="hero__collage-row hero__collage-row--bottom">
              <span class="hero__shape hero__shape--green" aria-hidden="true"></span>
              <span class="hero__shape hero__shape--blue" aria-hidden="true"></span>
              <figure class="hero__figure hero__figure--sub">
                <img src="<?php echo esc_url(get_theme_file_uri('assets/img/top/hero-02.png')); ?>" alt="" width="283" height="160" />
              </figure>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php if ($hero_news_post) : ?>
  <div class="hero-news">
    <div class="hero-news__inner container">
      <a class="hero-news__link" href="<?php echo esc_url(get_permalink($hero_news_post)); ?>">
        <time class="hero-news__date" datetime="<?php echo esc_attr(get_the_date('Y-m-d', $hero_news_post)); ?>"><?php echo esc_html(get_the_date('Y.n.j', $hero_news_post)); ?></time>
        <p class="hero-news__text"><?php echo esc_html(get_the_title($hero_news_post)); ?></p>
      </a>
    </div>
  </div>
  <?php endif; ?>
</section>
