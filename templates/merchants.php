<?php
/*
Template Name: Merchants
*/
?>

<?php get_header(); ?>

<div class="wrapper">
     <div id="content" class="content">
          <div class="container merchant_list" style="flex-wrap: wrap;">
               <?php

               $warnings = new WP_Query('post_type=post&cat=7');
               if ($warnings->have_posts()) :

                    while ($warnings->have_posts()) :
                         $warnings->the_post();
                         get_template_part('template-parts/content', 'merchant');

                    endwhile;
               endif;
               wp_reset_postdata();

               ?>

          </div>
     </div>
</div>

<?php get_footer(); ?>