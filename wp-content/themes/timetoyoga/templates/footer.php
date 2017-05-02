<?php get_template_part('templates/send-to-friends'); ?>


    <div id="footer">
			<div class="container">
        <div class="row">
  				
          <div class="col-sm-3 box">
            <div class="title">About Us</div>
            <div class="text">Time To Yoga is a dynamic platform that engages yoga communities to participate, grow, travel, and connect. Join our community for free today!</div>
          </div>
          
          <div class="col-md-2 col-sm-3 box">
            <div class="title"><a href="<?php echo home_url(); ?>/retreats">Yoga Retreats</a></div>
            <ul>
              <li><a href="<?php echo home_url(); ?>/teachers">Yoga Teachers</a></li>
              <li><a href="<?php echo home_url(); ?>/styles">Yoga Styles</a></li>
              <?php /* ?><li><a href="<?php echo home_url(); ?>/venues">Yoga Venues</a></li><?php */ ?>
            </ul>
          </div>
          
          <div class="col-sm-3 box">
            <div class="title"><a href="<?php echo home_url(); ?>/contact">Contact</a></div>
            <ul>   
              <?php /* ?><li><a href="<?php echo home_url(); ?>/blog">Blog</a></li><?php */ ?>
              <li><a href="<?php echo home_url(); ?>/terms">Terms&Conditions</a></li>
              <li><a href="<?php echo home_url(); ?>/privacy">Privacy Policy</a></li>
              <li><a href="<?php echo home_url(); ?>/sitemap">Sitemap</a></li>
            </ul>
          </div>
          
          <div class="col-md-4 col-sm-3 box">
            <div class="title">Subscribe</div>
            
            <div id="mc_embed_signup">
            <form action="//timetoyoga.us14.list-manage.com/subscribe/post?u=3954a6cf61eb1481b94b3c7e9&amp;id=a252462740" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
              <div class="mc-field-group">
              <div class="body">
                <input type="email" value="" placeholder="Enter your email" name="EMAIL" class="required email text" id="mce-EMAIL">
                <input type="submit" value="Go" name="subscribe" id="mc-embedded-subscribe" class="button submit">                      
                <div class="clear"></div>
              </div>
              </div>
            <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_3954a6cf61eb1481b94b3c7e9_a252462740" tabindex="-1" value=""></div>
                <div class="clear"></div>
            </div>
            </form>
            </div>
            <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
            <!--End mc_embed_signup-->
          </div>
          
          <div class="col-sm-6 social-icons">
            <a href="https://www.facebook.com/TimeToYoga-1473631726184572/" target="_blank"><i class="fa fa-facebook"></i></a>
  					<a href="https://twitter.com/timetoyoga" target="_blank"><i class="fa fa-twitter"></i></a>
            <a href="https://www.instagram.com/timetoyoga/" target="_blank"><i class="fa fa-instagram"></i></a>
          </div>
          
          <div class="col-sm-6 text-right">
            <div class="copy">&copy; TimeToYoga <?php echo date('Y'); ?></div>
          </div>
          
  			</div>
      </div>                     
		</div> 

<?php wp_footer(); ?>
