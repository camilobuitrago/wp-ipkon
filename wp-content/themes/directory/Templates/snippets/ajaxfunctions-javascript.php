var opts = {
  lines: 13, // The number of lines to draw
  length: 9, // The length of each line
  width: 9, // The line thickness
  radius: 27, // The radius of the inner circle
  corners: 1, // Corner roundness (0..1)
  rotate: 0, // The rotation offset
  color: '#FFF', // #rgb or #rrggbb
  speed: 1.8, // Rounds per second
  trail: 81, // Afterglow percentage
  shadow: true, // Whether to render a shadow
  hwaccel: false, // Whether to use hardware acceleration
  className: 'spinner', // The CSS class to assign to the spinner
  zIndex: 2e9, // The z-index (defaults to 2000000000)
  top: 'auto', // Top position relative to parent in px
  left: 'auto' // Left position relative to parent in px
};
var target = document.getElementById('directory-main-bar');
var spinner = new Spinner(opts).spin(target);
var spinnerDiv = mapDiv.find('.spinner');

// set interactive search
var search = $('#directory-search');
if(search.data('interactive') == 'yes'){
	var searchInput = $('#dir-searchinput-text'),
		categoryInput = $('#dir-searchinput-category'),
		locationInput = $('#dir-searchinput-location'),
		geoInput = $('#dir-searchinput-geo'),
		geoRadiusInput = $('#dir-searchinput-geo-radius');
	
	searchInput.typeWatch({
		callback: function() {
			ajaxGetMarkers(true,false);
		},
		wait: 500,
		highlight: false,
		captureLength: 0
	});

	categoryInput.on( "autocompleteselect", function( event, ui ) {
		ajaxGetMarkers(true,false,ui.item.value,false);
	});
	locationInput.on( "autocompleteselect", function( event, ui ) {
		ajaxGetMarkers(true,false,false,ui.item.value);
	});
	categoryInput.on( "autocompleteclose", function( event, ui ) {
		if($('#dir-searchinput-category-id').val() == '0'){
			ajaxGetMarkers(true,false);
		}
	});
	locationInput.on( "autocompleteclose", function( event, ui ) {
		if($('#dir-searchinput-location-id').val() == '0'){
			ajaxGetMarkers(true,false);
		}
	});
}

// ajax geolocation
$('#dir-searchinput-geo').FancyCheckbox().bind("afterChangeIphone",function(event) {
	if($(this).is(':checked')){
		mapDiv.gmap3({
			getgeoloc:{
				callback : function(latLng){
					if (latLng){
						$('#dir-searchinput-geo-lat').val(latLng.lat());
						$('#dir-searchinput-geo-lng').val(latLng.lng());
						if(search.data('interactive') == 'yes'){
							ajaxGetMarkers(true,false);
						}
					}
				}
			}
		});
	} else {
		if(search.data('interactive') == 'yes'){
			ajaxGetMarkers(true,false);
		}
	}
});

$('#dir-searchinput-settings .icon').click(function() {
	$('#dir-search-advanced').toggle();
});

$('#dir-search-advanced-close').click(function() {
	$('#dir-search-advanced').hide();
});

$('#dir-search-advanced .value-slider').slider({
	value: {ifset $themeOptions->search->advancedSearchDefaultValue}{$themeOptions->search->advancedSearchDefaultValue}{else}100{/ifset},
	min: {ifset $themeOptions->search->advancedSearchMinValue}{$themeOptions->search->advancedSearchMinValue}{else}5{/ifset},
	max: {ifset $themeOptions->search->advancedSearchMaxValue}{$themeOptions->search->advancedSearchMaxValue}{else}2000{/ifset},
	step: {ifset $themeOptions->search->advancedSearchStepValue}{$themeOptions->search->advancedSearchStepValue}{else}5{/ifset},
	change: function( event, ui ) {
		if(geoInput.is(':checked')){
			ajaxGetMarkers(true,false);
		}
	},
	slide: function( event, ui ) {
		$( "#dir-searchinput-geo-radius" ).val( ui.value );
	}
});

