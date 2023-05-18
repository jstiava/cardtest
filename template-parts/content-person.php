<article class="person_card">
    <div class="portrait" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->id); ?>);"></div>
    <h5><?php the_title(); ?></h5>
    <p><?php the_field('description'); ?></p>
    <a href="<?php the_permalink(); ?>">More</a>
</article>