<?php
/**
 * Front page — Hero section.
 *
 * Phase 2: static markup. Phase 3+: news ticker from news CPT.
 *
 * @package BizLife
 */
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
  <div class="hero-news">
    <div class="hero-news__inner container">
      <a class="hero-news__link" href="<?php echo esc_url(home_url('/news/')); ?>">
        <time class="hero-news__date" datetime="2026-08-01">2026.8.1</time>
        <p class="hero-news__text">革新的な福利厚生サービスが登場！次世代の完全従業員ファーストの新サービス</p>
      </a>
    </div>
  </div>
</section>
