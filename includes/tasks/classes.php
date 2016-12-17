<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors;
defined( 'WPINC' ) or die();

/**
 * Class Tasks
 *
 * A manager for a collection of Task objects.
 *
 * @package WordCamp\Mentors
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
				$task_meta = $this->get_task_meta( $id );

				$this->tasks[ $id ] = new Task( $task_data, $task_meta );
			}
		}
	}

	/**
	 * Get the metadata for a particular task.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id The task ID
	 *
	 * @return array
	 */
	private function get_task_meta( $id ) {
		$all_task_meta = get_option( self::OPTION_KEY, array() );

		if ( isset( $all_task_meta[ $id ] ) ) {
			return $all_task_meta[ $id ];
		}

		return array();
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
	 * Update the metadata for a particular task.
	 *
	 * @since 1.0.0
	 *
	 * @param string $id   The task ID
	 * @param array  $meta An associative array of metadata
	 *
	 * @return bool
	 */
	public function update_task_meta( $id, array $meta ) {
		$task = $this->get_task( $id );

		if ( is_null( $task ) ) {
			return false;
		}

		$all_task_meta = get_option( self::OPTION_KEY, array() );

		if ( empty( $meta ) && isset( $all_task_meta[ $id ] ) ) {
			$this->tasks[ $id ] = $task->reset_meta();
			unset( $all_task_meta[ $id ] );
		} else {
			foreach ( $meta as $prop => $value ) {
				$this->tasks[ $id ] = $task->set( $prop, $value );
			}
			$all_task_meta[ $id ] = $meta;
		}

		return update_option( self::OPTION_KEY, $all_task_meta, false );
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
 * @package WordCamp\Mentors
 */
class Task {
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
	 * @var string Meta | State of the task
	 */
	private $state = '';

	/**
	 * @var string Meta | Username of person who switched the task to a complete state
	 */
	private $completed_by = '';

	/**
	 * Task constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param array $data Static task data
	 * @param array $meta Dynamic task data
	 */
	public function __construct( array $data, array $meta ) {
		// Data
		foreach ( $data as $prop => $value ) {
			$this->set( $prop, $value );
		}

		// Meta
		foreach ( $meta as $prop => $value ) {
			$this->set( $prop, $value );
		}
	}

	/**
	 * Allow properties to be accessed with ->
	 *
	 * @since 1.0.0
	 *
	 * @param string $prop
	 *
	 * @return mixed|null
	 */
	public function __get( $prop ) {
		return $this->get( $prop );
	}

	/**
	 * Get the value of a property, if it exists.
	 *
	 * @since 1.0.0
	 *
	 * @param string $prop
	 *
	 * @return mixed|null
	 */
	public function get( $prop ) {
		if ( isset( $this->$prop ) ) {
			return $this->$prop;
		}

		return null;
	}

	/**
	 * Set the value of a property if it has been defined.
	 *
	 * @since 1.0.0
	 *
	 * @param string $prop
	 * @param mixed  $value
	 *
	 * @return $this
	 */
	public function set( $prop, $value ) {
		if ( isset( $this->$prop ) ) {
			$this->$prop = $value;
		}

		return $this;
	}

	/**
	 * Reset the properties associated with metadata back to their default values.
	 *
	 * @since 1.0.0
	 *
	 * @return $this
	 */
	public function reset_meta() {
		$this->state = '';
		$this->completed_by = '';

		return $this;
	}

	/**
	 * Generate a string for the `id` HTML attribute.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_html_id() {
		return 'wordcamp-mentors-task-item-' . $this->id;
	}

	/**
	 * Generate a string for the `class` HTML attribute.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_html_class() {
		$class = array( 'wordcamp-mentors-task-item' );

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
}