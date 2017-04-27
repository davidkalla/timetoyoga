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
