<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title><?php the_title(); ?></title>

     <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

     <header>
          <section class="main-bar">
               <div class="container">
                    <img id="wordmark" src="<?php echo esc_url( get_template_directory_uri() . '/images/masthead.svg' ); ?>" alt="WashU Campus Card Services">
                    <div class="row" aria-labelledby="quick-actions">
                         <?php wp_nav_menu(array('theme_location' => 'quick_tools')); ?>
                    </div>
               </div>
          </section>

          <section class="menu-bar">
               <div class="container">
                    <div class="row">
                         <nav id="main_menu" aria-labelledby="main-menu">
                              <?php $walker = new Menu_With_Description; ?>
                              <?php wp_nav_menu(array('theme_location' => 'my_main_menu', 'menu_class' => 'nav-menu', 'walker' => $walker)); ?>
                         </nav>
                    </div>
               </div>
          </section>

          <!-- Fixed element -->
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

          <?php 
               $args = array(
                    'post_type' => 'post',
                    'category_name' => 'featured'
               );
               $featured = new WP_Query($args);
               if ($featured->have_posts()) : $featured->the_post();
          ?>

          <section class="subheader">
               <div class="container">
                    <div class="figure">
                         <!-- <img src="the_post_thumbnail_url()"> -->
                         <img src="<?php echo esc_url( get_template_directory_uri() . '/images/example.png'); ?>">
                    </div>
                    <div class="content">
                         <h3><?php the_title(); ?></h3>
                         <p><?php the_content(); ?></p>
                    </div>
               </div>

          </section>

          <?php
               endif;
               wp_reset_postdata();
          ?>

     </header>