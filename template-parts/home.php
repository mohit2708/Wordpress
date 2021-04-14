<?php
/* Template Name: Home */
get_header(); ?>
<?php $args = array('post_type' => 'slider','posts_per_page'=>-1,'post_status' => 'publish',
                    'category_name' => 'mobile-apps', 'order' => 'DESC');
      $loop = new WP_Query( $args );
      $i=1;	while ( $loop->have_posts() ) : $loop->the_post();?>
      <div class="item <?php if($i==1){?> active <?php }?> ">
      	<img class="img-responsive" src="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $post->ID ));?>" alt="<?php echo $post->post_title ?>">
        <div class="container">
          <div class="carousel-caption"> 
          	<h2><?php echo $post->post_title ?></h2>
          </div>
        </div>
      </div>
      <?php $i++; endwhile; ?>


<?php get_footer(); ?>
