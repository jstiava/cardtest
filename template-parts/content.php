<article>
     <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
     <?php the_post_thumbnail('medium'); ?>
     <p>Posted in <?php echo get_the_date(); ?> by <?php the_author_posts_link(); ?> </p>
     <p>Categories: <?php the_category(); ?></p>
     <p><?php the_tags('Tags: ', ', ') ?></p>
     <div style="display: flex; flex-direction: column;"><?php the_content(); ?></div>
</article>