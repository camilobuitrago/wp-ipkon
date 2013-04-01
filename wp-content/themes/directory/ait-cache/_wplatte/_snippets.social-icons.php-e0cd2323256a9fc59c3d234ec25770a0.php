<?php //netteCache[01]000492a:2:{s:4:"time";s:21:"0.72027600 1364843416";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:102:"C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\snippets\social-icons.php";i:2;i:1353447190;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\snippets\social-icons.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'gqvgk67een')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if (isset($themeOptions->socialIcons->displayIcons)): if (isset($themeOptions->socialIcons->icons)): ?>
    <ul class="social-icons right clearfix">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($themeOptions->socialIcons->icons) as $icon): ?>
        <li class="left"><a href="<?php if (!empty($icon->link)): echo htmlSpecialChars($icon->link) ;else: ?>
#<?php endif ?>"><img src="<?php echo htmlSpecialChars($icon->iconUrl) ?>" height="24" width="24" alt="<?php echo htmlSpecialChars($icon->title) ?>
" title="<?php echo htmlSpecialChars($icon->title) ?>" /></a></li>
<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
    </ul>
<?php endif ;endif ;
