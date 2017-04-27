<div class="row edit-member">
        <div class="info-column col-md-4">
          <div id="image-carousel" class="text-center">        
            <div class="image">
              <?php echo bp_core_fetch_avatar( 'type=thumb&height=500&width=500&item_id='.bp_displayed_user_id()); ?>
            </div>                 
          </div>
          
        </div>
        
        <div class="col-md-8">
          <div class="profile-tabs">
            <?php $survey_id=getSurveyId(); ?>    
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>profile/edit/">Profile</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/buddystream-networks/">Activity stream</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>media/">Media gallery</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/">Password</a>
            <a class="tab" href="<?php echo get_permalink($survey_id) ?>"><?php echo get_the_title($survey_id) ?></a>
          </div>
          
          <h1><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?></h1>           
          
          <?php
          /**
           * BuddyPress - Members Profile Change Avatar
           *
           * @package BuddyPress
           * @subpackage bp-legacy
           */
          
          ?>
          
          <h2><?php _e( 'Change Profile Photo', 'buddypress' ); ?></h2>
          
          <?php
          
          /**
           * Fires before the display of profile avatar upload content.
           *
           * @since 1.1.0
           */
          do_action( 'bp_before_profile_avatar_upload_content' ); ?>
          
          <?php if ( !(int)bp_get_option( 'bp-disable-avatar-uploads' ) ) : ?>
          
          	<p><?php _e( 'Your profile photo will be used on your profile and throughout the site. If there is a <a href="http://gravatar.com">Gravatar</a> associated with your account email we will use that, or you can upload an image from your computer.', 'buddypress' ); ?></p>
          
          	<form action="" method="post" id="avatar-upload-form" class="standard-form" enctype="multipart/form-data">
          
          		<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>
          
          			<?php wp_nonce_field( 'bp_avatar_upload' ); ?>
          			<p><?php _e( 'Click below to select a JPG, GIF or PNG format photo from your computer and then click \'Upload Image\' to proceed.', 'buddypress' ); ?></p>
          
          			<p id="avatar-upload">
          				<label for="file" class="bp-screen-reader-text"><?php
          					/* translators: accessibility text */
          					_e( 'Select an image', 'buddypress' );
          				?></label>
          				<input type="file" name="file" id="file" />
          				<input type="submit" name="upload" id="upload" value="<?php esc_attr_e( 'Upload Image', 'buddypress' ); ?>" />
          				<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
          			</p>
          
          			<?php if ( bp_get_user_has_avatar() ) : ?>
          				<p><?php _e( "If you'd like to delete your current profile photo but not upload a new one, please use the delete profile photo button.", 'buddypress' ); ?></p>
          				<p><a class="button edit" href="<?php bp_avatar_delete_link(); ?>" title="<?php esc_attr_e( 'Delete Profile Photo', 'buddypress' ); ?>"><?php _e( 'Delete My Profile Photo', 'buddypress' ); ?></a></p>
          			<?php endif; ?>
          
          		<?php endif; ?>
          
          		<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>
          
          			<h5><?php _e( 'Crop Your New Profile Photo', 'buddypress' ); ?></h5>
          
          			<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php esc_attr_e( 'Profile photo to crop', 'buddypress' ); ?>" />
          
          			<div id="avatar-crop-pane">
          				<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" alt="<?php esc_attr_e( 'Profile photo preview', 'buddypress' ); ?>" />
          			</div>
          
          			<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php esc_attr_e( 'Crop Image', 'buddypress' ); ?>" />
          
          			<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
          			<input type="hidden" id="x" name="x" />
          			<input type="hidden" id="y" name="y" />
          			<input type="hidden" id="w" name="w" />
          			<input type="hidden" id="h" name="h" />
          
          			<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>
          
          		<?php endif; ?>
          
          	</form>
          
          	<?php
          	/**
          	 * Load the Avatar UI templates
          	 *
          	 * @since  2.3.0
          	 */
          	bp_avatar_get_templates(); ?>
          
          <?php else : ?>
          
          	<p><?php _e( 'Your profile photo will be used on your profile and throughout the site. To change your profile photo, please create an account with <a href="http://gravatar.com">Gravatar</a> using the same email address as you used to register with this site.', 'buddypress' ); ?></p>
          
          <?php endif; ?>
          
          <?php
          
          /**
           * Fires after the display of profile avatar upload content.
           *
           * @since 1.1.0
           */
          do_action( 'bp_after_profile_avatar_upload_content' ); ?>

          
          
          </div>

        
        
      </div>
      





