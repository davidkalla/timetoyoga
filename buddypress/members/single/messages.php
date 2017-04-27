<div class="row edit-member">
        <div class="info-column col-md-4">
          <div id="image-carousel" class="text-center">        
            <div class="image">
              <?php echo bp_core_fetch_avatar( 'type=thumb&height=500&width=500&item_id='.bp_displayed_user_id()); ?>
            </div>                 
          </div>
          
        </div>
        
        <div class="col-md-8">
          <h1><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?></h1>           
          <?php
          /**
           * BuddyPress - Users Messages
           *
           * @package BuddyPress
           * @subpackage bp-legacy
           */
          
          ?>
          
          <div class="item-list-tabs no-ajax" id="subnav" role="navigation">
          	<ul>
          
          		<?php bp_get_options_nav(); ?>
          
          	</ul>
          
          	<?php if ( bp_is_messages_inbox() || bp_is_messages_sentbox() ) : ?>
          
          		<div class="message-search"><?php bp_message_search_form(); ?></div>
          
          	<?php endif; ?>
          
          </div><!-- .item-list-tabs -->
          
          <?php
          switch ( bp_current_action() ) :
          
          	// Inbox/Sentbox
          	case 'inbox'   :
          	case 'sentbox' :
          
          		/**
          		 * Fires before the member messages content for inbox and sentbox.
          		 *
          		 * @since 1.2.0
          		 */
          		do_action( 'bp_before_member_messages_content' ); ?>
          
          		<div class="messages">
          			<?php bp_get_template_part( 'members/single/messages/messages-loop' ); ?>
          		</div><!-- .messages -->
          
          		<?php
          
          		/**
          		 * Fires after the member messages content for inbox and sentbox.
          		 *
          		 * @since 1.2.0
          		 */
          		do_action( 'bp_after_member_messages_content' );
          		break;
          
          	// Single Message View
          	case 'view' :
          		bp_get_template_part( 'members/single/messages/single' );
          		break;
          
          	// Compose
          	case 'compose' :
          		bp_get_template_part( 'members/single/messages/compose' );
          		break;
          
          	// Sitewide Notices
          	case 'notices' :
          
          		/**
          		 * Fires before the member messages content for notices.
          		 *
          		 * @since 1.2.0
          		 */
          		do_action( 'bp_before_member_messages_content' ); ?>
          
          		<div class="messages">
          			<?php bp_get_template_part( 'members/single/messages/notices-loop' ); ?>
          		</div><!-- .messages -->
          
          		<?php
          
          		/**
          		 * Fires after the member messages content for inbox and sentbox.
          		 *
          		 * @since 1.2.0
          		 */
          		do_action( 'bp_after_member_messages_content' );
          		break;
          
          	// Any other
          	default :
          		bp_get_template_part( 'members/single/plugins' );
          		break;
          endswitch;
        ?>
        </div>
        
        
      </div>
      





