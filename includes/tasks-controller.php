<?php
/**
 * REST Controller for Tasks.
 *
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Tasks;
defined( 'WPINC' ) || die();

use WordCamp\Mentors;

/**
 * Class Controller.
 *
 * @package WordCamp\Mentors\Tasks
 */
class Controller extends \WP_REST_Posts_Controller {
	/**
	 * Retrieves the Task post's schema, conforming to JSON Schema.
	 *
	 * Task-specific modifications to the standard post schema.
	 *
	 * @since 1.0.0
	 *
	 * @return array Item schema data.
	 */
	public function get_item_schema() {
		$schema = parent::get_item_schema();

		// Show the custom statuses in the REST response.
		if ( false === array_search( 'view', $schema['properties']['status']['context'], true ) ) {
			$schema['properties']['status']['context'][] = 'view';
		}

		// Specify custom statuses.
		$schema['properties']['status']['enum'] = array_keys( get_task_statuses() );

		// Add a localized, relative date string.
		$schema['properties']['modified']['type'] = 'object';
		$schema['properties']['modified']['properties'] = array(
			'raw' => array(
				'description' => __( "The date the object was last modified, in the site's timezone." ),
				'type'        => 'string',
				'format'      => 'date-time',
				'context'     => array( 'view', 'edit' ),
				'readonly'    => true,
			),
			'relative' => array(
				'description' => __( 'The relative time since the object was last modified.' ),
				'type'        => 'string',
				'format'      => 'date-time',
				'context'     => array( 'view', 'edit' ),
				'readonly'    => true,
			),
		);

		return $this->add_additional_fields_schema( $schema );
	}

	/**
	 * Retrieves the query params for the posts collection.
	 *
	 * Task-specific modifications to the standard posts collection query params.
	 *
	 * @since 1.0.0
	 *
	 * @return array Collection parameters.
	 */
	public function get_collection_params() {
		$query_params = parent::get_collection_params();

		// Allow posts with our custom statuses.
		$query_params['status']['items']['enum'] = array_keys( get_task_statuses() );
		$query_params['status']['default'] = $query_params['status']['items']['enum'];

		// Allow a higher maximum for query results.
		$query_params['per_page']['maximum'] = 300;

		return $query_params;
	}

	/**
	 * Sanitizes and validates the list of post statuses, including whether the
	 * user can query private statuses.
	 *
	 * @since 1.0.0
	 *
	 * @param  string|array     $statuses  One or more post statuses.
	 * @param  \WP_REST_Request $request   Full details about the request.
	 * @param  string           $parameter Additional parameter to pass to validation.
	 * @return array|\WP_Error A list of valid statuses, otherwise WP_Error object.
	 */
	public function sanitize_post_statuses( $statuses, $request, $parameter ) {
		$statuses = wp_parse_slug_list( $statuses );

		$task_statuses = array_keys( get_task_statuses() );

		foreach ( $statuses as $status ) {
			if ( in_array( $status, $task_statuses, true ) ) {
				continue;
			}

			if ( current_user_can( Mentors\ORGANIZER_CAP ) ) {
				$result = rest_validate_request_arg( $status, $request, $parameter );
				if ( is_wp_error( $result ) ) {
					return $result;
				}
			} else {
				return new \WP_Error(
					'rest_forbidden_status',
					__( 'Status is forbidden.' ),
					array(
						'status' => rest_authorization_required_code(),
					)
				);
			}
		}

		return $statuses;
	}
}
