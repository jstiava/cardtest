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
                    <img id="wordmark" src="http://localhost/wordpress/wp-content/uploads/2022/05/card_logo.svg" alt="WashU Campus Card Services">
                    <div class="row" aria-labelledby="quick-actions">
                         <?php wp_nav_menu(array('theme_location' => 'quick_tools')); ?>
                    </div>
               </div>
          </section>

          <section class="menu-bar">
               <div class="container">
                    <div class="row">
                         <nav aria-labelledby="main-menu">
                              <?php $walker = new Menu_With_Description; ?>
                              <?php wp_nav_menu(array('theme_location' => 'my_main_menu', 'menu_class' => 'nav-menu', 'walker' => $walker)); ?>
                         </nav>
                    </div>
               </div>
          </section>

          <?php 
               $featured = new WP_Query('post_type=post&cat=13');
               if ($featured->have_posts()) : $featured->the_post();
          ?>

          <section class="subheader" style="background-color: var(--grey-light);">
               <div class="container">
                    <div class="figure" style="background-image: url(<?php the_post_thumbnail_url() ?>);"></div>
                    <div class="content">
                         <h6><?php 
                              $category = get_the_category();
                              echo $category[0]->name;
                         ?></h6>
                         <h3><?php the_title(); ?></h3>
                         <p><?php the_field('description'); ?></p>
                         <a href="<?php the_permalink(); ?>">Apply</a>
                    </div>
               </div>

          </section>

          <?php
               endif;
               wp_reset_postdata();
          ?>

     </header>