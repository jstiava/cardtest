<?php get_header('simple'); ?>

<section class="page-header" style="background-color: <?php echo get_field('primary_color'); ?>; height: 70vh">
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
    <div class="figure merchant" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->ID, 'large'); ?>);">
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

<?php
  try {
    console_log(get_the_ID());
    console_log(get_post_meta(get_the_ID(), 'js_test_value'));
  } catch (Exception $e) {
    // Code to handle the exception
    echo "Caught exception: " . $e->getMessage();
  }
?>

<?php get_footer(); ?>