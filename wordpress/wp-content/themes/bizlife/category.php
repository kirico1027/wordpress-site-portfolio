<?php
/**
 * Category archive for Blog posts.
 *
 * Reuses Blog archive card / sidebar design without the featured slider.
 *
 * @package BizLife
 */

get_header();
?>
<main class="blog-archive-page">
  <section class="blog-archive" aria-label="カテゴリー一覧">
    <div class="container blog-archive__inner">
      <div class="blog-archive__main">
        <h2 class="blog-archive__heading"><?php single_cat_title(); ?></h2>
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
          <?php else : ?>
            <p class="blog-archive__empty"><?php esc_html_e('このカテゴリーの記事はまだありません。', 'bizlife'); ?></p>
          <?php endif; ?>
        </div>
      </div>

      <?php get_template_part('template-parts/blog-sidebar'); ?>
    </div>
  </section>

  <?php get_template_part('template-parts/sections/cta-contact'); ?>
</main>
<?php
get_footer();
