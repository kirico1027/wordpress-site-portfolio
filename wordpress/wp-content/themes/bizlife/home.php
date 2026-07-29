<?php
/**
 * Blog posts archive (Posts page: /blog/).
 *
 * Featured slider, main grid (Ajax load more), and dynamic sidebar.
 *
 * @package BizLife
 */

get_header();

$featured_query = bizlife_get_blog_featured_query();
$blog_has_more  = bizlife_blog_archive_has_more();
?>
<main class="blog-archive-page">
  <section class="blog-featured" aria-label="注目の記事">
    <div class="blog-featured__viewport">
      <div class="blog-featured__track">
        <?php if ($featured_query->have_posts()) : ?>
          <?php while ($featured_query->have_posts()) : ?>
            <?php
            $featured_query->the_post();
            $featured_categories = bizlife_get_blog_category_names(get_post());
            $featured_thumbnail = get_the_post_thumbnail_url(null, 'large');
            if (!$featured_thumbnail) {
              $featured_thumbnail = bizlife_blog_fallback_thumbnail_url();
            }
            ?>
        <a class="blog-featured__slide" href="<?php echo esc_url(get_permalink()); ?>">
          <div class="blog-featured__card">
            <div class="blog-featured__content">
              <ul class="blog-featured__tags">
                <li class="blog-featured__tag"><?php echo esc_html($featured_categories[0]); ?></li>
              </ul>
              <p class="blog-featured__title"><?php echo esc_html(get_the_title()); ?></p>
              <time class="blog-featured__date" datetime="<?php echo esc_attr(get_the_date('Y-m-d')); ?>">
                <?php echo esc_html(get_the_date('Y/n/j')); ?>
              </time>
            </div>
            <figure class="blog-featured__figure">
              <img src="<?php echo esc_url($featured_thumbnail); ?>" alt="" width="550" height="330" />
            </figure>
          </div>
        </a>
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>
        <?php endif; ?>
      </div>
    </div>
    <div class="blog-featured__nav">
      <button type="button" class="blog-featured__nav-btn blog-featured__nav-btn--prev" aria-label="前のスライド">
        <span class="material-icons" aria-hidden="true">keyboard_arrow_left</span>
      </button>
      <button type="button" class="blog-featured__nav-btn blog-featured__nav-btn--next" aria-label="次のスライド">
        <span class="material-icons" aria-hidden="true">keyboard_arrow_right</span>
      </button>
    </div>
  </section>

  <section class="blog-archive" aria-label="ブログ一覧">
    <div class="container blog-archive__inner">
      <div class="blog-archive__main">
        <h2 class="blog-archive__heading">すべて</h2>
        <div class="blog-archive__grid">
          <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
              <?php
              the_post();
              get_template_part(
                'template-parts/cards/blog-card',
                null,
                bizlife_get_blog_card_args(get_post())
              );
              ?>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
        <div
          class="blog-archive__more-wrap<?php echo $blog_has_more ? '' : ' is-hidden'; ?>"
          data-blog-load-more
          data-next-page="2"
          <?php echo $blog_has_more ? '' : ' hidden'; ?>
        >
          <button class="blog-archive__more" type="button" aria-busy="false">
            <span class="blog-archive__more-label">もっと見る</span>
            <span class="blog-archive__more-icon" aria-hidden="true"><span class="material-icons">keyboard_arrow_down</span></span>
          </button>
          <p class="blog-archive__more-error" hidden role="alert"></p>
        </div>
      </div>

      <?php get_template_part('template-parts/blog-sidebar'); ?>
    </div>
  </section>

  <?php get_template_part('template-parts/sections/cta-contact'); ?>
</main>
<?php
get_footer();
