<?php
/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the display of the members loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_members_loop' ); ?>
<?php 
$favourite=xprofile_get_field_data('Favourite',get_current_user_id()); 
$favourite=explode("|", $favourite);
?>

<?php if ( bp_get_current_member_type() ) : ?>
	<p class="current-member-type"><?php bp_current_member_type_message() ?></p>
<?php endif; ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pagination-links" id="member-dir-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

	<?php

	/**
	 * Fires before the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_members_list' ); ?>

	<div id="members-list" class="teachers row">

	<?php while ( bp_members() ) : bp_the_member(); ?>
		      <?php
          if(($key=array_search(bp_get_member_user_id(),$favourite))!==false) $favourite_active=1;
          else $favourite_active=0;
          ?>
          
          <div class="card col-sm-6 col-md-4">
            <div class="body">
        			<div class="image">
                <?php bp_member_avatar('type=thumb&height=500&width=500'); ?>
              </div>
        			<a href="<?php bp_member_permalink(); ?>" class="hover-bg"></a>
              
              <?php if(get_current_user_id()!=0 && get_current_user_id()!=bp_get_member_user_id() && $favourite_active==1){ ?><a href="<?php bp_member_permalink(); ?>" class="like"><i class="fa fa-heart"></i></a><?php } ?>
              <div class="info">
                <h3 class="name"><?php bp_member_name(); ?></h3>
                <?php 
                $text=xprofile_get_field_data('City',bp_get_member_user_id());
                  if($text!=""){ ?><div class="orange"><i class="fa fa-map-marker"></i> <?php echo $text; ?></div><?php } else { ?><div class="orange">&nbsp;</div><?php } ?>
                
                <div class="clear"></div>
              </div> 
            </div>
            <?php $text=xprofile_get_field_data('About Me',bp_get_member_user_id()); ?>
            <div class="description"><?php echo $text; ?></div>
          </div>
	<?php endwhile; ?>

	</div>

	<?php

	/**
	 * Fires after the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( "Sorry, no members were found.", 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php

/**
 * Fires after the display of the members loop.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_members_loop' ); ?>
