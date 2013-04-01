<?php //netteCache[01]000483a:2:{s:4:"time";s:21:"0.01797700 1364844337";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:94:"C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\page-dir-home.php";i:2;i:1358546008;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\page-dir-home.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, '2cram1phxo')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbf18744f681_content')) { function _lbf18744f681_content($_l, $_args) { extract($_args)
?>

<?php if ($post->options('header')->headerType == 'map'): NCoreMacros::includeTemplate('snippets/map-javascript.php', $template->getParams(), $_l->templates['2cram1phxo'])->render() ;endif ?>

<article id="post-<?php echo htmlSpecialChars($post->id) ?>" class="<?php echo htmlSpecialChars($post->htmlClasses) ?>">

	<header class="entry-header">
		
		<h1 class="entry-title">
			<a href="<?php echo htmlSpecialChars($post->permalink) ?>" title="<?php echo htmlSpecialChars(__('Permalink to', 'ait')) ?>
 <?php echo htmlSpecialChars($post->title) ?>" rel="bookmark"><?php echo NTemplateHelpers::escapeHtml($post->title, ENT_NOQUOTES) ?></a>
		</h1>

	</header>
	
<?php if ($post->thumbnailSrc): ?>
	<a href="<?php echo $post->thumbnailSrc ?>">
		<div class="entry-thumbnail"><img src="<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $post->thumbnailSrc, 'w' => 140, 'h' => 200), "", "&amp;") ?>" alt="" /></div>
	</a>
<?php endif ?>

	<div class="entry-content">
		<?php echo $post->content ?>

	</div>
	
<?php if (isset($themeOptions->directory->showTopCategories)): ?>
	<div class="category-subcategories clearfix">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($subcategories) as $category): ?>
		<?php if ($iterator->isFirst()): ?><ul class="subcategories"><?php endif ?>

			<li class="category">
				<div class="category-wrap-table">
					<div class="category-wrap-row">
						<div class="icon" style="background: url('<?php echo TIMTHUMB_URL . "?" . http_build_query(array('src' => $category->icon, 'w' => 35, 'h' => 35), "", "&amp;") ?>') no-repeat center top;"></div>
						<div class="description">
							<h3><a href="<?php echo $category->link ?>"><?php echo $category->name ?></a></h3>
							<?php echo $category->excerpt ?>

						</div>
					</div>
				</div>
			</li>
		<?php if ($iterator->isLast()): ?></ul><?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
	</div>
<?php endif ?>
	
<?php if ($themeOptions->directory->dirHomepageAltContent): ?>
	<div class="alternative-content">
		<?php echo $themeOptions->directory->dirHomepageAltContent ?>

	</div>
<?php endif ?>

</article><!-- /#post-<?php echo NTemplateHelpers::escapeHtmlComment($post->id) ?> -->

<?php if (isset($themeOptions->advertising->showBox4)): ?>
<div id="advertising-box-4" class="advertising-box">
    <?php echo $themeOptions->advertising->box4Content ?>

</div>
<?php endif ?>

<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = true; unset($_extends, $template->_extends);


if ($_l->extends) {
	ob_start();
} elseif (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
$_l->extends = $layout ?>

<?php 
// template extending support
if ($_l->extends) {
	ob_end_clean();
	NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render();
}
