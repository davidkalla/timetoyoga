<?php
/**
 * Custom functions
 */

function getSurveyId() {
  return 4780;
}

function get_the_custom_excerpt($id=-1,$length=240){
  if($id!=-1) $excerpt=get_post_field('post_content', $id);
  else $excerpt = get_the_content();
  $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
  $excerpt = strip_shortcodes($excerpt);
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $length);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
  $excerpt = $excerpt.'...';
  return $excerpt;
}        
echo get_site_option( 'fileupload_maxk' );
define ( 'BP_AVATAR_THUMB_WIDTH', 500 );
define ( 'BP_AVATAR_THUMB_HEIGHT', 500 );
define ( 'BP_AVATAR_FULL_WIDTH', 500 );
define ( 'BP_AVATAR_FULL_HEIGHT', 500 );


function setVideoViews($postID) {
    $count_key = 'post_video_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function http_check($url) {
$return = $url;
if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) { $return = 'http://' . $url; }
return $return;
} 


function remove_admin_bar() {
	//if( !is_super_admin() ) 
		add_filter( 'show_admin_bar', '__return_false' );
}
add_action('wp', 'remove_admin_bar');



function bbg_register_member_types() {
    bp_register_member_type( 'teacher', array(
        'labels' => array(
            'name'          => 'Teachers',
            'singular_name' => 'Teacher',
        ),
    ) );
}
add_action( 'bp_init', 'bbg_register_member_types' );



add_action( 'user_register', 'default_member_type', 10, 1 );
function default_member_type( $user_id ) {

	if ( ! bp_get_member_type($user_id) ) {
		bp_set_member_type( $user_id, 'member' );
	}
}



function exclude_by_type($exclude_roles) {

$memberArray = array();
$member_args = array(
    'member_type' => array('teacher'),
    'per_page' => 100000, 

);

if (bp_has_members($member_args)) :
  while (bp_members()) : bp_the_member();
    array_push($memberArray, bp_get_member_user_id());
  endwhile;
endif;

$theExcludeString=implode(",",$memberArray);
return $theExcludeString;
}

function search_teacher_by($term,$type="") {
$memberArray = array();
$member_args = array(
    'member_type' => array('teacher'),
    'per_page' => 100000,
    'search_terms' => $term 

);
global $members_template;
$reset_members_template = $members_template;

if (bp_has_members($member_args)) :
  while (bp_members()) : bp_the_member();
    $id=bp_get_member_user_id();
    if($type=='all'){
      array_push($memberArray, $id);
    }
    elseif($type=='name'){
      $name=bp_core_get_user_displayname($id);
      if (stripos($name, $term) !== false)
        array_push($memberArray, $id);
    }
    elseif($type=='type'){
      $styles=xprofile_get_field_data('Yoga styles',$id);
      if (stripos($styles, $term) !== false)
        array_push($memberArray, $id);
    }
    elseif($type=='favourite'){
      $favourite=xprofile_get_field_data('Favourite',$id);
      $favourite=explode('|', $favourite);
      if (in_array($term,$favourite))
        array_push($memberArray, $id);
      
    }
    elseif($type=='location'){
      $city=xprofile_get_field_data('City',$id);
      $state=xprofile_get_field_data('State',$id);
      $country=xprofile_get_field_data('Country',$id);
      if (stripos($city, $term) !== false || stripos($state, $term) !== false || stripos($country, $term) !== false)
        array_push($memberArray, $id);
    }
  endwhile;
endif;

$members_template = $reset_members_template;

$theIncludeString=implode(",",$memberArray);
return $theIncludeString;
}

function search_member_by($term,$type="") {
$memberArray = array();
$search="&search_terms=".$term;

if (bp_has_members( bp_ajax_querystring('members').'&type=alphabetical&per_page=10000'.$search.'&exclude='.exclude_by_type('teacher') )) :
  while (bp_members()) : bp_the_member();
    $id=bp_get_member_user_id();
    if($type=='all'){
      array_push($memberArray, $id);
    }
    elseif($type=='name'){
      $name=bp_core_get_user_displayname($id);
      if (stripos($name, $term) !== false)
        array_push($memberArray, $id);
    }
    elseif($type=='type'){
      $styles=xprofile_get_field_data('Yoga styles',$id);
      if (stripos($styles, $term) !== false)
        array_push($memberArray, $id);
    }
    elseif($type=='location'){
      $city=xprofile_get_field_data('City',$id);
      $state=xprofile_get_field_data('State',$id);
      $country=xprofile_get_field_data('Country',$id);
      if (stripos($city, $term) !== false || stripos($state, $term) !== false || stripos($country, $term) !== false)
        array_push($memberArray, $id);
    }
  endwhile;
endif;

$theIncludeString=implode(",",$memberArray);
return $theIncludeString;
}




function sendToFriends_ajax(){ 
  $user=get_userdata(get_current_user_id());
  $user->user_email;       
  $name=bp_core_get_user_displayname(get_current_user_id());;
  $message='<p>Hi,<br />
            I use Time To Yoga to follow my favorite yoga teachers.<br /><br /> 
            <a href="http://timetoyoga.wpengine.com/?utm_source=invite&utm_medium=email&utm_campaign='.$user->user_login.'" target="_blank">You should join them!</a></p>';
            
  
  $headers[] = 'From: '.$name.' <'.$user->user_email.'>';
  $headers[] = 'Content-Type: text/html; charset=UTF-8';
  
  wp_mail( $_POST["email"], 'Have you heard about TimeToYoga?', $message,$headers);      

  echo 'We sent your invitation to the teacher.';
  exit;
}