function ajaxGetMarkers(ajax,geoloc,rewriteCategory,rewriteLocation,reset) {

	//map.panTo(new google.maps.LatLng(0,0));
	var topPosition = mapDiv.height() / 2;
	spinnerDiv.css('top',topPosition+'px').fadeIn();

	radius = new Array();

	var category = 0;
	var location = 0;
	var search = ''; 

	var ajaxGeo = $('#dir-searchinput-geo').attr("checked");

	if(ajax){
		if(rewriteCategory){
			category = rewriteCategory;
		} else {
			category = $('#dir-searchinput-category-id').val();
		}
		if(rewriteLocation){
			location = rewriteLocation;
		} else {
			location = $('#dir-searchinput-location-id').val();
		}
		search = $('#dir-searchinput-text').val();
		if(ajaxGeo && !reset){
			var inputRadius = $('#dir-searchinput-geo-radius').val();
			if(!isNaN(inputRadius)){
				radius.push(parseInt(inputRadius));
			} else {
				$('#dir-searchinput-geo-radius').val($('#dir-searchinput-geo-radius').data('default-value'));
				radius.push(parseInt($('#dir-searchinput-geo-radius').data('default-value')));
			}
			radius.push(parseFloat($('#dir-searchinput-geo-lat').val()));
			radius.push(parseFloat($('#dir-searchinput-geo-lng').val()));
		}
	} else {
		if(reset){
			category = parseInt(mapDiv.data('category'));
			location = parseInt(mapDiv.data('location'));
			search = mapDiv.data('search');
		} else {
			if(geoloc){
				radius.push(parseInt({ifset $geolocationRadius}{$geolocationRadius}{else}100{/ifset}));
				radius.push(geoloc.lat());
				radius.push(geoloc.lng());

				category = parseInt(mapDiv.data('category'));
				location = parseInt(mapDiv.data('location'));
				search = mapDiv.data('search');
			}
		}
	}
	// get items from ajax
	$.post(
		// MyAjax defined in functions.php
		MyAjax.ajaxurl,
	    {
	        action : 'get_items',
	        category : category,
	        location : location,
	        search : search,
	        radius : radius
	    },
	    function( response ) {
	    	// show reset ajax button
	    	if((!reset) && (!geoloc)){
	    		$('#directory-search .reset-ajax').show();
	    	}
	    	{if isset($themeOptions->search->interactiveReplaceContent) && ($themeOptions->search->interactiveReplaceContent == 'enabled') }
	    	if((!reset) && (!geoloc)){
	    		generateContent(response);
	    	}
	    	{/if}
	    	if(ajaxGeo && !reset){
	    		var ajaxGeoObj = new google.maps.LatLng(parseFloat($('#dir-searchinput-geo-lat').val()),parseFloat($('#dir-searchinput-geo-lng').val()));
	    		generateMarkers(response,ajaxGeoObj,true);
	    	} else {
	    		generateMarkers(response,geoloc);
	    	}
	    }
	)
	.fail(function(e) { console.log("AJAX ERROR", e); });
}

function generateMarkers(dataRaw,geoloc,ajaxGeo) {
	
	// clear map
	infobox.close();
	mapDiv.gmap3({ clear: { } });

	map.setZoom({!$themeOptions->directory->setZoomIfOne});
	
	var len = $.map(dataRaw, function(n, i) { return i; }).length;

	var i = 0;
	// prepare data
	var data = new Array();
    for(var key in dataRaw){
    	var thumbCode = (dataRaw[key].timthumbUrl) ? ' with-image"><img src="'+dataRaw[key].timthumbUrl+'" alt="">' : '">';
    	data[i] = { 
			latLng: [dataRaw[key].optionsDir['gpsLatitude'],dataRaw[key].optionsDir['gpsLongitude']], 
			options: { 
				icon: dataRaw[key].marker,
				shadow: "{!$themeOptions->directoryMap->mapMarkerImageShadow}",
			},
			data: '<div class="marker-holder"><div class="marker-content'+thumbCode+'<div class="map-item-info"><div class="title">'+dataRaw[key].post_title+'</div><div class="address">'+dataRaw[key].optionsDir["address"]+'</div><a href="'+dataRaw[key].link+'" class="more-button">VIEW MORE</a></div><div class="arrow"></div><div class="close"></div></div></div></div>'
		};
		i++;
    }

    // show geoloc marker
    if(geoloc){
    	mapDiv.gmap3({
			marker: {
    			latLng: geoloc,
    			options: {
    				animation: google.maps.Animation.DROP,
    				zIndex: 1000,
    				icon: "{$themeImgUrl}/geolocation-pin.png"
    			}
    		}
    	});
	}

	// generate markers in map
	var mapObj = {
		marker: {
			values: data,
			options:{
				draggable: false
			},
			cluster:{
          		radius: 20,
				// This style will be used for clusters with more than 0 markers
				0: {
					content: "<div class='cluster cluster-1'>CLUSTER_COUNT</div>",
					width: 90,
					height: 80
				},
				// This style will be used for clusters with more than 20 markers
				20: {
					content: "<div class='cluster cluster-2'>CLUSTER_COUNT</div>",
					width: 90,
					height: 80
				},
				// This style will be used for clusters with more than 50 markers
				50: {
					content: "<div class='cluster cluster-3'>CLUSTER_COUNT</div>",
					width: 90,
					height: 80
				},
				events: {
					click: function(cluster) {
						map.panTo(cluster.main.getPosition());
						map.setZoom(map.getZoom() + 2);
					}
				}	
          	},
			events: {
				click: function(marker, event, context){
					map.panTo(marker.getPosition());

					infobox.setContent(context.data);
					infobox.open(map,marker);

					// if map is small
					var iWidth = 260;
					var iHeight = 300;
					if((mapDiv.width() / 2) < iWidth ){
						var offsetX = iWidth - (mapDiv.width() / 2);
						map.panBy(offsetX,0);
					}
					if((mapDiv.height() / 2) < iHeight ){
						var offsetY = -(iHeight - (mapDiv.height() / 2));
						map.panBy(0,offsetY);
					}

				}
			}
		}
	};

	if(geoloc){
		if(ajaxGeo){
			var inputRadius = $('#dir-searchinput-geo-radius').val();
			if(!isNaN(inputRadius)){
				var radiusInM = parseInt($('#dir-searchinput-geo-radius').val()) * 1000;
			} else {
				var radiusInM = parseInt($('#dir-searchinput-geo-radius').data('default-value')) * 1000;
			}
			// autofit by circle
			mapObj.circle = {
				options: {
					center: geoloc,
					radius : radiusInM,
					visible : {ifset $themeOptions->search->showAdvancedSearchRadius}true{else}false{/ifset},
					fillOpacity : 0.15,
					fillColor : "#2c82be",
					strokeColor : "#2c82be"
				}
			}
		} else {
			var radiusInM = parseInt({ifset $geolocationRadius}{$geolocationRadius}{else}100{/ifset}) * 1000;
			// autofit by circle
			mapObj.circle = {
				options: {
					center: geoloc,
					radius : radiusInM,
					visible : {ifset $geolocationCircle}true{else}false{/ifset},
					fillOpacity : 0.15,
					fillColor : "#2c82be",
					strokeColor : "#2c82be"
				}
			}
		}
	}

	spinnerDiv.fadeOut();

	mapDiv.gmap3( mapObj, "autofit" );

	if(len == 1 && !geoloc){
		map.setZoom({!$themeOptions->directory->setZoomIfOne});
	}

}

