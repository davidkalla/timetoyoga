<div class="card col-sm-6 col-md-4">
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
            </div>