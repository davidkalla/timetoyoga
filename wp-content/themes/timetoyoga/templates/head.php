<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  
  <title><?php 
  $title=get_post_meta(get_the_ID(), 'page_title',true);
  if($title!="") echo $title; 
  else wp_title('|', true, 'right');
  ?></title>
  
  <?php $description=get_post_meta(get_the_ID(), 'meta_description',true); ?> 
  <?php if($description!="") { ?><meta name="description" content="<?php echo $description; ?>"><?php } ?>    
  <?php $keywords=get_post_meta(get_the_ID(), 'meta_keywords',true); ?> 
  <?php if($keywords!="") { ?><meta name="keywords" content="<?php echo $keywords; ?>"><?php } ?>      
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js'></script>
  <?php wp_head(); ?>

  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.ico" />
    
  <script type="text/javascript">
  var leady_track_key="jfXCJX9c9uMT2rhn";
  (function(){
  var l=document.createElement("script");l.type="text/javascript";l.async=true;
  l.src='https://t.leady.com/'+leady_track_key+"/L.js";
  var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(l,s);
  })();
  </script>
  <script type="text/javascript">
  //_leady.push(['identify', 'novak@example.com']);
  </script>
</head>
