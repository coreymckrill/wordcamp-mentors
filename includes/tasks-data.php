<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Tasks;
defined( 'WPINC' ) or die();

use WordCamp\Mentors;

/**
 * Define the task categories for the Planning Checklist.
 *
 * @since 1.0.0
 *
 * @return array
 */
function get_task_category_data() {
	return array(
		'after-party'     => esc_html__( 'After Party', 'wordcamp-mentors' ),
		'audio-video'     => esc_html__( 'Audio/Video', 'wordcamp-mentors' ),
		'budget'          => esc_html__( 'Budget', 'wordcamp-mentors' ),
		'committee'       => esc_html__( 'Committee', 'wordcamp-mentors' ),
		'contributor-day' => esc_html__( 'Contributor Day', 'wordcamp-mentors' ),
		'design'          => esc_html__( 'Design', 'wordcamp-mentors' ),
		'food'            => esc_html__( 'Food', 'wordcamp-mentors' ),
		'lead'            => esc_html__( 'Lead', 'wordcamp-mentors' ),
		'registration'    => esc_html__( 'Registration', 'wordcamp-mentors' ),
		'speaker'         => esc_html__( 'Speaker', 'wordcamp-mentors' ),
		'sponsor'         => esc_html__( 'Sponsor', 'wordcamp-mentors' ),
		'swag'            => esc_html__( 'Swag', 'wordcamp-mentors' ),
		'volunteer'       => esc_html__( 'Volunteer', 'wordcamp-mentors' ),
		'web'             => esc_html__( 'Web', 'wordcamp-mentors' ),
	);
}

/**
 * Define the tasks for the Planning Checklist.
 *
 * @since 1.0.0
 *
 * @return array
 */
