<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version  4.3
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div class="row">
        <div class="info-column col-md-4">
          <div class="main-informations-top"></div>
          
          <div id="image-carousel" class="owl-carousel text-center">       
            <div class="image">

            <?php 
            if (has_post_thumbnail($event_id ) ){ 
            	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($event_id),'thumbnail');
            	$url = $thumb['0'];

            	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($event_id),'large');
            	$url2 = $thumb['0'];

            	if($url!=""){ 
            		if($url2!="") echo '<a href="'.$url2.'" data-fancybox-type="image" rel="fancybox[]">'; 
            		echo '<img src="'.$url.'" title="" alt="" />';
            		if($url2!="") echo '</a>';             
            	}
            } 
            ?>

            </div>
            <?php 
            $gallery=get_field('event_photos');
            if($gallery!=0 && $gallery!=""){
              foreach($gallery as $image){
              ?>
                <div class="image">
                  <a href="<?php echo $image["url"]; ?>" data-fancybox-type="image" rel="fancybox[]">
                    <img src="<?php echo $image["size"]["thumbnail"]; ?>" alt="<?php echo $image["title"]; ?>" title="<?php echo $image["title"]; ?>">
                  </a>
                </div>
              <?php
              }
            } 
            ?>
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
            <?php $link=get_field('event_pinterest'); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="pinterest" target="_blank"><i class="fa fa-pinterest-p"></i></a><?php } ?>
            <?php $link=get_field('event_linked_in'); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="linkedin" target="_blank"><i class="fa fa-linkedin"></i></a><?php } ?>
            <?php $link=get_field('event_google'); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="google" target="_blank"><i class="fa fa-google-plus"></i></a><?php } ?>
            <?php $link=get_field('event_facebook'); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a><?php } ?>
            <?php $link=get_field('event_twitter'); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
            <?php $link=get_field('event_instagram'); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="instagram" target="_blank"><i class="fa fa-instagram"></i></a><?php } ?>
            <?php $link=get_field('event_youtube'); if($link!=""){ ?><a href="<?php echo http_check($link); ?>" class="youtube" target="_blank"><i class="fa fa-youtube"></i></a><?php } ?>
          </div>
          
          <div class="contact-info">

            <?php $map=get_field('event_location'); if($map!=""){ ?><div><i class="fa fa-map-marker"></i>   <?php echo $map["address"]; ?></div><?php } ?>
            <?php $text=get_field('event_phone'); if($text!=""){ ?><div><i class="fa fa-phone"></i>  <?php echo $text; ?></div><?php } ?>
            <?php $text=get_field('event_email'); if($text!=""){ ?><div><a href="mailto:<?php echo $text; ?>"><i class="fa fa-envelope"></i> <?php echo $text; ?></a></div><?php } ?>
            <?php 
            $text=tribe_get_event_meta( get_the_ID(), '_EventURL', true ); 
            if($text!=""){ 
              $text2=str_replace('http://','',$text);
              $text2=str_replace('https://','',$text2);
            ?>
              <div><a href="<?php echo http_check($text); ?>" target="_blank" class="web"><i class="fa fa-globe"></i>  <?php echo $text2; ?></a></div>
            <?php } ?>           
          </div>
          
          <?php
          $organizer=get_field('event_organizer');
          if($organizer!=0 && $organizer!=""){ 
          ?>
            <?php
            $favourite=xprofile_get_field_data('Favourite',get_current_user_id());
            $favourite=explode("|", $favourite);
            if(($key=array_search($organizer["ID"],$favourite))!==false) $favourite_active=" active";
            else $favourite_active="";
            ?>
                      
            <div class="card">
                        <div class="body">
                    			<div class="image">
                            <?php echo bp_core_fetch_avatar('type=thumb&height=500&width=500&item_id='.$organizer["ID"]); ?>
                          </div>
                    			<a href="<?php echo bp_core_get_user_domain($organizer["ID"]); ?>" class="hover-bg"></a>
                          
                          <?php if(get_current_user_id()!=0 && get_current_user_id()!=bp_get_member_user_id() && $favourite_active==1){ ?><a href="<?php bp_member_permalink(); ?>" class="like"><i class="fa fa-heart"></i></a><?php } ?>
                          <div class="info">
                            <h3 class="name"><?php bp_core_get_user_displayname($organizer["ID"]); ?></h3>
                            <?php                    
                            $text="";       
                            $city=xprofile_get_field_data('City',$organizer["ID"]); 
                            $state=xprofile_get_field_data('State',$organizer["ID"]);
                            $country=xprofile_get_field_data('Country',$organizer["ID"]);
                            if($city!="") $text=$city;
                            if($state!=""){ if($text!="") $text.=', '.$state; else $text=$state; }
                            if($country!=""){ if($text!="") $text.=', '.$country; else $text=$country; }
                        
                            if($text!=""){ ?><div class="orange"><i class="fa fa-map-marker"></i> <?php echo $text; ?></div><?php } else { ?><div class="orange">&nbsp;</div><?php } ?>
                            
                            <div class="clear"></div>
                          </div> 
                        </div>
                        <?php $text=xprofile_get_field_data('About Me',$organizer["ID"]); ?>
                        <div class="description"><?php echo $text; ?></div>
            </div> 
          <?php  
          }
          ?>
          
 
        </div>
        
        
        <div class="content-column col-md-8">
          <div class="main-informations">
            <?php the_title( '<h1>', '</h1>' ); ?>
                       
            <div class="main-content">
              <?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
              <div class="clear"></div>

          	<?php if ( tribe_get_cost() ) : ?>
          		<h2>Price & registration</h2>
          		<p class="tribe-events-cost"><b><?php echo tribe_get_cost( null, true ) ?></b></p>
          	<?php endif; ?>

              <?php while (have_posts()) : the_post(); ?>
              	<?php the_content(); ?>
              <?php endwhile; ?>

          	
              <?php /* ?>
              <?php do_action( 'tribe_events_single_event_before_the_content' ) ?>

        			<!-- .tribe-events-single-event-description -->
        			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
        
        			<!-- Event meta -->
        			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
        			<?php tribe_get_template_part( 'modules/meta' ); ?>
        			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
              <?php */ ?>
            </div>
          </div> 
          
           
          
        </div>
        
        
      </div>