<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Tasks;
defined( 'WPINC' ) or die();

use WordCamp\Mentors;

/**
 * Initialize the Tasks functionality
 */
function init() {
	register_cpt();
	register_tax();
	register_status();

	// Admin notices
	if ( isset( $_GET['page'] ) && Mentors\PREFIX . '-planning-checklist' === $_GET['page'] ) {
		add_action( 'admin_notices', __NAMESPACE__ . '\admin_notices' );
	}
}

add_action( 'init', __NAMESPACE__ . '\init', 0 );

/**
 * Register custom post types.
 *
 * @since 1.0.0
 */
function register_cpt() {
	$labels = array(
		'name'                  => _x( 'Tasks', 'Post Type General Name', 'wordcamp-mentors' ),
		'singular_name'         => _x( 'Task', 'Post Type Singular Name', 'wordcamp-mentors' ),
		'menu_name'             => __( 'Tasks', 'wordcamp-mentors' ),
		'name_admin_bar'        => __( 'Tasks', 'wordcamp-mentors' ),
		'archives'              => __( 'Task Archives', 'wordcamp-mentors' ),
		'attributes'            => __( 'Task Attributes', 'wordcamp-mentors' ),
		'parent_item_colon'     => __( 'Parent Task:', 'wordcamp-mentors' ),
		'all_items'             => __( 'All Tasks', 'wordcamp-mentors' ),
		'add_new_item'          => __( 'Add New Task', 'wordcamp-mentors' ),
		'add_new'               => __( 'Add New', 'wordcamp-mentors' ),
		'new_item'              => __( 'New Task', 'wordcamp-mentors' ),
		'edit_item'             => __( 'Edit Task', 'wordcamp-mentors' ),
		'update_item'           => __( 'Update Task', 'wordcamp-mentors' ),
		'view_item'             => __( 'View Task', 'wordcamp-mentors' ),
		'view_items'            => __( 'View Tasks', 'wordcamp-mentors' ),
		'search_items'          => __( 'Search Task', 'wordcamp-mentors' ),
		'not_found'             => __( 'Not found', 'wordcamp-mentors' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'wordcamp-mentors' ),
		'featured_image'        => __( 'Featured Image', 'wordcamp-mentors' ),
		'set_featured_image'    => __( 'Set featured image', 'wordcamp-mentors' ),
		'remove_featured_image' => __( 'Remove featured image', 'wordcamp-mentors' ),
		'use_featured_image'    => __( 'Use as featured image', 'wordcamp-mentors' ),
		'insert_into_item'      => __( 'Insert into task', 'wordcamp-mentors' ),
		'uploaded_to_this_item' => __( 'Uploaded to this task', 'wordcamp-mentors' ),
		'items_list'            => __( 'Tasks list', 'wordcamp-mentors' ),
		'items_list_navigation' => __( 'Tasks list navigation', 'wordcamp-mentors' ),
		'filter_items_list'     => __( 'Filter tasks list', 'wordcamp-mentors' ),
	);

	$args = array(
		'label'                 => __( 'Task', 'wordcamp-mentors' ),
		'description'           => __( 'Planning Checklist tasks', 'wordcamp-mentors' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'page-attributes', ),
		'taxonomies'            => array( Mentors\PREFIX . '_task_category' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => false,
		'show_in_menu'          => false,
		'menu_position'         => 5,
		'show_in_admin_bar'     => false,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'rewrite'               => false,
		'capability_type'       => 'task',
		'show_in_rest'          => true,
		'rest_controller_class' => __NAMESPACE__ . '\Controller',
	);

	register_post_type( Mentors\PREFIX . '_task', $args );

	add_filter( 'map_meta_cap', __NAMESPACE__ . '\map_task_caps', 10, 2 );
}

/**
 * Map CPT capabilities.
 *
 * @since 1.0.0
 *
 * @param array  $caps
 * @param string $cap
 *
 * @return array
 */
function map_task_caps( $caps, $cap ) {
	switch ( $cap ) {
		case 'edit_task' :
		case 'edit_tasks' :
		case 'edit_others_tasks' :
		case 'read_task' :
			$caps[] = Mentors\ORGANIZER_CAP;
			break;

		case 'read_private_tasks' :
		case 'publish_tasks' :
		case 'delete_task' :
			$caps[] = Mentors\MENTOR_CAP;
			break;
	}

	return $caps;
}

/**
 * Register custom taxonomies.
 *
 * @since 1.0.0
 */
function register_tax() {
	$labels = array(
		'name'                       => _x( 'Task Categories', 'Taxonomy General Name', 'wordcamp-mentors' ),
		'singular_name'              => _x( 'Task Category', 'Taxonomy Singular Name', 'wordcamp-mentors' ),
		'menu_name'                  => __( 'Category', 'wordcamp-mentors' ),
		'all_items'                  => __( 'All Categories', 'wordcamp-mentors' ),
		'parent_item'                => __( 'Parent Category', 'wordcamp-mentors' ),
		'parent_item_colon'          => __( 'Parent Category:', 'wordcamp-mentors' ),
		'new_item_name'              => __( 'New Category Name', 'wordcamp-mentors' ),
		'add_new_item'               => __( 'Add New Category', 'wordcamp-mentors' ),
		'edit_item'                  => __( 'Edit Category', 'wordcamp-mentors' ),
		'update_item'                => __( 'Update Category', 'wordcamp-mentors' ),
		'view_item'                  => __( 'View Category', 'wordcamp-mentors' ),
		'separate_items_with_commas' => __( 'Separate categories with commas', 'wordcamp-mentors' ),
		'add_or_remove_items'        => __( 'Add or remove categories', 'wordcamp-mentors' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'wordcamp-mentors' ),
		'popular_items'              => __( 'Popular Categories', 'wordcamp-mentors' ),
		'search_items'               => __( 'Search Categories', 'wordcamp-mentors' ),
		'not_found'                  => __( 'Not Found', 'wordcamp-mentors' ),
		'no_terms'                   => __( 'No categories', 'wordcamp-mentors' ),
		'items_list'                 => __( 'Categories list', 'wordcamp-mentors' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'wordcamp-mentors' ),
	);

	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => false,
		'show_ui'                    => false,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => false,
		'show_in_rest'               => true,
	);

	register_taxonomy( Mentors\PREFIX . '_task_category', array( Mentors\PREFIX . '_task' ), $args );
}

