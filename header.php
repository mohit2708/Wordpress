<?php echo get_template_directory_uri(); ?> //call the css and img and js path
<title><?php if (is_front_page() ) { bloginfo('name'); } else { wp_title(''); ?> | <?php bloginfo('name'); } ?></title>
logo: <?php the_custom_logo(); ?>
<?php
   wp_nav_menu([
     'menu'            => 'header-menu',
     'theme_location'  => 'top',
     'container'       => 'div',
     'container_id'    => 'bs4navbar',
     'container_class' => 'collapse navbar-collapse',
     'menu_id'         => false,
     'menu_class'      => 'navbar-nav',
     'depth'           => 2,
     'fallback_cb'     => 'bs4navwalker::fallback',
     'walker'          => new bs4navwalker()
   ]);
   ?>
<?php wp_head(); ?>
