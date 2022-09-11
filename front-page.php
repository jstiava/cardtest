<?php get_header('home'); ?>

<div class="wrapper">
     <div id="content" class="content front-page">
          <div class="container">
               <form role="search" method="get" action="http://localhost/wordpress/" class="wp-block-search__button-outside wp-block-search__text-button wp-block-search">
                    <label for="wp-block-search__input-1" class="wp-block-search__label">Search</label>
                    <div class="wp-block-search__inside-wrapper ">
                         <input type="search" id="wp-block-search__input-1" class="wp-block-search__input " name="s" value="" placeholder="" required=""><button type="submit" class="wp-block-search__button  ">Search</button>
                    </div>
               </form>
               <?php the_content(); ?>
          </div>
     </div>
     <div class="sidebar front-page">
          <div class="container">
               <?php

               $warnings = new WP_Query('post_type=post&cat=9&post_per_page=3');
               if ($warnings->have_posts()) :
                    while ($warnings->have_posts()) :
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