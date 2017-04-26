<footer ng-class="{'mapClosed': isMapClosed}">
    <ul>
        <?php footer_nav(); ?>
      <li>
        <p>Theme By<a href="http://averyethomas.com" target="_blank"> Avery Thomas</a></p>
      </li>
      <li>
        <p>&COPY;<?php echo date("Y"); ?> <?php $user_info = get_userdata(1); echo $user_info->display_name ?></p>
      </li>
    </ul>
</footer>
<!--JAVASCRIPT-->
<script>
    var darkColor = '<?php echo get_theme_mod('dark_color', '#0F5154'); ?>'
    var lightColor = '<?php echo get_theme_mod('light_color', '#4b8287'); ?>'
    var highlightColor = '<?php echo get_theme_mod('highlight_color', '#87b401'); ?>'

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA91zkGx48lzfF7ZO4dr69VVTpVSWEhZJk&callback"></script>
</body>
</html>