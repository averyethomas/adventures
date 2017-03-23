var app = angular.module('angularApp', ['ngResource']);

var darkColor = '#7db5aa';
var lightColor = '#a6dad1';
var highlightColor = '#f16262';

app.controller('mainCtrl', ['$scope', function ($scope) {

    $scope.showMenu = false;

}]);

app.factory('postsData', ['$http', function ($http) {
    var promise;

    return {
        async: function () {
            if (!promise) {
                promise = $http.get('http://adventures.averyethomas.com/wp-json/wp/v2/posts?per_page=100').then(function (response) {
                    return response.data;
                });
            }
            return promise;
        }
    }
}]);

app.controller('postsCtrl', ['$scope', 'postsData', '$interval', '$anchorScroll', '$location', function ($scope, postsData, $interval, $anchorScroll, $location) {

    $scope.isMapClosed = false;
    $scope.closeMap = function () {
        $scope.isMapClosed = !$scope.isMapClosed;
    };

    postsData.async().then(function (d) {

        $scope.posts = d;
        
        $scope.locations = [];

        angular.forEach($scope.posts, function(value){
            $scope.locations.push(value.acf);
        });
        
        $scope.scrollTo = function(point){
            $location.hash(point);
            $anchorScroll();
        }
        
        $scope.initMap = function() {

            var template = [
                '<?xml version="1.0"?>',
                '<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.55 111.04" width="25px" height="25px">',
                '<path d="M381.65,55.59A23.65,23.65,0,0,1,405.3,31.94c0-6.22,0-11.71,0-16a38,38,0,0,0-35.43,23.37h0a41.44,41.44,0,0,0,3.45,39.06L405.25,127s0-22.29,0-47.73A23.65,23.65,0,0,1,381.65,55.59Z" transform="translate(-366.52 -15.92)" style="fill: {{ color1 }}"/>',
                ' <path d="M405.3,31.94h0a23.65,23.65,0,0,0,0,47.29h0" transform="translate(-366.52 -15.92)" style="fill:#fff"/>',
                '<path d="M440.73,39.29h0A38,38,0,0,0,405.3,15.92c0,4.31,0,9.8,0,16a23.65,23.65,0,1,1,0,47.29c0,25.44,0,47.73,0,47.73l32-48.62A41.44,41.44,0,0,0,440.73,39.29Z" transform="translate(-366.52 -15.92)" style="fill: {{ color2 }}"/>',
                '<circle cx="38.83" cy="39.67" r="22.46" stroke="white" stroke-width="3" style="fill:{{ color3 }}"/>',
                '</svg>'
            ].join('\n');

            var iconOnLoad = template.replace('{{ color1 }}', darkColor).replace('{{ color2 }}', lightColor).replace('{{ color3 }}', '#fff');
            var iconOnHover = template.replace('{{ color1 }}', darkColor).replace('{{ color2 }}', lightColor).replace('{{ color3 }}', highlightColor);
            var iconLoad = {
                url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(iconOnLoad),
                scaledSize: new google.maps.Size(35,35),
            }
            var iconHover = { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(iconOnHover),
                scaledSize: new google.maps.Size(35,35),
            }

            var mapOptions = {
                zoom: 3,
                center: new google.maps.LatLng(38.3078, -56.7505),
                mapTypeId: google.maps.MapTypeId.R,
                navigationControl: false,
                mapTypeControl: false,
                scaleControl: false,
                styles: [
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.man_made",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#e1e1e1"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.man_made",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#f2f2f2"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural.landcover",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural.terrain",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape.natural.terrain",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.business",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#d8ecb9"
                            }
                        ]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#ffffff"
                            },
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road.local",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "color": "#b7cadd"
                            }
                        ]
                    }
                ]
            };

            $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);

            $scope.markers = [];

            var createMarker = function(info){

                var marker = new google.maps.Marker({
                    map: $scope.map,
                    position: new google.maps.LatLng(info.lat, info.long),
                    icon: iconLoad,
                    optimized: false,
                    title: info.title,
                    link: info.title.replace(/\s/g,''),
                });

                $scope.markers.push(marker);
                
                marker.addListener('click', function(){
                    console.log(marker.link);
                    $scope.scrollTo(marker.link);
                    document.getElementById(marker.link).style.border = '3px solid #f16262';
                    document.getElementById(marker.link).getElementsByClassName('location-hover')[0].style.display = 'table';


                });

               marker.addListener('mouseover',function(){

                    marker.setIcon(iconHover);
                    document.getElementById(marker.link).getElementsByClassName('location-hover')[0].style.display = 'table';



                });
                marker.addListener('mouseout',function(){

                    marker.setIcon(iconLoad);

                });
            };

            for (i = 0; i < $scope.locations.length; i++){
                createMarker($scope.locations[i]);
            }
        };

        $scope.initMap();
    });
}]);

app.factory('apiCall', ['$location', function($location){
    
    var protocol = $location.protocol() + '://';
    var host = $location.host();
    var origin = protocol + host;
    var apiPoint = appInfo.api_url;
    var apiCall = origin + '/' + apiPoint;
    
    return apiCall;

}]);

