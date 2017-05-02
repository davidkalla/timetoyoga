<?php
/* Template Name: Sitemap */  
?>

<?php if(!bp_is_member()) { ?><?php get_template_part('templates/page', 'header'); ?><?php  } ?>


<?php while (have_posts()) : the_post(); ?>
  <?php generateSitemap(); the_content(); ?>
  
  <?php $query = new WP_Query(['post_type' => 'post','post_status' => 'publish','orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1]); ?>
  <?php if ($query->have_posts()) {  ?>
    <h2>Articles</h2>
    <ul class="simple-sitemap">
      <?php while ($query->have_posts()) { $query->the_post(); ?>
        <li><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
      <?php } ?>
    </ul> 
   <?php wp_reset_postdata(); ?>
  <?php } ?>
  
  <?php $query = new WP_Query(['post_type' => 'page','post_status' => 'publish','orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'post__not_in' => array(114, 112, 4265)]); ?>
  <?php if ($query->have_posts()) {  ?>
    <h2>Pages</h2>
    <ul class="simple-sitemap">
      <?php while ($query->have_posts()) { $query->the_post(); ?>
        <li><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
      <?php } ?>
    </ul> 
   <?php wp_reset_postdata(); ?>
  <?php } ?>
  
  <?php $query = new WP_Query(['post_type' => 'video','post_status' => 'publish','orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1]); ?>
  <?php if ($query->have_posts()) {  ?>
    <h2>Videos</h2>
    <ul class="simple-sitemap">
      <?php while ($query->have_posts()) { $query->the_post(); ?>
        <li><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
      <?php } ?>
    </ul> 
   <?php wp_reset_postdata(); ?>
  <?php } ?>
  
  
  <?php $query = new WP_Query(['post_type' => 'style','post_status' => 'publish','orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1]); ?>
  <?php if ($query->have_posts()) {  ?>
    <h2>Yoga Styles</h2>
    <ul class="simple-sitemap">
      <?php while ($query->have_posts()) { $query->the_post(); ?>
        <li><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
      <?php } ?>
    </ul> 
   <?php wp_reset_postdata(); ?>
  <?php } ?>
  
  
  <?php
  $member_args = array(
      'member_type' => array('teacher'),
      'type' => 'alphabetical', 
      'per_page' => 100000
  );
  ?>
  <?php if ( bp_has_members( $member_args ) ) : ?>
    <h2>Teachers</h2>
    <ul class="simple-sitemap">
    <?php while ( bp_members() ) : bp_the_member(); ?>
      <li><a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a></li>
  	<?php endwhile; ?>
    </ul>
  <?php endif; ?>
  
  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>