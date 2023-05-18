<?php get_header('simple'); ?>

<section class="page-header">
  <div class="container">
    <div class="content">
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
    <?php
    // if has_post_thumbnail();
    if (true) {
    ?>
      <div class="figure">
        <img class="featured_image" src="<?php echo get_the_post_thumbnail_url($post->id); ?>">
      </div>
    <?php
    };

    wp_reset_postdata();
    ?>
  </div>
</section>

</header>

<div class="wrapper">
  <div id="content" class="content">
    <div class="container">
      <p>This is a single.</p>
      <?php the_content(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>