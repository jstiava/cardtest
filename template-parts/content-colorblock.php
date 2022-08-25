<article 
     <?php post_class(array('class' => 'colorblock')); ?>
     style="background-color: var(--yellow);"
     >

     <h5><?php the_title(); ?></h5>
     <p><?php the_field('description'); ?></p>
     
</article>