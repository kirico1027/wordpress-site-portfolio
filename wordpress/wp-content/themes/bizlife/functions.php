<?php
/**
 * BizLife theme functions.
 *
 * Keep this file as a thin loader. Logic lives in inc/.
 *
 * @package BizLife
 */

if (!defined('ABSPATH')) {
  exit;
}

require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/cpt.php';
require_once get_template_directory() . '/inc/acf.php';
require_once get_template_directory() . '/inc/works.php';
require_once get_template_directory() . '/inc/ajax-works.php';
