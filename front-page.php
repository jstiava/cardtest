<?php get_header('home'); ?>

<div class="wrapper">
     <div id="content" class="content front-page">
          <div class="container">
               <?php the_content(); ?>
          </div>
     </div>
     <div class="sidebar front-page">
          <div class="container">
               <?php 
                    $warnings = new WP_Query('post_type=post&cat=9&post_per_page=3');
                    if ($warnings->have_posts()):
                         while ($warnings->have_posts()):
                              $warnings->the_post();
                              get_template_part('template-parts/content', 'colorblock');
                         endwhile;
                    endif;
                    wp_reset_postdata();
               ?>
               <?php get_sidebar(); ?>
          </div>
     </div>
</div>

<?php get_footer(); ?>