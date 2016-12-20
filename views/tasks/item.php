<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

/** @var string $task_id */
/** @var \WordCamp\Mentors\Task_Dashboard\Task $task */

?>
<li id="<?php echo esc_attr( $task->get_html_id() ); ?>" class="<?php echo esc_attr( $task->get_html_class() ); ?>" <?php echo esc_html( $task->get_html_data_attributes() ); ?>>
    <?php if ( ! is_rtl() ) : ?>
        <div class="spinner"></div>
        <div class="<?php echo esc_attr( $task->get_toggle_html_class() ); ?>"></div>
    <?php endif; ?>
	<div class="tasks-dash-item-content">
		<?php echo wp_kses_post( $task->text ); ?>
		<?php if ( 'complete' === $task->state && $task->completed_by ) : ?>
            <span class="completed-by">(<?php echo esc_html( $task->completed_by ); ?>)</span>
		<?php endif; ?>
	</div>
	<?php if ( is_rtl() ) : ?>
        <div class="tasks-dash-item-toggle"></div>
        <div class="spinner"></div>
	<?php endif; ?>
</li>