/**
 * Register custom post statuses.
 *
 * @since 1.0.0
 */
function register_status() {
	$stati = array(
		Mentors\PREFIX . '_task_pending'  => esc_html__( 'Pending',  'wordcamp-mentors' ),
		Mentors\PREFIX . '_task_complete' => esc_html__( 'Complete', 'wordcamp-mentors' ),
		Mentors\PREFIX . '_task_skipped'  => esc_html__( 'Skipped',  'wordcamp-mentors' ),
	);

	foreach ( $stati as $id => $label ) {
		register_post_status(
			$id,
			array(
				'label'       => $label,
				'label_count' => array(
					sprintf( '%s <span class="count">(%s)</span>', $label, '%s' ),
					sprintf( '%s <span class="count">(%s)</span>', $label, '%s' ),
					'wordcamp-mentors'
				),
				// Custom parameter to flag its use with the Task CPT
				Mentors\PREFIX . '_task' => true,
			)
		);
	}
}

/**
 * Get the array of Task-specific status objects.
 *
 * @since 1.0.0
 *
 * @return array
 */
function get_task_statuses() {
	return get_post_stati( array( Mentors\PREFIX . '_task' => true ), false );
}

/**
 * Add a page to the Dashboard menu.
 *
 * @since 1.0.0
 *
 * @return void
 */
