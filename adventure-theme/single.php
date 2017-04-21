<?php
    /*
     *Template Name: Post Page
     *
     */
    
    get_header();
?>
<div class="single" ng-controller="singlePostsCtrl" ng-init="init(<?php echo get_the_ID(); ?>)" ng-cloak>
      <div class="map-button" ng-click="closeMap();" ng-class="{'mapClosed': isMapClosed}">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 74.88 76.02">
                  <polygon points="18.72 76.02 0 64.76 0 0 18.72 11.26 18.72 76.02" style="fill:#c1c1c0"/>
                  <polygon points="56.16 76.02 37.44 64.76 37.44 0 56.16 11.26 56.16 76.02" style="fill:#c1c1c0"/>
                  <polygon points="56.16 76.02 74.88 64.76 74.88 0 56.16 11.26 56.16 76.02" style="fill:#e5e5e5"/>
                  <polygon points="18.72 76.02 37.44 64.76 37.44 0 18.72 11.26 18.72 76.02" style="fill:#e5e5e5"/>
                  <path d="M339.15,432.7a5.87,5.87,0,0,1,5.87-5.87c0-1.54,0-2.91,0-4a9.43,9.43,0,0,0-8.79,5.8h0a10.29,10.29,0,0,0,.86,9.69L345,450.41s0-5.53,0-11.85A5.87,5.87,0,0,1,339.15,432.7Z" transform="translate(-295.45 -387.15)" style="fill:<?php echo get_theme_mod('dark_color', '#0F5154'); ?>"/>
                  <path d="M345,426.83h0a5.87,5.87,0,0,0,0,11.74h0" transform="translate(-295.45 -387.15)" style="fill:#fff"/>
                  <path d="M353.81,428.65h0a9.43,9.43,0,0,0-8.79-5.8c0,1.07,0,2.43,0,4a5.87,5.87,0,1,1,0,11.74c0,6.31,0,11.85,0,11.85L353,438.34A10.29,10.29,0,0,0,353.81,428.65Z" transform="translate(-295.45 -387.15)" style="fill:<?php echo get_theme_mod('light_color', '#4b8287'); ?>"/>
                  <circle cx="49.57" cy="45.55" r="6.07" style="fill:#fff"/>
                  <path d="M311.12,400.87A5.87,5.87,0,0,1,317,395c0-1.54,0-2.91,0-4a9.43,9.43,0,0,0-8.79,5.8h0a10.29,10.29,0,0,0,.86,9.69L317,418.58s0-5.53,0-11.85A5.87,5.87,0,0,1,311.12,400.87Z" transform="translate(-295.45 -387.15)" style="fill:<?php echo get_theme_mod('dark_color', '#0F5154'); ?>"/>
                  <path d="M317,395h0a5.87,5.87,0,0,0,0,11.74h0" transform="translate(-295.45 -387.15)" style="fill:#fff"/>
                  <path d="M325.78,396.82h0A9.43,9.43,0,0,0,317,391c0,1.07,0,2.43,0,4a5.87,5.87,0,1,1,0,11.74c0,6.31,0,11.85,0,11.85l7.95-12.07A10.29,10.29,0,0,0,325.78,396.82Z" transform="translate(-295.45 -387.15)" style="fill:<?php echo get_theme_mod('light_color', '#4b8287'); ?>"/>
                  <circle cx="21.54" cy="13.72" r="6.07" style="fill:#fff"/>
            </svg>
      </div>
      <div class="map" ng-class="{'mapClosed': isMapClosed}">
        <div id="map"></div>
      </div>
      <div class="content-container container" ng-class="{'mapClosed': isMapClosed}">
        <div class="content">
          <div class="intro">
            <h1>{{singlePost.title.rendered}}</h1>
            <h4>{{singlePost.date | date:'MMMM yyyy'}}</h4>
            <p ng-bind-html="singlePost.acf.intro | preserveHtml"></p>
            <div ng-repeat="item in singlePost.acf.intro_images">
              <div class="single" ng-if="item.acf_fc_layout == 'single'"><img ng-src="{{item.image}}"></div>
              <div class="double" ng-if="item.acf_fc_layout == 'double'"><img ng-src="{{item.image_left}}"><img ng-src="{{item.image_right}}"></div>
            </div>
          </div>
          <div class="location" ng-repeat="location in singlePost.acf.locations track by $index" id="{{location.name | removeSpaces}}">
            <h3>{{location.name}}</h3>
            <p ng-bind-html="location.text | preserveHtml"></p>
            <div ng-repeat="item in location.images">
              <div class="single" ng-if="item.acf_fc_layout == 'single'"><img ng-src="{{item.image}}"></div>
              <div class="double" ng-if="item.acf_fc_layout == 'double'"><img ng-src="{{item.image_left}}"><img ng-src="{{item.image_right}}"></div>
              <div class="tall" ng-if="item.acf_fc_layout == 'tall'"><img ng-src="{{item.image}}"></div>              
            </div>
          </div>
        </div>
      </div>
    <?php get_footer(); ?>
</div>