<?php
/**
 * Plugin Name: Back to the Top
 * Plugin URI:  https://github.com/thingsym/back-to-the-top
 * Description: Back to the Top is a WordPress plugin to return to scroll smoothly to the top of the page. You can scroll to the smooth anchor link in the page.
 * Version:     1.2.1
 * Author:      thingsym
 * Author URI:  https://www.thingslabo.com/
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: backtothetop
 * Domain Path: /languages/
 *
 * @package Back_To_The_Top
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( '__BACK_TO_THE_TOP__', __FILE__ );

require_once plugin_dir_path( __FILE__ ) . 'inc/class-back-to-the-top.php';

if ( class_exists( 'Back_To_The_Top' ) ) {
	new Back_To_The_Top();
};
