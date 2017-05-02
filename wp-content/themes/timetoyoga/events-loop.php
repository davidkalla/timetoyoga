<?php
/*
Template Name: Events
*/

/**
 * Template for displaying the Events Loop
 * You can copy this file to your-theme
 * and then edit the layout. 
 */

?>

<?php get_template_part('templates/page', 'header'); ?>

<?php

$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

$args = array(
	'post_type'      => 'event',
	'order'          => 'ASC',
	'orderby'		 => 'meta_value_num',
	'meta_key'		 => 'event-unix',
	'paged'          => $paged,
	'posts_per_page' => 10,

	'meta_query' => array(
		array(
			'key'		=> 'event-unix',
			'value'		=> current_time( 'timestamp' ),
			'compare'	=> '>=',
			'type' 		=> 'NUMERIC',
		),
	),

);

$wp_query = new WP_Query( $args );
?>

		
		<?php if ( $wp_query->have_posts() ) : ?>

		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); 	?>

			<?php get_template_part('templates/content', get_post_format()); ?>		

		<?php endwhile; ?>

		<div class="entry-content"><br/>
			<?php echo pp_events_pagination( $wp_query ); ?>
		</div>

		<?php else : ?>

			<div class="alert alert-warning"><div class="entry-content"><br/>There are no upcoming Events.</div></div>


		<?php endif; ?>


		<?php wp_reset_postdata(); ?>
		