app.controller('singlePostsCtrl', ['$scope', '$http','apiCall', '$anchorScroll', '$location', function ($scope, $http, apiCall, $anchorScroll, $location) {

    $scope.isMapClosed = false;
    $scope.closeMap = function () {
        $scope.isMapClosed = !$scope.isMapClosed;
    };
    
    var postID = '';
    
    $scope.init = function(data){
        postID = data;
        
        $http.get(apiCall + 'posts/' + postID).then(function(response){
            $scope.singlePost = response.data;
            
            $scope.singleLocations = [];

            angular.forEach($scope.singlePost.acf.locations, function(value){
                $scope.singleLocations.push(value);
            });
            
            console.log($scope.singleLocations);
            
            $scope.scrollTo = function(point){
                $location.hash(point);
                $anchorScroll();
            }
    
            $scope.initMap = function() {
    
                var template = [
                    '<?xml version="1.0"?>',
                    '<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.55 111.04" width="25px" height="25px">',
                    '<path d="M381.65,55.59A23.65,23.65,0,0,1,405.3,31.94c0-6.22,0-11.71,0-16a38,38,0,0,0-35.43,23.37h0a41.44,41.44,0,0,0,3.45,39.06L405.25,127s0-22.29,0-47.73A23.65,23.65,0,0,1,381.65,55.59Z" transform="translate(-366.52 -15.92)" style="fill: {{ color1 }}"/>',
                    ' <path d="M405.3,31.94h0a23.65,23.65,0,0,0,0,47.29h0" transform="translate(-366.52 -15.92)" style="fill:#fff"/>',
                    '<path d="M440.73,39.29h0A38,38,0,0,0,405.3,15.92c0,4.31,0,9.8,0,16a23.65,23.65,0,1,1,0,47.29c0,25.44,0,47.73,0,47.73l32-48.62A41.44,41.44,0,0,0,440.73,39.29Z" transform="translate(-366.52 -15.92)" style="fill: {{ color2 }}"/>',
                    '<circle cx="38.83" cy="39.67" r="22.46" stroke="white" stroke-width="3" style="fill:{{ color3 }}"/>',
                    '</svg>'
                ].join('\n');
    
                var iconOnLoad = template.replace('{{ color1 }}', darkColor).replace('{{ color2 }}', lightColor).replace('{{ color3 }}', '#fff');
                var iconOnHover = template.replace('{{ color1 }}', darkColor).replace('{{ color2 }}', lightColor).replace('{{ color3 }}', highlightColor);
    
                var iconLoad = { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(iconOnLoad) }
    
                var iconHover = { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(iconOnHover) }
    
                var mapOptions = {
                    zoom: 13,
                    center: new google.maps.LatLng($scope.singlePost.acf.lat, $scope.singlePost.acf.long),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: [
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape.man_made",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#e1e1e1"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape.man_made",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape.natural",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#f2f2f2"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape.natural.landcover",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape.natural.terrain",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape.natural.terrain",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.business",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#d8ecb9"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "color": "#ffffff"
                                },
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#b7cadd"
                                }
                            ]
                        }
                    ]
                };
    
                $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);
    
                $scope.markers = [];
    
                var createMarker = function (info){
    
                    var marker = new google.maps.Marker({
                        map: $scope.map,
                        position: new google.maps.LatLng(info.lat, info.long),
                        title: info.name,
                        link: info.name.replace(/\s/g,''),
                        icon: iconLoad
                    });
    
                    $scope.markers.push(marker);
    
                    marker.addListener('click', function(){
                        $scope.scrollTo(marker.link);
                    });
                    marker.addListener('mouseover',function(){
    
                        marker.setIcon(iconHover);
                        document.getElementById(marker.link).getElementsByTagName("H3")[0].style.color = highlightColor;
    
                    });
                    marker.addListener('mouseout',function(){
    
                        marker.setIcon(iconLoad);
                        document.getElementById(marker.link).getElementsByTagName("H3")[0].style.color = darkColor;
                    });
    
                };
    
                for (i = 0; i < $scope.singleLocations.length; i++){
                    createMarker($scope.singleLocations[i]);
                }
    
    
            };
    
            $scope.initMap();
        })
    }
}]);

app.controller('singlePageCtrl', ['$scope', '$http', 'apiCall', function($scope, $http, apiCall){
    var pageID = '';
    
    $scope.init = function(data){
        pageID = data;
        
        $http.get(apiCall + 'pages/' + pageID).then(function(response){
            $scope.pageData = response.data;
            console.log($scope.pageData);
        })
    }
}])

app.filter('preserveHtml', function($sce) {
    return function(val) {
        return $sce.trustAsHtml(val);
    };
});
app.filter('removeSpaces', [function() {
    return function(string) {
        if (!angular.isString(string)) {
            return string;
        }
        return string.replace(/[\s]/g, '');
    };
}]);