function add_tasks_page() {
	\add_submenu_page(
		'index.php',
		__( 'Planning Checklist', 'wordcamp-mentors' ),
		__( 'Planning', 'wordcamp-mentors' ),
		Mentors\ORGANIZER_CAP,
		Mentors\PREFIX . '-planning-checklist',
		__NAMESPACE__ . '\render_tasks_page'
	);
}

add_action( 'admin_menu', __NAMESPACE__ . '\add_tasks_page' );

/**
 * Render callback for the page.
 *
 * @since 1.0.0
 *
 * return void
 */
function render_tasks_page() {
	$list_table = new List_Table();

	require Mentors\get_views_dir_path() . 'tasks.php';
}

/**
 * Enqueue JavaScript and CSS assets for the Tasks Dashboard page.
 *
 * @since 1.0.0
 *
 * @return void
 */
function enqueue_page_assets( $hook_suffix ) {
	if ( 'dashboard_page_' . Mentors\PREFIX . '-planning-checklist' !== $hook_suffix ) {
		return;
	}

	wp_enqueue_style(
		Mentors\PREFIX . '-planning-checklist',
		Mentors\get_css_url() . 'tasks/dashboard.css',
		array(),
		Mentors\CSS_VERSION
	);

	$script_dependencies = array(
		'wp-api',
		'wp-util',
		'utils',
	);

	wp_enqueue_script(
		Mentors\PREFIX . '-planning-checklist',
		Mentors\get_js_url() . 'tasks/dashboard.js',
		$script_dependencies,
		Mentors\JS_VERSION,
		true
	);

	wp_localize_script(
		Mentors\PREFIX . '-planning-checklist',
		'WordCampMentors',
		array(
			'prefix'  => Mentors\PREFIX,
			'scripts' => array(
				Mentors\get_js_url() . 'tasks/views.js',
			),
			'stati'   => get_task_statuses(),
			'l10n'    => array(
				'confirmReset' => esc_html__( 'Are you sure you want to reset the task data? This action cannot be undone.', 'wordcamp-mentors' ),
			),
		)
	);
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue_page_assets', 20 );

/**
 * Render JS templates.
 *
 * @since 1.0.0
 *
 * @return void
 */
function print_templates() {
	$js_list_table = new List_Table( array( 'js' => true ) );
	$js_list_table->prepare_items();
	?>
	<script id="tmpl-<?php echo esc_attr( Mentors\PREFIX ); ?>-task" type="text/template">
		<?php $js_list_table->single_row_columns( $js_list_table->items[0] ); ?>
	</script>
<?php
}

add_action( 'admin_print_footer_scripts-dashboard_page_' . Mentors\PREFIX . '-planning-checklist', __NAMESPACE__ . '\print_templates' );

/**
 * Display admin notices at the top of the Planning Checklist page.
 *
 * @since 1.0.0
 *
 * @return void
 */
function admin_notices() {
	global $pagenow;

	if ( 'index.php' !== $pagenow ||
	     ! isset( $_GET['page'], $_GET['status'] ) ||
	     Mentors\PREFIX . '-planning-checklist' !== $_GET['page'] ) {
		return;
	}

	$type = 'error';
	$message = '';

	switch ( $_GET['status'] ) {
		case 'invalid-nonce' :
			$message = esc_html__( 'Invalid nonce.', 'wordcamp-mentors' );
			break;

		case 'insufficient-permissions' :
			$message = esc_html__( 'Insufficient permissions to reset task data.', 'wordcamp-mentors' );
			break;

		case 'reset-errors' :
			$message = esc_html__( 'Checklist data reset with errors.', 'wordcamp-mentors' );
			break;

		case 'reset-success' :
			$type = 'success';
			$message = esc_html__( 'Checklist data successfully reset.', 'wordcamp-mentors' );
			break;
	}

	if ( $message ) : ?>
	<div class="notice notice-<?php echo esc_attr( $type ); ?> is-dismissible">
		<?php echo wpautop( esc_html( $message ) ); ?>
	</div>
<?php endif;
}