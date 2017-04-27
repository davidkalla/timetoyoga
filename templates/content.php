<div class="card col-sm-6 col-md-4">
              <div class="body">
                <?php 
                $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),'thumbnail');
                $url = $thumb['0'];
                if($url=="") $url=get_template_directory_uri().'/assets/img/empty-box.jpg';
                ?>
                
                
                <div class="image"><img src="<?php echo $url; ?>" title="<?php echo get_the_title(); ?>" alt="<?php echo get_the_title(); ?>" /></div>
                <a href="<?php echo get_permalink(); ?>" class="hover-bg"></a>
                <div class="date"><?php echo get_the_time('F jS'); ?></div>
                <div class="info">
                  <h3 class="name"><?php echo get_the_title(); ?></h3>
                </div>              
              </div>
              <div class="description"><?php echo get_the_custom_excerpt(get_the_ID(),200); ?></div>
            </div>