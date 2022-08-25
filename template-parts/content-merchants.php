<article <?php post_class(array('class' => 'merchants')); ?>>
     <img style="max-width: 100%; max-height: 125px; margin-left: auto; margin-right: auto; border-radius: 2px; overflow: hidden;" src="<?php the_field('logo'); ?>">

     <p style="color: <?php the_field('secondary_color'); ?>; margin-bottom: 30px;"><?php the_field('description'); ?></p>

     <a class="merchant_link" style="background-color: <?php the_field('secondary_color') ?>; color: <?php the_field('primary_color') ?>;" href="<?php the_permalink(); ?>">See Merchant</a>
</article>