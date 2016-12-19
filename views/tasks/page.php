<?php
/**
 * @package WordCamp\Mentors
 */

namespace WordCamp\Mentors\Task_Dashboard;
defined( 'WPINC' ) or die();

use WordCamp\Mentors;

/** @var array $data */
/** @var \WordCamp\Mentors\Tasks $tasks */

?>
<div class="wrap">
	<h1><?php echo esc_html( $data['page']['title'] ); ?></h1>

	<p class="description"><?php echo wp_kses_post( $data['page']['description'] ); ?></p>

    <div class="tasks-dash-container">
        <?php foreach( $data['categories'] as $category_slug => $category_data ) : ?>
            <?php require Mentors\get_views_dir_path() . 'tasks/category.php'; ?>
        <?php endforeach; ?>
    </div>
</div>