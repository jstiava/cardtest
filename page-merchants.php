<?php get_header('simple'); ?>

</header>

<div class="wrapper">
     <div id="content" class="content">
          <div class="container merchant_list" style="flex-wrap: wrap;">
               <?php

               $args = array(
                    'post_type' => 'merchants',
               );
               $merchants = new WP_Query($args);
               if ($merchants->have_posts()) :

                    while ($merchants->have_posts()) :
                         $merchants->the_post();
                         get_template_part('template-parts/content', 'searchblock');
                    endwhile;
               endif;
               wp_reset_postdata();

               ?>

          </div>
     </div>
</div>

<?php get_footer(); ?>