<?php
/**
 * Single blog post template.
 *
 * Renders post title, date, categories, and content dynamically.
 * Pickup, share, breadcrumb current, and hero image remain static (Phase 2).
 *
 * @package BizLife
 */

get_header();

$blog_archive_href = home_url('/blog/');
$blog_single_href = '#';
$img_blog_single_hero = get_theme_file_uri('assets/img/blog/blog-single_hero.png');
$img_blog_single_pickup_01 = get_theme_file_uri('assets/img/blog/blog-single_pickup_01.png');
$img_blog_single_pickup_02 = get_theme_file_uri('assets/img/blog/blog-single_pickup_02.png');
$img_blog_single_pickup_03 = get_theme_file_uri('assets/img/blog/blog-single_pickup_03.png');
?>
<main class="blog-single-page blog-single">
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
        <span class="blog-single__breadcrumb-current" aria-current="page">福利厚生の進化：従業員の幸福を...</span>
      </nav>
      <span class="blog-single__breadcrumb-line" aria-hidden="true"></span>
    </div>
  </div>

  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
      <?php the_post(); ?>
      <article class="blog-single__article" aria-labelledby="blog-single-heading">
        <div class="container blog-single__inner">
          <div class="blog-single__content">
            <div class="blog-single__meta">
              <ul class="blog-single__tags">
                <?php foreach (get_the_category() as $category) : ?>
                  <li class="blog-single__tag"><?php echo esc_html($category->name); ?></li>
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
              <img
                src="<?php echo esc_url($img_blog_single_hero); ?>"
                alt=""
                width="720"
                height="432"
              />
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

  <section class="blog-single__pickup" aria-labelledby="blog-pickup-heading">
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
        <article class="blog-card">
          <a class="blog-card__link" href="<?php echo esc_url($blog_single_href); ?>">
            <figure class="blog-card__figure">
              <img src="<?php echo esc_url($img_blog_single_pickup_01); ?>" alt="" width="328" height="197" />
              <span class="blog-card__dim" aria-hidden="true"></span>
              <span class="blog-card__more" aria-hidden="true">Read more</span>
            </figure>
            <div class="blog-card__body">
              <ul class="blog-card__tags">
                <li class="blog-card__tag">お役立ち情報</li>
              </ul>
              <h3 class="blog-card__title">ビジネスの成功と従業員の幸福を両立させる福利厚生の秘訣</h3>
              <time class="blog-card__date" datetime="2024-04-25">2024/4/25</time>
            </div>
          </a>
        </article>
        <article class="blog-card">
          <a class="blog-card__link" href="<?php echo esc_url($blog_single_href); ?>">
            <figure class="blog-card__figure">
              <img src="<?php echo esc_url($img_blog_single_pickup_02); ?>" alt="" width="328" height="197" />
              <span class="blog-card__dim" aria-hidden="true"></span>
              <span class="blog-card__more" aria-hidden="true">Read more</span>
            </figure>
            <div class="blog-card__body">
              <ul class="blog-card__tags">
                <li class="blog-card__tag">導入事例</li>
              </ul>
              <h3 class="blog-card__title">従業員の幸福と企業の繁栄を両立する福利厚生戦略</h3>
              <time class="blog-card__date" datetime="2024-04-09">2024/4/9</time>
            </div>
          </a>
        </article>
        <article class="blog-card">
          <a class="blog-card__link" href="<?php echo esc_url($blog_single_href); ?>">
            <figure class="blog-card__figure">
              <img src="<?php echo esc_url($img_blog_single_pickup_03); ?>" alt="" width="328" height="197" />
              <span class="blog-card__dim" aria-hidden="true"></span>
              <span class="blog-card__more" aria-hidden="true">Read more</span>
            </figure>
            <div class="blog-card__body">
              <ul class="blog-card__tags">
                <li class="blog-card__tag">お役立ち情報</li>
                <li class="blog-card__tag">新着記事</li>
              </ul>
              <h3 class="blog-card__title">幸せな働き方を支援する福利厚生プログラムの魅力</h3>
              <time class="blog-card__date" datetime="2024-04-14">2024/4/14</time>
            </div>
          </a>
        </article>
      </div>
    </div>
  </section>
</main>
<?php
get_footer();
