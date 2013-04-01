<!doctype html>

<!--[if IE 8]><html class="no-js oldie ie8 ie" lang="{$site->language}"><![endif]-->
<!--[if gte IE 9]><!--><html class="no-js" lang="{$site->language}"><!--<![endif]-->

    <head>
        <meta charset="{$site->charset}">
        {mobileDetectionScript}
        <meta name="Author" content="AitThemes.com, http://www.ait-themes.com">

        <title>{title}</title>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="{$site->pingbackUrl}">

        {if $themeOptions->fonts->fancyFont->type == 'google'}
        <link href="http://fonts.googleapis.com/css?family={$themeOptions->fonts->fancyFont->font}" rel="stylesheet" type="text/css">
        {/if}

        <link id="ait-style" rel="stylesheet" type="text/css" media="all" href="{less}">

        {head}

        <script>
          'article aside footer header nav section time'.replace(/\w+/g,function(n){ document.createElement(n) })
        </script>

        <script type="text/javascript">
        jQuery(document).ready(function($) {
            var categories = [
            {foreach $categories as $cat}
                { value: {$cat->term_id}, label: {$cat->name} }{if !($iterator->last)},{/if}
            {/foreach}
            ];
            var locations = [
            {foreach $locations as $loc}
                { value: {$loc->term_id}, label: {$loc->name} }{if !($iterator->last)},{/if}
            {/foreach}
            ];
            var catInput = $( "#dir-searchinput-category" ),
                catInputID = $( "#dir-searchinput-category-id" ),
                locInput = $( "#dir-searchinput-location" ),
                locInputID = $( "#dir-searchinput-location-id" );

            catInput.autocomplete({
                minLength: 0,
                source: categories,
                focus: function( event, ui ) {
                    catInput.val( ui.item.label.replace(/&amp;/g, "&") );
                    return false;
                },
                select: function( event, ui ) {
                    catInput.val( ui.item.label.replace(/&amp;/g, "&") );
                    catInputID.val( ui.item.value );
                    return false;
                }
            }).data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "</a>" )
                    .appendTo( ul );
            };
            var catList = catInput.autocomplete( "widget" );
            catList.niceScroll({ autohidemode: false });

            catInput.click(function(){
                catInput.val('');
                catInputID.val('0');
                catInput.autocomplete( "search", "" );
            });

            locInput.autocomplete({
                minLength: 0,
                source: locations,
                focus: function( event, ui ) {
                    locInput.val( ui.item.label.replace(/&amp;/g, "&") );
                    return false;
                },
                select: function( event, ui ) {
                    locInput.val( ui.item.label.replace(/&amp;/g, "&") );
                    locInputID.val( ui.item.value );
                    return false;
                },
                open: function(event, ui) {

                }
            }).data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                    .data( "item.autocomplete", item )
                    .append( "<a>" + item.label + "</a>" )
                    .appendTo( ul );
            };
            var locList = locInput.autocomplete( "widget" );
            locList.niceScroll({ autohidemode: false });

            locInput.click(function(){
                locInput.val('');
                locInputID.val('0');
                locInput.autocomplete( "search", "" );
            });

            {ifset $isDirSearch}
            catInputID.val({$_GET["categories"]});
            for(var i=0;i<categories.length;i++){
                if(categories[i].value == {$_GET["categories"]}) catInput.val(categories[i].label);
            }
            locInputID.val({$_GET["locations"]});
            for(var i=0;i<locations.length;i++){
                if(locations[i].value == {$_GET["locations"]}) locInput.val(locations[i].label);
            }
            {/ifset}

        });
        </script>

    </head>

    <body <?php body_class('ait-directory'); ?> data-themeurl="{$themeUrl}">

        <div id="page" class="hfeed {if (isset($themeOptions->general->layoutStyle) && $themeOptions->general->layoutStyle == 'narrow')} narrow{/if}" >
            
            {ifset $_GET['dir-register-status']}
            <div id="ait-dir-register-notifications" class="{if $_GET['dir-register-status'] == '3'}error{else}info{/if}">
                {if $_GET['dir-register-status'] == '3'}
                <div class="message defaultContentWidth">
                {__ "You canceled payment. Your account was registered but without option to add items. Upgrade your account in admin to add items."}
                <div class="close"></div>
                </div>
                {/if}
            </div>
            {/ifset}

            {ifset $registerErrors}
            <div id="ait-dir-register-notifications" class="error">
                <div class="message defaultContentWidth">
                {!$registerErrors}
                <div class="close"></div>
                </div>
            </div>
            {/ifset}

            {ifset $registerMessages}
            <div id="ait-dir-register-notifications" class="info">
                <div class="message defaultContentWidth">
                {!$registerMessages}
                <div class="close"></div>
                </div>
            </div>
            {/ifset}

            {ifset $themeOptions->advertising->showBox1}
            <div id="advertising-box-1" class="advertising-box">
                <div class="defaultContentWidth clearfix">
                    <div>{!$themeOptions->advertising->box1Content}</div>
                 </div>
            </div>
            {/ifset}

            <div class="topbar clearfix">
                    {if !empty($themeOptions->general->topBarContact)}
                    <div id="tagLineHolder">
                        <div class="defaultContentWidth clearfix">
                            <p class="left info">{$themeOptions->general->topBarContact}</p>
                            {include 'snippets/social-icons.php'}
                            {include 'snippets/wpml-flags.php'}
                            <!-- {include 'snippets/search-form.php'} -->
                        </div>
                    </div>
                    {/if}
            </div>

            <header id="branding" role="banner">
                <div class="defaultContentWidth clearfix">
                    <div id="logo" class="left">
                        {if !empty($themeOptions->general->logo_img)}
                        <a class="trademark" href="{$homeUrl}">
                            <img src="{linkTo $themeOptions->general->logo_img}" alt="logo" />
                        </a>
                        {else}
                        <a href="{$homeUrl}">
                            <span>{$themeOptions->general->logo_text}</span>
                        </a>
                        {/if}
                    </div>

                    <nav id="access" role="navigation">
                        <h3 class="assistive-text">{__ 'Main menu'}</h3>
                        {menu 'theme_location' => 'primary-menu', 'fallback_cb' => 'default_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu' }
                    </nav><!-- #accs -->
                </div>
            </header><!-- #branding -->

            <div id="directory-main-bar"{if $headerType == 'image'} style="background: url({$headerImage}) no-repeat center top; height: {!$headerImageSize[1]}px;"{/if} data-category="{$mapCategory}" data-location="{$mapLocation}" data-search="{$mapSearch}" data-geolocation="{ifset $isGeolocation}true{else}false{/ifset}">
            {if $headerType == 'slider'}
                {if function_exists('putRevSlider')}
                    {? putRevSlider($headerSlider)}
                {/if}
            {/if}
            </div>

            {ifset $isDirSingle}
                {include 'snippets/map-single-javascript.php'}
            {else}
                {if $headerType == 'map'}
                    {include 'snippets/map-javascript.php'}
                {/if}
            {/ifset}

            <div id="directory-search" data-interactive="{ifset $themeOptions->search->enableInteractiveSearch}yes{else}no{/ifset}">
                <div class="defaultContentWidth clearfix">
                    <form action="{$homeUrl}" id="dir-search-form" method="get" class="dir-searchform">
                        <div id="dir-search-inputs">
                            <div id="dir-holder">
                                <input type="text" name="s" id="dir-searchinput-text" placeholder="{__ 'Search keyword...'}" class="dir-searchinput"{ifset $isDirSearch} value="{$site->searchQuery}"{/ifset}>
                                
                                {ifset $themeOptions->search->showAdvancedSearch}
                                <div id="dir-searchinput-settings" class="dir-searchinput-settings">
                                    <div class="icon"></div>
                                    <div id="dir-search-advanced" style="display: none;">
                                        {ifset $themeOptions->search->advancedSearchText}<div class="text">{$themeOptions->search->advancedSearchText}</div>{/ifset}
                                        <div class="text-geo-radius clear">
                                            <div class="geo-radius">Radius:</div>
                                            <div class="metric">km</div>
                                            <input type="text" name="geo-radius" id="dir-searchinput-geo-radius" value="{ifset $themeOptions->search->advancedSearchDefaultValue}{$themeOptions->search->advancedSearchDefaultValue}{else}100{/ifset}" data-default-value="{ifset $themeOptions->search->advancedSearchDefaultValue}{$themeOptions->search->advancedSearchDefaultValue}{else}100{/ifset}" disabled="true">
                                        </div>
                                        <div class="geo-slider">
                                            <div class="value-slider"></div>
                                        </div>
                                        <div class="geo-button">
                                            <input type="checkbox" name="geo" id="dir-searchinput-geo">
                                        </div>
                                        <div id="dir-search-advanced-close"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="geo-lat" id="dir-searchinput-geo-lat" value="0">
                                <input type="hidden" name="geo-lng" id="dir-searchinput-geo-lng" value="0">
                                {/ifset}
                                
                                <input type="text" id="dir-searchinput-category" placeholder="{__ 'All categories'}">
                                <input type="text" name="categories" id="dir-searchinput-category-id" value="0" style="display: none;">
                                
                                <input type="text" id="dir-searchinput-location" placeholder="{__ 'All locations'}">
                                <input type="text" name="locations" id="dir-searchinput-location-id" value="0" style="display: none;">

                                <div class="reset-ajax"></div>
                            </div>
                        </div>
                        {ifset $themeOptions->search->showAdvancedSearch}
                        
                        {/ifset}
                        <div id="dir-search-button">
                            <input type="submit" value="{__ 'Search'}" class="dir-searchsubmit">
                        </div>
                        <input type="hidden" name="dir-search" value="yes" />
                        <input type="hidden" name="post_type" value="ait-dir-item">
                    </form>
                </div>
            </div>
