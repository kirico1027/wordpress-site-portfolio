<?php
/**
 * Search results (Blog sidebar search: post_type=post).
 *
 * @package BizLife
 */

get_header();

$search_query = get_search_query();
?>
<main class="blog-archive-page">
  <section class="blog-archive" aria-label="検索結果">
    <div class="container blog-archive__inner">
      <div class="blog-archive__main">
        <h2 class="blog-archive__heading">
          <?php
          printf(
            /* translators: %s: search query */
            esc_html__('「%s」の検索結果', 'bizlife'),
            esc_html($search_query)
          );
          ?>
        </h2>
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
            <p class="blog-archive__empty"><?php esc_html_e('該当する記事が見つかりませんでした。', 'bizlife'); ?></p>
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
