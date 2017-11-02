<?php
/**
 * Plugin Name: MyBanner
 * Plugin URI: https://github.com/pihedy/SubModal
 * Description: TODO
 * Version: 0.1.0
 * Author: Pihedy
 * Author URI: https://github.com/pihedy/MyBanner
 * Requires at least: 4.0
 * Tested up to: 4.8
 *
 * Text Domain: goat
 * Domain Path: /languages/
 *
 */

// no direct access
defined( 'ABSPATH' ) or die;

define('G_MY_BANNER_ROOT', __FILE__);
define('G_MY_BANNER_ROOT_URL', plugin_dir_url(__FILE__));
define('G_MY_BANNER_ASSETS', G_MY_BANNER_ROOT_URL . 'assets/');
define('G_MY_BANNER_INC', __DIR__ . '/include');
define('G_MY_BANNER_INC_ADMIN', G_MY_BANNER_INC . '/admin');
define('G_MY_BANNER_INC_SITE', G_MY_BANNER_INC . '/site');

require G_MY_BANNER_INC_ADMIN . '/functions.php';
require G_MY_BANNER_INC_SITE . '/functions.php';

// only admin
if (is_admin()) {
    new gMyBannerAdmin;
}

// only site
new gMyBannerSite;
