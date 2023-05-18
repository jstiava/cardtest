<?php get_header('simple'); ?>

</header>

<div class="wrapper">
    <div id="content" class="content">
        <div class="container">
            
            <?php
            global $query_string;

            wp_parse_str($query_string, $search_query);
            $the_query = new WP_Query($search_query);
            $search_term = substr($query_string, 2);

            ?>

            <h1>Search: "<?php echo urldecode($search_term);?>"</h1>
            <br><br>

            <?php

            // The Loop
            if ($the_query->have_posts()) {
                echo '<ul>';
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    get_template_part('template-parts/content', 'searchblock');
                }
                echo '</ul>';
            } else {
                echo '<p>No results found.</p>';
            }


            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>