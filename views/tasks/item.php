<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

/** @var string $task_id */
/** @var \WordCamp\Mentors\Task $task */

?>
<li id="<?php echo esc_attr( $task->get_html_id() ); ?>" class="<?php echo esc_attr( $task->get_html_class() ); ?>" <?php echo esc_html( $task->get_html_data_attributes() ); ?>>
	<div class="tasks-dash-item-toggle">
		<input type="checkbox"<?php checked( 'complete', $task->state ); ?> />
	</div>
	<div class="tasks-dash-item-content">
		<?php echo wpautop( wp_kses_post( $task->text ) ); ?>
		<?php if ( 'complete' === $task->state && $task->completed_by ) : ?>
			<?php echo esc_html( $task->completed_by ); ?>
		<?php endif; ?>
	</div>
</li>