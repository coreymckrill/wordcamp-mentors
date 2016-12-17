<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

use WordCamp\Mentors;

/** @var \WordCamp\Mentors\Tasks $tasks */
/** @var string $category_slug */
/** @var string $category_name */

?>
<section id="wordcamp-mentors-task-group-<?php echo esc_attr( $category_slug ); ?>" class="wordcamp-mentors-task-group card">
	<h2><?php echo esc_html( $category_name ); ?></h2>

    <ul>
        <?php foreach ( $tasks->get_tasks_in_category( $category_slug ) as $task_id => $task ) : ?>
	        <?php require Mentors\get_views_dir_path() . 'tasks/item.php'; ?>
        <?php endforeach; ?>
    </ul>
</section>