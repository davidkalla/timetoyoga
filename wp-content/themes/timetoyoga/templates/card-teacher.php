<?php
if(isset($post->favourite) && is_array($post->favourite)){
  if(($key=array_search(bp_get_member_user_id(),$post->favourite))!==false) $favourite_active=1;
  else $favourite_active=0;
} else $favourite_active=0;
?>
          
<div class="card col-sm-6 col-md-4">
            <div class="body">
        			<div class="image">
                <?php bp_member_avatar('type=thumb&height=500&width=500'); ?>
              </div>
        			<a href="<?php bp_member_permalink(); ?>" class="hover-bg"></a>
              
              <?php if(get_current_user_id()!=0 && get_current_user_id()!=bp_get_member_user_id() && $favourite_active==1){ ?><a href="<?php bp_member_permalink(); ?>" class="like"><i class="fa fa-heart"></i></a><?php } ?>
              <div class="info">
                <h3 class="name"><?php bp_member_name(); ?></h3>
                <?php                    
                $text="";       
                $city=xprofile_get_field_data('City',bp_get_member_user_id()); 
                $state=xprofile_get_field_data('State',bp_get_member_user_id());
                $country=xprofile_get_field_data('Country',bp_get_member_user_id());
                if($city!="") $text=$city;
                if($state!=""){ if($text!="") $text.=', '.$state; else $text=$state; }
                if($country!=""){ if($text!="") $text.=', '.$country; else $text=$country; }
            
                if($text!=""){ ?><div class="orange"><i class="fa fa-map-marker"></i> <?php echo $text; ?></div><?php } else { ?><div class="orange">&nbsp;</div><?php } ?>
                
                <div class="clear"></div>
              </div> 
            </div>
            <?php $text=xprofile_get_field_data('About Me',bp_get_member_user_id()); ?>
            <div class="description"><?php echo $text; ?></div>
</div>