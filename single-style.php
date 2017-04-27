<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header>
    <div class="entry-content">
      <?php 
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'full');
        $url = $thumb['0'];
      ?>
            
      <?php if($url!="") { ?>
        <div class="content-image"><img src="<?php echo $url; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" /></a></div> 
      <?php } ?>
      
      <?php the_content(); ?>
      
      <?php $meta=get_post_meta(get_the_ID(), 'whattoexpect',true); ?>
      <?php if($meta!="") { ?>
        <h2>What to expect</h2>
        <div><p><?php echo $meta; ?></p></div>
      <?php } ?>
      
      <?php $meta=get_post_meta(get_the_ID(), 'founderdescription',true); ?>
      <?php if($meta!="") { ?>
        <h2>Founder</h2>
        <div><p><?php echo $meta; ?></p></div>
      <?php } ?>  
    </div>
  </article>
<?php endwhile; ?>

   
<?php 
$favourite=xprofile_get_field_data('Favourite',get_current_user_id()); 
$favourite=explode("|", $favourite);
?>
<?php
$member_args = array(
    'member_type' => array('teacher'),
    'type' => 'random',
    'search_terms' => get_the_title(), 
    'per_page' => 12
);

do_action( 'bp_before_members_loop' ); ?>


<?php if ( bp_has_members( $member_args ) ) : ?>

	
	<?php do_action( 'bp_before_directory_members_list' ); ?>
  <h2>Related Teachers</h2>
	<div id="members-list" class="teachers row">

	<?php while ( bp_members() ) : bp_the_member(); ?>
		      <?php
          if(($key=array_search(bp_get_member_user_id(),$favourite))!==false) $favourite_active=" active";
          else $favourite_active="";
          ?>
          
          <div class="card col-sm-6 col-md-4">
            <div class="body">
        			<div class="image">
                <?php bp_member_avatar('type=thumb&height=500&width=500'); ?>
              </div>
        			<a href="<?php bp_member_permalink(); ?>" class="hover-bg"></a>
              
              <?php if(get_current_user_id()!=0 && get_current_user_id()!=bp_get_member_user_id()){ ?><a href="<?php bp_member_permalink(); ?>?favourite" class="like<?php echo $favourite_active; ?>"><i class="fa fa-heart"></i></a><?php } ?>
              <div class="info">
                <h3 class="name"><?php bp_member_name(); ?></h3>
                <?php 
                $text=xprofile_get_field_data('City',bp_get_member_user_id());
                  if($text!=""){ ?><div class="orange"><i class="fa fa-map-marker"></i> <?php echo $text; ?></div><?php } else { ?><div class="orange">&nbsp;</div><?php } ?>
                
                <div class="clear"></div>
              </div> 
            </div>
            <?php $text=xprofile_get_field_data('About Me',bp_get_member_user_id()); ?>
            <div class="description"><?php echo $text; ?></div>
          </div>
	<?php endwhile; ?>

	</div>


<?php endif; ?>
<?php do_action( 'bp_after_members_loop' ); ?>
