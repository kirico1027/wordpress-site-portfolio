<?php
/**
 * News archive filter navigation.
 *
 * Shared by archive-news.php and taxonomy-news_category.php.
 *
 * Active state uses `--active` + aria-current (static / Works pattern).
 *
 * @package BizLife
 */

$news_archive_url = get_post_type_archive_link('news');
$is_all_active    = is_post_type_archive('news') && !is_tax('news_category');

$term_order   = bizlife_news_category_term_order();
$terms_by_slug = array();
$terms         = get_terms(
  array(
    'taxonomy'   => 'news_category',
    'hide_empty' => false,
  )
);

if (!is_wp_error($terms) && is_array($terms)) {
  foreach ($terms as $term) {
    $terms_by_slug[$term->slug] = $term;
  }
}
?>
<nav class="news-archive__filters" aria-label="カテゴリフィルター">
  <a
    class="news-archive__filter<?php echo $is_all_active ? ' news-archive__filter--active' : ''; ?>"
    href="<?php echo esc_url($news_archive_url ? $news_archive_url : home_url('/news/')); ?>"
    <?php echo $is_all_active ? ' aria-current="page"' : ''; ?>
  >すべて</a>
  <ul class="news-archive__filter-list">
    <?php foreach ($term_order as $slug) : ?>
      <?php
      if (!isset($terms_by_slug[$slug])) {
        continue;
      }

      $term      = $terms_by_slug[$slug];
      $term_link = get_term_link($term);

      if (is_wp_error($term_link)) {
        continue;
      }

      $is_term_active = is_tax('news_category', $slug);
      $filter_class   = 'news-archive__filter';

      if ($is_term_active) {
        $filter_class .= ' news-archive__filter--active';
      }
      ?>
    <li class="news-archive__filter-item">
      <a
        class="<?php echo esc_attr($filter_class); ?>"
        href="<?php echo esc_url($term_link); ?>"
        <?php echo $is_term_active ? ' aria-current="page"' : ''; ?>
      ><?php echo esc_html($term->name); ?></a>
    </li>
    <?php endforeach; ?>
  </ul>
</nav>
