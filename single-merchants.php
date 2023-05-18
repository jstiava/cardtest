<?php get_header('simple'); ?>

<section class="page-header" style="background-color: <?php echo get_field('primary_color'); ?>">
  <div class="container" style="color: <?php echo get_contrast_color(get_field('primary_color')) ?>">
    <div class="content merchant">
      <h6 class="parent-title">
        <?php
        if (has_post_parent()) :
          echo get_the_title($post->post_parent);
        endif;
        ?>
      </h6>
      <h1><?php the_title(); ?></h1>
      <p><?php the_field('description'); ?></p>
    </div>
    <div class="figure merchant">
      <?php echo wp_get_attachment_image(get_field('icon'), 'large'); ?>
    </div>
    <?php

    wp_reset_postdata();
    ?>
  </div>
</section>

</header>

<div class="wrapper">
  <div id="content" class="content">
    <div class="container">
      <?php the_content(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>