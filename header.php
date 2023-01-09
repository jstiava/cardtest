<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?php the_title(); ?></title>

     <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>	

     <header id="sos">

          <section class="main-bar">
               <div class="container">
                    <a href="<?php echo get_home_url(); ?>" style="padding: 0;">
                         <img id="wordmark" src="<?php echo esc_url( get_template_directory_uri() . '/images/masthead.svg' ); ?>" alt="WashU Campus Card Services">
                         <img id="wordmark_mobile" src="<?php echo esc_url( get_template_directory_uri() . '/images/washu_card_mobile_logo.svg' ); ?>" alt="WashU Campus Card Services">
                         <img id="wordmark_mobile_small" src="<?php echo esc_url( get_template_directory_uri() . '/images/washu_small_mobile.svg' ); ?>" alt="WashU Campus Card Services">
                    </a>
                    <div class="row">
                         <?php wp_nav_menu(array('theme_location' => 'quick_tools')); ?>
                    </div>
                    <!-- Mobile menu button -->
                    <div id="mobile_menu_trigger_button">
                         <div class="menu_horizontal_piece"></div>
                         <div class="menu_horizontal_piece"></div>
                         <div class="menu_horizontal_piece"></div>
                    </div>
               </div>
          </section>

          <?php 
          if (is_user_logged_in()) {
               echo "<style>#scroll-menu, #mobile_menu_trigger_button {top: var(--wp-admin--admin-bar--height) !important;}</style>";
          }
          ?>

          <section class="menu-bar">
               <div class="container">
                    <div class="row">
                         <nav id="main_menu">
                              <?php $walker = new Menu_With_Description; ?>
                              <?php wp_nav_menu(array('theme_location' => 'my_main_menu', 'menu_class' => 'nav-menu', 'walker' => $walker)); ?>
                         </nav>
                    </div>
               </div>
          </section>


          <section id="scroll-menu" class="menu-bar fixed">
               <div class="container">
                    <div class="row">
                         <nav id="main_menu" aria-labelledby="main-menu">
                              <?php $walker = new Menu_With_Description; ?>
                              <?php wp_nav_menu(array('theme_location' => 'my_main_menu', 'menu_class' => 'nav-menu', 'walker' => $walker)); ?>
                         </nav>
                    </div>
               </div>
          </section>

          <section class="page-header">
               <div class="container">
                    <div class="content">
                         <h6 class="parent-title">
                              <?php 
                                   if (has_post_parent()):
                                        echo get_the_title( $post->post_parent ); 
                                   endif;
                              ?>
                         </h6>
                         <h1><?php the_title(); ?></h1>
                         <p><?php the_field('description'); ?></p>
                    </div>
                    <?php
                    // if has_post_thumbnail();
                    if (true) {
                    ?>
                         <div class="figure">
                              <img class="featured_image" src="<?php echo get_the_post_thumbnail_url($post->id); ?>">
                         </div>
                    <?php
                    };
                    
                    wp_reset_postdata();
                    ?>
               </div>
          </section>

     </header>