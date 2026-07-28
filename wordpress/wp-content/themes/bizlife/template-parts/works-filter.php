<?php
/**
 * Works archive filter navigation.
 *
 * Shared by archive-works.php and taxonomy-works_category.php.
 *
 * @package BizLife
 */

$works_archive_url = get_post_type_archive_link('works');
$is_all_active = is_post_type_archive('works') && !is_tax('works_category');

$term_order = array(
  'mental-coach',
  'connected-workflow',
  'welfare-cloud',
);

$terms_by_slug = array();
$terms = get_terms(
  array(
    'taxonomy'   => 'works_category',
    'hide_empty' => false,
  )
);

if (!is_wp_error($terms) && is_array($terms)) {
  foreach ($terms as $term) {
    $terms_by_slug[$term->slug] = $term;
  }
}
?>
<div class="works-archive__filters-sticky">
  <nav class="works-archive__filters" aria-label="カテゴリフィルター">
    <a
      class="works-archive__filter<?php echo $is_all_active ? ' works-archive__filter--active' : ''; ?>"
      href="<?php echo esc_url($works_archive_url ? $works_archive_url : home_url('/works/')); ?>"
      <?php echo $is_all_active ? ' aria-current="page"' : ''; ?>
    >すべて</a>
    <ul class="works-archive__filter-list">
      <?php foreach ($term_order as $slug) : ?>
        <?php
        if (!isset($terms_by_slug[$slug])) {
          continue;
        }

        $term = $terms_by_slug[$slug];
        $term_link = get_term_link($term);

        if (is_wp_error($term_link)) {
          continue;
        }

        $is_term_active = is_tax('works_category', $slug);
        $filter_class = 'works-archive__filter';

        if ($is_term_active) {
          $filter_class .= ' works-archive__filter--active';
        }
        ?>
      <li class="works-archive__filter-item">
        <a
          class="<?php echo esc_attr($filter_class); ?>"
          href="<?php echo esc_url($term_link); ?>"
          <?php echo $is_term_active ? ' aria-current="page"' : ''; ?>
        ><?php echo esc_html($term->name); ?></a>
      </li>
      <?php endforeach; ?>
    </ul>
  </nav>
</div>
