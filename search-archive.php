<?php
/* Template Name: Custom Search */  

$teachers=0; $posts=0;
?>

<?php 
global $post;
$post->favourite=xprofile_get_field_data('Favourite',get_current_user_id()); 
$post->favourite=explode("|", get_current_user_id());
?>

    <div class="search-form">
      <form action="<?php echo get_permalink(110); ?>" method="get">
        <div class="label">Search for</div>
        <input class="input" type="text" name="q" placeholder="keyword" <?php if(isset($_GET["q"]) && $_GET["q"]!="") echo ' value="'.$_GET["q"].'"'; ?>/>
        <div class="label">in</div>
        <select name="in">
          <option value="all">All</option>
          <option value="post"<?php if(isset($_GET["in"]) && $_GET["in"]=="post") echo ' selected'; ?>>Articles</option>
          <option value="teacher"<?php if(isset($_GET["in"]) && $_GET["in"]=="teacher") echo ' selected'; ?>>Teachers</option>
        </select>
        <input type="submit" class="btn" value="Go">
        <div class="clear"></div>
      </form>
    </div>  

<div class="row">   

<?php if($_GET["in"]=='all' || $_GET["in"]=='teacher') { ?>   
  <?php  
  $member_args = array(
    'member_type' => array('teacher'),
    'search_terms' => stripslashes($_GET["q"]),
    'per_page' => 100000
  );  
  
  if ( bp_has_members( $member_args ) ) : ?>
    <?php $teachers=1; ?>
  	<?php while ( bp_members() ) : bp_the_member(); ?>
  		      <?php get_template_part('templates/card-teacher'); ?>
  	<?php endwhile; ?>   
  <?php endif; ?> 
<?php } ?>

<?php if($_GET["in"]=='all' || $_GET["in"]=='post') { ?>
  <?php 
  	$args = array(
      'post_type' => 'post',
      'posts_per_page' => -1,
      'orderby' => 'date',
  		'order' => 'DESC',
      'post_status' => 'publish',
      's' => $_GET["q"]
    );
  	$loop = new WP_Query($args);   
  ?>
  
  <?php if ($loop->have_posts()) { $posts=1; ?>
     <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
        <div class="card col-sm-6 col-md-4">
          <div class="body">
            <?php 
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'full');
            $url = $thumb['0'];
            if($url=="") $url=get_template_directory_uri().'/assets/img/empty-box.jpg';
            ?>
                  
                  
            <div class="image"><img src="<?php echo $url; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" /></div>
            <a href="<?php echo get_permalink(get_the_ID()); ?>" class="hover-bg"></a>
            <?php $date = strtotime(get_the_date()); ?>
            <div class="date"><?php echo date('F jS', $date); ?></div>
            <div class="info">
              <h3 class="name"><?php echo get_the_title(); ?></h3>
            </div>              
          </div>
          <div class="description"><?php echo get_the_custom_excerpt(get_the_ID(),200); ?></div>
        </div>
      <?php endwhile; ?>
  <?php } ?>
  
  <?php wp_reset_postdata(); ?>
<?php } ?>


<?php if($posts==0 && $teachers==0) { ?>
  <h3 class="col-sm-12">Sorry, no results were found.</h3>
<?php } ?>

</div>   
