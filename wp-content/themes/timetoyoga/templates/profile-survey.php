<?php
/*
Template Name: Profile Survey
*/
?>

<?php 
if(get_current_user_id()!=0){
$survey=getSurvey();
if(isset($_POST["profile-group-edit-submit"])){
  $answers=array();
  for($i=0;$i<count($survey);$i++){
      $answers[]=$_POST['question_'.$i];
  }
  $answers=implode('|', $answers);
  xprofile_set_field_data('Survey', get_current_user_id(), $answers);    
}
$answers=xprofile_get_field_data('Survey',get_current_user_id());
$answers=explode('|',$answers);
?>


<div id="buddypress">
  <div class="row edit-member">
        <div class="info-column col-md-4">
          <div id="image-carousel" class="text-center">        
            <div class="image">
              <?php echo bp_core_fetch_avatar( 'type=thumb&height=500&width=500&item_id='.get_current_user_id()); ?>
            </div>                 
          </div>
          
        </div>
        
        <div class="col-md-8">
          <div class="profile-tabs">
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>profile/edit/">Profile</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/buddystream-networks/">Activity stream</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>media/">Media gallery</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/">Password</a>
            <div class="tab active" href="<?php echo get_permalink($survey_id) ?>"><?php echo get_the_title($survey_id) ?></div>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>events/">Events</a>

          </div>
          
          <h1><?php echo bp_core_get_user_displayname(get_current_user_id()); ?></h1>           
          
          
          
          <h2><?php echo get_the_title($survey_id) ?></h2>
          
          
          <form action="<?php echo get_permalink($survey_id) ?>" method="post" class="standard-form">
            <?php for($i=0;$i<count($survey);$i++){ ?>
            <div class="editfield field_type_textbox">
          		<label for="question_<?php echo $i; ?>"><?php echo $survey[$i]; ?></label>
              <?php if(isset($answers[$i])) $value=$answers[$i]; else $value=""; ?>
          		<input id="question_<?php echo $i; ?>" name="question_<?php echo $i; ?>" type="text" value="<?php echo $value; ?>" />
            </div>
            <?php } ?>
           
           <div class="submit">
          		<input type="submit" style="float:right;" name="profile-group-edit-submit" id="profile-group-edit-submit" value="Save Changes">
              <div class="clear"></div>
           </div>
          </form>
        
        </div>

        
        
      </div>
  
</div>
      
<?php 
} else { 
  die('<script type="text/javascript">window.location.href="' . home_url() . '";</script>');
} 
?>





      


