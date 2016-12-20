<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

use WordCamp\Mentors;

/** @var \WordCamp\Mentors\Tasks $tasks */
/** @var string $category_slug */
/** @var string $category_data */

?>
<li id="tasks-dash-tab-<?php echo esc_attr( $category_slug ); ?>" class="tasks-dash-tab" data-category="<?php echo esc_attr( $category_slug ); ?>">
	<a href="#tasks-dash-category-<?php echo esc_attr( $category_slug ); ?>">
		<?php if ( is_rtl() ) : ?>
			<span class="tasks-dash-tab-progresslabel"></span>
			<?php echo esc_html( $category_data['name'] ); ?>
			<span class="tasks-dash-tab-flag" style="background: <?php echo esc_attr( $category_data['color'] ); ?>"></span>
		<?php else : ?>
			<span class="tasks-dash-tab-flag" style="background: <?php echo esc_attr( $category_data['color'] ); ?>"></span>
			<?php echo esc_html( $category_data['name'] ); ?>
			<span class="tasks-dash-tab-progresslabel"></span>
		<?php endif; ?>
	</a>
	<div class="tasks-dash-tab-progressbar"></div>
</li>