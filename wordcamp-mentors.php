<?php
/**
 * Plugin Name:     WordCamp Mentors
 * Plugin URI:      n/a
 * Description:     n/a
 * Author:          WordCamp.org
 * Author URI:      https://wordcamp.org
 * Text Domain:     wordcamp-mentors
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         WordCamp\Mentors
 */

namespace WordCamp\Mentors;

const PLUGIN_VERSION = '1.0.0';
const JS_VERSION     = '1.0.0';
const CSS_VERSION    = '1.0.0';

define( __NAMESPACE__ . '\PLUGIN_DIR', \plugin_dir_path( __FILE__ ) );
define( __NAMESPACE__ . '\PLUGIN_URL', \plugins_url( '/', __FILE__ ) );

const MENTOR_CAP    = 'manage_network';
const ORGANIZER_CAP = 'switch_themes';

/**
 * Get the path for the includes directory.
 *
 * @since 1.0.0
 *
 * @return string Path with trailing slash
 */
function get_includes_dir_path() {
	return trailingslashit( PLUGIN_DIR ) . 'includes/';
}

/**
 * Get the path for the views directory.
 *
 * @since 1.0.0
 *
 * @return string Path with trailing slash
 */
function get_views_dir_path() {
	return trailingslashit( PLUGIN_DIR ) . 'views/';
}

/**
 * The the URL for the JavaScript assets directory.
 *
 * @since 1.0.0
 *
 * @return string URL with trailing slash
 */
function get_js_url() {
	return trailingslashit( PLUGIN_URL ) . 'js/';
}

/**
 * Get the URL for the CSS assets directory.
 *
 * @since 1.0.0
 *
 * @return string URL with trailing slash
 */
function get_css_url() {
	return trailingslashit( PLUGIN_URL ) . 'css/';
}

/**
 * Load the plugin's files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function load_files() {
	$files = array(
		'tasks/classes.php',
		'tasks/dashboard.php',
	);

	foreach ( $files as $file ) {
		$file = get_includes_dir_path() . $file;

		if ( is_readable( $file ) ) {
			require_once $file;
		}
	}
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\load_files' );

/**
 * Load the translation file for the current locale.
 *
 * @since 1.0.0
 *
 * @return void
 */
function localize() {
	load_plugin_textdomain( 'wordcamp-mentors' );
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\localize' );