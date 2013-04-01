<?php //netteCache[01]000501a:2:{s:4:"time";s:21:"0.30747400 1364844460";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:111:"C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\snippets\map-single-javascript.php";i:2;i:1363204502;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\snippets\map-single-javascript.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'xzsayyvsvk')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<script type="text/javascript">
	var map,
		mapDiv,
		smallMapDiv,
		infobox;

	jQuery(document).ready(function($) {
		mapDiv = $("#directory-main-bar");
		smallMapDiv = $(".item-map");

		smallMapDiv.width(300).height(300).gmap3({
			map: {
				options: {
					center: [<?php echo NTemplateHelpers::escapeJs($options['gpsLatitude']) ?>, <?php echo NTemplateHelpers::escapeJs($options['gpsLongitude']) ?>],
					zoom: 18
				}
			},
			marker: {
				values: [
					{
						latLng: [<?php echo NTemplateHelpers::escapeJs($options['gpsLatitude']) ?>
, <?php echo NTemplateHelpers::escapeJs($options['gpsLongitude']) ?>]
					}
				]
			}
		});

		mapDiv.height(<?php echo $themeOptions->directoryMap->mapHeight ?>).gmap3({
			map: {
				options: {
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(parseMapOptions($themeOptions->directoryMap)) as $key => $value): ?>
					<?php if ($iterator->first): echo NTemplateHelpers::escapeJs($key) ?>: <?php echo $value ;else: ?>
,<?php echo NTemplateHelpers::escapeJs($key) ?>: <?php echo $value ;endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;if (count($items) <= 1): ?>
					,center: [<?php echo NTemplateHelpers::escapeJs($options['gpsLatitude']) ?>
, <?php echo NTemplateHelpers::escapeJs($options['gpsLongitude']) ?>]
					,zoom: <?php echo $themeOptions->directory->setZoomIfOne ?>

<?php endif ?>
				}

			},
			marker: {
				values: [
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($items) as $item): ?>
						{
							latLng: [<?php if (isset($item->optionsDir['gpsLatitude'])): echo $item->optionsDir['gpsLatitude'] ;else: ?>
0<?php endif ?>,<?php if (isset($item->optionsDir['gpsLongitude'])): echo $item->optionsDir['gpsLongitude'] ;else: ?>
0<?php endif ?>],
							options: {
								icon: "<?php echo $item->marker ?>",
								shadow: "<?php echo $themeOptions->directoryMap->mapMarkerImageShadow ?>",
							},
							data: '<div class="marker-holder"><div class="marker-content<?php if (!empty($item->thumbnailDir)): ?>
 with-image"><img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $item->thumbnailDir, 'w' => 120, 'h' => 160), "", "&amp;") ?>
" alt=""><?php else: ?>"><?php endif ?><div class="map-item-info"><div class="title">'+<?php if (isset($item->post_title)): echo NTemplateHelpers::escapeJs($item->post_title) ?>
+<?php endif ?>'</div><div class="address">'+<?php if (isset($item->optionsDir["address"])): echo NTemplateHelpers::escapeJs($template->nl2br($item->optionsDir["address"])) ?>
+<?php endif ?>'</div><a href="<?php echo $item->link ?>" class="more-button">' + <?php echo NTemplateHelpers::escapeJs(__('VIEW MORE', 'ait')) ?> +'</a></div><div class="arrow"></div><div class="close"></div></div></div></div>',
							tag: "marker-<?php echo $item->ID ?>"
						}
					<?php if (!($iterator->last)): ?>,<?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
				],
				options:{
					draggable: false
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
<?php if (isset($isGeolocation)): ?>
			,getgeoloc:{
				callback : function(latLng){

					$(this).gmap3({
						marker: {
			    			latLng: latLng,
			    			options: {
			    				animation: google.maps.Animation.DROP
			    			}
			    		}
			    	});

				}
			}
<?php endif ;if (isset($options['showStreetview'])): ?>
			,streetviewpanorama:{
				options: {
					container: mapDiv,
					opts:{
						position: [parseFloat(<?php echo NTemplateHelpers::escapeJs($options['streetViewLatitude']) ?>
),parseFloat(<?php echo NTemplateHelpers::escapeJs($options['streetViewLongitude']) ?>)],
						pov: {
							heading: parseFloat(<?php echo NTemplateHelpers::escapeJs($options['streetViewHeading']) ?>),
							pitch: parseFloat(<?php echo NTemplateHelpers::escapeJs($options['streetViewPitch']) ?>),
							zoom: parseInt(<?php echo NTemplateHelpers::escapeJs($options['streetViewZoom']) ?>)
						},
						scrollwheel : <?php if (isset($themeOptions->directoryMap->scrollwheel)): ?>
true<?php else: ?>false<?php endif ?>,
						enableCloseButton : true
					}
				}
			}
<?php endif ?>
		}<?php if (count($items) > 1): ?>,"autofit"<?php endif ?>);

		map = mapDiv.gmap3("get");
        infobox = new InfoBox({
        	pixelOffset: new google.maps.Size(-50, -65),
        	closeBoxURL: '',
        	enableEventPropagation: true
        });
        mapDiv.delegate('.infoBox .close','click',function () {
        	infobox.close();
        });

        var currMarker = mapDiv.gmap3({ get: { name: "marker", tag: "marker-<?php echo $post->id ?>"}});
        infobox.setContent('<div class="marker-holder"><div class="marker-content<?php if (!empty($thumbnailDir)): ?>
 with-image"><img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $thumbnailDir, 'w' => 120, 'h' => 160), "", "&amp;") ?>
" alt=""><?php else: ?>"><?php endif ?><div class="map-item-info"><div class="title">'+<?php echo NTemplateHelpers::escapeJs($post->title) ?>
+'</div><div class="address">'+<?php if (isset($options["address"])): echo NTemplateHelpers::escapeJs($template->nl2br($options["address"])) ?>
+<?php endif ?>'</div><a href="<?php echo $post->link ?>" class="more-button">' + <?php echo NTemplateHelpers::escapeJs(__('VIEW MORE', 'ait')) ?> + '</a></div><div class="arrow"></div><div class="close"></div></div></div></div>');
        infobox.open(map,currMarker);
<?php if (count($items) > 1): ?>
        map.panTo(new google.maps.LatLng(<?php echo $options['gpsLatitude'] ?>, <?php echo $options['gpsLongitude'] ?>));
<?php endif ?>

        if(isTouchDevice()){
        	<?php if (isset($themeOptions->directoryMap->draggableForTouch)): ?>map.setOptions({ draggable : true });<?php else: ?>
map.setOptions({ draggable : false });<?php endif ?>

<?php if (isset($themeOptions->directoryMap->draggableToggleButton)): ?>
	        var draggableClass = <?php if (isset($themeOptions->directoryMap->draggableForTouch)): ?>
'active'<?php else: ?>'inactive'<?php endif ?>;
	        var draggableTitle = <?php if (isset($themeOptions->directoryMap->draggableForTouch)): echo NTemplateHelpers::escapeJs(__('Deactivate map', 'ait')) ;else: echo NTemplateHelpers::escapeJs(__('Activate map', 'ait')) ;endif ?>;
	        var draggableButton = $('<div class="draggable-toggle-button '+draggableClass+'">'+draggableTitle+'</div>').appendTo(mapDiv);
	        draggableButton.click(function () {
	        	if($(this).hasClass('active')){
	        		$(this).removeClass('active').addClass('inactive').text(<?php echo NTemplateHelpers::escapeJs(__('Activate map', 'ait')) ?>);
	        		map.setOptions({ draggable : false });
	        	} else {
	        		$(this).removeClass('inactive').addClass('active').text(<?php echo NTemplateHelpers::escapeJs(__('Deactivate map', 'ait')) ?>);
	        		map.setOptions({ draggable : true });
	        	}
	        });
<?php endif ?>
	    }

<?php NCoreMacros::includeTemplate('ajaxfunctions-javascript.php', $template->getParams(), $_l->templates['xzsayyvsvk'])->render() ?>

	});
</script>