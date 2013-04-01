<?php //netteCache[01]000476a:2:{s:4:"time";s:21:"0.47286700 1364843417";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:87:"C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\footer.php";i:2;i:1358546008;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\footer.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'zfcp0zmobi')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
		<footer id="colophon" role="contentinfo">
			
			<div id="supplementary" class="widgets defaultContentWidth">
				
<?php if(is_active_sidebar("footer-widgets")): ?>
				<div id="footer-widgets" class="widget-area" role="complementary">
<?php dynamic_sidebar('footer-widgets') ?>
				</div>
<?php endif ?>

			</div>

			<div id="site-generator" class="clearfix">
				<div class="defaultContentWidth">
					<div id="footer-text">
						<?php echo $themeOptions->general->footer_text ?>

					</div>
<?php wp_nav_menu(array('theme_location' => 'footer-menu', 'fallback_cb' => 'default_footer_menu', 'container' => 'nav', 'container_class' => 'footer-menu', 'menu_class' => 'menu', 'depth' => 1)) ?>
				</div>
			</div>

		</footer>

	</div><!-- #page -->

<?php wp_footer() ?>

<?php if (isset($themeOptions->general->ga_code) && ($themeOptions->general->ga_code!="")): ?>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', <?php echo NTemplateHelpers::escapeJs($themeOptions->general->ga_code) ?>]);
		_gaq.push(['_trackPageview']);

		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
<?php endif ?>

</body>
</html>