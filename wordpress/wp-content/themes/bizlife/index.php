<?php
/**
 * Fallback template.
 *
 * Phase 2 Step 1: minimal valid theme entry.
 * Do not call get_header()/get_footer() until those files exist (Step 2).
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<main>
  <p><?php esc_html_e('BizLife theme (Phase 2 Step 1 scaffold).', 'bizlife'); ?></p>
</main>
<?php wp_footer(); ?>
</body>
</html>
