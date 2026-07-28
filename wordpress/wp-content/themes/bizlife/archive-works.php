<?php
/**
 * Works archive template (CPT: works).
 *
 * Phase 3 Step14: static HTML markup from works-archive.html.
 * Dynamic loop and single-works.php come in later steps.
 *
 * @package BizLife
 */

get_header();

$works_card_href = '#';
$img_works_01 = get_theme_file_uri('assets/img/works/works_01.png');
$img_works_02 = get_theme_file_uri('assets/img/works/works_02.png');
$img_works_03 = get_theme_file_uri('assets/img/works/works_03.png');
$img_works_04 = get_theme_file_uri('assets/img/works/works_04.png');
?>
<main class="works-archive-page">
  <?php
  get_template_part(
    'template-parts/page-hero',
    null,
    array(
      'heroModifier'  => 'page-hero--light',
      'heroHeadingId' => 'works-hero-heading',
      'heroTitleEn'   => 'Works',
      'heroTitleJa'   => '実績紹介',
      'heroImgSrc'    => '',
    )
  );
  ?>

  <section class="works-archive" aria-label="実績一覧">
    <div class="container works-archive__inner">
      <div class="works-archive__filters-sticky">
        <nav class="works-archive__filters" aria-label="カテゴリフィルター">
          <a class="works-archive__filter works-archive__filter--active" href="<?php echo esc_url(home_url('/works/')); ?>" aria-current="page">すべて</a>
          <ul class="works-archive__filter-list">
            <li class="works-archive__filter-item">
              <a class="works-archive__filter" href="#">あなたのメンタルコーチ</a>
            </li>
            <li class="works-archive__filter-item">
              <a class="works-archive__filter" href="#">つながるワークフロー</a>
            </li>
            <li class="works-archive__filter-item">
              <a class="works-archive__filter" href="#">みんなの福利厚生クラウド</a>
            </li>
          </ul>
        </nav>
      </div>

      <div class="works-archive__grid">
        <?php
        get_template_part(
          'template-parts/cards/works-card',
          null,
          array(
            'href'      => $works_card_href,
            'thumbnail' => $img_works_01,
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
            'thumbnail' => $img_works_02,
            'tags'      => array('つながるワークフロー', 'みんなの福利厚生クラウド'),
            'title'     => '従業員満足度が前年比200％Up！「従業員」の本質を語れるBiz Lifeのサービス',
            'company'   => '株式会社Rabbit',
          )
        );
        get_template_part(
          'template-parts/cards/works-card',
          null,
          array(
            'href'      => $works_card_href,
            'thumbnail' => $img_works_03,
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
            'thumbnail' => $img_works_04,
            'tags'      => array('あなたのメンタルコーチ'),
            'title'     => '内部崩壊しかけていた弊社を救うきっかけになった「福利厚生」の話',
            'company'   => '株式会社monkey',
          )
        );
        ?>
      </div>

      <div class="works-archive__more-wrap">
        <button class="works-archive__more" type="button">
          <span class="works-archive__more-label">もっと見る</span>
          <span class="works-archive__more-icon" aria-hidden="true"><span class="material-icons">keyboard_arrow_down</span></span>
        </button>
      </div>
    </div>
  </section>

  <?php get_template_part('template-parts/sections/cta-contact'); ?>
</main>
<?php
get_footer();
