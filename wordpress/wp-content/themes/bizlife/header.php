<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover" />
  <?php
  /*
   * Mobile reload flicker prevention.
   * Must run after <meta viewport> and before wp_head().
   * Mirrors src/partials/head.html inline script.
   */
  ?>
  <script>
    document.documentElement.classList.add("js");
    (function () {
      var mobileQuery = "(max-width: 768px)";
      if ("scrollRestoration" in history) {
        history.scrollRestoration = "manual";
      }
      function snapMobileBelowTop() {
        if (!window.matchMedia(mobileQuery).matches) return;
        if (window.scrollY < 1) {
          window.scrollTo(0, 1);
        }
      }
      snapMobileBelowTop();
      document.addEventListener("DOMContentLoaded", snapMobileBelowTop);
      window.addEventListener("pageshow", snapMobileBelowTop);
      window.addEventListener("load", snapMobileBelowTop);
      if (window.visualViewport) {
        window.visualViewport.addEventListener("resize", snapMobileBelowTop);
      }
    })();
  </script>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php get_template_part('template-parts/header'); ?>
