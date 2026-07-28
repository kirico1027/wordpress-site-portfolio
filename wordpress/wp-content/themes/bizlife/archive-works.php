<?php
/**
 * Works archive template (CPT: works).
 *
 * Main query renders works cards with featured images.
 * Filters, more button, and CTA remain static.
 *
 * @package BizLife
 */

get_header();

$works_card_fallback = get_theme_file_uri('assets/img/works/works_01.png');
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
      <?php get_template_part('template-parts/works-filter'); ?>

      <div class="works-archive__grid">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : ?>
            <?php the_post(); ?>
        <article class="works-card">
          <a class="works-card__link" href="<?php the_permalink(); ?>">
            <figure class="works-card__figure">
              <?php if (has_post_thumbnail()) : ?>
                <?php
                echo get_the_post_thumbnail(
                  null,
                  'large',
                  array(
                    'alt' => '',
                  )
                );
                ?>
              <?php else : ?>
              <img src="<?php echo esc_url($works_card_fallback); ?>" alt="" width="432" height="259" />
              <?php endif; ?>
              <span class="works-card__dim" aria-hidden="true"></span>
              <span class="works-card__more" aria-hidden="true">Read more</span>
            </figure>
            <div class="works-card__body">
              <ul class="works-card__tags">
                <?php
                $works_category_label = 'つながるワークフロー';
                $works_categories = get_the_terms(get_the_ID(), 'works_category');

                if ($works_categories && !is_wp_error($works_categories)) {
                  $works_category_label = $works_categories[0]->name;
                }
                ?>
                <li class="works-card__tag"># <?php echo esc_html($works_category_label); ?></li>
              </ul>
              <h3 class="works-card__title"><?php the_title(); ?></h3>
              <p class="works-card__company">株式会社BizLife</p>
            </div>
          </a>
        </article>
          <?php endwhile; ?>
        <?php endif; ?>
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
