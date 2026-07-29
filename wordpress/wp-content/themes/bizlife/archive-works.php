<?php
/**
 * Works archive template (CPT: works).
 *
 * Main query shows the first batch; further posts load via Ajax.
 *
 * @package BizLife
 */

get_header();

$works_has_more      = bizlife_works_archive_has_more();
$works_category_slug = '';
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
            <?php
            the_post();
            get_template_part(
              'template-parts/cards/works-card',
              null,
              bizlife_get_works_card_args(get_post())
            );
            ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>

      <div
        class="works-archive__more-wrap<?php echo $works_has_more ? '' : ' is-hidden'; ?>"
        data-works-load-more
        data-next-page="2"
        data-category="<?php echo esc_attr($works_category_slug); ?>"
        <?php echo $works_has_more ? '' : ' hidden'; ?>
      >
        <button class="works-archive__more" type="button" aria-busy="false">
          <span class="works-archive__more-label">もっと見る</span>
          <span class="works-archive__more-icon" aria-hidden="true"><span class="material-icons">keyboard_arrow_down</span></span>
        </button>
        <p class="works-archive__more-error" hidden role="alert"></p>
      </div>
    </div>
  </section>

  <?php get_template_part('template-parts/sections/cta-contact'); ?>
</main>
<?php
get_footer();
