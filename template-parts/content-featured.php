<article <?php post_class(array('class' => 'featured')); ?>>
     <h2><?php the_title(); ?></h2>
     
     <div style="display: flex; flex-direction: column;">
          <?php the_content(); ?>
     </div>
</article>