<footer>
     <img id="footer_shield" style="cursor: pointer;" onclick="window.location.href='https://wustl.edu/';"
          src="<?php echo esc_url(get_template_directory_uri() . '/icons/washu_digital.svg'); ?>"
          alt="Washington University in St. Louis">
     <h6>Campus Card Services</h6>
     <h6>Washington University in St. Louis</h6>
     <br>
     <p>One Brookings Drive, St. Louis, MO</p>
     <p>Ann W. Olin Women's Building, Suite 002</p>
     <div class="flex">
          <?php wp_nav_menu(array('theme_location' => 'footer', 'menu_class' => 'footer_menu', 'walker' => $walker)); ?>
     </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>