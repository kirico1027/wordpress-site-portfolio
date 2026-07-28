<?php
/**
 * Single Works template (CPT: works).
 *
 * Renders title and content dynamically. Hero, client block, pickup remain static.
 *
 * @package BizLife
 */

get_header();

$works_archive_href = home_url('/works/');
$works_card_href = '#';
$img_works_single_01 = get_theme_file_uri('assets/img/works-single/works-single_01.png');
$img_works_single_02 = get_theme_file_uri('assets/img/works-single/works-single_02.png');
$img_works_single_05 = get_theme_file_uri('assets/img/works-single/works-single_05.png');
$img_works_single_06 = get_theme_file_uri('assets/img/works-single/works-single_06.png');
$img_works_single_07 = get_theme_file_uri('assets/img/works-single/works-single_07.png');
?>
<main class="works-single-page works-single">
  <div class="works-single__breadcrumb-area">
    <div class="container works-single__breadcrumb-inner">
      <nav class="works-single__breadcrumb" aria-label="パンくずリスト">
        <a class="works-single__breadcrumb-parent" href="<?php echo esc_url($works_archive_href); ?>">
          <span class="works-single__breadcrumb-en">Works</span>
          <span class="works-single__breadcrumb-ja">実績紹介</span>
        </a>
        <span class="works-single__breadcrumb-sep" aria-hidden="true">
          <span class="material-icons">chevron_right</span>
        </span>
        <span class="works-single__breadcrumb-current" aria-current="page">内部崩壊しかけていた弊社を救う...</span>
      </nav>
    </div>
  </div>

  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
      <?php the_post(); ?>
      <article class="works-single__article" aria-labelledby="works-single-heading">
        <div class="container works-single__inner">
          <div class="works-single__content">
            <time class="works-single__date" datetime="2026-08-08T15:45">2026/8/8 15:45</time>
            <h1 id="works-single-heading" class="works-single__title">
              <?php the_title(); ?>
            </h1>

            <figure class="works-single__hero">
              <img
                src="<?php echo esc_url($img_works_single_01); ?>"
                alt=""
                width="720"
                height="432"
              />
            </figure>

            <div class="works-single__client">
              <div class="works-single__client-head">
                <figure class="works-single__client-logo">
                  <img
                    src="<?php echo esc_url($img_works_single_02); ?>"
                    alt="株式会社monkey"
                    width="120"
                    height="60"
                  />
                </figure>
                <p class="works-single__client-name">株式会社monkey</p>
              </div>
              <p class="works-single__client-desc">
                モンキーは、クリエイティブなデザインとブランディングソリューションを提供する会社です。当社のデザインチームは、顧客企業のビジュアルアイデンティティを強化し、魅力的なブランドイメージを構築するための戦略的なアプローチを提供しています。
              </p>
            </div>

            <div class="works-single__body">
              <?php the_content(); ?>
            </div>

            <div class="works-single__share">
              <p class="works-single__share-label">\ Let's shere ! /</p>
              <ul class="works-single__share-list" aria-hidden="true">
                <li><span class="works-single__share-link"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></span></li>
                <li><span class="works-single__share-link"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></span></li>
              </ul>
            </div>
          </div>

          <div class="works-single__back">
            <?php
            get_template_part(
              'template-parts/sections/btn-more',
              null,
              array(
                'modifier' => '',
                'href'     => $works_archive_href,
                'label'    => '一覧ページに戻る',
              )
            );
            ?>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>

  <section class="works-single__pickup" aria-labelledby="works-pickup-heading">
    <div class="container works-single__pickup-inner">
      <?php
      get_template_part(
        'template-parts/sections/section-heading',
        null,
        array(
          'en'    => 'Pick up',
          'title' => 'おすすめ記事',
        )
      );
      ?>

      <div class="works-single__pickup-grid">
        <?php
        get_template_part(
          'template-parts/cards/works-card',
          null,
          array(
            'href'      => $works_card_href,
            'thumbnail' => $img_works_single_05,
            'tags'      => array('つながるワークフロー', 'あなたのメンタルコーチ'),
            'title'     => '意地でも従業員満足度を高めたかった。とことん向き合うことで見えたこれからの福利厚生',
            'company'   => '株式会社giraffe',
          )
        );
        get_template_part(
          'template-parts/cards/works-card',
          null,
          array(
            'href'      => $works_card_href,
            'thumbnail' => $img_works_single_06,
            'tags'      => array('つながるワークフロー'),
            'title'     => 'これはただの福利厚生ではないと確信。これからより求められる働き方だと感じた',
            'company'   => '株式会社turtle',
          )
        );
        get_template_part(
          'template-parts/cards/works-card',
          null,
          array(
            'href'      => $works_card_href,
            'thumbnail' => $img_works_single_07,
            'tags'      => array('つながるワークフロー', 'みんなの福利厚生クラウド'),
            'title'     => '従業員満足度が前年比200％Up！「従業員」の本質を語れるBiz Lifeのサービス',
            'company'   => '株式会社Rabbit',
          )
        );
        ?>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
