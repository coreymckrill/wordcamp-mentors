<?php
/**
 * Data for the Planning Checklist.
 *
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Tasks;
defined( 'WPINC' ) || die();

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
		'after-party'     => esc_html__( 'After Party', 'wordcamporg' ),
		'audio-video'     => esc_html__( 'Audio/Video', 'wordcamporg' ),
		'budget'          => esc_html__( 'Budget', 'wordcamporg' ),
		'committee'       => esc_html__( 'Committee', 'wordcamporg' ),
		'contributor-day' => esc_html__( 'Contributor Day', 'wordcamporg' ),
		'design'          => esc_html__( 'Design', 'wordcamporg' ),
		'food'            => esc_html__( 'Food', 'wordcamporg' ),
		'lead'            => esc_html__( 'Lead', 'wordcamporg' ),
		'registration'    => esc_html__( 'Registration', 'wordcamporg' ),
		'speaker'         => esc_html__( 'Speaker', 'wordcamporg' ),
		'sponsor'         => esc_html__( 'Sponsor', 'wordcamporg' ),
		'swag'            => esc_html__( 'Swag', 'wordcamporg' ),
		'volunteer'       => esc_html__( 'Volunteer', 'wordcamporg' ),
		'web'             => esc_html__( 'Web', 'wordcamporg' ),
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
	 * When adding or editing items, be sure to update the value of the DATA_VERSION constant in
	 * the wordcamp-mentors.php file with the current YYYYMMDD timestamp (include hours and
	 * minutes if necessary).
	 *
	 * The task data keys are randomized strings instead of sequential and/or contextual because:
	 * - The order of the tasks could change, in which case having out-of-order sequential numbers
	 *   could be confusing.
	 * - The wording, category, or other properties of a task could change, in which case a key
	 *   string based on these properties could be confusing.
	 *
	 * When adding new task items, randomized key strings can be created here:
	 * http://textmechanic.com/text-tools/randomization-tools/random-string-generator/
	 */
	return array(
		'8pb0' => array(
			'title' => __( 'Update budget template', 'wordcamporg' ),
			'cat'   => array( 'budget' ),
		),
		'v2cu' => array(
			'title' => __( 'Explore venue options', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'jv29' => array(
			'title' => __( 'Start thinking about Design process/branding', 'wordcamporg' ),
			'cat'   => array( 'design' ),
		),
		't5o8' => array(
			'title' => __( 'Application process and approval', 'wordcamporg' ),
			'cat'   => array( 'lead' ),
		),
		'22ix' => array(
			'title' => __( 'Build/Organize Team', 'wordcamporg' ),
			'cat'   => array( 'lead' ),
		),
		'o1rt' => array(
			'title' => __( 'Discuss topics/requested speaker topics', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'qi33' => array(
			'title' => __( 'WordCamp Central website is created', 'wordcamporg' ),
			'cat'   => array( 'web' ),
		),
		'n7rk' => array(
			'title' => __( 'Budget approval', 'wordcamporg' ),
			'cat'   => array( 'budget' ),
		),
		'siq8' => array(
			'title' => __( 'Choose a Date', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'7j6f' => array(
			'title' => __( 'Venue walkthrough with all wranglers', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'f087' => array(
			'title' => __( 'Solidify Venue', 'wordcamporg' ),
			'cat'   => array( 'lead' ),
		),
		'3vf4' => array(
			'title' => __( 'Identify internal sponsorship levels and what each level includes', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'u1rl' => array(
			'title' => __( 'Organizer team creates sponsorship packs and guidelines. Verifying all sponsors agree with licensing.', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'5uqp' => array(
			'title' => __( 'Areas that have had WordCamps in the past should reach out to sponsors from prior camps.', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'vbbj' => array(
			'title' => __( 'begin website design - prepare to launch', 'wordcamporg' ),
			'cat'   => array( 'web' ),
		),
		'inv6' => array(
			'title' => __( 'Announce WordCamp event/site to community', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'erjt' => array(
			'title' => __( 'Create/use email templates for sponsorship, volunteers, speakers, etc', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'ibzq' => array(
			'title' => __( 'Have web wrangler add call for speakers on site', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'wccy' => array(
			'title' => __( 'Reach out to known/wanted community speakers', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'9tsp' => array(
			'title' => __( 'Call for sponsors on website (form)', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'p1ff' => array(
			'title' => __( 'include why to sponsor on website (perks)', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'gy0i' => array(
			'title' => __( 'Contact larger Community sponsors', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'lkcs' => array(
			'title' => __( 'Get quotes from vendors', 'wordcamporg' ),
			'cat'   => array( 'swag' ),
		),
		'rko5' => array(
			'title' => __( 'Have web wrangler add call for volunteers on website including descriptions', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'krv3' => array(
			'title' => __( 'Launch website design', 'wordcamporg' ),
			'cat'   => array( 'web' ),
		),
		'uw8g' => array(
			'title' => __( 'Open ticket sales', 'wordcamporg' ),
			'cat'   => array( 'registration' ),
		),
		'qi9n' => array(
			'title' => __( 'Anonymize speaker submissions (remove gender specific information, names)', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'co30' => array(
			'title' => __( 'Prep review panel', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'eu82' => array(
			'title' => __( 'Send out update email to speaker applicants', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'4isl' => array(
			'title' => __( 'Identify any special A/V needs and coordinate with A/V wrangler', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'k9k0' => array(
			'title' => __( 'Start drafting the sponsorship shoutouts for blog posts', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'm2sc' => array(
			'title' => __( 'Send emails to sponsor regarding what they need for them. ', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'eel1' => array(
			'title' => __( 'Design swag decisions', 'wordcamporg' ),
			'cat'   => array( 'swag' ),
		),
		'cxpj' => array(
			'title' => __( 'Find venue for volunteer orientation and set date', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'75sp' => array(
			'title' => __( 'Find Social Venue', 'wordcamporg' ),
			'cat'   => array( 'after-party' ),
		),
		'uutz' => array(
			'title' => __( 'Select videographer or request video kit from WordCamp Central', 'wordcamporg' ),
			'cat'   => array( 'audio-video' ),
		),
		'o14g' => array(
			'title' => __( 'Find location for contributor day', 'wordcamporg' ),
			'cat'   => array( 'contributor-day' ),
		),
		'sfrb' => array(
			'title' => __( 'Begin posting original content (WordCamp stories, speaker profiles, community involvement stories, etc)', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'5j0m' => array(
			'title' => __( 'Select caterer and secure food for event', 'wordcamporg' ),
			'cat'   => array( 'food' ),
		),
		'h8y4' => array(
			'title' => __( 'Committee approve speakers', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'mkj1' => array(
			'title' => __( 'Email selected speakers (ticket codes, location information, will they need a +1, A/V release)', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'c00l' => array(
			'title' => __( 'Email remaining speaker applicants', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'fucx' => array(
			'title' => __( 'Finalize swag decisions', 'wordcamporg' ),
			'cat'   => array( 'swag' ),
		),
		'2hoa' => array(
			'title' => __( 'Find swag vendor', 'wordcamporg' ),
			'cat'   => array( 'swag' ),
		),
		'2x9f' => array(
			'title' => __( 'get lanyards and stickers from WordCamp Central', 'wordcamporg' ),
			'cat'   => array( 'swag' ),
		),
		'3b1k' => array(
			'title' => __( 'Determine what volunteers roles and how many are needed, create grid (example 1, example 2, example 3, and determine how many volunteers are needed', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'84y3' => array(
			'title' => __( 'Publish/Announce speakers', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'2ghl' => array(
			'title' => __( 'Ask speakers to promote on their social channels', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'y3ct' => array(
			'title' => __( 'Tell Speakers that slides are needed by 4 weeks out.', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'9yj5' => array(
			'title' => __( 'write volunteer role descriptions and create volunteer web request form (not published yet)', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'l931' => array(
			'title' => __( 'Publish/Announce sessions', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'p0ns' => array(
			'title' => __( 'Order speaker gifts', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'03kv' => array(
			'title' => __( 'Speaker/sponsor dinner “save the date”', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'srgu' => array(
			'title' => __( 'Have web wrangler publish sponsor posts', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'sq9v' => array(
			'title' => __( 'Speaker/sponsor dinner “save the date”', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'gyz3' => array(
			'title' => __( 'Put out call for volunteers', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'ws2p' => array(
			'title' => __( 'order swag (and custom stickers if applicable) ', 'wordcamporg' ),
			'cat'   => array( 'swag' ),
		),
		'1vob' => array(
			'title' => __( 'Publish/Announce speaker bio posts', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'r3ge' => array(
			'title' => __( 'Remind speakers to send slides', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'bc1e' => array(
			'title' => __( 'Badge/Name Tag design', 'wordcamporg' ),
			'cat'   => array( 'design' ),
		),
		'e0uc' => array(
			'title' => __( 'Signage Design', 'wordcamporg' ),
			'cat'   => array( 'design' ),
		),
		'0ona' => array(
			'title' => __( 'Remind speakers to promote the event in their social channels/blogs', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'2bq3' => array(
			'title' => __( 'Send out coupon codes to speakers', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'se9c' => array(
			'title' => __( 'Swag from sponsors who will not be attending / swag going in handout bags', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'su2b' => array(
			'title' => __( 'Send out coupon codes to sponsors', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'1f48' => array(
			'title' => __( 'Start scheduling volunteers.', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'ckzp' => array(
			'title' => __( 'Confirm volunteers and gather volunteer information', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'qk6k' => array(
			'title' => __( 'Send out coupon codes', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'h9fk' => array(
			'title' => __( 'Collect invoices from vendors and get them to WordCamp Central', 'wordcamporg' ),
			'cat'   => array( 'budget' ),
		),
		'2u4x' => array(
			'title' => __( 'Offer speaker mentorship (via google hangouts, speaker training)', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'q97z' => array(
			'title' => __( 'Review speaker slides', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'c46e' => array(
			'title' => __( 'Confirm food, arrange delivery/pickup', 'wordcamporg' ),
			'cat'   => array( 'food' ),
		),
		'nhws' => array(
			'title' => __( 'Finalize name badge order', 'wordcamporg' ),
			'cat'   => array( 'design' ),
		),
		'f1ln' => array(
			'title' => __( 'Order signage', 'wordcamporg' ),
			'cat'   => array( 'design' ),
		),
		'r4ty' => array(
			'title' => __( 'Schedule pre-camp pep talk with WordCamp Central', 'wordcamporg' ),
			'cat'   => array( 'lead' ),
		),
		'tpvw' => array(
			'title' => __( 'Create backup plans including backup speaker', 'wordcamporg' ),
			'cat'   => array( 'lead' ),
		),
		'm8k1' => array(
			'title' => __( 'Write attendee survey', 'wordcamporg' ),
			'cat'   => array( 'lead' ),
		),
		'h641' => array(
			'title' => __( 'Communicate with speakers about schedule', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'eut6' => array(
			'title' => __( 'Communicate with speakers about travel details (flight/hotel details)', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'9ukf' => array(
			'title' => __( 'Communicate about A/V setup (photos of venue, types of equipment being used)', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'a4m3' => array(
			'title' => __( 'Communicate about Speaker dinner', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'svit' => array(
			'title' => __( 'Email on logistical details for day of set up (photos, tables, etc)', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'v6ur' => array(
			'title' => __( 'Speaker/sponsor dinner email announcement/RSVP', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'6kg0' => array(
			'title' => __( 'Have volunteer schedule pretty much done', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'h4pa' => array(
			'title' => __( 'Publish schedule on website', 'wordcamporg' ),
			'cat'   => array( 'web' ),
		),
		'f5fo' => array(
			'title' => __( 'Confirm food/drinks or coordinate with food wrangler', 'wordcamporg' ),
			'cat'   => array( 'after-party' ),
		),
		'2iiq' => array(
			'title' => __( 'If you’re not using a professional videographer get camera ready', 'wordcamporg' ),
			'cat'   => array( 'audio-video' ),
		),
		'5kx4' => array(
			'title' => __( 'Venue walk-through', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'lcnm' => array(
			'title' => __( 'Confirm food/drinks or coordinate with food wrangler', 'wordcamporg' ),
			'cat'   => array( 'contributor-day' ),
		),
		'219u' => array(
			'title' => __( 'Confirm order with caterer based on attendance numbers', 'wordcamporg' ),
			'cat'   => array( 'food' ),
		),
		'woys' => array(
			'title' => __( 'Pick up outside food and drink (if applicable)', 'wordcamporg' ),
			'cat'   => array( 'food' ),
		),
		'gmue' => array(
			'title' => __( 'Close registration', 'wordcamporg' ),
			'cat'   => array( 'registration' ),
		),
		'qha0' => array(
			'title' => __( 'Communicate sponsor dinner plans to sponsors', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'yzu9' => array(
			'title' => __( 'Sort swag (fold t-shirts)', 'wordcamporg' ),
			'cat'   => array( 'swag' ),
		),
		'hscb' => array(
			'title' => __( 'Volunteer Training', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'nn2q' => array(
			'title' => __( 'locate where volunteer stations will be in venue.', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'hc9u' => array(
			'title' => __( 'Communicate with speakers, etc for all A/V needs', 'wordcamporg' ),
			'cat'   => array( 'audio-video' ),
		),
		'872l' => array(
			'title' => __( 'If you’re not using a professional videographer: test camera operation', 'wordcamporg' ),
			'cat'   => array( 'audio-video' ),
		),
		'rhgc' => array(
			'title' => __( 'Pre-camp prep with venue', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'w3l6' => array(
			'title' => __( 'Send attendee email with info about parking, wifi, any other reminders', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'20g7' => array(
			'title' => __( 'Speaker/sponsor dinner', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'73qa' => array(
			'title' => __( 'Send email on logistical details for day of set up', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'hkv5' => array(
			'title' => __( 'A/V setup, etc.', 'wordcamporg' ),
			'cat'   => array( 'audio-video' ),
		),
		'gyc3' => array(
			'title' => __( 'Registration', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'3oqk' => array(
			'title' => __( 'Session Management', 'wordcamporg' ),
			'cat'   => array( 'volunteer' ),
		),
		'vunm' => array(
			'title' => __( 'Coordinate last minute details', 'wordcamporg' ),
			'cat'   => array( 'food' ),
		),
		'011v' => array(
			'title' => __( 'Coordinate with Social Venue/Sponsors', 'wordcamporg' ),
			'cat'   => array( 'after-party' ),
		),
		'y1on' => array(
			'title' => __( 'Coordinate with Sponsors (event setup)', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'b7i5' => array(
			'title' => __( 'Coordinate with Speakers about sessions', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'jccc' => array(
			'title' => __( 'Upload videos to WordPress.tv', 'wordcamporg' ),
			'cat'   => array( 'audio-video' ),
		),
		'gnws' => array(
			'title' => __( 'If using WordCamp Central cameras ship them back', 'wordcamporg' ),
			'cat'   => array( 'audio-video' ),
		),
		'f8k2' => array(
			'title' => __( 'Make sure all bills are paid', 'wordcamporg' ),
			'cat'   => array( 'budget' ),
		),
		'xuv6' => array(
			'title' => __( 'Breathe.', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'fl69' => array(
			'title' => __( 'Debrief what to keep and what to improve for next time', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'04ia' => array(
			'title' => __( 'Go to beginning ;)', 'wordcamporg' ),
			'cat'   => array( 'committee' ),
		),
		'r95r' => array(
			'title' => __( 'Send attendee survey', 'wordcamporg' ),
			'cat'   => array( 'lead' ),
		),
		'uu96' => array(
			'title' => __( 'Thank you emails', 'wordcamporg' ),
			'cat'   => array( 'sponsor' ),
		),
		'uqrx' => array(
			'title' => __( 'Thank you emails', 'wordcamporg' ),
			'cat'   => array( 'speaker' ),
		),
		'1hc1' => array(
			'title' => __( 'Thank you emails and request feedback', 'wordcamporg' ),
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
	// The base redirect URL.
	$redirect_url = add_query_arg( array(
		'page' => Mentors\PREFIX . '-planning-checklist',
	), admin_url( 'index.php' ) );

	if ( ! isset( $_POST[ Mentors\PREFIX . '-tasks-reset-nonce' ] ) ||
	     ! wp_verify_nonce( $_POST[ Mentors\PREFIX . '-tasks-reset-nonce' ], Mentors\PREFIX . '-tasks-reset' ) ) {
		$status_code = 'invalid-nonce';
	} elseif ( ! current_user_can( Mentors\MENTOR_CAP ) ) {
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

	// Delete existing tasks.
	$existing_tasks = get_posts( array(
		'post_type'      => Mentors\PREFIX . '_task',
		'post_status'    => array_keys( get_task_statuses() ),
		'posts_per_page' => 999,
	) );

	foreach ( $existing_tasks as $existing_task ) {
		$results[] = wp_delete_post( $existing_task->ID, true );
	}

	// Delete existing categories.
	$existing_categories = get_terms( array(
		'taxonomy'   => Mentors\PREFIX . '_task_category',
		'hide_empty' => false,
	) );

	foreach ( $existing_categories as $existing_category ) {
		$results[] = wp_delete_term( $existing_category->term_id, Mentors\PREFIX . '_task_category' );
	}

	// Create new categories.
	$new_category_data = get_task_category_data();

	foreach ( $new_category_data as $slug => $label ) {
		$results[] = wp_insert_term( $slug, Mentors\PREFIX . '_task_category' );
	}

	// Create new tasks.
	$new_task_data = get_task_data();
	$order = 0;

	foreach ( $new_task_data as $l10n_id => $data ) {
		$order += 10;

		$args = array(
			'post_type'   => Mentors\PREFIX . '_task',
			'post_status' => Mentors\PREFIX . '_task_pending',
			'post_title'  => $l10n_id,
			'menu_order'  => $order,
			'meta_input'  => array(
				Mentors\PREFIX . '-data-version' => Mentors\DATA_VERSION,
			),
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
 * The strings are translated here instead of when the task posts are inserted so that
 * they remain translatable if mentors and/or organizers who are viewing the Planning Checklist
 * have a different locale than the one used when the task data was set up.
 *
 * @since 1.0.0
 *
 * @param \WP_REST_Response $response The response object to be sent.
 * @param \WP_Post          $post     The post in the response object.
 *
 * @return \WP_REST_Response
 */
function localize_task( $response, $post ) {
	$l10n_id = $post->post_title;
	$task_data = get_task_data();

	if ( isset( $task_data[ $l10n_id ] ) ) {
		$response->data['title']['rendered'] = apply_filters( 'the_title', $task_data[ $l10n_id ]['title'] );
	} else {
		$response->data['title']['rendered'] = esc_html__( 'Unknown task.', 'wordcamporg' );
	}

	$raw_modified = $response->data['modified'];
	$response->data['modified'] = array(
		'raw'      => $raw_modified,
		'relative' => sprintf(
			/* translators: Time since an event has occurred. */
			esc_html__( '%s ago', 'wordcamporg' ),
			human_time_diff( strtotime( $raw_modified ), current_time( 'timestamp' ) )
		),
	);

	return $response;
}

add_filter( 'rest_prepare_' . Mentors\PREFIX . '_task', __NAMESPACE__ . '\localize_task', 10, 2 );

/**
 * Insert translated strings into REST response for task categories.
 *
 * The strings are translated here instead of when the task posts are inserted so that
 * they remain translatable if mentors and/or organizers who are viewing the Planning Checklist
 * have a different locale than the one used when the task data was set up.
 *
 * @since 1.0.0
 *
 * @param \WP_REST_Response $response The response object to be sent.
 * @param \WP_Term          $item     The term in the response object.
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

/**
 * Record the username of the user updating the task post.
 *
 * @since 1.0.0
 *
 * @param \WP_Post $post The task post currently being updated.
 */
function update_last_modifier( $post ) {
	$user = wp_get_current_user();

	if ( $user instanceof \WP_User ) {
		update_post_meta( $post->ID, Mentors\PREFIX . '-last-modifier', $user->user_login );
	}
}

add_action( 'rest_insert_' . Mentors\PREFIX . '_task', __NAMESPACE__ . '\update_last_modifier' );
