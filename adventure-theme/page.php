<?php
    /*
     *Template Name: Single Page
     *
     */
    
    get_header();
?>

<div ng-cloak class="content-container container" ng-controller="singlePageCtrl" ng-init="init(<?php echo get_the_ID(); ?>)">
    <h1>{{ pageData.title.rendered }}</h1>
    <div class="content" ng-bind-html="pageData.content.rendered | preserveHtml"></div>
</div>

<?php get_footer(); ?>
