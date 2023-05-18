<?php get_header('simple'); ?>

<section class="page-header person">
    <div class="container">
        <div class="figure">
            <div class="portrait" style="background-image: url(<?php echo get_the_post_thumbnail_url($post->id); ?>);"></div>
        </div>
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
            <div class="row badges" style="margin-top: 15px">
            <?php
                if (get_field('safe_zone_certified')) {
                    ?>
                        <img class="person_icon" style="width: 175px" src="<?php echo esc_url(get_template_directory_uri() . '/icons/safe_zones.png'); ?>" alt="">
                    <?php
                }

                if (get_field('twenty_five_years')) {
                    ?>
                        <img class="person_icon" src="<?php echo esc_url(get_template_directory_uri() . '/icons/twenty_five_seal.png'); ?>" alt="25 Years of Service at WashU">
                    <?php
                }

                if (get_field('green_office_rep')) {
                    ?>
                        <img class="person_icon" src="<?php echo esc_url(get_template_directory_uri() . '/icons/green_office.png'); ?>" alt="Green Office Representative">
                    <?php
                }

                if (get_field('missouri_business_officer')) {
                    ?>
                        <img class="person_icon" src="<?php echo esc_url(get_template_directory_uri() . '/icons/missouri.png'); ?>" alt="Missouri Business Officer">
                    <?php
                }
            ?>
                
            </div>
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