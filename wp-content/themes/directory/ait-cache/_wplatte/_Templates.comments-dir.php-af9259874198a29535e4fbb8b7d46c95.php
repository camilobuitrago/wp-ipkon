<?php //netteCache[01]000482a:2:{s:4:"time";s:21:"0.60270300 1364844460";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:93:"C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\comments-dir.php";i:2;i:1363106272;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\comments-dir.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'dpi1drlsh1')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
if ($post->hasOpenComments): if (isset($themeOptions->advertising->showBox3)): ?>
<div id="advertising-box-3" class="advertising-box">
    <?php echo $themeOptions->advertising->box3Content ?>

</div>
<?php endif ;endif ?>

<?php if (isset($closeable) && ($post->hasOpenComments)): ?>
<div class="closeable">
	<div class="open-button item <?php if ($defaultState == 'opened'): ?>comments-opened<?php else: ?>
comments-closed<?php endif ?>">
<?php if ($defaultState == 'opened'): ?>
			<?php echo NTemplateHelpers::escapeHtml(__("Close Reviews", 'ait'), ENT_NOQUOTES) ?>

<?php else: ?>
			<?php echo NTemplateHelpers::escapeHtml(__("Show Reviews", 'ait'), ENT_NOQUOTES) ?>

<?php endif ?>
	</div>
<?php endif ?>

<div id="comments">
<?php if (!$post->isPasswordRequired): ?>

<?php if ($post->comments): ?>

	<h2 id="comments-title">
		<?php echo NTemplateHelpers::escapeHtml(_n('Review', 'Reviews', $post->commentsCount, 'ait'), ENT_NOQUOTES) ?>
 (<?php echo NTemplateHelpers::escapeHtml($post->commentsCount, ENT_NOQUOTES) ?>)
	</h2>

<?php NCoreMacros::includeTemplate("snippets/comments-pagination.php", array('location' => 'above') + $template->getParams(), $_l->templates['dpi1drlsh1'])->render() ?>

<?php 
			$a = array('comments' => $post->comments);
			$depth = 1;
			if(isset($a["begin"]))
				echo $a["begin"];
			else
				echo "<ol class=\"commentlist\">";

			if(isset($a["childrenClass"]))
				$children = " class=\"$a[childrenClass]\"";
			else
				$children = " class=\"children\"";

			$iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($a["comments"]) as $comment):
				if ($comment->depth > $depth){
					echo "<ul{$children}>";
					$depth = $comment->depth;
				}elseif($comment->depth == $depth and !$iterator->isFirst()){
					echo "</li>";
				}elseif($comment->depth < $depth){
					echo "</li>";
					echo str_repeat("</ul></li>", $depth - $comment->depth);
					$depth = $comment->depth;
				}
			 if ($comment->type == 'pingback' or $comment->type == 'trackback'): ?>
		<li class="post pingback">
			<p>
			<?php echo NTemplateHelpers::escapeHtml(__('Pingback', 'ait'), ENT_NOQUOTES) ?>

			<?php echo $comment->author->link ?>

<?php WpLatteFunctions::editCommentLink(__("Edit", "ait"), $comment->id, "<span class=\"edit-link\">", "</span>") ?>
			</p>
<?php else: ?>

		<li class="<?php echo htmlSpecialChars($comment->classes) ?>">

			<article id="comment-<?php echo htmlSpecialChars($comment->id) ?>" class="comment">

				<div class="left controls clearfix">
					<div class="comment-avatar"><?php echo $comment->author->avatar ?></div>
				</div>

				<div class="body clearfix">
					<div class="arrow left"><!--  --></div>
					<div class="content ">
						<div>
							<span class="author vcard"><cite class="fn"><?php echo $comment->author->nameWithLink ?>
