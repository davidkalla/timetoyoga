<?php
/* Template Name: Set Teachers */  
  set_time_limit(250);
  
  $member_args = array(
    'per_page' => 100000
  );
  
  $posts_args = array(
    'fields' => 'ids',
    'post_type' => 'style',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'post_status' => array('publish'),
    'order' => 'DESC',        
  );
  $posts_ids = get_posts($posts_args);
  $i=0; $min=271; $max=280;    
  
  if ( bp_has_members( $member_args ) ) : ?>
    
  	<?php while ( bp_members() ) : bp_the_member(); ?>
  	<?php          
      // Set teachers group
      /*$review=xprofile_get_field_data('Admin review',bp_get_member_user_id()); 
      if($review!="") { 
	 bp_set_member_type(bp_get_member_user_id(),'teacher');
        xprofile_set_field_data('Teacher', bp_get_member_user_id(), array("I\'m a teacher"));
	 //xprofile_set_field_data('Admin review', bp_get_member_user_id(), "checked");
      } else{
        bp_set_member_type(bp_get_member_user_id(),'');
        xprofile_set_field_data('Teacher', bp_get_member_user_id(), '');
      }       */
     
     
     // Set Yoga Styels links 
      if($i>=$min){
      ob_start();
      bp_member_profile_data(array('field'=>'About me','user_id'=>bp_get_member_user_id()));
      $array["about"] = ob_get_contents();
      ob_end_clean();
      
      ob_start();
      bp_member_profile_data(array('field'=>'Highlights','user_id'=>bp_get_member_user_id()));
      $array["highlights"] = ob_get_contents();
      ob_end_clean();
      
      ob_start();
      bp_member_profile_data(array('field'=>'Yoga styles','user_id'=>bp_get_member_user_id()));
      $array["styles"] = ob_get_contents();
      ob_end_clean();
      
      foreach($posts_ids as $id){            
        $array["about"] = str_ireplace(get_the_title($id), '<a href="'.get_permalink($id).'" title="'.get_the_title($id).'">'.get_the_title($id).'</a>', $array["about"]);
        $array["styles"] = str_ireplace(get_the_title($id), '<a href="'.get_permalink($id).'" title="'.get_the_title($id).'">'.get_the_title($id).'</a>',  $array["styles"]);
        $array["highlights"] = str_ireplace(get_the_title($id), '<a href="'.get_permalink($id).'" title="'.get_the_title($id).'">'.get_the_title($id).'</a>',  $array["highlights"]);
        
        xprofile_set_field_data('About me', bp_get_member_user_id(), $array["about"]);    
        xprofile_set_field_data('Yoga styles', bp_get_member_user_id(), $array["styles"]);
        xprofile_set_field_data('Highlights', bp_get_member_user_id(), $array["highlights"]);
      }
      print_r($array);
      echo '<br /><br />';
      }  
      ?>	  
      <?php if($i==$max) break; ?>
      <?php $i++; ?>   
  	<?php endwhile; ?>   
  <?php endif; ?> 

