<?php
/**
 * Blog archive sidebar (CATEGORY / KEYWORD / PICK UP).
 *
 * @package BizLife
 */

$blog_categories   = bizlife_get_blog_sidebar_categories();
$blog_pickup_query = bizlife_get_blog_pickup_query();
$blog_search_value = '';

if (is_search()) {
  $blog_search_value = get_search_query();
}
?>
<aside class="blog-archive__sidebar" aria-label="ブログサイドバー">
  <?php if ($blog_categories) : ?>
  <div class="blog-archive__widget blog-archive__widget--category">
    <p class="blog-archive__widget-title">
      <span class="blog-archive__widget-title-en">CATEGORY</span>
      <span class="blog-archive__widget-title-ja">カテゴリ</span>
    </p>
    <ul class="blog-archive__categories">
      <?php foreach ($blog_categories as $blog_category) : ?>
        <?php
        $is_current = is_category($blog_category->term_id);
        $link_class = 'blog-archive__category' . ($is_current ? ' is-current' : '');
        ?>
      <li>
        <a
          class="<?php echo esc_attr($link_class); ?>"
          href="<?php echo esc_url(get_category_link($blog_category->term_id)); ?>"
          <?php echo $is_current ? ' aria-current="page"' : ''; ?>
        ><?php echo esc_html($blog_category->name); ?></a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <div class="blog-archive__widget blog-archive__widget--keyword">
    <p class="blog-archive__widget-title">
      <span class="blog-archive__widget-title-en">KEYWORD</span>
      <span class="blog-archive__widget-title-ja">キーワード検索</span>
    </p>
    <form class="blog-archive__search" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
      <input type="hidden" name="post_type" value="post" />
      <label class="u-visually-hidden" for="blog-search">キーワード検索</label>
      <input
        id="blog-search"
        class="blog-archive__search-input"
        type="search"
        name="s"
        placeholder="Search"
        value="<?php echo esc_attr($blog_search_value); ?>"
      />
      <button class="blog-archive__search-btn" type="submit" aria-label="検索する">
        <span class="material-icons" aria-hidden="true">search</span>
      </button>
    </form>
  </div>

  <?php if ($blog_pickup_query instanceof WP_Query) : ?>
  <div class="blog-archive__widget blog-archive__widget--pickup">
    <p class="blog-archive__widget-title">
      <span class="blog-archive__widget-title-en">PICK UP</span>
      <span class="blog-archive__widget-title-ja">今話題の記事</span>
    </p>
    <div class="blog-archive__pickup">
      <?php while ($blog_pickup_query->have_posts()) : ?>
        <?php
        $blog_pickup_query->the_post();
        get_template_part(
          'template-parts/cards/blog-pickup',
          null,
          bizlife_get_blog_pickup_args(get_post())
        );
        ?>
      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    </div>
  </div>
  <?php endif; ?>
</aside>
