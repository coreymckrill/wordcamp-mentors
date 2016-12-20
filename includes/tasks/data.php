<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

/** @var array $data */

$data = array_merge( $data, array(
	'page' => array(
		'title'       => __( 'Task Dashboard', 'wordcamp-mentors' ),
		'description' => __( 'This tool provides a broad overview of the tasks necessary to plan and run a successful WordCamp. Drag and drop the categories into any order you wish.', 'wordcamp-mentors' ),
	),
	'categories' => array(
		'after-party'     => array(
			'name'  => __( 'After Party', 'wordcamp-mentors' ),
			'color' => '#a7863d',
		),
		'audio-video'     => array(
			'name'  => __( 'Audio/Video', 'wordcamp-mentors' ),
			'color' => '#a4c2f4',
		),
		'budget'          => array(
			'name'  => __( 'Budget', 'wordcamp-mentors' ),
			'color' => '#d64db8',
		),
		'committee'       => array(
			'name'  => __( 'Committee', 'wordcamp-mentors' ),
			'color' => '#e69138',
		),
		'contributor-day' => array(
			'name'  => __( 'Contributor Day', 'wordcamp-mentors' ),
			'color' => '#c67df4',
		),
		'design'          => array(
			'name'  => __( 'Design', 'wordcamp-mentors' ),
			'color' => '#76a5af',
		),
		'food'            => array(
			'name'  => __( 'Food', 'wordcamp-mentors' ),
			'color' => '#a64d79',
		),
		'lead'            => array(
			'name'  => __( 'Lead', 'wordcamp-mentors' ),
			'color' => '#cc0000',
		),
		'registration'    => array(
			'name'  => __( 'Registration', 'wordcamp-mentors' ),
			'color' => '#ffa6e7',
		),
		'speaker'         => array(
			'name'  => __( 'Speaker', 'wordcamp-mentors' ),
			'color' => '#3d85c6',
		),
		'sponsor'         => array(
			'name'  => __( 'Sponsor', 'wordcamp-mentors' ),
			'color' => '#38761d',
		),
		'swag'            => array(
			'name'  => __( 'Swag', 'wordcamp-mentors' ),
			'color' => '#93c47d',
		),
		'volunteer'       => array(
			'name'  => __( 'Volunteer', 'wordcamp-mentors' ),
			'color' => '#674ea7',
		),
		'web'             => array(
			'name'  => __( 'Web', 'wordcamp-mentors' ),
			'color' => '#bf9000',
		),
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