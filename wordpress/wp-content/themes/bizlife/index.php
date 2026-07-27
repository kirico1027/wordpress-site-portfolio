<?php
/**
 * Fallback template.
 *
 * Used when no more specific template matches.
 * Page-specific templates are added from Step 3 onward.
 *
 * @package BizLife
 */

get_header();
?>
<main>
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
      <?php the_post(); ?>
      <article <?php post_class(); ?>>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      </article>
    <?php endwhile; ?>
  <?php else : ?>
    <p><?php esc_html_e('Content not found.', 'bizlife'); ?></p>
  <?php endif; ?>
</main>
<?php
get_footer();
