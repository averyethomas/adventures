<!doctype html>
    <html <?php language_attributes(); ?> >
  <head>
    <title>Adventures of Avery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--CSS-->
    <link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet" type="text/css">
    <?php wp_head(); ?>
  </head>
  <body ng-app="angularApp" ng-controller="mainCtrl" ng-init="init(<?php if( is_front_page() ) echo 'true'; else echo 'false' ?>)">
    <div class="mobile-nav" ng-class="{'fullHero': fullHero}">
      <a href="/">
        <img src="images/logo.png">
      </a>
      <p ng-click="showMenu = !showMenu"><span></span><span></span><span></span></p>
    </div>
    <div class="nav" ng-show="showMenu" ng-class="{'fullHero': fullHero}">
      <ul>
        <li><a href="/"><img src="images/logo.png"></a></li>
        <li class="home"><a href="/">HOME</a></li>
        <?php main_nav(); ?>
      </ul>
    </div>