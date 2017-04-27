<?php setVideoViews(get_the_ID()); ?>

<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php 
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'full');
        $url = $thumb['0'];
      ?>
            
      <?php if($url!="") { ?>
        <div class="content-image"><img src="<?php echo $url; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" /></a></div> 
      <?php } ?>
      
      <?php $video=get_post_meta(get_the_ID(),'video',true); ?>
      <?php if($video!="") { ?>
      <div class="video-content">
        <iframe width="540" height="360" src="https://www.youtube.com/embed/<?php echo $video?>" frameborder="0" allowfullscreen></iframe>
      </div>
      <?php } ?>
      
      <?php the_content(); ?>
    </div>
  </article>
<?php endwhile; ?>

   
<?php
$query = new WP_Query([
    'post_type'      => 'video',
    'post_status'    => 'publish', 
    'orderby'        => 'title',
    'order' => 'ASC',
    'posts_per_page' => 6,
    'post__not_in' => array(get_the_ID())
]);

?>


<?php if ($query->have_posts()) {  ?>
  <h2>Recent videos</h2>
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


<?php } ?>

	
