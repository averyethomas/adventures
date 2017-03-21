<?php
    /*
     *Template Name: Post Page
     *
     */
    
    get_header();
?>
<div class="single" ng-controller="singlePostsCtrl" ng-init="init(<?php echo get_the_ID(); ?>)" ng-cloak>
      <div class="map-button" ng-click="closeMap();" ng-class="{'mapClosed': isMapClosed}"></div>
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
            </div>
          </div>
        </div>
      </div>
    <?php get_footer(); ?>
</div>