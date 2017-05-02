<?php
/*
Template Name: Videos
*/
?>

<?php get_template_part('templates/page', 'header'); ?>
<?php get_template_part('templates/content', 'page'); ?>

<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$query = new WP_Query([
    'post_type'      => 'video',
    'post_status'    => 'publish', 
    'orderby'        => 'title',
    'order' => 'ASC',
    'posts_per_page' => 15,
    'paged' => $paged
]);

?>


<?php if ($query->have_posts()) {  ?>
	<div class="row yoga-videos-list">

	<?php while ($query->have_posts()) { $query->the_post(); ?>
		      
          <a class="video-card col-sm-4 col-md-4" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
            <div class="image">             
              <img src="http://img.youtube.com/vi/<?php echo get_post_meta(get_the_ID(),'video',true); ?>/0.jpg" alt="<?php echo get_the_title(); ?>" title="<?php echo get_the_title(); ?>" />
            </div>
            <div class="body">
              <?php
              $views=get_post_meta(get_the_ID(),'post_video_count',true);
              if($views=="") $views='0 views';
              elseif($views==1) $views='1 view';
              else $views=$views.' views';
              ?>
        			<h3 class="title"><?php echo get_the_title(); ?></h3>
              <span class="views"><?php echo $views; ?></span>
              <span class="date"><?php echo get_the_date('F jS'); ?></span>
              <div class="clear"></div>
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
