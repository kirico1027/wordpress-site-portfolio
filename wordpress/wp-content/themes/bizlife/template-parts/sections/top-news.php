<?php
/**
 * Front page — News section.
 *
 * Phase 2: static sample items. Phase 3: WP_Query news CPT.
 *
 * @package BizLife
 */

$news_href = home_url('/news/');
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
      <ul class="news__list">
        <?php
        get_template_part(
          'template-parts/cards/news-item',
          null,
          array(
            'href'     => $news_href,
            'datetime' => '2026-08-08',
            'date'     => '2026/8/8',
            'tag'      => '採用',
            'title'    => '2027年卒 インターンシップ募集開始のお知らせ',
          )
        );
        get_template_part(
          'template-parts/cards/news-item',
          null,
          array(
            'href'     => $news_href,
            'datetime' => '2026-08-08',
            'date'     => '2026/8/8',
            'tag'      => 'お知らせ',
            'title'    => '夏季休業のお知らせ',
          )
        );
        get_template_part(
          'template-parts/cards/news-item',
          null,
          array(
            'href'     => $news_href,
            'datetime' => '2026-08-01',
            'date'     => '2026/8/1',
            'tag'      => 'メディア掲載',
            'title'    => 'イベント出展のお知らせ【2024夏】',
          )
        );
        get_template_part(
          'template-parts/cards/news-item',
          null,
          array(
            'href'     => $news_href,
            'datetime' => '2026-08-01',
            'date'     => '2026/8/1',
            'tag'      => 'お知らせ',
            'title'    => '【ご報告】導入社数1000社を突破しました！',
          )
        );
        get_template_part(
          'template-parts/cards/news-item',
          null,
          array(
            'href'     => $news_href,
            'datetime' => '2026-08-01',
            'date'     => '2026/8/1',
            'tag'      => 'お知らせ',
            'title'    => '革新的な福利厚生サービスが登場！次世代の完全従業員ファーストの新サービス',
          )
        );
        ?>
      </ul>
      <?php
      get_template_part(
        'template-parts/sections/btn-more',
        null,
        array(
          'href'     => $news_href,
          'label'    => '一覧をみる',
          'modifier' => 'btn-more--center js-scroll-reveal',
        )
      );
      ?>
    </div>
  </div>
</section>
