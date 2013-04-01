{extends $layout}

{block content}

{include 'snippets/map-javascript.php'}

<article id="post-item-category">

	<header class="entry-header">
	
		<h1 class="entry-title">
			<span>{!$term->name}</span>
		</h1>

		<div class="category-breadcrumb clearfix">
			<span class="here">{__ 'You are here:'}</span>
			<span class="home"><a href="{!$homeUrl}">{__ 'Home'}</a>&nbsp;&nbsp;></span>
			{foreach $ancestors as $anc}
			{first}<span class="ancestors">{/first}
				<a href="{!$anc->link}">{!$anc->name}</a>&nbsp;&nbsp;>
			{last}</span>{/last}
			{/foreach}
			<span class="name"><a href="{!$term->link}">{!$term->name}</a></span>
		</div>

	</header>

	<div class="entry-content">
		{!$term->description}
	</div>

	<div class="category-subcategories clearfix">
		{foreach $subcategories as $category}
		{first}<ul class="subcategories">{/first}
			<li class="category">
				<div class="category-wrap-table">
					<div class="category-wrap-row">
						<div class="icon" style="background: url('{timthumb src => $category->icon, w => 35, h => 35 }') no-repeat center top;"></div>
						<div class="description">
							<h3><a href="{!$category->link}">{!$category->name}</a></h3>
							{!$category->excerpt}
						</div>
					</div>
				</div>
			</li>
		{last}</ul>{/last}
		{/foreach}
	</div>

	<hr>

	<div class="category-items clearfix">
		{foreach $posts as $item}
		{first}<ul class="items">{/first}
			<li class="item clear{ifset $item->packageClass} {$item->packageClass}{/ifset}">
				{if $item->thumbnailDir}
				<div class="thumbnail">
					<img src="{timthumb src => $item->thumbnailDir, w => 100, h => 100}" alt="{__ 'Item thumbnail'}">
					<div class="comment-count">{$item->commentsCount}</div>
				</div>
				{/if}
				
				<div class="description">
					<h3><a href="{!$item->link}">{$item->title}</a></h3>
					{!$item->excerpt}
				</div>
			</li>
		{last}</ul>{/last}
		{/foreach}
	</div>
	
	{willPaginate}
	<nav class="paginate-links">
		{paginateLinks true}
	</nav>
{/willPaginate}

</article><!-- /#post-item-category -->

{ifset $themeOptions->advertising->showBox4}
<div id="advertising-box-4" class="advertising-box">
    {!$themeOptions->advertising->box4Content}
</div>
{/ifset}

{/block}