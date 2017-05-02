<?php
/*
Template Name: Members
*/
?>
<?php get_template_part('search-form'); ?>
<?php 
global $post;
$post->favourite=xprofile_get_field_data('Favourite',get_current_user_id()); 
$post->favourite=explode("|", get_current_user_id());
?>
<?php

do_action( 'bp_before_members_loop' ); ?>

<?php if ( bp_get_current_member_type() ) : ?>
	<p class="current-member-type"><?php bp_current_member_type_message() ?></p>
<?php endif; ?>

<?php 
$include="";
if(isset($_GET["in"]) && isset($_GET["q"]) && $_GET["q"]!=""){ 
  $include='&include='.search_member_by($_GET["q"],$_GET["in"]);
} else {$_GET["in"]=-1; $_GET["q"]=-1; }
?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ).'&type=alphabetical&per_page=21'.$include.'&exclude='.exclude_by_type('teacher') ) ) : ?>

  <?php /* ?>
	<div id="pag-top" class="pagination">

		<div class="pagination-links" id="member-dir-pag-top">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>
  <?php */ ?>
  
	<?php

	/**
	 * Fires before the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_before_directory_members_list' ); ?>

	<div id="members-list" class="teachers row">

	<?php while ( bp_members() ) : bp_the_member(); ?>
    <?php get_template_part('templates/card-teacher'); ?>
	<?php endwhile; ?>

	</div>
  
  <p id="loading" class="text-center" style="display:none;">
  	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/loading.gif" alt="Loading…" />
  </p>

	<?php

	/**
	 * Fires after the display of the members list.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

	<?php /* ?>
  <div id="pag-bottom" class="pagination">

		<div class="pagination-links" id="member-dir-pag-bottom">

			<?php bp_members_pagination_links(); ?>

		</div>

	</div>
  <?php */ ?>
  
  <script type="text/javascript">
    function inViewport($ele) {
      var lBound = $(window).scrollTop(),
          uBound = lBound + $(window).height(),
          top = $ele.offset().top,
          bottom = top + $ele.outerHeight(true);
  
      return (top > lBound && top < uBound)
          || (bottom > lBound && bottom < uBound)
          || (lBound >= top && lBound <= bottom)
          || (uBound >= top && uBound <= bottom);
    }
    
    $(document).ready(function() {
    	var ajaxUrl = "<?php echo admin_url('admin-ajax.php', null); ?>";
      var win = $(window);
      var ppp=21;
      var page = <?php if(isset($_GET["upage"])) echo $_GET["upage"]; else echo 1; ?>; 
      var search_in="<?php echo $_GET['in']; ?>";
      var search_q="<?php echo $_GET['q']; ?>";
    
    	// Each time the user scrolls
    	$(window).scroll(function() {            
        if (inViewport($('#members-list .card:last-child'))===true  && !$("#members-list").hasClass('members-loading')) {
          $("#members-list").addClass('members-loading');
    			$('#loading').show();         
          $.post(ajaxUrl, {
            action:"more_members_ajax",
            search_q: search_q,
            search_in: search_in,
            page: page,
            ppp: ppp            
          }).success(function(posts){
            page++;   
            $("#members-list").append(posts);
            $('#loading').hide();
            $(window).on('scroll');
            if(posts.trim()=="")
              $('#loading').remove();
            $("#members-list").removeClass('members-loading');             
          });
    		}                               
    	});
    });
  </script>

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