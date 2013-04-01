<?php //netteCache[01]000475a:2:{s:4:"time";s:21:"0.46191600 1364843415";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:86:"C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\index.php";i:2;i:1358546008;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\index.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'qzo3fn8d0z')
;//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbe1be802967_content')) { function _lbe1be802967_content($_l, $_args) { extract($_args)
?>

<?php if ($posts): ?>
	
<?php if ($type): ?>

<?php NCoreMacros::includeTemplate("snippets/content-loop-dir-search.php", array('posts' => $posts) + $template->getParams(), $_l->templates['qzo3fn8d0z'])->render() ?>

<?php if($GLOBALS["wp_query"]->max_num_pages > 1): ?>
		<nav class="paginate-links">
			<?php echo WpLatteFunctions::paginateLinks(true) ?>

		</nav>
<?php endif ?>

<?php else: ?>

<?php if (!$isIndexPage): ?>
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
		</article><!-- /#post-<?php echo NTemplateHelpers::escapeHtmlComment($post->id) ?> -->	
<?php endif ?>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-above') + $template->getParams(), $_l->templates['qzo3fn8d0z'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-loop.php", array('posts' => $posts) + $template->getParams(), $_l->templates['qzo3fn8d0z'])->render() ?>

<?php NCoreMacros::includeTemplate("snippets/content-nav.php", array('location' => 'nav-below') + $template->getParams(), $_l->templates['qzo3fn8d0z'])->render() ?>

<?php endif ?>

<?php if (isset($themeOptions->advertising->showBox4)): ?>
	<div id="advertising-box-4" class="advertising-box">
	    <?php echo $themeOptions->advertising->box4Content ?>

	</div>
<?php endif ?>

<?php else: ?>

<?php NCoreMacros::includeTemplate("snippets/nothing-found.php", $template->getParams(), $_l->templates['qzo3fn8d0z'])->render() ?>

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
