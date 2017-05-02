<?php
/*
Template Name: Yoga Styles
*/
?>

<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>

<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$query = new WP_Query([
    'post_type'      => 'style',
    'post_status'    => 'publish', 
    'orderby'        => 'title',
    'order' => 'ASC',
    'posts_per_page' => 72,
    'paged' => $paged
]);

?>


<?php if ($query->have_posts()) {  ?>
	<div class="row yoga-styles-list">

	<?php while ($query->have_posts()) { $query->the_post(); ?>
		      
          <a class="style-card col-xs-6 col-sm-4 col-md-3" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
            <div class="body">
        			<span class="text"><?php echo get_the_title(); ?></span>
            </div>
          </a>
	<?php } ?>
      <?php wp_reset_postdata(); ?>

	</div>
  
  
  <nav class="post-nav">
        <ul class="pager">
          <li class="previous"><?php next_posts_link('&larr; Previous styles', $query->max_num_pages); ?></li>
          <li class="next"><?php previous_posts_link('Next styles &rarr;'); ?></li>
        </ul>
      </nav>


<?php } ?>
