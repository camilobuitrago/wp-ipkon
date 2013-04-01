{extends $layout}

{block content}

<article id="post-{$post->id}" class="{$post->htmlClasses}">

	<header class="entry-header">

		<h1 class="entry-title">
			<a href="{$post->permalink}" title="Permalink to {$post->title}" rel="bookmark">{$post->title}</a>
		</h1>
		
		<div class="category-breadcrumb clearfix">
			<span class="here">{__ 'You are here'}</span>
			<span class="home"><a href="{!$homeUrl}">{__ 'Home'}</a>&nbsp;&nbsp;></span>
			{foreach $ancestors as $anc}
				{first}<span class="ancestors">{/first}
				<a href="{!$anc->link}">{!$anc->name}</a>&nbsp;&nbsp;>
				{last}</span>{/last}
			{/foreach}
			{ifset $term}<span class="name"><a href="{!$term->link}">{!$term->name}</a></span>{/ifset}
			<span class="title"> >&nbsp;&nbsp;{$post->title}</span>
		</div>

	</header>

	<div class="entry-content clearfix">
		{if $post->thumbnailSrc}
		<div class="item-image">
			<img src="{timthumb src => $post->thumbnailSrc, w => 140, h => 200}" alt="{__ 'Item image'}">
		</div>
		{/if}
		
		{!$post->content}
	</div>

	{ifset $themeOptions->directory->showShareButtons}
	<div class="item-share">
		<!-- facebook -->
		<div class="social-item fb">
			<iframe src="//www.facebook.com/plugins/like.php?href={$post->permalink}&amp;send=false&amp;layout=button_count&amp;width=113&amp;show_faces=true&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:113px; height:21px;" allowTransparency="true"></iframe>
		</div>
		<!-- twitter -->
		<div class="social-item">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="{$post->permalink}" data-text="{$themeOptions->directory->shareText} {$post->permalink}" data-lang="en">Tweet</a>
			<script>!function(d,s,id){ var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){ js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<!-- google plus -->
		<!-- Place this tag where you want the +1 button to render. -->
		<div class="social-item">
			<div class="g-plusone"></div>
			<!-- Place this tag after the last +1 button tag. -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>

	</div>
	{/ifset}

	<hr>
	<div class="item-info">
		
		{if $options['address'] || $options['gpsLatitude'] || $options['telephone'] || $options['email'] || $options['web']}
		<dl class="item-address">
			
			<dt class="title"><h4>{__ 'Our address'}</h4></dt> 
			
			{if $options['address']}
		    <dt class="address">{__ 'Address:'}</dt>
		    <dd class="data">{!$options['address']}</dd>
		    {/if}
		     
		    {if $options['gpsLatitude']}        
		    <dt class="gps">{__ 'GPS:'}</dt>
		    <dd class="data">{$options['gpsLatitude']}, {$options['gpsLongitude']}</dd>
		    {/if}
		    
		    {if $options['telephone']}
		    <dt class="phone">{__ 'Telephone:'}</dt>
		    <dd class="data">{$options['telephone']}</dd>
		    {/if}
		    
		    {if $options['email']}         
		    <dt class="email">{__ 'Email:'} </dt>
		    <dd class="data"><a href="mailto:{!$options['email']}">{!$options['email']}</a></dd>
		    {/if}

		    {if $options['web']} 
		    <dt class="web">{__ 'Web:'} </dt>
		    <dd class="data"><a href="{!$options['web']}">{!$options['web']}</a></dd>
		    {/if}
		    
		</dl>
		{/if}

		{if $options['hoursMonday'] || $options['hoursTuesday'] || $options['hoursWednesday'] || $options['hoursThursday'] || $options['hoursFriday'] || $options['hoursSaturday'] || $options['hoursSunday']}     
		<dl class="item-hours">
			
			<dt class="title"><h4>{__ 'Opening Hours'}</h4></dt> 
			
			{if $options['hoursMonday']}
		    <dt class="day">{__ 'Monday:'}</dt>
		    <dd class="data">{!$options['hoursMonday']}</dd>
		    {/if}
		    
		    {if $options['hoursTuesday']}
		    <dt class="day">{__ 'Tuesday:'}</dt>
		    <dd class="data">{!$options['hoursTuesday']}</dd>
		    {/if}
		    
		    {if $options['hoursWednesday']}
		    <dt class="day">{__ 'Wednesday:'}</dt>
		    <dd class="data">{!$options['hoursWednesday']}</dd>
		    {/if}
		    
		    {if $options['hoursThursday']}
		    <dt class="day">{__ 'Thursday:'}</dt>
		    <dd class="data">{!$options['hoursThursday']}</dd>
		    {/if}
		    
		    {if $options['hoursFriday']}
		    <dt class="day">{__ 'Friday:'}</dt>
		    <dd class="data">{!$options['hoursFriday']}</dd>
		    {/if}

		    {if $options['hoursSaturday']}
		    <dt class="day">{__ 'Saturday:'}</dt>
		    <dd class="data">{!$options['hoursSaturday']}</dd>
		    {/if}
		    
		    {if $options['hoursSunday']}
		    <dt class="day">{__ 'Sunday:'}</dt>
		    <dd class="data">{!$options['hoursSunday']}</dd>
		    {/if}
		    
		</dl>
		{/if}

	</div>
	
	<div class="item-map clearfix">
	</div>

	<hr>

</article><!-- /#post-{$post->id} -->

{include comments-dir.php, closeable => $themeOptions->general->closeComments, defaultState => $themeOptions->general->defaultPosition}

{ifset $themeOptions->advertising->showBox4}
<div id="advertising-box-4" class="advertising-box">
    {!$themeOptions->advertising->box4Content}
</div>
{/ifset}

{/block}