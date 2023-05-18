<article <?php post_class(array('class' => 'merchants')); ?> style="border-radius: 5px; padding: 4rem; background-color: <?php the_field('primary_color') ?>; color: <?php echo get_contrast_color(get_field('primary_color')) ?>">
     <h3><?php the_title(); ?></h3>
     <!-- <img style="max-width: 100%; max-height: 125px; margin-left: auto; margin-right: auto; border-radius: 2px; overflow: hidden; " src="<?php the_field('logo'); ?>"> -->

     <p style="margin-bottom: 30px;"><?php the_field('description'); ?></p>

     <a class="merchant_link" href="<?php the_permalink(); ?>">See Merchant</a>
</article>