<?php
/**
 * Front page — Works section.
 *
 * Phase 2: static sample cards. Phase 3: WP_Query works CPT.
 *
 * @package BizLife
 */

$works_thumb = get_theme_file_uri('assets/img/top/about-01.png');
$works_href  = home_url('/works/');
?>
<section class="section works">
  <div class="container works__header">
    <div class="works__intro">
      <?php
      get_template_part(
        'template-parts/sections/section-heading',
        null,
        array(
          'en'    => 'Works',
          'title' => '実績紹介',
        )
      );
      get_template_part(
        'template-parts/sections/section-body',
        null,
        array(
          'blockClass' => 'works__text js-scroll-reveal',
          'modifier'   => '',
          'text'       => '業種や形態問わず、さまざまなクライアント様にご活用いただいております。<br />新しい福利厚生の形として事業規模や用途に合わせご支援が可能です。',
        )
      );
      ?>
    </div>
    <?php
    get_template_part(
      'template-parts/sections/btn-more',
      null,
      array(
        'href'     => $works_href,
        'label'    => '一覧をみる',
        'modifier' => 'btn-more--header js-scroll-reveal',
      )
    );
    ?>
  </div>
  <div class="works__slider-wrap js-scroll-reveal">
    <div class="works__slider" tabindex="0">
      <?php
      get_template_part(
        'template-parts/cards/works-card',
        null,
        array(
          'href'      => $works_href,
          'thumbnail' => $works_thumb,
          'tags'      => array('あなたのメンタルコーチ'),
          'title'     => '内部崩壊しかけていた弊社を救うきっかけになった「福利厚生」の話',
          'company'   => '株式会社monkey',
        )
      );
      get_template_part(
        'template-parts/cards/works-card',
        null,
        array(
          'href'      => $works_href,
          'thumbnail' => $works_thumb,
          'tags'      => array('みんなの福利厚生クラウド', 'つながるワークフロー', 'あなたのメンタルコーチ'),
          'title'     => '従業員の悩みや不安に本気で向き合うことで会社全体の『人』に対する考え方が変わった',
          'company'   => '株式会社horse',
        )
      );
      get_template_part(
        'template-parts/cards/works-card',
        null,
        array(
          'href'      => $works_href,
          'thumbnail' => $works_thumb,
          'tags'      => array('つながるワークフロー', 'あなたのメンタルコーチ'),
          'title'     => '意地でも従業員満足度を高めたかった。とことん向き合うことで見えたこれからの福利厚生',
          'company'   => '株式会社giraffe',
        )
      );
      get_template_part(
        'template-parts/cards/works-card',
        null,
        array(
          'href'      => $works_href,
          'thumbnail' => $works_thumb,
          'tags'      => array('つながるワークフロー', 'みんなの福利厚生クラウド'),
          'title'     => '従業員満足度が前年比200％Up！「従業員」の本質を語れるBiz Lifeのサービス',
          'company'   => '株式会社Rabbit',
        )
      );
      get_template_part(
        'template-parts/cards/works-card',
        null,
        array(
          'href'      => $works_href,
          'thumbnail' => $works_thumb,
          'tags'      => array('つながるワークフロー'),
          'title'     => 'これはただの福利厚生ではないと確信。これからより求められる働き方だと感じた',
          'company'   => '株式会社turtle',
        )
      );
      ?>
    </div>
  </div>
</section>
