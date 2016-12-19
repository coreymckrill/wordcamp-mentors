<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

use WordCamp\Mentors;

/**
 * Add the Tasks Dashboard page to the Dashboard menu.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_page() {
	\add_submenu_page(
		'index.php',
		__( 'Tasks Dashboard', 'wordcamp-mentors' ),
		__( 'Tasks', 'wordcamp-mentors' ),
		Mentors\ORGANIZER_CAP,
		'mentors-tasks',
		__NAMESPACE__ . '\render_page'
	);
}

add_action( 'admin_menu', __NAMESPACE__ . '\add_page' );

/**
 * Load the file containing all the translation strings and other data for the Tasks Dashboard.
 *
 * @since 1.0.0
 *
 * @return array
 */
function load_task_data() {
	$data = array();

	$file = Mentors\get_includes_dir_path() . 'tasks/data.php';
	if ( is_readable( $file ) ) {
		require $file;
	}

	/**
	 * Filter: Modify the array of statically-defined task data.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data
	 */
	return apply_filters( 'wordcamp_mentors_task_data', $data );
}

/**
 * Render callback for the Tasks Dashboard page.
 *
 * @since 1.0.0
 *
 * return void
 */
function render_page() {
	$data = load_task_data();
	$tasks = new Mentors\Tasks( $data['tasks'] );
	unset( $data['tasks'] );

	require Mentors\get_views_dir_path() . 'tasks/page.php';
}

/**
 * Enqueue JavaScript and CSS assets for the Tasks Dashboard page.
 *
 * @since 1.0.0
 *
 * @return void
 */
function enqueue_page_assets( $hook_suffix ) {
	if ( 'dashboard_page_mentors-tasks' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_style(
		'wordcamp-mentors-tasks-dashboard',
		Mentors\get_css_url() . 'tasks/dashboard.css',
		array(),
		Mentors\CSS_VERSION
	);

	wp_enqueue_script(
		'wordcamp-mentors-tasks-dashboard',
		Mentors\get_js_url() . 'tasks/dashboard.js',
		array( 'jquery', 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-progressbar', 'jquery-ui-sortable' ),
		Mentors\JS_VERSION,
		true
	);
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_page_assets' );

// TODO Ajax stuff