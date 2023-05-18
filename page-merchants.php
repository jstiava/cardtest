<?php get_header('simple'); ?>

</header>

<div class="wrapper">
     <div id="content merchants_list" class="content">
          <?php

          $args = array(
               'post_type' => 'merchants',
          );
          $merchants = new WP_Query($args);
          if ($merchants->have_posts()) :

               while ($merchants->have_posts()) :
                    $merchants->the_post();
                    get_template_part('template-parts/content', 'merchant');
               endwhile;
          endif;
          wp_reset_postdata();

          ?>
     </div>
</div>

<?php get_footer(); ?>