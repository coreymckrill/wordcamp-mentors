<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

use WordCamp\Mentors;

const USER_OPTION_KEY = 'wordcamp-mentors-tasks-dashboard';

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
		'wordcamp-mentors-tasks-dashboard',
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

	// Sort categories
	if ( isset( $data['categories'] ) ) {
		// Use `get_user_option` instead of `get_user_meta` so that it's site-specific
		$user_options = get_user_option( USER_OPTION_KEY );

		if ( is_array( $user_options ) && isset( $user_options['tab-order'] ) ) {
			$user_order = array_intersect( array_unique( $user_options['tab-order'] ), array_keys( $data['categories'] ) );

			$data['categories'] = array_merge(
				array_flip( $user_order ),
				$data['categories']
			);
		}
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
	$tasks = new Tasks( $data['tasks'] );
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
	if ( 'dashboard_page_wordcamp-mentors-tasks-dashboard' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_style(
		'wordcamp-mentors-tasks-dashboard',
		Mentors\get_css_url() . 'tasks/dashboard.css',
		array(),
		Mentors\CSS_VERSION
	);

	$script_dependencies = array(
		'jquery',
		'jquery-ui-core',
		'jquery-ui-tabs',
		'jquery-ui-progressbar',
		'jquery-ui-sortable'
	);

	wp_enqueue_script(
		'wordcamp-mentors-tasks-dashboard',
		Mentors\get_js_url() . 'tasks/dashboard.js',
		$script_dependencies,
		Mentors\JS_VERSION,
		true
	);
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_page_assets' );

/**
 * Handle Ajax requests from the Tasks Dashboard page.
 *
 * @since 1.0.0
 */
function handle_requests() {
	if ( 'wp_ajax_wordcamp-mentors-tasks-dashboard' !== current_action() ||
	     ! defined( 'DOING_AJAX' ) ||
	     ! DOING_AJAX ||
	     ! isset( $_POST['nonce'] ) ||
		 ! isset( $_POST['data'] ) ) {
		wp_send_json_error();
	}

	$request = new Ajax_Request( $_POST['nonce'], $_POST['data'] );

	$request->send_response();

	wp_die();
}

add_action( 'wp_ajax_wordcamp-mentors-tasks-dashboard', __NAMESPACE__ . '\handle_requests' );