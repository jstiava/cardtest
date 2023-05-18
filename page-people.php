<?php get_header('simple'); ?>

</header>

<div class="wrapper">
     <div id="content" class="content people">
          <?php

          $args = array(
               'post_type' => 'people',
          );
          $people = new WP_Query($args);
          if ($people->have_posts()) :

               while ($people->have_posts()) :
                    $people->the_post();
                    get_template_part('template-parts/content', 'person');
               endwhile;
          endif;
          wp_reset_postdata();

          ?>
     </div>
</div>

<?php get_footer(); ?>