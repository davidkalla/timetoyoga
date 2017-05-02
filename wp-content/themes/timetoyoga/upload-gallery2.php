<?php
set_time_limit(250); 
global $wpdb;  
$compare=new compareImages;

$path = './wp-content/themes/timetoyoga/galleries';
$results = scandir($path);
$i=1;  
foreach (new DirectoryIterator($path) as $file) {
    if ($file->isDot()) continue;

    if ($file->isDir()) {
        $login=str_replace('-', '_', $file->getFilename());
        $user=get_user_by("login",$login);
        if($user!==false){                                        
          $path = './wp-content/themes/timetoyoga/galleries/'.$file->getFilename().'/photos/gallery';
          if(is_dir($path)!==false){
            $path2='./wp-content/themes/timetoyoga/galleries/'.$file->getFilename().'/photos';
            foreach (new DirectoryIterator($path2) as $file2) {
              if($file2->isDir()){
                continue;
              }
              else {
                unlink($path2.'/'.$file2->getFilename());
              }
            }         
            
            $j=0;
            foreach (new DirectoryIterator($path) as $file2) {
              if ($file2->isDot()) continue;
              $name=$file2->getBasename('.' .$file2->getExtension());
              $length=strlen($name)-1;
              
              if(is_numeric($name[$length]) && $name[$length-3]=='x') {
                //unlink($path.'/'.$file2->getFilename());
                continue;                 
              }
              else{   
                if($j==0){ 
                  $url='./wp-content/uploads/avatars/'.$user->id;
                  if(!is_dir($url)){
                    mkdir($url,0777);               
                    $bpfull = wp_get_image_editor( $file2->getPathname() );
                    $bpfull->resize( 500, 500, true );
                    $destination_bpthumb=$url.'/'.$file2->getBasename('.' .$file2->getExtension()).'-bpthumb.jpg';
                    $destination_bpfull=$url.'/'.$file2->getBasename('.' .$file2->getExtension()).'-bpfull.jpg';
                    $bpfull->save( $destination_bpfull ); $bpfull->save( $destination_bpthumb ); 
                  }
                  $j++;
                }
                else{
                  $file_array=array();
                  $file_array["name"]=$file2->getBasename('.' .$file2->getExtension());
                  if($file2->getExtension()=="jpg") $file_array["type"]='image/jpeg'; 
                  else $file_array["type"]='image/'.$file2->getExtension();                   
                  $path=$file2->getPathname();
                  $file_array["error"]=0;
                  $file_array["size"]=$file2->getSize();
                  
                  $query = "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_title='".$file_array["name"]."'";
                  $count = $wpdb->get_var($query);
                  
                  if($count==0){
                    if ( ! function_exists( 'wp_handle_upload' ) ) {
                      require_once( ABSPATH . 'wp-admin/includes/file.php' );
                    }
    
                    $uploadedfile = $file_array;       
                    $upload_overrides = array( 'test_form' => false );
                    //$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
                    
                    $movefile = wp_upload_bits($file2->getFilename(), null, file_get_contents($path));   
                    if ( $movefile ) {
                      $attachment = array(
                      'post_title' => $file_array["name"],
                      'post_content' => '',
                      'post_type' => 'attachment',
                      'post_mime_type' => $file_array["type"],
                      'guid' => $movefile['url']
                      );
                      $attach_id = wp_insert_attachment($attachment,$movefile['file']);
                      require_once( ABSPATH . 'wp-admin/includes/image.php' );
                      $attach_data = wp_generate_attachment_metadata( $attach_id, $movefile['file'] );
                      wp_update_attachment_metadata( $attach_id, $attach_data ); 
                      
                      
                      $wpdb->insert( 'wp_rt_rtm_media', 
                                    array( 'blog_id' => 1, 'media_id' => $attach_id, 'media_author'=> $user->ID, 
                                    'media_title'=>$file_array["name"],'album_id'=>1, 'media_type'=>'photo','context'=>'profile',
                                    'context_id'=>$user->ID,'upload_date'=>date('Y-M-D h:i:s'),'file_size'=>$file_array["size"]
                                    ), array( '%d', '%d', '%d','%s','%d','%s','%s','%d','%s','%d' ) );
                    } else {
                      $error=$movefile['error'];
                    }
                  }
                } 
              }
            }  
          }    
        } else {      
          $path = './wp-content/themes/timetoyoga/galleries/'.$file->getFilename(); 
          //unlink($path);
          recursive_rmdir($path);
        }
    }else{
      $path = './wp-content/themes/timetoyoga/galleries/'.$file->getFilename(); 
      unlink($path);
    }
}

echo $i;

function recursive_rmdir($dir) { 
    if( is_dir($dir) ) { 
      $objects = array_diff( scandir($dir), array('..', '.') );
      foreach ($objects as $object) { 
        $objectPath = $dir."/".$object;
        if( is_dir($objectPath) )
          recursive_rmdir($objectPath);
        else
          unlink($objectPath); 
      } 
      rmdir($dir); 
    } 
  }   



