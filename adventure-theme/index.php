<?php
    /*
     *Template Name: Home Page
     *
     */
    
    get_header();
?>
<div class="home" ng-controller="singlePageCtrl" ng-init="init(<?php echo get_the_ID(); ?>)">
    <div class="hero-image" ng-style="{'background-image':'url(' + pageData.acf.hero_photo + ')'}"></div>
    <div class="about-row" id="about">
      <div class="about-info" ng-bind-html="pageData.acf.about_me | preserveHtml"></div>
      <div class="about-image" ng-style="{'background-image':'url(' + pageData.acf.about_image + ')'}"></div>
    </div>
    <div class="map-section" id="map-section" ng-controller="postsCtrl">
      <div class="title">
        <h1>{{pageData.acf.map_section_title}}</h1>
      </div>
      <div class="map" ng-init="initMap();">
        <div id="map"></div>
      </div>
      <div class="locations-grid container">
        <ul>
          <li class="location-tile" ng-repeat="post in posts" id="{{post.acf.title | removeSpaces}}">
            <div class="location-hover"><a class="location-info" ng-href="{{post.link}}">
                <h2>{{post.title.rendered}}</h2>
                <h4>{{post.date | date:'MMMM yyyy'}}</h4></a></div>
            <div class="location-image" ng-style="{'background-image':'url({{post.acf.thumbnail_image}})'}"></div>
          </li>
        </ul>
      </div>
    </div>
</div>
<?php get_footer(); ?>