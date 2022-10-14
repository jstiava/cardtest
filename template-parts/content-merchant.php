<article <?php post_class(array('class' => 'merchants')); ?> style="border-radius: 5px; padding: 4rem; background-color: <?php the_field('primary_color') ?>">
     <img style="max-width: 100%; max-height: 125px; margin-left: auto; margin-right: auto; border-radius: 2px; overflow: hidden; " src="<?php the_field('logo'); ?>">

     <p style="color: #ffffff; margin-bottom: 30px;"><?php the_field('description'); ?></p>

     <a class="merchant_link" style="color: <?php the_field('primary_color') ?>; background-color: #ffffff;" href="<?php the_permalink(); ?>">See Merchant</a>
</article>