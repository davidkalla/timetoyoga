<?php

 /** 
 * Template for displaying a single Event
 * You can copy this file to your-theme
 * and then edit the layout.
 */

/*$gapikey = get_site_option( 'pp_gapikey' );
				
if ( $gapikey != false ) {		

	wp_register_script( 'google-maps-api', '//maps.googleapis.com/maps/api/js?key=' . $gapikey );
	wp_print_scripts( 'google-maps-api' );

}*/

function pp_single_map_css() {
	echo '<style type="text/css"> .single_map_canvas img { max-width: none; } </style>';
}
add_action( 'wp_head', 'pp_single_map_css' );

wp_print_scripts( 'google-maps-api' );

?>



<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php 
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'full');
        $url = $thumb['0'];
      ?>
            
      <?php if($url!="") { ?>
        <div class="content-image"><img src="<?php echo $url; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" /></a></div> 
      <?php } ?>
      
      <?php the_content(); ?>
			<p>
			<?php
				$meta = get_post_meta($post->ID );

				if( ! empty( $meta['event-date'][0] ) )
					echo __( 'Date', 'bp-simple-events' ) . ':&nbsp;' . $meta['event-date'][0];

				if( ! empty( $meta['event-time'][0] ) )
					echo '<br/>' . __( 'Time', 'bp-simple-events' ) . ':&nbsp;' . $meta['event-time'][0];

				if( ! empty( $meta['event-address'][0] ) )
					echo '<br/>' . __( 'Location', 'bp-simple-events' ) . ':&nbsp;' . $meta['event-address'][0];

				if( ! empty( $meta['event-url'][0] ) )
					echo '<br/>' . __( 'Url', 'bp-simple-events' ) . ':&nbsp;' . pp_event_convert_url( $meta['event-url'][0] );

				?>

				<br/>
				Category: <?php the_category(', ') ?>
			</p>

				<?php if( ! empty( $meta['event-latlng'][0] ) ) : ?>

					
					<div class="single_map_canvas" id="single_event_map" style="height: 225px; width: 100%;"></div>

					<script type="text/javascript">
					function initialize() {
					  var singleLatlng = new google.maps.LatLng(<?php echo $meta['event-latlng'][0]; ?>);
					  var mapOptions = {
					    zoom: 12,
					    center: singleLatlng
					  }
					  var map = new google.maps.Map(document.getElementById('single_event_map'), mapOptions);

					  var marker = new google.maps.Marker({
					      position: singleLatlng,
					      map: map
					  });
					}

					google.maps.event.addDomListener(window, 'load', initialize);
					</script>

				<?php endif; ?>

    </div>
  </article>
<?php endwhile; ?>


<?php
$tags = wp_get_post_terms( get_queried_object_id(), 'post_tag', ['fields' => 'ids'] );
$args = [
    'post__not_in'        => array( get_queried_object_id() ),
    'posts_per_page'      => 3,
    'ignore_sticky_posts' => 1,
    'orderby'             => 'rand',
    'tax_query' => [
        [
            'taxonomy' => 'post_tag',
            'terms'    => $tags
        ]
    ]
];
$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {
    echo '<div id="related">
            <h2>Related Posts</h2>';
    ?>
    <div class="articles row">
    <?php
        while( $my_query->have_posts() ) {
            $my_query->the_post(); ?>
            <?php get_template_part('templates/content', get_post_format()); ?>
        <?php }
        wp_reset_postdata();
        ?>
    </div>
    <?php
    echo '</div><!--related-->';
}
?> 
