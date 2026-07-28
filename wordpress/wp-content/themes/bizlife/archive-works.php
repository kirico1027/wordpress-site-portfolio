<?php
/**
 * Works archive template (CPT: works).
 *
 * Main query renders works cards; filters, more button, and CTA remain static.
 *
 * @package BizLife
 */

get_header();

$works_card_thumbnails = array(
  get_theme_file_uri('assets/img/works/works_01.png'),
  get_theme_file_uri('assets/img/works/works_02.png'),
  get_theme_file_uri('assets/img/works/works_03.png'),
  get_theme_file_uri('assets/img/works/works_04.png'),
);
$works_card_thumbnail_count = count($works_card_thumbnails);
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
        $works_card_index = 0;

        if (have_posts()) :
          while (have_posts()) :
            the_post();
            $card_thumbnail = $works_card_thumbnails[$works_card_index % $works_card_thumbnail_count];
            ?>
        <article class="works-card">
          <a class="works-card__link" href="<?php the_permalink(); ?>">
            <figure class="works-card__figure">
              <img src="<?php echo esc_url($card_thumbnail); ?>" alt="" width="432" height="259" />
              <span class="works-card__dim" aria-hidden="true"></span>
              <span class="works-card__more" aria-hidden="true">Read more</span>
            </figure>
            <div class="works-card__body">
              <ul class="works-card__tags">
                <li class="works-card__tag"># つながるワークフロー</li>
              </ul>
              <h3 class="works-card__title"><?php the_title(); ?></h3>
              <p class="works-card__company">株式会社BizLife</p>
            </div>
          </a>
        </article>
            <?php
            ++$works_card_index;
          endwhile;
        endif;
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
