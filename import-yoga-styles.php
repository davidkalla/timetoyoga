<?php
/* Template Name: Import styles */  

set_time_limit(250); 

$styles=array();
$i=0;

$xml = file_get_contents(get_template_directory_uri().'/YogaStyles.2016-10-27.xml');
$doc = new SimpleXmlElement($xml);
$doc->registerXPathNamespace ('wp', 'http://wordpress.org/export/1.0/');

$wp_meta_title = $doc->xpath("//wp:postmeta[wp:meta_key = 'whatis']/wp:meta_value");

$xpath = ".//wp:postmeta[wp:meta_key = 'whatis']/wp:meta_value";
$xpath2 = ".//wp:postmeta[wp:meta_key = 'whattoexpect']/wp:meta_value";
$xpath3 = ".//wp:postmeta[wp:meta_key = 'founderdescription']/wp:meta_value";
$xpath4 = ".//wp:postmeta[wp:meta_key = 'meta_description']/wp:meta_value";
$xpath5 = ".//wp:postmeta[wp:meta_key = 'page_title']/wp:meta_value";
$xpath6 = ".//wp:postmeta[wp:meta_key = 'lucene_kwp']/wp:meta_value";

$items = $doc->channel->item;
foreach( $items as $item ) {
  $styles[$i]["title"]=(string)$item->title;
  $result = $item->xpath($xpath);
  $styles[$i]["description"]=strip_tags((string)$result[0]);
  
  $result = $item->xpath($xpath2);
  $styles[$i]["whattoexpect"]=strip_tags((string)$result[0]);
  
  $result = $item->xpath($xpath3);
  $styles[$i]["founderdescription"]=strip_tags((string)$result[0]);
  
  $result = $item->xpath($xpath4);
  $styles[$i]["meta_description"]=strip_tags((string)$result[0]);
  
  $result = $item->xpath($xpath5);
  $styles[$i]["page_title"]=strip_tags((string)$result[0]);
  
  $result = $item->xpath($xpath6);
  $styles[$i]["lucene_kwp"]=preg_replace('/\s+/', ', ', trim(strip_tags((string)$result[0])));
  
  $i++;
}                                                       
  
$posts_args = array(
    'fields' => 'ids',
    'post_type' => 'style',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'post_status' => array('publish'),
    'order' => 'DESC',        
);
$posts_ids = get_posts($posts_args);

for($i=0;$i<count($styles);$i++){
  foreach($posts_ids as $id){  
    if(get_the_title($id)!=$styles[$i]["title"])
      $styles[$i]["description"] = str_ireplace(get_the_title($id), '<a href="'.get_permalink($id).'" title="'.get_the_title($id).'">'.get_the_title($id).'</a>', $styles[$i]["description"]);
  }   
  
  $page = get_page_by_title($styles[$i]["title"], OBJECT, 'style');
    
  if(!is_null($page)) {
    $postdata["ID"]=$page->ID;
    $postdata["post_content"]='<p>'.$styles[$i]["description"].'</p>';
    wp_update_post($postdata);
    
    delete_post_meta($page->ID, 'whattoexpect');
    delete_post_meta($page->ID, 'founderdescription'); 
    delete_post_meta($page->ID, 'page_title');
    delete_post_meta($page->ID, 'meta_keywords');
    delete_post_meta($page->ID, 'meta_description');
    
    add_post_meta($page->ID, 'whattoexpect', $styles[$i]["whattoexpect"], true);
    add_post_meta($page->ID, 'founderdescription', $styles[$i]["founderdescription"], true);
    add_post_meta($page->ID, 'page_title', $styles[$i]["page_title"], true);
    add_post_meta($page->ID, 'meta_keywords', $styles[$i]["lucene_kwp"], true);
    add_post_meta($page->ID, 'meta_description', $styles[$i]["meta_description"], true);
    
  }   
  else{
    $postdata["post_title"]=$styles[$i]["title"];
    $postdata["post_author"]=get_current_user_id();       
    $postdata["post_status"]="publish";
    $postdata["post_type"]="style";
    $postdata["post_content"]='<p>'.$styles[$i]["description"].'</p>';
    wp_insert_post($postdata);
    add_post_meta($page->ID, 'whattoexpect', $styles[$i]["whattoexpect"], true);
    add_post_meta($page->ID, 'founderdescription', $styles[$i]["founderdescription"], true);
    add_post_meta($page->ID, 'page_title', $styles[$i]["page_title"], true);
    add_post_meta($page->ID, 'lucene_kwp', $styles[$i]["lucene_kwp"], true);
    add_post_meta($page->ID, 'meta_description', $styles[$i]["meta_description"], true);
  }
  unset($postdata);
}  
