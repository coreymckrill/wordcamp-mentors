<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

/**
 * Class Tasks
 *
 * A manager for a collection of Task objects.
 *
 * @package WordCamp\Mentors\Task_Dashboard
 */
class Tasks {
	/**
	 * @const string The option key for the tasks metadata
	 */
	const OPTION_KEY = 'wordcamp-mentors-task-meta';

	/**
	 * @var array Collection of Task objects
	 */
	private $tasks = array();

	/**
	 * Tasks constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data The contents of the `tasks` item from the `load_task_data` array
	 */
	public function __construct( array $data ) {
		foreach ( $data as $task_data ) {
			if ( $this->has_required_fields( $task_data ) ) {
				$id = sanitize_key( $task_data['id'] );
				$this->tasks[ $id ] = new Task( $task_data );
			}
		}
	}

	/**
	 * Check if task item's data array contains required keys.
	 *
	 * @since 1.0.0
	 *
	 * @param array $task_data
	 *
	 * @return bool
	 */
	private function has_required_fields( array $task_data ) {
		return isset( $task_data['id'] ) &&
	           isset( $task_data['text'] ) &&
	           isset( $task_data['category'] );
	}

	/**
	 * Check if a particular ID is associated with a task.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id The task ID
	 *
	 * @return bool
	 */
	public function is_task( $id ) {
		return isset( $this->tasks[ $id ] );
	}

	/**
	 * Get a particular Task object from the $tasks array.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id The task ID
	 *
	 * @return \WordCamp\Mentors\Task|null
	 */
	public function get_task( $id ) {
		if ( $this->is_task( $id ) ) {
			return $this->tasks[ $id ];
		}

		return null;
	}

	/**
	 * Get an array of Task objects that have a particular category set.
	 *
	 * @since 1.0.0
	 *
	 * @param string $category_slug
	 *
	 * @return array Collection of Task objects
	 */
	public function get_tasks_in_category( $category_slug ) {
		$tasks = wp_list_pluck( $this->tasks, 'category' );
		$valid_keys = array_keys( $tasks, $category_slug );

		$filtered_tasks = array_intersect_key( $this->tasks, array_flip( $valid_keys ) );
		uasort( $filtered_tasks, function( $a, $b ) {
			$a = absint( $a->order );
			$b = absint( $b->order );

			if ( $a === $b ) {
				return 0;
			}

			return ( $a < $b ) ? -1 : 1;
		} );

		return $filtered_tasks;
	}
}

/**
 * Class Task
 *
 * An object containing data about a WordCamp planning task.
 *
 * @package WordCamp\Mentors\Task_Dashboard
 */
class Task {
	/**
	 * @const string The option key for the tasks metadata
	 */
	const OPTION_KEY = 'wordcamp-mentors-task-meta';

	/**
	 * @var string Arbitrary unique ID for the task
	 */
	private $id = '';

	/**
	 * @var string The description of the task
	 */
	private $text = '';

	/**
	 * @var string Category slug
	 */
	private $category = '';

	/**
	 * @var int Optional number to prioritize the task
	 */
	private $order = 10;

	/**
	 * @var array Optional list of IDs of other tasks that must be completed first
	 */
	private $dependencies = array();

	/**
	 * Task constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Static task data
	 */
	public function __construct( array $data ) {
		// Data
		foreach ( $data as $prop => $value ) {
			$this->$prop = $value;
		}
	}

	/**
	 * Allow properties and metadata to be accessed with ->
	 *
	 * @since 1.0.0
	 *
	 * @param string $prop
	 *
	 * @return mixed|null
	 */
	public function __get( $prop ) {
		if ( isset( $this->$prop ) ) {
			return $this->$prop;
		} else if ( ! is_null( $meta = $this->get_meta( $prop ) ) ) {
			return $meta;
		}

		return null;
	}

	/**
	 * Allow properties and metadata to be set with ->
	 *
	 * @since 1.0.0
	 *
	 * @param string $prop
	 * @param mixed  $value
	 *
	 * @return Task
	 */
	public function __set( $prop, $value ) {
		if ( isset( $this->$prop ) ) {
			$this->$prop = $value;
		} else {
			$this->update_meta( $prop, $value );
		}

		return $this;
	}

	/**
	 * The default keys and values for the meta array.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	private function get_meta_defaults() {
		return array(
			'state'        => '',
			'completed_by' => '',
		);
	}

	/**
	 * Get the value of a particular meta property.
	 *
	 * @since 1.0.0
	 *
	 * @param string $prop
	 *
	 * @return mixed|null
	 */
	private function get_meta( $prop ) {
		$stored_meta = get_option( self::OPTION_KEY, array() );

		if ( ! isset( $stored_meta[ $this->id ] ) ) {
			$stored_meta[ $this->id ] = $this->get_meta_defaults();
		}

		if ( isset( $stored_meta[ $this->id ][ $prop ] ) ) {
			return $stored_meta[ $this->id ][ $prop ];
		}

		return null;
	}

