    <div id="header">
      <div class="container">   				
  			<div id="logo">
  				<a href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>">
  					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.jpg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
  				</a>
  			</div>
                         
        <div class="user-header-profile">
          <?php $user_id=bp_loggedin_user_id(); ?>
          <?php if($user_id!="" && $user_id!=0) { ?>
          <div class="image"><a href="<?php echo bp_loggedin_user_domain() ?>profile/edit/"><?php echo bp_core_fetch_avatar( 'type=thumb&height=50&width=50&item_id='.$user_id ); ?></a></div>
          <div class="body">    
            <?php $count=messages_get_unread_count(); ?>
            <a href="<?php echo bp_loggedin_user_domain() ?>profile/edit/" class="name"><?php echo bp_core_get_user_displayname($user_id); ?></a>
            <a href="<?php echo bp_loggedin_user_domain() ?>messages" class="messages"><i class="fa fa-envelope"></i><?php if($count>0) { ?><span><?php echo $count; ?></span><?php } ?></a>
            <a href="<?php echo wp_logout_url(home_url()) ?>" class="logout"><i class="fa fa-sign-out"></i></a>
          </div>  
          <div class="clear"></div>
          <?php } else { ?>                            
            <div class="login">          
              <a href="<?php echo home_url(); ?>/login"><i class="fa fa-sign-in"></i> Login</a>
            </div>
          <?php } ?>
        </div>
        
        <div class="showMenu">
        	<i class="fa fa-bars"></i>
        </div>           
          
        <div class="menu-area">
    			<div id="menu-main">
        		<div class="top-menu">
        			<?php
                if (has_nav_menu('primary_navigation')) :
                  wp_nav_menu(array('theme_location' => 'primary_navigation'));
                endif;
              ?>
        		</div>
        	</div>
        </div>
			</div>
		</div>
    
    <?php if(is_front_page()){ ?>
    <div class="slideshow">
      <div id="slides">
        <ul class="slides-container">
          <li> 
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner.jpg" alt="banner" title="banner" />              
          </li>
          
          <li> 
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/banner2.jpg" alt="banner" title="banner" />              
          </li>
        </ul>
        
        <nav class="slides-navigation">
          <a href="#" class="next"></a>
          <a href="#" class="prev"></a>
        </nav>            
      </div>
      
      <script type="text/javascript">     
        $(function() {
          $('#slides').superslides({ 
            inherit_height_from:'.slideshow',
            inherit_width_from:'.slideshow',
            animation: 'fade',
            pagination: false,          
            play: 4000  
          });
        });  
        
        $(document).ready(function(){
          resizeBanners();
        });    
        
        $(window).resize(function() {
          resizeBanners();
        });     
        
        resizeBanners();
      </script>
  </div>
  
  <div class="container">
    <div class="search-form">
      <form action="<?php echo get_permalink(110); ?>" method="get">
        <div class="label">Search for</div>
        <input class="input" type="text" name="q" placeholder="keyword" />
        <div class="label">in</div>
        <select name="in">
          <option value="all">All</option>
          <option value="post">Articles</option>
          <option value="teacher">Teachers</option>
        </select>
        <input type="submit" class="btn" value="Go">
        <div class="clear"></div>
      </form>
    </div>
  </div>


<?php } ?>