</cite></span><span class="eh">&nbsp;&nbsp;|&nbsp;&nbsp;</span><span class="date"><a href="<?php echo htmlSpecialChars($comment->url) ?>
" class="comment-date"><time pubdate datetime="<?php echo htmlSpecialChars($template->date($comment->date, 'c')) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->date($comment->date, $site->dateFormat), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml(_x('at', 'comment publish time', 'ait'), ENT_NOQUOTES) ?>
 <?php echo NTemplateHelpers::escapeHtml($template->date($comment->date, $site->timeFormat), ENT_NOQUOTES) ?></time></a></span>

							<div class="reply">
								<?php ob_start() ?> <?php echo __('Reply <span>&darr;</span>', 'ait') ?>
 <?php $replyTitle = ob_get_clean() ?>

<?php 
				$a = array($replyTitle, $comment->args, $comment->depth, $comment->id);
				comment_reply_link(array_merge(
					$a[1],
					array(
						"reply_text" => $a[0],
						"depth" => $a[2],
						"max_depth" => $a[1]["max_depth"]
					)
				), $a[3]); unset($a) ?>
							</div>
<?php WpLatteFunctions::editCommentLink(__("Edit", "ait"), $comment->id, "<span class=\"edit-link\">", "</span>") ?>
						</div>

<?php if (!$comment->approved): ?>
							<em class="comment-awaiting-moderation"><?php echo NTemplateHelpers::escapeHtml(__('Your review is awaiting moderation.', 'ait'), ENT_NOQUOTES) ?></em><br />
<?php endif ?>
						<?php echo $comment->content ?>

					</div>
				</div>

			</article>
<?php endif ;
			$iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its);
			echo "</li>";
			echo str_repeat("</ul></li>", $depth - 1);
			if(isset($a["end"]))
				echo $a["end"];
			else
				echo "</ol>" ?>

<?php NCoreMacros::includeTemplate("snippets/comments-pagination.php", array('location' => 'below') + $template->getParams(), $_l->templates['dpi1drlsh1'])->render() ?>

<?php elseif (!$post->hasOpenComments && $post->type != 'page' && $post->hasSupportFor('comments')): ?>

	<p class="nocomments"><?php echo NTemplateHelpers::escapeHtml(__('Reviews are closed.', 'ait'), ENT_NOQUOTES) ?></p>

<?php endif ?>

<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('Review', 'noun', 'ait'), ENT_NOQUOTES) ;$reviewNoun = ob_get_clean() ?>

<?php ob_start() ;echo $template->printf(__('You must be <a href="%s">logged in</a> to post a review.', 'ait'), wp_login_url(apply_filters('the_permalink', get_permalink()))) ;$reviewLoggedIn = ob_get_clean() ?>

<?php ob_start() ;echo NTemplateHelpers::escapeHtml(__('Leave a Review', 'ait'), ENT_NOQUOTES) ;$reviewLeave = ob_get_clean() ?>

<?php ob_start() ;echo NTemplateHelpers::escapeHtml(__('Leave a Review to %s', 'ait'), ENT_NOQUOTES) ;$reviewReplyTo = ob_get_clean() ?>

<?php ob_start() ;echo NTemplateHelpers::escapeHtml(__('Cancel review', 'ait'), ENT_NOQUOTES) ;$reviewCancel = ob_get_clean() ?>

<?php ob_start() ;echo NTemplateHelpers::escapeHtml(__('Post Review', 'ait'), ENT_NOQUOTES) ;$reviewPost = ob_get_clean() ?>


<?php comment_form(array('comment_field' => '<p class="comment-form-comment"><label for="comment">' . $reviewNoun . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
	'must_log_in' => '<p class="must-log-in">' .  $reviewLoggedIn . '</p>',
	'title_reply' => $reviewLeave,
	'title_reply_to' => $reviewReplyTo,
	'cancel_reply_link' => $reviewCancel,
	'label_submit' => $reviewPost)) ?>

<?php else: ?>
	<p class="nopassword"><?php echo NTemplateHelpers::escapeHtml(__('This post is password protected. Enter the password to view any reviews.', 'ait'), ENT_NOQUOTES) ?></p>
<?php endif ?>
</div><!-- #comments -->

<?php if (isset($closeable) && ($post->hasOpenComments)): ?>
</div> 			<!-- /.closeable -->
<?php endif ;
