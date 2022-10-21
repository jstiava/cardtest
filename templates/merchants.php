<!-- Template Name: Merchants -->

<?php get_header(); ?>

<div class="wrapper">
     <div id="content" class="content">
          <div class="container merchant_list" style="flex-wrap: wrap;">
               <?php

               $args = array(
                    'post_type' => 'post',
                    'category_name' => 'merchant',
               );
               $merchants = new WP_Query($args);
               if ($merchants->have_posts()) :

                    while ($merchants->have_posts()) :
                         $merchants->the_post();
                         ?>
                         <p><?php the_title(); ?></p>
                         <?php

                    endwhile;
               endif;
               wp_reset_postdata();

               ?>

          </div>
     </div>
</div>

<?php get_footer(); ?>