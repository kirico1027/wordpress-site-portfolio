<?php
/**
 * Front page template.
 *
 * Assigned via Settings → Reading (page_on_front = home).
 * Phase 2: static section markup via template-parts.
 *
 * @package BizLife
 */

get_header();
?>
<main class="top-page">
  <?php
  get_template_part('template-parts/sections/top-hero');
  get_template_part('template-parts/sections/top-about');
  get_template_part('template-parts/sections/top-services');
  get_template_part('template-parts/sections/top-works');
  get_template_part('template-parts/sections/top-company');
  get_template_part('template-parts/sections/top-news');
  get_template_part('template-parts/sections/cta-contact');
  ?>
</main>
<?php
get_footer();