var contentDiv = $('#main #content');
var currContent = contentDiv.html();
var ajaxContent;

function generateContent(data) {

	var length = $.map(data, function(n, i) { return i; }).length;

	contentDiv.find('.ajax-content').remove();
	var title;
	if(length == 0){
		title = $('<header class="entry-header"><h1 class="entry-title"><span>{__ 'No result found'}</span></h1></header>');
	} else {
		title = $('<header class="entry-header"><h1 class="entry-title"><span>{__ 'Search result'}</span></h1></header>');
	}
	
	var html;
	if(length > 0){
		html = $('<ul class="items"></ul>');
	}
	var limit = {ifset $themeOptions->search->interactiveContentMaxItems}{!$themeOptions->search->interactiveContentMaxItems}{else}30{/ifset};
	if(limit > length) {
		limit = length;
	}
	var i = 0;
	for(var key in data){
		var thumbnailHtml;
		if(data[key].timthumbUrlContent){
			var thumbnailHtml = '<div class="thumbnail"><img src="'+data[key].timthumbUrlContent+'" alt="Item thumbnail"><div class="comment-count">'+data[key].comment_count+'</div></div>';
		} else {
			thumbnailHtml = '';
		}
		var descriptionHtml = '<div class="description"><h3><a href="'+data[key].link+'">'+data[key].post_title+'</a></h3>'+data[key].excerptDir+'</div>';
		html.append('<li class="item clear">'+thumbnailHtml+descriptionHtml+'</li>');
		if(i <= limit){
			i++;
		} else {
			break;
		}
	};
	ajaxContent = $('<div class="ajax-content"></div>').html(title).append(html);
	contentDiv.find('>').hide();
	contentDiv.append(ajaxContent);
}

// reset search ajax values
$('#directory-search .reset-ajax').click(function () {
	ajaxGetMarkers(false,false,false,false,true);
	{if isset($themeOptions->search->interactiveReplaceContent) && ($themeOptions->search->interactiveReplaceContent == 'enabled') }
	contentDiv.find('.ajax-content').remove();
	contentDiv.find('>').show();
	{/if}
	$('#dir-searchinput-text').val('');
	$('#dir-searchinput-location').val("");
	$('#dir-searchinput-location-id').val("0");
	$('#dir-searchinput-category').val("");
	$('#dir-searchinput-category-id').val("0");
	$('#dir-searchinput-geo').attr('checked',false);
	$('div.iphone-style[rel=dir-searchinput-geo]').removeClass('on').addClass('off');
	//$('#dir-searchinput-geo-radius').val($('#dir-searchinput-geo-radius').data('default-value'));
	$(this).hide();
});

