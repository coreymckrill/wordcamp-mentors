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
<section id="tasks-dash-category-<?php echo esc_attr( $category_slug ); ?>" class="tasks-dash-category" data-color="<?php echo esc_attr( $category_data['color'] ); ?>">
    <header>
        <h2><?php echo esc_html( $category_data['name'] ); ?></h2>
    </header>

    <ul>
        <?php foreach ( $tasks->get_tasks_in_category( $category_slug ) as $task_id => $task ) : ?>
	        <?php require Mentors\get_views_dir_path() . 'tasks/item.php'; ?>
        <?php endforeach; ?>
    </ul>
</section>