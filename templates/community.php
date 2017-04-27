<?php
/*
Template Name: Community
*/
?>

<script type='text/javascript' src='<?php echo home_url(); ?>/wp-content/plugins/buddypress/bp-core/js/confirm.min.js?ver=2.5.3'></script>
<script type='text/javascript' src='<?php echo home_url(); ?>/wp-content/plugins/buddypress/bp-core/js/widget-members.min.js?ver=2.5.3'></script>
<script type='text/javascript' src='<?php echo home_url(); ?>/wp-content/plugins/buddypress/bp-core/js/jquery-query.min.js?ver=2.5.3'></script>
<script type='text/javascript' src='<?php echo home_url(); ?>/wp-content/plugins/buddypress/bp-core/js/jquery-cookie.min.js?ver=2.5.3'></script>
<script type='text/javascript' src='<?php echo home_url(); ?>/wp-content/plugins/buddypress/bp-core/js/jquery-scroll-to.min.js?ver=2.5.3'></script>
<script type='text/javascript' src='<?php echo home_url(); ?>/wp-content/plugins/buddypress/bp-templates/bp-legacy/js/buddypress.min.js?ver=2.5.3'></script>

	<?php do_action( 'bp_before_directory_activity_page' ); ?>

	<div id="buddypress">
		<div class="padder">

			<?php do_action( 'bp_before_directory_activity' ); ?>    

			<?php do_action( 'bp_before_directory_activity_content' ); ?>

			<?php do_action( 'template_notices' ); ?>

			<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
				<ul>

					<?php do_action( 'bp_activity_syndication_options' ); ?>

					<li id="activity-filter-select" class="last">
						<label for="activity-filter-by"><?php _e( 'Show:', 'buddypress' ); ?></label>
						<select id="activity-filter-by">
							<option value="-1"><?php _e( '&mdash; Everything &mdash;', 'buddypress' ); ?></option>
							<option value="activity_update"><?php _e( 'Updates', 'buddypress' ); ?></option>
              <option value="updated_profile">Profile Updates</option>
							<?php if ( bp_is_active( 'blogs' ) ) : ?>

								<option value="new_blog_post"><?php _e( 'Posts', 'buddypress' ); ?></option>
								<option value="new_blog_comment"><?php _e( 'Comments', 'buddypress' ); ?></option>

							<?php endif; ?>

							<?php if ( bp_is_active( 'forums' ) ) : ?>

								<option value="new_forum_topic"><?php _e( 'Forum Topics', 'buddypress' ); ?></option>
								<option value="new_forum_post"><?php _e( 'Forum Replies', 'buddypress' ); ?></option>

							<?php endif; ?>

							<?php if ( bp_is_active( 'groups' ) ) : ?>

								<option value="created_group"><?php _e( 'New Groups', 'buddypress' ); ?></option>
								<option value="joined_group"><?php _e( 'Group Memberships', 'buddypress' ); ?></option>

							<?php endif; ?>

							<?php if ( bp_is_active( 'friends' ) ) : ?>

								<option value="friendship_accepted,friendship_created"><?php _e( 'Friendships', 'buddypress' ); ?></option>

							<?php endif; ?>

							<option value="new_member"><?php _e( 'New Members', 'buddypress' ); ?></option>

							<?php do_action( 'bp_activity_filter_options' ); ?>

						</select>
					</li>
				</ul>
			</div><!-- .item-list-tabs -->

			<?php do_action( 'bp_before_directory_activity_list' ); ?>

			<div class="activity" role="main">

				<?php do_action( 'bp_before_activity_loop' ); ?>

          <?php if ( bp_has_activities( bp_ajax_querystring( 'activity' ) ) ) : ?>
          
          	<?php /* Show pagination if JS is not enabled, since the "Load More" link will do nothing */ ?>
          	<noscript>
          		<div class="pagination">
          			<div class="pag-count"><?php bp_activity_pagination_count(); ?></div>
          			<div class="pagination-links"><?php bp_activity_pagination_links(); ?></div>
          		</div>
          	</noscript>
          
          	<?php if ( empty( $_POST['page'] ) ) : ?>
          
          		<ul id="activity-stream" class="activity-list item-list">
          
          	<?php endif; ?>
          
          	<?php while ( bp_activities() ) : bp_the_activity(); ?>
          
          		<?php do_action( 'bp_before_activity_entry' ); ?>
          
              <li class="<?php bp_activity_css_class(); ?> mini" id="activity-<?php bp_activity_id(); ?>">
              	<div class="activity-avatar">
              		<a href="<?php bp_activity_user_link(); ?>">
              
              			<?php bp_activity_avatar(); ?>
              
              		</a>
              	</div>
              
              	<div class="activity-content">
              
              		<div class="activity-header">
              
              			<?php bp_activity_action(); ?>
              
              		</div>
              
              		<?php if ( 'activity_comment' == bp_get_activity_type() ) : ?>
              
              			<div class="activity-inreplyto">
              				<strong><?php _e( 'In reply to: ', 'buddypress' ); ?></strong><?php bp_activity_parent_content(); ?> <a href="<?php bp_activity_thread_permalink(); ?>" class="view" title="<?php esc_attr_e( 'View Thread / Permalink', 'buddypress' ); ?>"><?php _e( 'View', 'buddypress' ); ?></a>
              			</div>
              
              		<?php endif; ?>
              
              		<?php if ( bp_activity_has_content() ) : ?>
              
              			<div class="activity-inner">
              
              				<?php bp_activity_content_body(); ?>
              
              			</div>
              
              		<?php endif; ?>
              
              		<?php do_action( 'bp_activity_entry_content' ); ?>
              
              	</div>
              
              	<?php do_action( 'bp_before_activity_entry_comments' ); ?>
              
              	<?php if ( ( is_user_logged_in() && bp_activity_can_comment() ) || bp_is_single_activity() ) : ?>
              
              		<div class="activity-comments">
              
              			<?php bp_activity_comments(); ?>
              
              			<?php if ( is_user_logged_in() ) : ?>
              
              				<form action="<?php bp_activity_comment_form_action(); ?>" method="post" id="ac-form-<?php bp_activity_id(); ?>" class="ac-form"<?php bp_activity_comment_form_nojs_display(); ?>>
              					<div class="ac-reply-avatar"><?php bp_loggedin_user_avatar( 'width=' . BP_AVATAR_THUMB_WIDTH . '&height=' . BP_AVATAR_THUMB_HEIGHT ); ?></div>
              					<div class="ac-reply-content">
              						<div class="ac-textarea">
              							<textarea id="ac-input-<?php bp_activity_id(); ?>" class="ac-input bp-suggestions" name="ac_input_<?php bp_activity_id(); ?>"></textarea>
              						</div>
              						<input type="submit" name="ac_form_submit" value="<?php esc_attr_e( 'Post', 'buddypress' ); ?>" /> &nbsp; <?php _e( 'or press esc to cancel.', 'buddypress' ); ?>
              						<input type="hidden" name="comment_form_id" value="<?php bp_activity_id(); ?>" />
              					</div>
              
              					<?php do_action( 'bp_activity_entry_comments' ); ?>
              
              					<?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ); ?>
              
              				</form>
              
              			<?php endif; ?>
              
              		</div>
              
              	<?php endif; ?>
              
              	<?php do_action( 'bp_after_activity_entry_comments' ); ?>
              
              </li>
              
              <?php do_action( 'bp_after_activity_entry' ); ?>
          
          	<?php endwhile; ?>
          
          	<?php if ( bp_activity_has_more_items() ) : ?>
          
          		<li class="load-more">
          			<a href="#more"><?php _e( 'Load More', 'buddypress' ); ?></a>
          		</li>
          
          	<?php endif; ?>
          
          	<?php if ( empty( $_POST['page'] ) ) : ?>
          
          		</ul>
          
          	<?php endif; ?>
          
          <?php else : ?>
          
          	<div id="message" class="info">
          		<p><?php _e( 'Sorry, there was no activity found. Please try a different filter.', 'buddypress' ); ?></p>
          	</div>
          
          <?php endif; ?>
          
          <?php do_action( 'bp_after_activity_loop' ); ?>
          
          <?php if ( empty( $_POST['page'] ) ) : ?>
          
          	<form action="" name="activity-loop-form" id="activity-loop-form" method="post">
          
          		<?php wp_nonce_field( 'activity_filter', '_wpnonce_activity_filter' ); ?>
          
          	</form>
          
          <?php endif; ?>

			</div><!-- .activity -->

			<?php do_action( 'bp_after_directory_activity_list' ); ?>

			<?php do_action( 'bp_directory_activity_content' ); ?>

			<?php do_action( 'bp_after_directory_activity_content' ); ?>

			<?php do_action( 'bp_after_directory_activity' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_activity_page' ); ?>

