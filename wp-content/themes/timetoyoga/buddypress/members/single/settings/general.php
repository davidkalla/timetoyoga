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
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>profile/edit/">Profile</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/buddystream-networks/">Activity stream</a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>media/">Media gallery</a>
            <div class="active tab">Password</div>
            <a class="tab" href="<?php echo get_permalink($survey_id) ?>"><?php echo get_the_title($survey_id) ?></a>
            <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>events/">Events</a>
          </div>
          
          <h1><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?></h1>           
      
          <?php
          /**
           * BuddyPress - Members Single Profile
           *
           * @package BuddyPress
           * @subpackage bp-legacy
           */
          
          /** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
          do_action( 'bp_before_member_settings_template' ); ?>
          
          <form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>" method="post" class="standard-form" id="settings-form">
          
          	<?php if ( !is_super_admin() ) : ?>
          
          		<label for="pwd"><?php _e( 'Current Password <span>(required to update email or change current password)</span>', 'buddypress' ); ?></label>
          		<input type="password" name="pwd" id="pwd" size="16" value="" class="settings-input small" <?php bp_form_field_attributes( 'password' ); ?>/> &nbsp;<a href="<?php echo wp_lostpassword_url(); ?>" title="<?php esc_attr_e( 'Password Lost and Found', 'buddypress' ); ?>"><?php _e( 'Lost your password?', 'buddypress' ); ?></a>
          
          	<?php endif; ?>
          
          	<label for="email"><?php _e( 'Account Email', 'buddypress' ); ?></label>
          	<input type="email" name="email" id="email" value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input" <?php bp_form_field_attributes( 'email' ); ?>/>
          
          	<label for="pass1"><?php _e( 'Change Password <span>(leave blank for no change)</span>', 'buddypress' ); ?></label>
          	<input type="password" name="pass1" id="pass1" size="16" value="" class="settings-input small password-entry" <?php bp_form_field_attributes( 'password' ); ?>/> &nbsp;<?php _e( 'New Password', 'buddypress' ); ?><br />
          	<div id="pass-strength-result"></div>
          	<label for="pass2" class="bp-screen-reader-text"><?php
          		/* translators: accessibility text */
          		_e( 'Repeat New Password', 'buddypress' );
          	?></label>
          	<input type="password" name="pass2" id="pass2" size="16" value="" class="settings-input small password-entry-confirm" <?php bp_form_field_attributes( 'password' ); ?>/> &nbsp;<?php _e( 'Repeat New Password', 'buddypress' ); ?>
          
          	<?php
          
          	/**
          	 * Fires before the display of the submit button for user general settings saving.
          	 *
          	 * @since 1.5.0
          	 */
          	do_action( 'bp_core_general_settings_before_submit' ); ?>
          
          	<div class="submit">
          		<input type="submit" style="float:right;" name="submit" value="<?php esc_attr_e( 'Save Changes', 'buddypress' ); ?>" id="submit" class="auto" />
          	</div>
          
          	<?php
          
          	/**
          	 * Fires after the display of the submit button for user general settings saving.
          	 *
          	 * @since 1.5.0
          	 */
          	do_action( 'bp_core_general_settings_after_submit' ); ?>
          
          	<?php wp_nonce_field( 'bp_settings_general' ); ?>
          
          </form>
          
          <?php
          
          /** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
          do_action( 'bp_after_member_settings_template' ); ?>
        </div>
        
        
      </div>
      


