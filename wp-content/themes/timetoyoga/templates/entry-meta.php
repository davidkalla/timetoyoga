<div class="entry-meta">
  <?php
  if ( is_singular( 'video' ) ) {
    $views=get_post_meta(get_the_ID(),'post_video_count',true);
    if($views=="") $views='0 views';
    elseif($views==1) $views='1 view';
    else $views=$views.' views';
    echo '<div class="views">'.$views.'</div>';
  }
  ?>
  
  <div class="image">
    <?php echo bp_core_fetch_avatar( 'type=thumb&height=78&width=75&item_id='.get_the_author_meta('ID')); ?>
  </div>
  
  <time class="published" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
  <p class="byline author vcard"><?php echo __('By', 'roots'); ?> <?php echo bp_core_get_userlink(get_the_author_meta('ID')); ?></p>   
  
  
  <div class="clear"></div>
</div>
                                                                   