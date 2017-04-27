<?php
/* Template Name: Import styles Old */  

set_time_limit(250); 

//echo file_get_contents(get_template_directory_uri().'/yoga_styles.txt');


$file_handle = fopen(get_template_directory_uri().'/yoga_styles.txt', "rb");


while (!feof($file_handle) ) {

  $line_of_text = fgets($file_handle);
  $parts = explode('=', $line_of_text);

  $page = get_page_by_title(trim($parts[0]), OBJECT, 'style');

  if(!is_null($page)) {
    echo $page->ID; echo '<br />';  
  }   
  else{
    $postdata["post_title"]=$parts[0];
    $postdata["post_author"]=get_current_user_id();       
    $postdata["post_status"]="publish";
    $postdata["post_type"]="style";
    wp_insert_post($postdata);
  }
  
}

fclose($file_handle);    