function get_task_data() {
	/**
	 * This array can be generated with the following steps:
	 *
	 * - Open the spreadsheet:
	 *   https://docs.google.com/spreadsheets/d/1PMwyb8RcvOqcNOBzVgXrWFTniTr8utT8ew0lwNaWbeo/edit
	 *
	 * - Download the current sheet as a tab-delimited file.
	 *
	 * - Run a Regex search/replace:
	 *   Search:  "?([^\t]+)"?\t"?([^\t]+)"?\t"?([^\t]+)"?\n
	 *   Replace: '$1' => array(\n\t'title' => __( '$2', 'wordcamp-mentors' ),\n\t'cat' => array( '$3' ),\n),\n
	 *
	 * - Paste the output inside the outer array.
	 *
	 * When adding new task items, the unique ID keys can be created here:
	 * http://textmechanic.com/text-tools/randomization-tools/random-string-generator/
	 */
	return array(
		'8pb0' => array(
			'title' => __( 'Update budget template', 'wordcamp-mentors' ),
			'cat'   => array( 'budget' ),
		),
		'v2cu' => array(
			'title' => __( 'Explore venue options', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'jv29' => array(
			'title' => __( 'Start thinking about Design process/branding', 'wordcamp-mentors' ),
			'cat'   => array( 'design' ),
		),
		't5o8' => array(
			'title' => __( 'Application process and approval', 'wordcamp-mentors' ),
			'cat'   => array( 'lead' ),
		),
		'22ix' => array(
			'title' => __( 'Build/Organize Team', 'wordcamp-mentors' ),
			'cat'   => array( 'lead' ),
		),
		'o1rt' => array(
			'title' => __( 'Discuss topics/requested speaker topics', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'qi33' => array(
			'title' => __( 'WordCamp Central website is created', 'wordcamp-mentors' ),
			'cat'   => array( 'web' ),
		),
		'n7rk' => array(
			'title' => __( 'Budget approval', 'wordcamp-mentors' ),
			'cat'   => array( 'budget' ),
		),
		'siq8' => array(
			'title' => __( 'Choose a Date', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'7j6f' => array(
			'title' => __( 'Venue walkthrough with all wranglers', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'f087' => array(
			'title' => __( 'Solidify Venue', 'wordcamp-mentors' ),
			'cat'   => array( 'lead' ),
		),
		'3vf4' => array(
			'title' => __( 'Identify internal sponsorship levels and what each level includes', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'u1rl' => array(
			'title' => __( 'Organizer team creates sponsorship packs and guidelines. Verifying all sponsors agree with licensing.', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'5uqp' => array(
			'title' => __( 'Areas that have had WordCamps in the past should reach out to sponsors from prior camps.', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'vbbj' => array(
			'title' => __( 'begin website design - prepare to launch', 'wordcamp-mentors' ),
			'cat'   => array( 'web' ),
		),
		'inv6' => array(
			'title' => __( 'Announce WordCamp event/site to community', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'erjt' => array(
			'title' => __( 'Create/use email templates for sponsorship, volunteers, speakers, etc', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'ibzq' => array(
			'title' => __( 'Have web wrangler add call for speakers on site', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'wccy' => array(
			'title' => __( 'Reach out to known/wanted community speakers', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'9tsp' => array(
			'title' => __( 'Call for sponsors on website (form)', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'p1ff' => array(
			'title' => __( 'include why to sponsor on website (perks)', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'gy0i' => array(
			'title' => __( 'Contact larger Community sponsors', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'lkcs' => array(
			'title' => __( 'Get quotes from vendors', 'wordcamp-mentors' ),
			'cat'   => array( 'swag' ),
		),
		'rko5' => array(
			'title' => __( 'Have web wrangler add call for volunteers on website including descriptions', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'krv3' => array(
			'title' => __( 'Launch website design', 'wordcamp-mentors' ),
			'cat'   => array( 'web' ),
		),
		'uw8g' => array(
			'title' => __( 'Open ticket sales', 'wordcamp-mentors' ),
			'cat'   => array( 'registration' ),
		),
		'qi9n' => array(
			'title' => __( 'Anonymize speaker submissions (remove gender specific information, names)', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'co30' => array(
			'title' => __( 'Prep review panel', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'eu82' => array(
			'title' => __( 'Send out update email to speaker applicants', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'4isl' => array(
			'title' => __( 'Identify any special A/V needs and coordinate with A/V wrangler', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'k9k0' => array(
			'title' => __( 'Start drafting the sponsorship shoutouts for blog posts', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'm2sc' => array(
			'title' => __( 'Send emails to sponsor regarding what they need for them. ', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'eel1' => array(
			'title' => __( 'Design swag decisions', 'wordcamp-mentors' ),
			'cat'   => array( 'swag' ),
		),
		'cxpj' => array(
			'title' => __( 'Find venue for volunteer orientation and set date', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'75sp' => array(
			'title' => __( 'Find Social Venue', 'wordcamp-mentors' ),
			'cat'   => array( 'after-party' ),
		),
		'uutz' => array(
			'title' => __( 'Select videographer or request video kit from WordCamp Central', 'wordcamp-mentors' ),
			'cat'   => array( 'audio-video' ),
		),
		'o14g' => array(
			'title' => __( 'Find location for contributor day', 'wordcamp-mentors' ),
			'cat'   => array( 'contributor-day' ),
		),
		'sfrb' => array(
			'title' => __( 'Begin posting original content (WordCamp stories, speaker profiles, community involvement stories, etc)', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'5j0m' => array(
			'title' => __( 'Select caterer and secure food for event', 'wordcamp-mentors' ),
			'cat'   => array( 'food' ),
		),
		'h8y4' => array(
			'title' => __( 'Committee approve speakers', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'mkj1' => array(
			'title' => __( 'Email selected speakers (ticket codes, location information, will they need a +1, A/V release)', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'c00l' => array(
			'title' => __( 'Email remaining speaker applicants', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'fucx' => array(
			'title' => __( 'Finalize swag decisions', 'wordcamp-mentors' ),
			'cat'   => array( 'swag' ),
		),
		'2hoa' => array(
			'title' => __( 'Find swag vendor', 'wordcamp-mentors' ),
			'cat'   => array( 'swag' ),
		),
		'2x9f' => array(
			'title' => __( 'get lanyards and stickers from WordCamp Central', 'wordcamp-mentors' ),
			'cat'   => array( 'swag' ),
		),
		'3b1k' => array(
			'title' => __( 'Determine what volunteers roles and how many are needed, create grid (example 1, example 2, example 3, and determine how many volunteers are needed', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'84y3' => array(
			'title' => __( 'Publish/Announce speakers', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'2ghl' => array(
			'title' => __( 'Ask speakers to promote on their social channels', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'y3ct' => array(
			'title' => __( 'Tell Speakers that slides are needed by 4 weeks out.', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'9yj5' => array(
			'title' => __( 'write volunteer role descriptions and create volunteer web request form (not published yet)', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'l931' => array(
			'title' => __( 'Publish/Announce sessions', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'p0ns' => array(
			'title' => __( 'Order speaker gifts', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'03kv' => array(
			'title' => __( 'Speaker/sponsor dinner “save the date”', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'srgu' => array(
			'title' => __( 'Have web wrangler publish sponsor posts', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'sq9v' => array(
			'title' => __( 'Speaker/sponsor dinner “save the date”', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'gyz3' => array(
			'title' => __( 'Put out call for volunteers', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'ws2p' => array(
			'title' => __( 'order swag (and custom stickers if applicable) ', 'wordcamp-mentors' ),
			'cat'   => array( 'swag' ),
		),
		'1vob' => array(
			'title' => __( 'Publish/Announce speaker bio posts', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'r3ge' => array(
			'title' => __( 'Remind speakers to send slides', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'bc1e' => array(
			'title' => __( 'Badge/Name Tag design', 'wordcamp-mentors' ),
			'cat'   => array( 'design' ),
		),
		'e0uc' => array(
			'title' => __( 'Signage Design', 'wordcamp-mentors' ),
			'cat'   => array( 'design' ),
		),
		'0ona' => array(
			'title' => __( 'Remind speakers to promote the event in their social channels/blogs', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'2bq3' => array(
			'title' => __( 'Send out coupon codes to speakers', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'se9c' => array(
			'title' => __( 'Swag from sponsors who will not be attending / swag going in handout bags', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'su2b' => array(
			'title' => __( 'Send out coupon codes to sponsors', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'1f48' => array(
			'title' => __( 'Start scheduling volunteers.', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'ckzp' => array(
			'title' => __( 'Confirm volunteers and gather volunteer information', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'qk6k' => array(
			'title' => __( 'Send out coupon codes', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'h9fk' => array(
			'title' => __( 'Collect invoices from vendors and get them to WordCamp Central', 'wordcamp-mentors' ),
			'cat'   => array( 'budget' ),
		),
		'2u4x' => array(
			'title' => __( 'Offer speaker mentorship (via google hangouts, speaker training)', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'q97z' => array(
			'title' => __( 'Review speaker slides', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'c46e' => array(
			'title' => __( 'Confirm food, arrange delivery/pickup', 'wordcamp-mentors' ),
			'cat'   => array( 'food' ),
		),
		'nhws' => array(
			'title' => __( 'Finalize name badge order', 'wordcamp-mentors' ),
			'cat'   => array( 'design' ),
		),
		'f1ln' => array(
			'title' => __( 'Order signage', 'wordcamp-mentors' ),
			'cat'   => array( 'design' ),
		),
		'r4ty' => array(
			'title' => __( 'Schedule pre-camp pep talk with WordCamp Central', 'wordcamp-mentors' ),
			'cat'   => array( 'lead' ),
		),
		'tpvw' => array(
			'title' => __( 'Create backup plans including backup speaker', 'wordcamp-mentors' ),
			'cat'   => array( 'lead' ),
		),
		'm8k1' => array(
			'title' => __( 'Write attendee survey', 'wordcamp-mentors' ),
			'cat'   => array( 'lead' ),
		),
		'h641' => array(
			'title' => __( 'Communicate with speakers about schedule', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'eut6' => array(
			'title' => __( 'Communicate with speakers about travel details (flight/hotel details)', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'9ukf' => array(
			'title' => __( 'Communicate about A/V setup (photos of venue, types of equipment being used)', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'a4m3' => array(
			'title' => __( 'Communicate about Speaker dinner', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'svit' => array(
			'title' => __( 'Email on logistical details for day of set up (photos, tables, etc)', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'v6ur' => array(
			'title' => __( 'Speaker/sponsor dinner email announcement/RSVP', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'6kg0' => array(
			'title' => __( 'Have volunteer schedule pretty much done', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'h4pa' => array(
			'title' => __( 'Publish schedule on website', 'wordcamp-mentors' ),
			'cat'   => array( 'web' ),
		),
		'f5fo' => array(
			'title' => __( 'Confirm food/drinks or coordinate with food wrangler', 'wordcamp-mentors' ),
			'cat'   => array( 'after-party' ),
		),
		'2iiq' => array(
			'title' => __( 'If you’re not using a professional videographer get camera ready', 'wordcamp-mentors' ),
			'cat'   => array( 'audio-video' ),
		),
		'5kx4' => array(
			'title' => __( 'Venue walk-through', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'lcnm' => array(
			'title' => __( 'Confirm food/drinks or coordinate with food wrangler', 'wordcamp-mentors' ),
			'cat'   => array( 'contributor-day' ),
		),
		'219u' => array(
			'title' => __( 'Confirm order with caterer based on attendance numbers', 'wordcamp-mentors' ),
			'cat'   => array( 'food' ),
		),
		'woys' => array(
			'title' => __( 'Pick up outside food and drink (if applicable)', 'wordcamp-mentors' ),
			'cat'   => array( 'food' ),
		),
		'gmue' => array(
			'title' => __( 'Close registration', 'wordcamp-mentors' ),
			'cat'   => array( 'registration' ),
		),
		'qha0' => array(
			'title' => __( 'Communicate sponsor dinner plans to sponsors', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'yzu9' => array(
			'title' => __( 'Sort swag (fold t-shirts)', 'wordcamp-mentors' ),
			'cat'   => array( 'swag' ),
		),
		'hscb' => array(
			'title' => __( 'Volunteer Training', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'nn2q' => array(
			'title' => __( 'locate where volunteer stations will be in venue.', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'hc9u' => array(
			'title' => __( 'Communicate with speakers, etc for all A/V needs', 'wordcamp-mentors' ),
			'cat'   => array( 'audio-video' ),
		),
		'872l' => array(
			'title' => __( 'If you’re not using a professional videographer: test camera operation', 'wordcamp-mentors' ),
			'cat'   => array( 'audio-video' ),
		),
		'rhgc' => array(
			'title' => __( 'Pre-camp prep with venue', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'w3l6' => array(
			'title' => __( 'Send attendee email with info about parking, wifi, any other reminders', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'20g7' => array(
			'title' => __( 'Speaker/sponsor dinner', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'73qa' => array(
			'title' => __( 'Send email on logistical details for day of set up', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'hkv5' => array(
			'title' => __( 'A/V setup, etc.', 'wordcamp-mentors' ),
			'cat'   => array( 'audio-video' ),
		),
		'gyc3' => array(
			'title' => __( 'Registration', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'3oqk' => array(
			'title' => __( 'Session Management', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
		'vunm' => array(
			'title' => __( 'Coordinate last minute details', 'wordcamp-mentors' ),
			'cat'   => array( 'food' ),
		),
		'011v' => array(
			'title' => __( 'Coordinate with Social Venue/Sponsors', 'wordcamp-mentors' ),
			'cat'   => array( 'after-party' ),
		),
		'y1on' => array(
			'title' => __( 'Coordinate with Sponsors (event setup)', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'b7i5' => array(
			'title' => __( 'Coordinate with Speakers about sessions', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'jccc' => array(
			'title' => __( 'Upload videos to WordPress.tv', 'wordcamp-mentors' ),
			'cat'   => array( 'audio-video' ),
		),
		'gnws' => array(
			'title' => __( 'If using WordCamp Central cameras ship them back', 'wordcamp-mentors' ),
			'cat'   => array( 'audio-video' ),
		),
		'f8k2' => array(
			'title' => __( 'Make sure all bills are paid', 'wordcamp-mentors' ),
			'cat'   => array( 'budget' ),
		),
		'xuv6' => array(
			'title' => __( 'Breathe.', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'fl69' => array(
			'title' => __( 'Debrief what to keep and what to improve for next time', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'04ia' => array(
			'title' => __( 'Go to beginning ;)', 'wordcamp-mentors' ),
			'cat'   => array( 'committee' ),
		),
		'r95r' => array(
			'title' => __( 'Send attendee survey', 'wordcamp-mentors' ),
			'cat'   => array( 'lead' ),
		),
		'uu96' => array(
			'title' => __( 'Thank you emails', 'wordcamp-mentors' ),
			'cat'   => array( 'sponsor' ),
		),
		'uqrx' => array(
			'title' => __( 'Thank you emails', 'wordcamp-mentors' ),
			'cat'   => array( 'speaker' ),
		),
		'1hc1' => array(
			'title' => __( 'Thank you emails and request feedback', 'wordcamp-mentors' ),
			'cat'   => array( 'volunteer' ),
		),
	);
}

/**
 * Handle a POST request to reset the task data.
 *
 * @since 1.0.0
 *
 * @return void
 */
function handle_tasks_reset() {
	// Base redirect URL
	$redirect_url = add_query_arg( array(
		'page' => Mentors\PREFIX . '-planning-checklist',
	), admin_url( 'index.php' ) );

	if ( ! isset( $_POST[ Mentors\PREFIX . '-tasks-reset-nonce' ] ) ||
	     ! wp_verify_nonce( $_POST[ Mentors\PREFIX . '-tasks-reset-nonce' ], Mentors\PREFIX . '-tasks-reset' ) ) {
		$status_code = 'invalid-nonce';
	} else if ( ! current_user_can( Mentors\MENTOR_CAP ) ) {
		$status_code = 'insufficient-permissions';
	} else {
		$status_code = _reset_tasks();
	}

	$redirect_url = add_query_arg( 'status', $status_code, $redirect_url );

	wp_safe_redirect( esc_url_raw( $redirect_url ) );
}

add_action( 'admin_post_' . Mentors\PREFIX . '-tasks-reset', __NAMESPACE__ . '\handle_tasks_reset' );

/**
 * Reset the list of task posts and their related taxonomy terms.
 *
 * @access private
 *
 * @since 1.0.0
 *
 * @return string Status code
 */
function _reset_tasks() {
	$results = array();

	// Delete existing tasks
	$existing_tasks = get_posts( array(
		'post_type'      => Mentors\PREFIX . '_task',
		'post_status'    => get_task_statuses(),
		'posts_per_page' => 999,
	) );

	foreach ( $existing_tasks as $existing_task ) {
		$results[] = wp_delete_post( $existing_task->ID, true );
	}

	// Delete existing categories
	$existing_categories = get_terms( array(
		'taxonomy'   => Mentors\PREFIX . '_task_category',
		'hide_empty' => false,
	) );

	foreach ( $existing_categories as $existing_category ) {
		$results[] = wp_delete_term( $existing_category->term_id, Mentors\PREFIX . '_task_category' );
	}

	// Create new categories
	$new_category_data = get_task_category_data();

	foreach ( $new_category_data as $slug => $label ) {
		$results[] = wp_insert_term( $slug, Mentors\PREFIX . '_task_category' );
	}

	// Create new tasks
	$new_task_data = get_task_data();
	$order = 0;

	foreach ( $new_task_data as $l10n_id => $data ) {
		$order += 10;

		$args = array(
			'post_type'   => Mentors\PREFIX . '_task',
			'post_status' => Mentors\PREFIX . '_task_pending',
			'post_title'  => $l10n_id,
			'menu_order'  => $order,
		);

		$post_id = wp_insert_post( $args );

		$results[] = wp_set_object_terms( $post_id, $data['cat'], Mentors\PREFIX . '_task_category' );
	}

	if ( in_array( false, $results, true ) ||
	     ! empty( array_filter( $results, function( $i ) { return $i instanceof \WP_Error; } ) ) ) {
		return 'reset-errors';
	}

	return 'reset-success';
}

/**
 * Insert translated strings into REST response for tasks.
 *
 * @since 1.0.0
 *
 * @param \WP_REST_Response $response
 * @param \WP_Post $post
 *
 * @return \WP_REST_Response
 */
function localize_task( $response, $post ) {
	$l10n_id = $post->post_title;
	$task_data = get_task_data();

	if ( isset( $task_data[ $l10n_id ] ) ) {
		$response->data['title']['rendered'] = apply_filters( 'the_title', $task_data[ $l10n_id ]['title'] );

		$raw_modified = $response->data['modified'];
		$response->data['modified'] = array(
			'raw'      => $raw_modified,
			'relative' => sprintf(
				/* translators: Time since an event has occurred. */
				esc_html__( '%s ago', 'wordcamp-mentors' ),
				human_time_diff( strtotime( $raw_modified ), time() )
			),
		);
	}

	return $response;
}

add_filter( 'rest_prepare_' . Mentors\PREFIX . '_task', __NAMESPACE__ . '\localize_task', 10, 2 );

/**
 * Insert translated strings into REST response for task categories.
 *
 * @since 1.0.0
 *
 * @param \WP_REST_Response$response
 * @param $item
 *
 * @return \WP_REST_Response
 */
function localize_task_category( $response, $item ) {
	$task_category_data = get_task_category_data();

	if ( isset( $task_category_data[ $item->slug ] ) ) {
		$response->data['name'] = $task_category_data[ $item->slug ];
	}

	return $response;
}

add_filter( 'rest_prepare_' . Mentors\PREFIX . '_task_category', __NAMESPACE__ . '\localize_task_category', 10, 2 );