add_action('wp_ajax_nopriv_sendToFriends_ajax', 'sendToFriends_ajax'); 
add_action('wp_ajax_sendToFriends_ajax', 'sendToFriends_ajax');





function more_members_ajax(){ 
  $_POST["page"]=$_POST["page"]+1;
  $ppp = $_POST["ppp"];
  
  if(isset($_POST["in"]) && $_POST["in"]!=-1 && isset($_POST["q"]) && $_POST["q"]!="" && $_POST["q"]!=-1){ 
    $include='&include='.search_member_by($_POST["q"],$_POST["in"]);
  }          

  if ( bp_has_members( bp_ajax_querystring( 'members' ).'&type=alphabetical&page='.$_POST["page"].'&per_page='.$ppp.$include.'&exclude='.exclude_by_type('teacher') ) ) :
  
  while ( bp_members() ) : bp_the_member();
    get_template_part('templates/card-teacher');
	endwhile;
  
  endif; 
  
  exit;
}

add_action('wp_ajax_nopriv_more_members_ajax', 'more_members_ajax'); 
add_action('wp_ajax_more_members_ajax', 'more_members_ajax');



function more_teachers_ajax(){ 
  $_POST["page"]=$_POST["page"]+1;
  $ppp = $_POST["ppp"];
  
  $member_args = array(
    'member_type' => array('teacher'),
    'type' => 'alphabetical', 
    'per_page' => $ppp,
    'page' => $_POST["page"]
  );

  if(isset($_POST["in"]) && $_POST["in"]!=-1 && isset($_POST["q"]) && $_POST["q"]!="" && $_POST["q"]!=-1){ 
    $member_args["include"]=search_teacher_by($_POST["q"],$_POST["in"]);
  }       

  if ( bp_has_members( $member_args ) ) :
  
  while ( bp_members() ) : bp_the_member();
    get_template_part('templates/card-teacher');
	endwhile;
  
  endif; 
  
  exit;
}

add_action('wp_ajax_nopriv_more_teachers_ajax', 'more_teachers_ajax'); 
add_action('wp_ajax_more_teachers_ajax', 'more_teachers_ajax');


function getSurvey(){
  $survey=array();
  $survey[]='What is yoga to you?'; 
  $survey[]='When do you feel happiness ?  What is happiness?';  
  $survey[]='How would you define a yoga practice?';  
  $survey[]='How would you define the difference between beginner yoga compared to intermediate and an expert?'; 
  $survey[]='What advice would you give to a beginner yoga?';  
  $survey[]='What is intuition to you?'; 
  $survey[]='What does living with authenticity mean to you?';  
  $survey[]='What self-knowledge can we acquire about our true identity?';  
  $survey[]='What are we actually doing when we practice yoga?'; 
  $survey[]="What is 'The Observer' in your yoga practice?";  
  $survey[]='What is yogic virtue ( Viveka discernment or right judgment ) ?';  
  $survey[]='When did yoga appear in your life?'; 
  $survey[]='How do you integrate yoga roots into your practice and teaching style?';  
  $survey[]='How would you describe your teaching style and the unique intention that you bring to it?'; 
  $survey[]='How do you set the intention during your yoga practice ?'; 
  $survey[]='How do manifest what you want ?';    
  $survey[]='What is the best advice that anyone has ever gotten?'; 
  $survey[]='What makes you feel passionate or inspired?'; 
  $survey[]='What Makes You Feel vulnerable?';  
  $survey[]='How do you handle stress?'; 
  $survey[]='What gets you through tough challenges?'; 
  $survey[]='What keeps you strong?'; 
  $survey[]='What inspires you?'; 
  
  return $survey;
}

function generateSitemap(){
  require_once locate_template('/lib/SitemapGenerator.class.php');
  $g = new SitemapGenerator(); //zapsani hlavicky                
  $g->WriteHeader("sitemap.xml", "UTF-8"); //jednoduche zapsani uzlu <url> 
  $g->GenerateURL(home_url()."/", date('Y-m-d'), "0.8", "daily"); 
  
  /* Articles */
  $query = new WP_Query(['post_type' => 'post','post_status' => 'publish','orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1]);
  if ($query->have_posts()) {  
    while ($query->have_posts()) { $query->the_post();
        $g->GenerateURL(get_permalink(),"","","monthly");
     }
    wp_reset_postdata();
  }
  
  /* Pages */
  $query = new WP_Query(['post_type' => 'page','post_status' => 'publish','orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'post__not_in' => array(114, 112, 4265)]);
  if ($query->have_posts()) {  
    while ($query->have_posts()) { $query->the_post();
        $g->GenerateURL(get_permalink(),"","","monthly");
     }
    wp_reset_postdata();
  }
  
  /* Videos */
  $query = new WP_Query(['post_type' => 'video','post_status' => 'publish','orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1]);
  if ($query->have_posts()) {  
    while ($query->have_posts()) { $query->the_post();
        $g->GenerateURL(get_permalink(),"","","monthly");
     }
    wp_reset_postdata();
  }
  
  /* Yoga Styles */
  $query = new WP_Query(['post_type' => 'style','post_status' => 'publish','orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1]);
  if ($query->have_posts()) {  
    while ($query->have_posts()) { $query->the_post();
        $g->GenerateURL(get_permalink(),"","","monthly");
     }
    wp_reset_postdata();
  }
  
  /* Teachers */
  $member_args = array('member_type' => array('teacher'),'type' => 'alphabetical', 'per_page' => 100000);
  if ( bp_has_members( $member_args ) ) :
    while ( bp_members() ) : bp_the_member();
      $g->GenerateURL(bp_core_get_user_domain(bp_get_member_user_id()),"","","monthly"); 
    endwhile;
  endif;
  
  $g->WriteFooter(); 
}


