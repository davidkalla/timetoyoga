<?php 
  $teacher=xprofile_get_field_data('Teacher',bp_displayed_user_id()); 
  if(isset($teacher[0])) { 
    bp_set_member_type(bp_displayed_user_id(),'teacher');
    xprofile_set_field_data('Admin review', bp_displayed_user_id(), "checked");
  } else{
    bp_set_member_type(bp_displayed_user_id(),'');
    xprofile_set_field_data('Admin review', bp_displayed_user_id(), "");
  } 
?>
<div class="row edit-member">
        <div class="info-column col-md-4">
          <div id="image-carousel" class="text-center">        
            <div class="image">
              <?php echo bp_core_fetch_avatar( 'type=thumb&height=500&width=500&item_id='.bp_displayed_user_id()); ?>
              <a href="<?php echo bp_loggedin_user_domain() ?>profile/change-avatar/" class="camera" title="Change Your Avatar!"><span class="icon"></span></a>
            </div>                 
          </div>
        </div>
        
        <div class="content-column col-md-8">
          <div class="profile-tabs">
            <?php $survey_id=getSurveyId(); ?>    
            <div class="active tab">Profile</div>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/buddystream-networks/">Activity stream</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>media/">Media gallery</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/">Password</a>
            <a class="tab" href="<?php echo get_permalink($survey_id) ?>"><?php echo get_the_title($survey_id) ?></a>
          </div>
          <h1><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?></h1>           
          
          <?php
          /**
           * BuddyPress - Members Single Profile Edit
           *
           * @package BuddyPress
           * @subpackage bp-legacy
           */
          
          /**
           * Fires after the display of member profile edit content.
           *
           * @since 1.1.0
           */
          do_action( 'bp_before_profile_edit_content' );
          
          if ( bp_has_profile( 'profile_group_id=' . bp_get_current_profile_group_id() ) ) :
          	while ( bp_profile_groups() ) : bp_the_profile_group(); ?>
          
          <form action="<?php bp_the_profile_group_edit_form_action(); ?>" method="post" id="profile-edit-form" class="standard-form <?php bp_the_profile_group_slug(); ?>">
          
          	<?php
             
          		/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
          		do_action( 'bp_before_profile_field_content' ); ?>
          
          		<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>
                 
          			<div<?php bp_field_css_class( 'editfield' ); ?>>
          
          				<?php
                  //echo bp_get_the_profile_field_type();
          				$field_type = bp_xprofile_create_field_type( bp_get_the_profile_field_type() );   
          				$field_type->edit_field_html();
          
          				/**
          				 * Fires before the display of visibility options for the field.
          				 *
          				 * @since 1.7.0
          				 */
          				do_action( 'bp_custom_profile_edit_fields_pre_visibility' );
          				?>
          
          				
          
          				<?php
          
          				/**
          				 * Fires after the visibility options for a field.
          				 *
          				 * @since 1.1.0
          				 */
          				do_action( 'bp_custom_profile_edit_fields' ); ?>
          
          			</div>
          
          		<?php endwhile; ?>
          
          	<?php
          
          	/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/profile/profile-wp.php */
          	do_action( 'bp_after_profile_field_content' ); ?>
          
          	<div class="submit">
          		<input type="submit" style="float:right;" name="profile-group-edit-submit" id="profile-group-edit-submit" value="<?php esc_attr_e( 'Save Changes', 'buddypress' ); ?> " />
              <div class="clear"></div>
          	</div>
          
          	<input type="hidden" name="field_ids" id="field_ids" value="<?php bp_the_profile_field_ids(); ?>" />
          
          	<?php wp_nonce_field( 'bp_xprofile_edit' ); ?>
          
          </form>
          
          <?php endwhile; endif; ?>
          
          <?php
          
          /**
           * Fires after the display of member profile edit content.
           *
           * @since 1.1.0
           */
          do_action( 'bp_after_profile_edit_content' ); ?>

          
        </div>
        
        
      </div>
      


