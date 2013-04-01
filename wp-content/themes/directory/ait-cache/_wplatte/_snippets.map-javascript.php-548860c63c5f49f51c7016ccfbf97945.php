<?php //netteCache[01]000494a:2:{s:4:"time";s:21:"0.82259000 1364844338";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:104:"C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\snippets\map-javascript.php";i:2;i:1363207042;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\snippets\map-javascript.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'qv16utu9v8')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if (!empty($items)): ?>
<script type="text/javascript">
	var mapDiv,
		map,
		infobox;
	jQuery(document).ready(function($) {
		mapDiv = $("#directory-main-bar");
		mapDiv.height(<?php echo $themeOptions->directoryMap->mapHeight ?>).gmap3({
			map: {
				options: {
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(parseMapOptions($themeOptions->directoryMap)) as $key => $value): ?>
					<?php if ($iterator->first): echo NTemplateHelpers::escapeJs($key) ?>: <?php echo $value ;else: ?>
,<?php echo NTemplateHelpers::escapeJs($key) ?>: <?php echo $value ;endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ;if ((count($items) == 1) && (!isset($isGeolocation))): ?>
					,center: [<?php if ($items[0]->optionsDir['gpsLatitude']): echo $items[0]->optionsDir['gpsLatitude'] ;else: ?>
0<?php endif ?>,<?php if ($items[0]->optionsDir['gpsLongitude']): echo $items[0]->optionsDir['gpsLongitude'] ;else: ?>
0<?php endif ?>]
					,zoom: <?php echo $themeOptions->directory->setZoomIfOne ?>

<?php endif ?>
				}
			}
<?php if (isset($isGeolocation)): ?>
			,getgeoloc:{
				callback : function(latLng){

					if (latLng){
						$(this).gmap3({
							map:{
								options:{
									center: latLng,
									zoom: 5
								}
							}
						});
						ajaxGetMarkers(false,latLng);
					}

				}
			}
<?php else: ?>
			,marker: {
				values: [
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($items) as $item): ?>
						{
							latLng: [<?php if ($item->optionsDir['gpsLatitude']): echo $item->optionsDir['gpsLatitude'] ;else: ?>
0<?php endif ?>,<?php if ($item->optionsDir['gpsLongitude']): echo $item->optionsDir['gpsLongitude'] ;else: ?>
0<?php endif ?>],
							options: {
								icon: "<?php echo $item->marker ?>",
								shadow: "<?php echo $themeOptions->directoryMap->mapMarkerImageShadow ?>",
							},
							data: '<div class="marker-holder"><div class="marker-content<?php if (isset($item->thumbnailDir)): ?>
 with-image"><img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $item->thumbnailDir, 'w' => 120, 'h' => 160), "", "&amp;") ?>
" alt=""><?php else: ?>"><?php endif ?><div class="map-item-info"><div class="title">'+<?php if (isset($item->post_title)): echo NTemplateHelpers::escapeJs($item->post_title) ?>
+<?php endif ?>'</div><div class="address">'+<?php if (isset($item->optionsDir["address"])): echo NTemplateHelpers::escapeJs($template->nl2br($item->optionsDir["address"])) ?>
+<?php endif ?>'</div><a href="<?php echo $item->link ?>" class="more-button">' + <?php echo NTemplateHelpers::escapeJs(__('VIEW MORE', 'ait')) ?> + '</a></div><div class="arrow"></div><div class="close"></div></div></div></div>'
						}
					<?php if (!($iterator->last)): ?>,<?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
				],
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
			<?php endif ?> 		}<?php if ((count($items) > 1) && (!isset($isGeolocation))): ?>
,"autofit"<?php endif ?>);

		map = mapDiv.gmap3("get");
        infobox = new InfoBox({
        	pixelOffset: new google.maps.Size(-50, -65),
        	closeBoxURL: '',
        	enableEventPropagation: true
        });
        mapDiv.delegate('.infoBox .close','click',function () {
        	infobox.close();
        });

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

<?php NCoreMacros::includeTemplate('ajaxfunctions-javascript.php', $template->getParams(), $_l->templates['qv16utu9v8'])->render() ?>

	});
</script>
<?php endif ;
