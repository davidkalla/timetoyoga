<?php /* ?>
<h1>Trending in Yoga</h1>
      
      <?php
      $args = array('numberposts' => 3, 'orderby' =>'post_date','order' => 'DESC',"suppress_filters" => false);  
      $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
      if(count($recent_posts)>0){
      ?>                                   
        <h2>Articles</h2>
        <div class="articles row">
          <?php foreach($recent_posts as $recent){ ?>
            <div class="card col-sm-6 col-md-4">
              <div class="body">
                <?php 
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($recent["ID"]),'thumbnail');
                $url = $thumb['0'];
                if($url=="") $url=get_template_directory_uri().'/assets/img/empty-box.jpg';
                ?>
                
                
                <div class="image"><img src="<?php echo $url; ?>" title="<?php echo $recent["post_title"]; ?>" alt="<?php echo $recent["post_title"]; ?>" /></div>
                <a href="<?php echo get_permalink($recent["ID"]); ?>" class="hover-bg"></a>
                <?php $date = strtotime($recent["post_date"]); ?>
                <div class="date"><?php echo date('F jS', $date); ?></div>
                <div class="info">
                  <h3 class="name"><?php echo $recent["post_title"]; ?></h3>
                </div>              
              </div>
              <div class="description"><?php echo get_the_custom_excerpt($recent["ID"],200); ?></div>
            </div>
          <?php } ?>
        </div>
      <?php } ?>
<?php */ ?> 
     
      <?php 
      $member_args = array('member_type' => array('teacher'),'per_page'=>3,'type'=>'random');
      do_action( 'bp_before_members_loop' ); 
      global $post;
      $post->favourite=xprofile_get_field_data('Favourite',get_current_user_id()); 
      $post->favourite=explode("|", get_current_user_id());
      ?>
      <?php if ( bp_has_members( $member_args ) ) : ?>
      <h2>Teachers</h2>
      <div class="teachers row">
        <?php $i=0; while ( bp_members() ) : bp_the_member(); ?>           
            <?php get_template_part('templates/card-teacher'); ?>
          <?php if($i==2) break; ?>
      	<?php $i++; endwhile; ?>         
      </div>
      <?php endif; ?>

      <?php do_action( 'bp_after_members_loop' ); ?>
      

<?php /* ?>      
      <h2>Retreats</h2>
      <div class="retreats row">
        <?php for($i=0;$i<3;$i++){ ?>
          <div class="card col-sm-6 col-md-4">
            <div class="body">
              <div class="image"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/box1.jpg" title="Yoga Journal Live in New York" alt="Yoga Journal Live in New York" /></div>
              <a href="#" class="hover-bg"></a>
              
              <div class="date">June 23 - 27</div>
              <a href="" class="sign"><i class="fa fa-sign-in"></i></a>
              <div class="info">
                <h3 class="name">Yoga Journal Live in New York</h3>
                <a class="card-button" href="#">Book now <i class="fa fa-angle-right"></i></a> 
                <div class="orange"><i class="fa fa-map-marker"></i> New York, New York</div>
                <div class="clear"></div>
              </div>              
            </div>
            <div class="description">Experience the stark beauty of the natural world in Iceland and immerse yourself in the elements. Magical moments, awesome sights, unique flavors and adventure await you in the land of fire and ice.</div>
          </div>
        <?php } ?>         
      </div>
      
<?php */ ?>      
      

	


