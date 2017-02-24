<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Tasks;
defined( 'WPINC' ) or die();

use WordCamp\Mentors;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Class List_Table
 * @package WordCamp\Mentors\Tasks
 */
class List_Table extends \WP_List_Table {
	/**
	 * Switch the context between page load and JS template
	 *
	 * @var bool
	 */
	protected $js = false;

	/**
	 * List_Table constructor.
	 *
	 * @param array $args
	 */
	public function __construct( $args = array() ) {
		$defaults = array(
			'js' => false,
		);
		$args = wp_parse_args( $args, $defaults );

		$this->js = $args['js'];

		parent::__construct( $args );
	}

	/**
	 * Add filter dropdowns
	 *
	 * @param string $which
	 */
	public function extra_tablenav( $which = 'top' ) {
		if ( 'top' === $which ) : ?>
		<div class="alignleft actions">
			<form id="tasks-filter">
				<?php $this->task_category_dropdown(); ?>
				<?php $this->status_dropdown(); ?>
				<?php submit_button( __( 'Filter', 'wordcamp-mentors' ), 'secondary', 'submit', false ); ?>
			</form>
		</div>
	<?php endif;
	}

	/**
	 * Dropdown for task categories
	 */
	protected function task_category_dropdown() {
		$task_categories = get_terms( array(
			'taxonomy'   => Mentors\PREFIX . '_task_category',
			'hide_empty' => false,
		) );
		?>
		<label for="filter-by-task-category" class="screen-reader-text"><?php esc_html_e( 'Filter by task category', 'wordcamp-mentors' ); ?></label>
		<select id="filter-by-task-category">
			<option value="all"><?php esc_html_e( 'All task categories', 'wordcamp-mentors' ); ?></option>
			<?php foreach ( $task_categories as $cat ) : ?>
				<option value="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name ); ?></option>
			<?php endforeach; ?>
		</select>
	<?php
	}

	/**
	 * Dropdown for task statuses
	 */
	protected function status_dropdown() {
		$task_statuses = get_task_statuses();
		?>
		<label for="filter-by-task-status" class="screen-reader-text"><?php esc_html_e( 'Filter by status', 'wordcamp-mentors' ); ?></label>
		<select id="filter-by-task-status">
			<option value="all"><?php esc_html_e( 'All statuses', 'wordcamp-mentors' ); ?></option>
			<?php foreach ( $task_statuses as $status ) : ?>
				<option value="<?php echo esc_attr( $status->name ); ?>"><?php echo esc_html( $status->label ); ?></option>
			<?php endforeach; ?>
		</select>
	<?php
	}

	/**
	 * Prepare the table items
	 */
	public function prepare_items() {
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = array();
		$this->_column_headers = array($columns, $hidden, $sortable);

		if ( $this->js ) {
			// For the JS template, onyl one row is needed
			$this->items = array(
				(object) array(
					'ID' => 'data.id',
				)
			);
		} else {
			$args = array(
				'post_type'      => Mentors\PREFIX . '_task',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'posts_per_page' => 999,
			);
			$this->items = get_posts( $args );
		}
	}

	/**
	 * Specify the column names and order
	 *
	 * @return array
	 */
	public function get_columns() {
		$columns = array();

		$columns['task']          = esc_html__( 'Task', 'wordcamp-mentors' );
		$columns['task_category'] = get_taxonomy( Mentors\PREFIX . '_task_category' )->labels->singular_name;
		$columns['status']        = esc_html__( 'Status', 'wordcamp-mentors' );

		return $columns;
	}

	/**
	 * Render the Task column
	 *
	 * @param $task
	 */
	public function column_task( $task ) {
		if ( $this->js ) {
			echo '{{{ data.title.rendered }}}';
		} else {
			echo get_the_title( $task );
		}
	}

	/**
	 * Render the Task Category column
	 *
	 * @param $task
	 */
	public function column_task_category( $task ) {
		$terms = get_the_terms( $task->ID, Mentors\PREFIX . '_task_category' );

		echo "<ul>\n";

		if ( $this->js ) {
			?>
			<# if ( data.wcm_task_category.length ) { #>
				<# _.each( data.wcm_task_category, function( category ) { #>
					<li class="category-{{ category.get( 'slug' ) }}">{{ category.get( 'name' ) }}</li>
				<# }); #>
			<# } else { #>
				<li class="category-none"><?php esc_html_e( 'No category' , 'wordcamp-mentors' ) ?></li>
			<# } #>
		<?php
		} else {
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					echo '<li class="category-' . esc_attr( $term->slug ) . '">' . $term->name . "</li>\n";
				}
			} else {
				echo '<li class="category-none">' . esc_html__( 'No category' , 'wordcamp-mentors' ) . "</li>\n";
			}
		}

		echo "</ul>\n";
	}

	/**
	 * Render the Status column
	 *
	 * @param $task
	 */
	public function column_status( $task ) {
		$task_stati = get_task_statuses();

		echo '<select>';

		if ( $this->js ) {
			?>
			<# if ( 'object' !== typeof data.stati[ data.status ] ) { #>
				<option value="{{ data.status }}" selected disabled>{{ data.status }}</option>
			<# } #>
			<# _.each( data.stati, function( status, slug ) { #>
				<option value="{{ slug }}" <# if ( slug === data.status ) { print( 'selected' ) } #> >{{ status.label }}</option>
			<# }); #>
		<?php
		} else {
			$status_slug = get_post_status( $task );
			$status = get_post_status_object( $status_slug );

			if ( is_null( $status ) ) {
				echo '<option value="" selected="selected" disabled="disabled"></option>';
			} else if ( ! isset( $task_stati[ $status_slug ] ) ) {
				echo '<option value="' . esc_attr( $status_slug ) . '" selected="selected" disabled="disabled">' . esc_html( $status->label ) . '</option>';
			}

			foreach ( $task_stati as $slug => $object ) {
				echo '<option value="' . esc_attr( $slug ) . '" ' . selected( $slug, $status_slug, false ) . '>' . esc_html( $object->label ) . '</option>';
			}
		}

		echo '</select>';
	}

	/**
	 * Render the full markup for a table row
	 *
	 * @param object $item
	 */
	public function single_row( $item ) {
		$id = 'id="' . Mentors\PREFIX . '-task-' . $item->ID . '"';

		$classes = array(
			Mentors\PREFIX . '-task',
		);
		if ( ! $this->js ) {
			$classes[] = 'hide-if-js';
		}
		$class = 'class="' . implode( ' ', $classes ) . '"';

		echo "<tr $id $class>";
		$this->single_row_columns( $item );
		echo '</tr>';
	}
}