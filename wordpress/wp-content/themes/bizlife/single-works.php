<?php
/**
 * Single Works template (CPT: works).
 *
 * Related works (same works_category) render below the article when available.
 *
 * @package BizLife
 */

get_header();

$works_archive_href = home_url('/works/');
$img_works_single_hero_fallback = get_theme_file_uri('assets/img/works-single/works-single_01.png');
$company_description_fallback = 'モンキーは、クリエイティブなデザインとブランディングソリューションを提供する会社です。当社のデザインチームは、顧客企業のビジュアルアイデンティティを強化し、魅力的なブランドイメージを構築するための戦略的なアプローチを提供しています。';

$related_works_query = null;
?>
<main class="works-single-page works-single">
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
      <?php
      the_post();
      // Related query does not alter the global post until its loop runs below.
      $related_works_query = bizlife_get_related_works_query(get_post());
      ?>
  <div class="works-single__breadcrumb-area">
    <div class="container works-single__breadcrumb-inner">
      <nav class="works-single__breadcrumb" aria-label="パンくずリスト">
        <a class="works-single__breadcrumb-parent" href="<?php echo esc_url($works_archive_href); ?>">
          <span class="works-single__breadcrumb-en">Works</span>
          <span class="works-single__breadcrumb-ja">実績紹介</span>
        </a>
        <span class="works-single__breadcrumb-sep" aria-hidden="true">
          <span class="material-icons">chevron_right</span>
        </span>
        <span class="works-single__breadcrumb-current" aria-current="page"><?php echo esc_html(get_the_title()); ?></span>
      </nav>
    </div>
  </div>

      <article class="works-single__article" aria-labelledby="works-single-heading">
        <div class="container works-single__inner">
          <div class="works-single__content">
            <time class="works-single__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
              <?php echo esc_html(get_the_date('Y/n/j H:i')); ?>
            </time>
            <h1 id="works-single-heading" class="works-single__title">
              <?php the_title(); ?>
            </h1>

            <figure class="works-single__hero">
              <?php if (has_post_thumbnail()) : ?>
                <?php
                // Prefer the media library alt; do not force a sample/empty override.
                echo get_the_post_thumbnail(null, 'large');
                ?>
              <?php else : ?>
              <img
                src="<?php echo esc_url($img_works_single_hero_fallback); ?>"
                alt=""
                width="720"
                height="432"
              />
              <?php endif; ?>
            </figure>

            <div class="works-single__client">
              <?php
              $company_name = function_exists('get_field') ? get_field('company_name') : '';
              if (!$company_name) {
                $company_name = '株式会社サンプル';
              }

              $company_description = function_exists('get_field') ? get_field('company_description') : '';
              if (!$company_description) {
                $company_description = $company_description_fallback;
              }
              ?>
              <div class="works-single__client-head">
                <p class="works-single__client-name"><?php echo esc_html($company_name); ?></p>
              </div>
              <p class="works-single__client-desc"><?php echo nl2br(esc_html(wp_strip_all_tags($company_description))); ?></p>
            </div>

            <div class="works-single__body">
              <?php the_content(); ?>
            </div>

            <div class="works-single__share">
              <p class="works-single__share-label">\ Let's shere ! /</p>
              <ul class="works-single__share-list" aria-hidden="true">
                <li><span class="works-single__share-link"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></span></li>
                <li><span class="works-single__share-link"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></span></li>
              </ul>
            </div>
          </div>

          <div class="works-single__back">
            <?php
            get_template_part(
              'template-parts/sections/btn-more',
              null,
              array(
                'modifier' => '',
                'href'     => $works_archive_href,
                'label'    => '一覧ページに戻る',
              )
            );
            ?>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php if ($related_works_query instanceof WP_Query) : ?>
  <section class="works-single__pickup" aria-label="関連実績">
    <div class="container works-single__pickup-inner">
      <?php
      get_template_part(
        'template-parts/sections/section-heading',
        null,
        array(
          'en'    => 'RELATED WORKS',
          'title' => '関連実績',
        )
      );
      ?>

      <div class="works-single__pickup-grid">
        <?php while ($related_works_query->have_posts()) : ?>
          <?php
          $related_works_query->the_post();
          get_template_part(
            'template-parts/cards/works-card',
            null,
            bizlife_get_works_card_args(get_post())
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
