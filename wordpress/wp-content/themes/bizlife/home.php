<?php
/**
 * Blog posts archive (Posts page: /blog/).
 *
 * Featured slider: latest 5 posts.
 * Main grid: main query (latest posts, BIZLIFE_BLOG_PER_PAGE).
 * Sidebar remains static for now.
 *
 * @package BizLife
 */

get_header();

$featured_query = bizlife_get_blog_featured_query();
$img_works_01 = get_theme_file_uri('assets/img/works/works_01.png');
$img_works_02 = get_theme_file_uri('assets/img/works/works_02.png');
$img_works_03 = get_theme_file_uri('assets/img/works/works_03.png');
$blog_single_href = '#';
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
        <div class="blog-archive__more-wrap">
          <button class="blog-archive__more" type="button">
            <span class="blog-archive__more-label">もっと見る</span>
            <span class="blog-archive__more-icon" aria-hidden="true"><span class="material-icons">keyboard_arrow_down</span></span>
          </button>
        </div>
      </div>

      <aside class="blog-archive__sidebar" aria-label="ブログサイドバー">
        <div class="blog-archive__widget blog-archive__widget--category">
          <p class="blog-archive__widget-title">
            <span class="blog-archive__widget-title-en">CATEGORY</span>
            <span class="blog-archive__widget-title-ja">カテゴリ</span>
          </p>
          <ul class="blog-archive__categories">
            <li><a class="blog-archive__category" href="#">新着記事</a></li>
            <li><a class="blog-archive__category" href="#">お役立ち情報</a></li>
            <li><a class="blog-archive__category" href="#">働き方</a></li>
            <li><a class="blog-archive__category" href="#">サービス・事業</a></li>
            <li><a class="blog-archive__category" href="#">導入事例</a></li>
            <li><a class="blog-archive__category" href="#">おすすめ</a></li>
            <li><a class="blog-archive__category" href="#">社員インタビュー</a></li>
            <li><a class="blog-archive__category" href="#">その他</a></li>
          </ul>
        </div>

        <div class="blog-archive__widget blog-archive__widget--keyword">
          <p class="blog-archive__widget-title">
            <span class="blog-archive__widget-title-en">KEYWORD</span>
            <span class="blog-archive__widget-title-ja">キーワード検索</span>
          </p>
          <form class="blog-archive__search" role="search" action="#" method="get">
            <label class="u-visually-hidden" for="blog-search">キーワード検索</label>
            <input id="blog-search" class="blog-archive__search-input" type="search" name="s" placeholder="Search" />
            <button class="blog-archive__search-btn" type="submit" aria-label="検索する">
              <span class="material-icons" aria-hidden="true">search</span>
            </button>
          </form>
        </div>

        <div class="blog-archive__widget blog-archive__widget--pickup">
          <p class="blog-archive__widget-title">
            <span class="blog-archive__widget-title-en">PICK UP</span>
            <span class="blog-archive__widget-title-ja">今話題の記事</span>
          </p>
          <div class="blog-archive__pickup">
            <a class="blog-pickup" href="<?php echo esc_url($blog_single_href); ?>">
              <figure class="blog-pickup__figure">
                <img src="<?php echo esc_url($img_works_01); ?>" alt="" width="272" height="163" />
                <span class="blog-pickup__dim" aria-hidden="true"></span>
                <span class="blog-pickup__more" aria-hidden="true">Read more</span>
              </figure>
              <div class="blog-pickup__body">
                <p class="blog-pickup__title">福利厚生の進化：従業員の幸福を追求するビジネスの新たな道</p>
                <p class="blog-pickup__category"><span class="blog-pickup__dot" aria-hidden="true"></span>社員インタビュー</p>
              </div>
            </a>
            <a class="blog-pickup" href="<?php echo esc_url($blog_single_href); ?>">
              <figure class="blog-pickup__figure">
                <img src="<?php echo esc_url($img_works_02); ?>" alt="" width="272" height="163" />
                <span class="blog-pickup__dim" aria-hidden="true"></span>
                <span class="blog-pickup__more" aria-hidden="true">Read more</span>
              </figure>
              <div class="blog-pickup__body">
                <p class="blog-pickup__title">ビジネスの成功と従業員の幸福を両立させる福利厚生の秘訣</p>
                <p class="blog-pickup__category"><span class="blog-pickup__dot" aria-hidden="true"></span>お役立ち情報</p>
              </div>
            </a>
            <a class="blog-pickup" href="<?php echo esc_url($blog_single_href); ?>">
              <figure class="blog-pickup__figure">
                <img src="<?php echo esc_url($img_works_03); ?>" alt="" width="272" height="163" />
                <span class="blog-pickup__dim" aria-hidden="true"></span>
                <span class="blog-pickup__more" aria-hidden="true">Read more</span>
              </figure>
              <div class="blog-pickup__body">
                <p class="blog-pickup__title">福利厚生の進化：従業員の幸福を追求するビジネスの新たな道</p>
                <p class="blog-pickup__category"><span class="blog-pickup__dot" aria-hidden="true"></span>社員インタビュー</p>
              </div>
            </a>
          </div>
        </div>
      </aside>
    </div>
  </section>

  <?php get_template_part('template-parts/sections/cta-contact'); ?>
</main>
<?php
get_footer();
