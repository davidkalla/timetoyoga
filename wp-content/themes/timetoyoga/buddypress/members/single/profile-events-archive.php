<?php

/**
 * Template for looping through expired Events on a member profile page
 * You can copy this file to your-theme/buddypress/members/single
 * and then edit the layout. 
 */

$paged = ( isset( $_GET['ep'] ) ) ? $_GET['ep'] : 1;

$args = array(
	'post_type'      => 'event',
	'author'         => bp_displayed_user_id(),
	'order'          => 'ASC',
	'orderby'		 => 'meta_value_num',
	'meta_key'		 => 'event-unix',
	'paged'          => $paged,
	'posts_per_page' => 10,

	'meta_query' => array(
		array(
			'key'		=> 'event-unix',
			'value'		=> current_time( 'timestamp' ),
			'compare'	=> '<=',
			'type' 		=> 'NUMERIC',
		),
	),

);

$wp_query = new WP_Query( $args );

$user_link = bp_core_get_user_domain( bp_displayed_user_id() );

?>

<?php if ( $wp_query->have_posts() ) : ?>

	<div class="entry-content"><br/>
		<?php echo pp_events_profile_pagination( $wp_query ); ?>
	</div>

	<div class="row">
	<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); 	?>
		<div class="card col-sm-6 col-md-6">
              <div class="body">
                <?php 
                $meta = get_post_meta(get_the_ID());
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'thumbnail');
                $url = $thumb['0'];
                if($url=="") $url=get_template_directory_uri().'/assets/img/empty-box.jpg';
                ?>
                
                <?php if( ! empty( $meta['event-latlng'][0] ) ) { ?>
                	<div class="image" style="position:relative;">
			<img src="<?php echo $url; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" />
			<div class="single_map_canvas" id="single_event_map_<?php echo get_the_ID(); ?>" style="position:absolute;top:0px;left:0px;width: 100%;height:100%;"></div>

			<script type="text/javascript">
			function initialize() {
				var singleLatlng = new google.maps.LatLng(<?php echo $meta['event-latlng'][0]; ?>);
				var mapOptions = {
					zoom: 12,
					center: singleLatlng
				}
				var map = new google.maps.Map(document.getElementById('single_event_map_<?php echo get_the_ID(); ?>'), mapOptions);

				var marker = new google.maps.Marker({
					position: singleLatlng,
					map: map
				});
			}

			google.maps.event.addDomListener(window, 'load', initialize);
			</script>

			</div>
                <?php } else { ?>
                	<div class="image"><img src="<?php echo $url; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" /></div>
                <?php } ?>

                <a href="<?php echo get_permalink(); ?>" class="hover-bg"></a>
                <div class="date"><?php echo get_the_time('F jS'); ?></div>
                <div class="info">
                  <h3 class="name"><?php echo get_the_title(); ?></h3>
                </div>              
              </div>
              <div class="description"><?php echo get_the_custom_excerpt(get_the_ID(),200); ?></div>
		<?php
			if( bp_is_my_profile() || is_super_admin() ) {

				$edit_link = wp_nonce_url( $user_link . 'events/create?eid=' . $post->ID, 'editing', 'edn');

				$delLink = get_delete_post_link( $post->ID );

			?>

				<span class="edit"><a href="<?php echo $edit_link; ?>" title="Edit  Event">Edit</a></span>
				&nbsp; &nbsp;
				<span class="trash"><a onclick="return confirm('Are you sure you want to delete this Event?')" href="<?php echo $delLink; ?>" title="Delete Event" class="submit">Delete</a></span>

		<?php } ?>
            </div>

	<?php endwhile; ?>
	</div>

	<div class="entry-content"><br/>
		<?php echo pp_events_profile_pagination( $wp_query ); ?>
	</div>


	<?php wp_reset_query(); ?>

<?php else : ?>

	<div class="entry-content"><br/>There are no expired Events for this member.</div>


<?php endif; ?>
