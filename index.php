

<?php wp_head(); ?>

     <header>
          <section class="main-bar">
               <div class="container">
                    <img id="wordmark" src="http://localhost/wordpress/wp-content/uploads/2022/05/card_logo.svg" alt="WashU Campus Card Services">
                    <div class="row">
                         <?php wp_nav_menu(array('theme_location' => 'quick_tools')); ?>
                    </div>
               </div>
          </section>

          <section class="menu-bar">
               <div class="container">
                    <div class="row">
                         <nav>
                              <?php $walker = new Menu_With_Description; ?>
                              <?php wp_nav_menu(array('theme_location' => 'my_main_menu', 'menu_class' => 'nav-menu', 'walker' => $walker)); ?>
                         </nav>
                    </div>
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