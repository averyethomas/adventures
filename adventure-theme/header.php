<!doctype html>
    <html <?php language_attributes(); ?> >
  <head>
    <title>Adventures of Avery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSS-->
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css">
    <?php wp_head(); ?>
  </head>
  <body ng-app="angularApp" ng-controller="mainCtrl">
    <div class="mobile-nav"><a href="/"><img src="images/logo.png"></a>
      <p ng-click="showMenu = !showMenu">&#9776;</p>
    </div>
    <div class="nav" ng-show="showMenu" >
      <div class="close">
        <p ng-click="showMenu = !showMenu">&#10006;</p>
      </div>
      <ul>
        <li><a href="/"><img src="images/logo.png"></a></li>
        <li class="home"><a href="/">HOME</a></li>
        <?php main_nav(); ?>
      </ul>
    </div>