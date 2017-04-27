<?php 
$favourite=xprofile_get_field_data('Favourite',get_current_user_id()); 
$favourite=explode("|", $favourite);
if(($key=array_search(bp_displayed_user_id(),$favourite))!==false) $favourite_active=" active";
else $favourite_active="";

if(isset($_GET["favourite"]) && get_current_user_id()!=0) {
  if($favourite_active!=""){
    unset($favourite[$key]);     
    $favourite_active="";      
  }
  else{
    $favourite[]=bp_displayed_user_id(); 
    $favourite_active=" active";      
  }  
  $favourite_string=implode("|",array_filter($favourite));
  xprofile_set_field_data('Favourite', get_current_user_id(), $favourite_string);
}

$who_likes_count="";
$who_likes_list="";
$who_likes=search_teacher_by(bp_displayed_user_id(),'favourite');
if($who_likes!=""){
  $who_likes=explode(',',$who_likes);
  $who_likes_count='<span class="count">'.count($who_likes).'</span>';       
  foreach($who_likes as $who)
    $who_likes_list.=bp_core_get_user_displayname($who).'&#013;'; 
}
?>

<div class="row">
        <div class="info-column col-md-4">
          <div class="main-informations-top"></div>
          
          <div id="image-carousel" class="owl-carousel text-center">       
            <div class="image">
              <a href="<?php echo bp_core_fetch_avatar( 'type=thumb&html=false&height=500&width=500&item_id='.bp_displayed_user_id()); ?>" data-fancybox-type="image" rel="fancybox[]"><?php echo bp_core_fetch_avatar( 'type=thumb&height=500&width=500&item_id='.bp_displayed_user_id()); ?></a>
            </div>
            <?php 
            $model = new RTMediaModel();
            $results = $model->get( array( 'media_type' => 'photo', 'media_author' => bp_displayed_user_id() ), 0,10000);
            if( $results ) {
              foreach( $results as $image ) { ?>
              <div class="image">
                <a href="<?php rtmedia_image( "rt_media_single_image", $image->id ); ?>" title="<?php echo $image->media_title; ?>" rel="fancybox[]">
                  <img src="<?php rtmedia_image( "rt_media_activity_image", $image->id ); ?>" alt="<?php echo rtmedia_image_alt( $image->id );?>" />
                </a>
              </div>
            <?php } } ?>                 
          </div>

          <script type="text/javascript">
            $("#image-carousel").owlCarousel({
              navigation : true,
              navigationText : ["",""],
              items : 1,
              itemsDesktop : [1199,1],
              itemsDesktopSmall : [992,1],
              itemsTablet: [768,1],
              itemsMobile : [480,1],
              pagination : false
            });
          </script>	
          
          <div class="social-icons">   
            <?php $link=xprofile_get_field_data('Pinterest',bp_displayed_user_id()); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="pinterest" target="_blank"><i class="fa fa-pinterest-p"></i></a><?php } ?>
            <?php $link=xprofile_get_field_data('Linked In',bp_displayed_user_id()); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="linkedin" target="_blank"><i class="fa fa-linkedin"></i></a><?php } ?>
            <?php $link=xprofile_get_field_data('Google Plus',bp_displayed_user_id()); if($link!=""){ ?><a href=<?php echo http_check($link); ?>" class="google" target="_blank"><i class="fa fa-google-plus"></i></a><?php } ?>
            <?php $link=xprofile_get_field_data('Facebook',bp_displayed_user_id()); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a><?php } ?>
            <?php $link=xprofile_get_field_data('Twitter',bp_displayed_user_id()); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
            <?php $link=xprofile_get_field_data('Instagram',bp_displayed_user_id()); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a><?php } ?>
            <?php $link=xprofile_get_field_data('Youtube',bp_displayed_user_id()); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="youtube" target="_blank"><i class="fa fa-youtube"></i></a><?php } ?>
          </div>
          
          <div class="contact-info">
            
            <?php 
            $text="";
            $city=xprofile_get_field_data('City',bp_displayed_user_id()); 
            $state=xprofile_get_field_data('State',bp_displayed_user_id());
            $country=xprofile_get_field_data('Country',bp_displayed_user_id());
            if($city!="") $text=$city;
            if($state!=""){ if($text!="") $text.=', '.$state; else $text=$state; }
            if($country!=""){ if($text!="") $text.=', '.$country; else $text=$country; }
             
            if($text!=""){ ?><div><i class="fa fa-map-marker"></i>   <?php echo $text; ?></div>
            <?php } ?>
            <?php $text=xprofile_get_field_data('Phone',bp_displayed_user_id()); if($text!=""){ ?><div><i class="fa fa-phone"></i>  <?php echo $text; ?></div><?php } ?>
            <div><a href="mailto:<?php bp_displayed_user_email(); ?>"><i class="fa fa-envelope"></i> <?php bp_displayed_user_email(); ?></a></div>
            <?php 
            $text=xprofile_get_field_data('Web',bp_displayed_user_id()); 
            if($text!=""){ 
              $text2=str_replace('http://','',$text);
              $text2=str_replace('https://','',$text2);
            ?>
              <div><a href="<?php echo http_check($text); ?>" target="_blank" class="web"><i class="fa fa-globe"></i>  <?php echo $text2; ?></a></div>
            <?php } ?>           
          </div>
          
          <?php if(is_array($who_likes) && count($who_likes)>0){ ?>
           <div class="endorsed-box"> 
              <?php $count=3; ?>
              <h2>Endorsed by</h2>
              <?php $i=0; foreach($who_likes as $who){ ?>
                <?php if($i>=$count) $style=' style="display:none;"'; else $style=""; ?>
                <div class="teacher"<?php echo $style;?>>
                  <div class="small-image"><a href="<?php echo bp_core_get_user_domain($who); ?>"><?php echo bp_core_fetch_avatar( 'type=thumb&height=50&width=50&item_id='.$who); ?></a></div>
                  <div class="name"><a href="<?php echo bp_core_get_user_domain($who); ?>"><?php echo bp_core_get_user_displayname($who); ?></a></div>
                </div>
              <?php $i++; } ?>
              
              <?php if($style!="") { ?><span class="show-more" onclick="$('.endorsed-box .teacher').show();$(this).remove();">...and <?php echo (count($who_likes)-$count); ?> more</span><?php } ?> 
           </div>
          <?php } ?>
          
          <?php /* ?>
          <div class="retreats-column-content">
            <h2><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?>'s Events</h2>
            <div class="retreats row">
              <div class="card col-sm-12">
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
            </div>
          </div>
          <?php */ ?>
        </div>
        
        
        <div class="content-column col-md-8">
          <div class="main-informations">
            <?php if(get_current_user_id()!=0) { ?>
              <h1><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?> <?php if(get_current_user_id()!=0 && get_current_user_id()!=bp_displayed_user_id()){ ?><a href="<?php echo get_permalink(); ?>?favourite" title="<?php echo $who_likes_list; ?>" class="like<?php echo $favourite_active; ?>"><i class="fa fa-heart"></i><?php echo $who_likes_count; ?></a><?php } ?></h1>
            <?php } elseif(is_array($who_likes) && count($who_likes)>0) { ?>
              <h1><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?> <a href="#" onclick="return false;" title="<?php echo $who_likes_list; ?>" class="like"><i class="fa fa-heart"></i><?php echo $who_likes_count; ?></a></h1>
            <?php } else { ?>
              <h1><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?></h1>
            <?php } ?>
                       
            <div class="main-content"><p><?php echo xprofile_get_field_data('About me',bp_displayed_user_id()); ?></p></div>
          </div> 
          
          <?php $highlights=xprofile_get_field_data('Highlights',bp_displayed_user_id()); ?>
          <?php if($highlights!="") { ?>
            <h2>Highlights</h2>
            <div class="highlights"><?php bp_member_profile_data('field=Highlights'); ?></div>
          <?php } ?>
          
          <?php $answers=xprofile_get_field_data('Survey',bp_displayed_user_id()); ?>
          <?php if($answers!="") { ?>
            <?php $survey_id=getSurveyId(); ?>    
            <h2><?php echo get_the_title($survey_id) ?></h2>
            <div class="survey">
              <?php 
              $survey=getSurvey();
              $answers=explode('|',$answers);
              for($i=0;$i<count($survey);$i++){ 
                if(isset($answers[$i]) && $answers[$i]!=""){
                ?>
                  <p><b><?php echo $survey[$i]; ?></b><br /><?php echo $answers[$i]; ?></p>
                <?php
                }
              }
              ?>
            </div>
          <?php } ?>
          
          <?php $styles=xprofile_get_field_data('Yoga styles',bp_displayed_user_id()); ?>
          <?php if($styles!="") { ?>
            <h2>Yoga styles</h2>
            <div class="styles"><?php bp_member_profile_data('field=Yoga styles'); ?></div>
          <?php } ?>
          
         
          <?php 
          $activity_count=0;
          if ( bp_has_activities( bp_ajax_querystring( 'activity' ) ) ) { 
            $activity_count = bp_get_activity_count(); 
          } 
          ?>
          
          <?php if($activity_count>0) { ?>
          <h2>Activity stream</h2>
          <div class="activity-stream">  
              
              <div class="item-list-tabs no-ajax" id="subnav" role="navigation">
              	<ul>
              
              		<?php bp_get_options_nav(); ?>
              
              		<li id="activity-filter-select" class="last">
              			<label for="activity-filter-by"><?php _e( 'Show:', 'buddypress' ); ?></label>
              			<select id="activity-filter-by">
              				<option value="-1"><?php _e( '&mdash; Everything &mdash;', 'buddypress' ); ?></option>
              
              				<?php bp_activity_show_filters(); ?>
              
              				<?php do_action( 'bp_member_activity_filter_options' ); ?>
              
              			</select>
              		</li>
              	</ul>
              </div><!-- .item-list-tabs -->
              
              <?php do_action( 'bp_before_member_activity_post_form' ); ?>  
              
              <div class="activity">
              
              	<?php bp_get_template_part( 'activity/activity-loop' ) ?>
              
              </div><!-- .activity -->
              
              <?php do_action( 'bp_after_member_activity_content' ); ?>
            
          </div>  
          
          <?php } ?> 
        </div>
        
        
      </div>
<div>      
  <div class="row">
    <div class="col-md-4 retreats-column">
          
    </div>
  </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function(){
    retreatsColumn();
  });    
        
  $(window).resize(function() {
    retreatsColumn();
  });     
  
  retreatsColumn();
</script>