	/**
	 * Set the value of a particular meta property, if it is an allowed property.
	 *
	 * @since 1.0.0
	 *
	 * @param string $prop
	 * @param mixed  $value
	 *
	 * @return bool
	 */
	private function update_meta( $prop, $value ) {
		$defaults = $this->get_meta_defaults();

		// Only set allowed properties
		if ( ! isset( $defaults[ $prop ] ) ) {
			return false;
		}

		$stored_meta = get_option( self::OPTION_KEY, array() );

		if ( ! isset( $stored_meta[ $this->id ] ) ) {
			$stored_meta[ $this->id ] = $this->get_meta_defaults();
		}

		$stored_meta[ $this->id ][ $prop ] = $value;

		return update_option( self::OPTION_KEY, $stored_meta );
	}

	/**
	 * Generate a string for the `id` HTML attribute.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_html_id() {
		return 'tasks-dash-item-' . $this->id;
	}

	/**
	 * Generate a string for the `class` HTML attribute.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_html_class() {
		$class = array( 'tasks-dash-item' );

		if ( $this->state ) {
			$class[] = $this->state;
		}

		return implode( ' ', $class );
	}

	/**
	 * Generate a string of HTML data attributes.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_html_data_attributes() {
		$data = array();

		if ( ! empty( $this->dependencies ) ) {
			$data['dep'] = implode( ',', $this->dependencies );
		}

		$attributes = array();

		foreach ( $data as $key => $value ) {
			$attributes[] = " data-$key=\"$value\"";
		}

		return implode( ' ', $attributes );
	}

	/**
	 * Get a string for the toggle's `class` HTML attribute.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_toggle_html_class() {
		$class = array( 'tasks-dash-item-toggle', 'dashicons-before' );

		if ( $this->state ) {
			$class[] = 'dashicons-yes';
		}

		return implode( ' ', $class );
	}
}

/**
 * Class Ajax_Request
 *
 *
 *
 * @package WordCamp\Mentors\Task_Dashboard
 */
class Ajax_Request {
	/**
	 * @var array The request data
	 */
	private $data = array();

	/**
	 * @var array|string The response data
	 */
	private $response = array();

	/**
	 * @var bool Switch to determine which type of response to send
	 */
	private $success = false;

	/**
	 * Ajax_Request constructor.
	 *
	 * @param string $nonce
	 * @param array  $data
	 */
	public function __construct( $nonce, $data ) {
		if ( ! wp_verify_nonce( $nonce, 'wordcamp-mentors-tasks-dashboard' ) ) {
			return;
		}

		$defaults = array(
			'action' => '',
		);
		$this->data = wp_parse_args( (array) $data, $defaults );

		switch ( $this->data['action'] ) {
			case 'tab-order' :
				$this->success = $this->tab_order( $this->data );
				break;

			case 'check-task' :
				$this->success = $this->check_task( $this->data );
				break;

			case 'uncheck-task' :
				$this->success = $this->uncheck_task( $this->data );
				break;
		}
	}

	/**
	 * Send a JSON response with the results of the request.
	 *
	 * @since 1.0.0
	 */
	public function send_response() {
		if ( $this->success ) {
			wp_send_json_success( $this->response );
		} else {
			wp_send_json_error( $this->response );
		}
	}

	/**
	 * Get the static data related to categories.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	private function get_category_data() {
		$data = load_task_data();

		return $data['categories'];
	}

	/**
	 * Get the collection of Task objects.
	 *
	 * @since 1.0.0
	 *
	 * @return Tasks
	 */
	private function get_task_data() {
		$data = load_task_data();

		return new Tasks( $data['tasks'] );
	}

	/**
	 * Handle a request to save a custom tab order.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data
	 *
	 * @return bool|int
	 */
	private function tab_order( $data ) {
		if ( isset( $data['tab-order'] ) ) {
			$category_slugs = array_keys( $this->get_category_data() );
			$order = array_intersect( $data['tab-order'], $category_slugs );

			if ( ! empty( $order ) ) {
				$user_options = get_user_option( USER_OPTION_KEY );

				if ( ! is_array( $user_options ) ) {
					$user_options = array();
				}

				$user_options['tab-order'] = $order;

				// Use `update_user_option` instead of `update_user_meta` so that it's site-specific
				return update_user_option( get_current_user_id(), USER_OPTION_KEY, $user_options );
			}
		}

		return false;
	}

	/**
	 * Handle a request to mark a task as complete.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data
	 *
	 * @return bool
	 */
	private function check_task( $data ) {
		if ( isset( $data['task-id'] ) ) {
			$tasks = $this->get_task_data();
			$id = $data['task-id'];

			if ( $tasks->is_task( $id ) ) {
				$task = $tasks->get_task( $id );
				$completed_by = get_user_by( 'id', get_current_user_id() )->user_login;

				$task->state        = 'complete';
				$task->completed_by = $completed_by;

				$this->response = array(
					'completed_by' => $completed_by,
				);

				return true;
			}
		}

		return false;
	}

	/**
	 * Handle a request to mark a task as incomplete.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data
	 *
	 * @return bool
	 */
	private function uncheck_task( $data ) {
		if ( isset( $data['task-id'] ) ) {
			$tasks = $this->get_task_data();
			$id = $data['task-id'];

			if ( $tasks->is_task( $id ) ) {
				$task = $tasks->get_task( $id );

				$task->state        = '';
				$task->completed_by = '';

				return true;
			}
		}

		return false;
	}
}