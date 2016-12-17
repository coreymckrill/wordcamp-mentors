<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

/** @var array $data */

$data = array_merge( $data, array(
	'page' => array(
		'title'       => __( 'Tasks Dashboard', 'wordcamp-mentors' ),
		'description' => __( '[Description]', 'wordcamp-mentors' ),
	),
	'categories' => array(
		'after-party'     => __( 'After Party', 'wordcamp-mentors' ),
		'audio-video'     => __( 'Audio/Video', 'wordcamp-mentors' ),
		'budget'          => __( 'Budget', 'wordcamp-mentors' ),
		'committee'       => __( 'Committee', 'wordcamp-mentors' ),
		'contributor-day' => __( 'Contributor Day', 'wordcamp-mentors' ),
		'design'          => __( 'Design', 'wordcamp-mentors' ),
		'food'            => __( 'Food', 'wordcamp-mentors' ),
		'lead'            => __( 'Lead', 'wordcamp-mentors' ),
		'registration'    => __( 'Registration', 'wordcamp-mentors' ),
		'speaker'         => __( 'Speaker', 'wordcamp-mentors' ),
		'sponsor'         => __( 'Sponsor', 'wordcamp-mentors' ),
		'swag'            => __( 'Swag', 'wordcamp-mentors' ),
		'volunteer'       => __( 'Volunteer', 'wordcamp-mentors' ),
		'web'             => __( 'Web', 'wordcamp-mentors' ),
	),
	'tasks' => array(
		/* Template
		array(
			'id'           => '',
			'text'         => __( '', 'wordcamp-mentors' ),
			'category'     => '',
			'order'        => 10,
			'dependencies' => array(),
		),
		*/

		// Budget
		array(
			'id'           => 'bgt01',
			'text'         => __( 'Update budget in Dashboard', 'wordcamp-mentors' ),
			'category'     => 'budget',
			'order'        => 10,
			'dependencies' => array(),
		),
		array(
			'id'           => 'bgt02',
			'text'         => __( 'Request budget review meeting', 'wordcamp-mentors' ),
			'category'     => 'budget',
			'order'        => 10,
			'dependencies' => array( 'bgt01' ),
		),
		array(
			'id'           => 'bgt03',
			'text'         => __( 'Collect invoices from vendors and get them to WordCamp Central', 'wordcamp-mentors' ),
			'category'     => 'budget',
			'order'        => 10,
			'dependencies' => array(),
		),
		array(
			'id'           => 'bgt04',
			'text'         => __( 'Make sure all bills are paid', 'wordcamp-mentors' ),
			'category'     => 'budget',
			'order'        => 10,
			'dependencies' => array(),
		),

		// Design
		array(
			'id'           => 'dsg01',
			'text'         => __( 'Start thinking about Design process/branding', 'wordcamp-mentors' ),
			'category'     => 'design',
			'order'        => 10,
			'dependencies' => array(),
		),
		array(
			'id'           => 'dsg02',
			'text'         => __( 'Badge/Name Tag design', 'wordcamp-mentors' ),
			'category'     => 'design',
			'order'        => 10,
			'dependencies' => array(),
		),
		array(
			'id'           => 'dsg03',
			'text'         => __( 'Signage Design', 'wordcamp-mentors' ),
			'category'     => 'design',
			'order'        => 10,
			'dependencies' => array(),
		),
		array(
			'id'           => 'dsg04',
			'text'         => __( 'Finalize name badge order', 'wordcamp-mentors' ),
			'category'     => 'design',
			'order'        => 10,
			'dependencies' => array(),
		),
		array(
			'id'           => 'dsg05',
			'text'         => __( 'Order signage', 'wordcamp-mentors' ),
			'category'     => 'design',
			'order'        => 10,
			'dependencies' => array(),
		),
	),
) );