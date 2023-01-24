<?php get_header('home'); ?>

<div class="wrapper">
     <div id="content" class="content front-page">
          <div class="container">
               <?php the_content(); ?>
          </div>
     </div>
     <div class="sidebar front-page">
          <div class="container">
               <h6>Alerts</h6>

               <?php
               $args = array(
                    'post_type' => 'post',
                    'category_name' => 'warning',
                    'post_per_page' => '3'
               );
               $warnings = new WP_Query($args);
               if ($warnings->have_posts()) :
                    
                    while ($warnings->have_posts()) :
                         $warnings->the_post();
                         get_template_part('template-parts/content', 'colorblock');

                    endwhile;
               endif;
               wp_reset_postdata();
               ?>
               
          </div>
     </div>
</div>

<?php get_footer(); ?>
// comment to test romina-test-branch
