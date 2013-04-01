{foreach $posts as $item}
{first}<ul class="items">{/first}
	<li class="item clear{ifset $item->packageClass} {$item->packageClass}{/ifset}">
		{if $item->thumbnailDir}
		<div class="thumbnail">
			<img src="{timthumb src => $item->thumbnailDir, w => 100, h => 100}" alt="{__ 'Item thumbnail'}">
			<div class="comment-count">{$item->comment_count}</div>
		</div>
		{/if}
		
		<div class="description">
			<h3><a href="{!$item->link}">{$item->post_title}</a></h3>
			{!$item->excerptDir}
		</div>
	</li>
{last}</ul>{/last}
{/foreach}
