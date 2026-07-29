<?php
/**
 * Single blog post template.
 *
 * Dynamic: breadcrumb title, categories, date, title, hero, content, Pick up.
 * Share UI remains decorative (no share URLs in design).
 *
 * @package BizLife
 */

get_header();

$blog_archive_href = home_url('/blog/');
$pickup_query = null;
?>
<main class="blog-single-page blog-single">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
      <?php
      the_post();
      $pickup_query = bizlife_get_blog_pickup_query(get_post());
      $category_names = bizlife_get_blog_category_names(get_post());
      ?>
  <div class="blog-single__breadcrumb-area">
    <div class="container blog-single__breadcrumb-inner">
      <nav class="blog-single__breadcrumb" aria-label="パンくずリスト">
        <a class="blog-single__breadcrumb-parent" href="<?php echo esc_url($blog_archive_href); ?>">
          <span class="blog-single__breadcrumb-en">Blog</span>
          <span class="blog-single__breadcrumb-ja">ブログ</span>
        </a>
        <span class="blog-single__breadcrumb-sep" aria-hidden="true">
          <span class="material-icons">chevron_right</span>
        </span>
        <span class="blog-single__breadcrumb-current" aria-current="page"><?php echo esc_html(get_the_title()); ?></span>
      </nav>
      <span class="blog-single__breadcrumb-line" aria-hidden="true"></span>
    </div>
  </div>

      <article class="blog-single__article" aria-labelledby="blog-single-heading">
        <div class="container blog-single__inner">
          <div class="blog-single__content">
            <div class="blog-single__meta">
              <ul class="blog-single__tags">
                <?php foreach ($category_names as $category_name) : ?>
                  <li class="blog-single__tag"><?php echo esc_html($category_name); ?></li>
                <?php endforeach; ?>
              </ul>
              <time class="blog-single__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                <?php echo esc_html(get_the_date('Y/n/j H:i')); ?>
              </time>
            </div>

            <h1 id="blog-single-heading" class="blog-single__title">
              <?php the_title(); ?>
            </h1>

            <figure class="blog-single__hero">
              <?php if (has_post_thumbnail()) : ?>
                <?php echo get_the_post_thumbnail(null, 'large'); ?>
              <?php else : ?>
              <img
                src="<?php echo esc_url(bizlife_blog_single_hero_fallback_url()); ?>"
                alt=""
                width="720"
                height="432"
              />
              <?php endif; ?>
            </figure>

            <div class="blog-single__body">
              <?php the_content(); ?>
            </div>

            <div class="blog-single__share">
              <p class="blog-single__share-label">\ Let's shere ! /</p>
              <ul class="blog-single__share-list" aria-hidden="true">
                <li><span class="blog-single__share-link"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></span></li>
                <li><span class="blog-single__share-link"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></span></li>
              </ul>
            </div>
          </div>

          <div class="blog-single__back">
            <?php
            get_template_part(
              'template-parts/sections/btn-more',
              null,
              array(
                'modifier' => '',
                'href'     => $blog_archive_href,
                'label'    => '一覧ページに戻る',
              )
            );
            ?>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php if ($pickup_query instanceof WP_Query) : ?>
  <section class="blog-single__pickup" aria-label="今話題の記事">
    <div class="container blog-single__pickup-inner">
      <?php
      get_template_part(
        'template-parts/sections/section-heading',
        null,
        array(
          'en'    => 'Pick up',
          'title' => '今話題の記事',
        )
      );
      ?>

      <div class="blog-single__pickup-grid">
        <?php while ($pickup_query->have_posts()) : ?>
          <?php
          $pickup_query->the_post();
          get_template_part(
            'template-parts/cards/blog-card',
            null,
            bizlife_get_blog_card_args(get_post())
          );
          ?>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>
</main>
<?php
get_footer();
