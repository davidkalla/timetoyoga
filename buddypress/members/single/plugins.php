<div class="row edit-member">
        <div class="info-column col-md-4">
          <div id="image-carousel" class="text-center">        
            <div class="image">
              <?php echo bp_core_fetch_avatar( 'type=thumb&height=500&width=500&item_id='.bp_displayed_user_id()); ?>
              <a href="<?php echo bp_loggedin_user_domain() ?>profile/change-avatar/" class="camera" title="Change Your Avatar!"><span class="icon"></span></a>
            </div>                 
          </div>
          
        </div>
        
        <div class="col-md-8">
          <?php if(bp_current_action()=='buddystream-networks') { ?>
            <div class="profile-tabs">
              <?php $survey_id=getSurveyId(); ?>    
              <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>profile/edit/">Profile</a>
              <div class="active tab">Activity stream</div>
              <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>media/">Media gallery</a> 
              <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/">Password</a>
              <a class="tab" href="<?php echo get_permalink($survey_id) ?>"><?php echo get_the_title($survey_id) ?></a>
            </div>
          <?php } ?>
          <h1><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?></h1>           
                    
          <?php   
      		/**
      		 * Fires at the start of the member plugin template.
      		 *
      		 * @since 1.2.0
      		 */
      		do_action( 'bp_before_member_plugin_template' ); ?>
      
      
      		<?php if ( has_action( 'bp_template_title' ) && bp_current_action()!='buddystream-networks') : ?>
      			<h2><?php
      
      			/**
      			 * Fires inside the member plugin template <h3> tag.
      			 *
      			 * @since 1.0.0
      			 */
      			do_action( 'bp_template_title' ); ?></h2>
      
      		<?php endif; ?>
      
      		<?php
      
      		/**
      		 * Fires and displays the member plugin template content.
      		 *
      		 * @since 1.0.0
      		 */
      		do_action( 'bp_template_content' ); ?>
                 
      		<?php
      
      		/**
      		 * Fires at the end of the member plugin template.
      		 *
      		 * @since 1.2.0
      		 */
      		do_action( 'bp_after_member_plugin_template' ); ?>

          
          
          </div>

        
        
      </div>
      







