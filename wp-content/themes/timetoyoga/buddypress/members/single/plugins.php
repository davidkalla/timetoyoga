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
          <?php if(bp_current_action()=='buddystream-networks' || bp_current_component()=='events') { ?>
            <div class="profile-tabs">
              <?php $survey_id=getSurveyId(); ?>    
              <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>profile/edit/">Profile</a>
              <?php if(bp_current_action()=='buddystream-networks'){ ?><div class="active tab">Activity stream</div><?php } else { ?><a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/buddystream-networks/">Activity stream</a><?php } ?>
              <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>media/">Media gallery</a> 
              <a class="tab" href="<?php echo bp_loggedin_user_domain() ?>settings/">Password</a>
              <a class="tab" href="<?php echo get_permalink($survey_id) ?>"><?php echo get_the_title($survey_id) ?></a>
		<?php if(bp_current_component()=='events'){ ?><div class="active tab">Events</div><?php } else { ?><a class="tab" href="<?php echo bp_loggedin_user_domain() ?>events/">Events</a><?php } ?>
            </div>
          <?php } ?>
          <h1><?php echo bp_core_get_user_displayname(bp_displayed_user_id()); ?></h1>           
          
          <?php if(bp_current_component()=='events'){ ?>
		<div id="item-body">
			<div class="item-list-tabs no-ajax" id="subnav">
				<ul>
					<li id="member-events-upcoming-personal-li"<?php if(bp_current_action()=='upcoming') echo ' class="current selected"'; ?>><a id="member-events-upcoming" href="<?php echo bp_loggedin_user_domain() ?>events/">Upcoming</a></li>
					<li id="member-events-archive-personal-li"<?php if(bp_current_action()=='archive') echo ' class="current selected"'; ?>><a id="member-events-archive" href="<?php echo bp_loggedin_user_domain() ?>events/archive/">Archive</a></li>
					<li id="member-events-create-personal-li"<?php if(bp_current_action()=='create') echo ' class="current selected"'; ?>><a id="member-events-create" href="<?php echo bp_loggedin_user_domain() ?>events/create/">Create Event</a></li>
				</ul>
			</div>
		</div>
	   <?php } ?> 
         
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

<?php 
if(bp_current_component()=='events' && bp_current_action()=='create'){
wp_enqueue_script('jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.js', array(), null, false);
wp_enqueue_script('googleSearch', get_template_directory_uri() . '/assets/js/plugins/googleSearch.js', array(), null, false);

?>

<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('#event-date').datepicker({
        dateFormat: 'DD, MM d, yy'
    });

    jQuery('#event-time').timepicker({
        timeFormat: 'h:mm p'        
    });


    var input = document.getElementById('event-location');
    var defaultBounds = new google.maps.LatLngBounds(
    	new google.maps.LatLng(-33.8902, 151.1759),
    	new google.maps.LatLng(-33.8474, 1512631)
    )

    var options = {
    	bounds: defaultBounds   
    }

    var autocomplete = new google.maps.places.Autocomplete(input, options);
    var searchBox = new google.maps.places.SearchBox(input, {
         bounds: defaultBounds
    });


    google.maps.event.addListener(searchBox, 'places_changed', function() {
    	var places = searchBox.getPlaces();
    	$('#event-latlng').val(places[0].geometry.location.lat()+','+places[0].geometry.location.lng()); // Get Latitude,Longitude
    	$('#event-address').val(places[0].formatted_address); // Formated Address of Place
    	//console.log(places[0].name); // Name of Place

    });
});
</script>

<?php } ?>

      







