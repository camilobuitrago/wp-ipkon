<?php //netteCache[01]000476a:2:{s:4:"time";s:21:"0.66183900 1364854746";s:9:"callbacks";a:3:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:87:"C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\header.php";i:2;i:1364854244;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:30:"eee17d5 released on 2011-08-13";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:21:"WPLATTE_CACHE_VERSION";i:2;i:4;}}}?><?php

// source file: C:\Program Files (x86)\Ampps\www\ipkon\wp-content\themes\directory\Templates\header.php

?><?php list($_l, $_g) = NCoreMacros::initRuntime($template, 'e66vlq3ejo')
;
// snippets support
if (!empty($control->snippetMode)) {
	return NUIMacros::renderSnippets($control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!doctype html>

<!--[if IE 8]><html class="no-js oldie ie8 ie" lang="<?php echo NTemplateHelpers::escapeHtmlComment($site->language) ?>"><![endif]-->
<!--[if gte IE 9]><!--><html class="no-js" lang="<?php echo htmlSpecialChars($site->language) ?>"><!--<![endif]-->

    <head>
        <meta charset="<?php echo htmlSpecialChars($site->charset) ?>" />
<script type='text/javascript'>var ua = navigator.userAgent; var meta = document.createElement('meta');if((ua.toLowerCase().indexOf('android') > -1 && ua.toLowerCase().indexOf('mobile')) || ((ua.match(/iPhone/i)) || (ua.match(/iPod/i)))){ meta.name = 'viewport';	meta.content = 'target-densitydpi=device-dpi, width=480'; }var m = document.getElementsByTagName('meta')[0]; m.parentNode.insertBefore(meta,m);</script>         <meta name="Author" content="AitThemes.com, http://www.ait-themes.com" />

        <title><?php echo WpLatteFunctions::getTitle() ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php echo htmlSpecialChars($site->pingbackUrl) ?>" />

<?php if ($themeOptions->fonts->fancyFont->type == 'google'): ?>
        <link href="http://fonts.googleapis.com/css?family=<?php echo htmlSpecialChars($themeOptions->fonts->fancyFont->font) ?>" rel="stylesheet" type="text/css" />
<?php endif ?>

        <link id="ait-style" rel="stylesheet" type="text/css" media="all" href="<?php echo WpLatteFunctions::lessify() ?>" />

<?php if(is_singular() && get_option("thread_comments")){wp_enqueue_script("comment-reply");}wp_head() ?>

        <script>
          'article aside footer header nav section time'.replace(/\w+/g,function(n){ document.createElement(n) })
        </script>

        <script type="text/javascript">
        jQuery(document).ready(function($) {
            var categories = [
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($categories) as $cat): ?>
                { value: <?php echo NTemplateHelpers::escapeJs($cat->term_id) ?>
, label: <?php echo NTemplateHelpers::escapeJs($cat->name) ?> }<?php if (!($iterator->last)): ?>
,<?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
            ];
            var locations = [
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($locations) as $loc): ?>
                { value: <?php echo NTemplateHelpers::escapeJs($loc->term_id) ?>
, label: <?php echo NTemplateHelpers::escapeJs($loc->name) ?> }<?php if (!($iterator->last)): ?>
,<?php endif ?>

<?php $iterations++; endforeach; array_pop($_l->its); $iterator = end($_l->its) ?>
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

<?php if (isset($isDirSearch)): ?>
            catInputID.val(<?php echo NTemplateHelpers::escapeJs($_GET["categories"]) ?>);
            for(var i=0;i<categories.length;i++){
                if(categories[i].value == <?php echo NTemplateHelpers::escapeJs($_GET["categories"]) ?>) catInput.val(categories[i].label);
            }
            locInputID.val(<?php echo NTemplateHelpers::escapeJs($_GET["locations"]) ?>);
            for(var i=0;i<locations.length;i++){
                if(locations[i].value == <?php echo NTemplateHelpers::escapeJs($_GET["locations"]) ?>) locInput.val(locations[i].label);
            }
<?php endif ?>

        });
        </script>

    </head>

    <body <?php body_class('ait-directory') ?> data-themeurl="<?php echo NTemplateHelpers::escapeHtml($themeUrl, ENT_NOQUOTES) ?>">

        <div id="page" class="hfeed <?php if ((isset($themeOptions->general->layoutStyle) && $themeOptions->general->layoutStyle == 'narrow')): ?>
 narrow<?php endif ?>" >
            
<?php if (isset($_GET['dir-register-status'])): ?>
            <div id="ait-dir-register-notifications" class="<?php if ($_GET['dir-register-status'] == '3'): ?>
error<?php else: ?>info<?php endif ?>">
<?php if ($_GET['dir-register-status'] == '3'): ?>
                <div class="message defaultContentWidth">
                <?php echo NTemplateHelpers::escapeHtml(__("You canceled payment. Your account was registered but without option to add items. Upgrade your account in admin to add items.", 'ait'), ENT_NOQUOTES) ?>

                <div class="close"></div>
                </div>
<?php endif ?>
            </div>
<?php endif ?>

<?php if (isset($registerErrors)): ?>
            <div id="ait-dir-register-notifications" class="error">
                <div class="message defaultContentWidth">
                <?php echo $registerErrors ?>

                <div class="close"></div>
                </div>
            </div>
<?php endif ?>

<?php if (isset($registerMessages)): ?>
            <div id="ait-dir-register-notifications" class="info">
                <div class="message defaultContentWidth">
                <?php echo $registerMessages ?>

                <div class="close"></div>
                </div>
            </div>
<?php endif ?>

<?php if (isset($themeOptions->advertising->showBox1)): ?>
            <div id="advertising-box-1" class="advertising-box">
                <div class="defaultContentWidth clearfix">
                    <div><?php echo $themeOptions->advertising->box1Content ?></div>
                 </div>
            </div>
<?php endif ?>

            <div class="topbar clearfix">
<?php if (!empty($themeOptions->general->topBarContact)): ?>
                    <div id="tagLineHolder">
                        <div class="defaultContentWidth clearfix">
                            <p class="left info"><?php echo NTemplateHelpers::escapeHtml($themeOptions->general->topBarContact, ENT_NOQUOTES) ?></p>
<?php NCoreMacros::includeTemplate('snippets/social-icons.php', $template->getParams(), $_l->templates['e66vlq3ejo'])->render() ;NCoreMacros::includeTemplate('snippets/wpml-flags.php', $template->getParams(), $_l->templates['e66vlq3ejo'])->render() ?>
                            <!-- <?php NCoreMacros::includeTemplate('snippets/search-form.php', $template->getParams(), $_l->templates['e66vlq3ejo'])->render() ?> -->
                        </div>
                    </div>
<?php endif ?>
            </div>

            <header id="branding" role="banner">
                <div class="defaultContentWidth clearfix">
                    <div id="logo" class="left">
<?php if (!empty($themeOptions->general->logo_img)): ?>
                        <a class="trademark" href="<?php echo htmlSpecialChars($homeUrl) ?>">
                            <img src="<?php echo WpLatteFunctions::linkTo($themeOptions->general->logo_img) ?>" alt="logo" />
                        </a>
<?php else: ?>
                        <a href="<?php echo htmlSpecialChars($homeUrl) ?>">
                            <span><?php echo NTemplateHelpers::escapeHtml($themeOptions->general->logo_text, ENT_NOQUOTES) ?></span>
                        </a>
<?php endif ?>
                    </div>

                    <nav id="access" role="navigation">
                        <h3 class="assistive-text"><?php echo NTemplateHelpers::escapeHtml(__('Main menu', 'ait'), ENT_NOQUOTES) ?></h3>
<?php wp_nav_menu(array('theme_location' => 'primary-menu', 'fallback_cb' => 'default_menu', 'container' => 'nav', 'container_class' => 'mainmenu', 'menu_class' => 'menu')) ?>
                    </nav><!-- #accs -->
                </div>
            </header><!-- #branding -->

            <div id="directory-main-bar"<?php if ($headerType == 'image'): ?> style="background: url(<?php echo htmlSpecialChars(NTemplateHelpers::escapeCss($headerImage)) ?>
) no-repeat center top; height: <?php echo $headerImageSize[1] ?>px;"<?php endif ?>
 data-category="<?php echo htmlSpecialChars($mapCategory) ?>" data-location="<?php echo htmlSpecialChars($mapLocation) ?>
" data-search="<?php echo htmlSpecialChars($mapSearch) ?>" data-geolocation="<?php if (isset($isGeolocation)): ?>
true<?php else: ?>false<?php endif ?>">
<?php if ($headerType == 'slider'): if (function_exists('putRevSlider')): putRevSlider($headerSlider) ;endif ;endif ?>
            </div>

<?php if (isset($isDirSingle)): NCoreMacros::includeTemplate('snippets/map-single-javascript.php', $template->getParams(), $_l->templates['e66vlq3ejo'])->render() ;else: if ($headerType == 'map'): NCoreMacros::includeTemplate('snippets/map-javascript.php', $template->getParams(), $_l->templates['e66vlq3ejo'])->render() ;endif ;endif ?>

            <div id="directory-search" data-interactive="<?php if (isset($themeOptions->search->enableInteractiveSearch)): ?>
yes<?php else: ?>no<?php endif ?>">
                <div class="defaultContentWidth clearfix">
                    <form action="<?php echo htmlSpecialChars($homeUrl) ?>" id="dir-search-form" method="get" class="dir-searchform">
                        <div id="dir-search-inputs">
                            <div id="dir-holder">
                                <input type="text" name="s" id="dir-searchinput-text" placeholder="<?php echo htmlSpecialChars(__('Palabra a buscar...', 'ait')) ?>
" class="dir-searchinput"<?php if (isset($isDirSearch)): ?> value="<?php echo htmlSpecialChars($site->searchQuery) ?>
"<?php endif ?> />
                                
<?php if (isset($themeOptions->search->showAdvancedSearch)): ?>
                                <div id="dir-searchinput-settings" class="dir-searchinput-settings">
                                    <div class="icon"></div>
                                    <div id="dir-search-advanced" style="display: none;">
                                        <?php if (isset($themeOptions->search->advancedSearchText)): ?>
<div class="text"><?php echo NTemplateHelpers::escapeHtml($themeOptions->search->advancedSearchText, ENT_NOQUOTES) ?>
</div><?php endif ?>

                                        <div class="text-geo-radius clear">
                                            <div class="geo-radius">Radius:</div>
                                            <div class="metric">km</div>
                                            <input type="text" name="geo-radius" id="dir-searchinput-geo-radius" value="<?php if (isset($themeOptions->search->advancedSearchDefaultValue)): echo htmlSpecialChars($themeOptions->search->advancedSearchDefaultValue) ;else: ?>
100<?php endif ?>" data-default-value="<?php if (isset($themeOptions->search->advancedSearchDefaultValue)): echo htmlSpecialChars($themeOptions->search->advancedSearchDefaultValue) ;else: ?>
100<?php endif ?>" disabled="true" />
                                        </div>
                                        <div class="geo-slider">
                                            <div class="value-slider"></div>
                                        </div>
                                        <div class="geo-button">
                                            <input type="checkbox" name="geo" id="dir-searchinput-geo" />
                                        </div>
                                        <div id="dir-search-advanced-close"></div>
                                    </div>
                                </div>
                                <input type="hidden" name="geo-lat" id="dir-searchinput-geo-lat" value="0" />
                                <input type="hidden" name="geo-lng" id="dir-searchinput-geo-lng" value="0" />
<?php endif ?>
                                
                                <input type="text" id="dir-searchinput-category" placeholder="<?php echo htmlSpecialChars(__('Todas las categorías', 'ait')) ?>" />
                                <input type="text" name="categories" id="dir-searchinput-category-id" value="0" style="display: none;" />
                                
                                <input type="text" id="dir-searchinput-location" placeholder="<?php echo htmlSpecialChars(__('Todas las localizaciones', 'ait')) ?>" />
                                <input type="text" name="locations" id="dir-searchinput-location-id" value="0" style="display: none;" />

                                <div class="reset-ajax"></div>
                            </div>
                        </div>
<?php if (isset($themeOptions->search->showAdvancedSearch)): ?>
                        
<?php endif ?>
                        <div id="dir-search-button">
                            <input type="submit" value="<?php echo htmlSpecialChars(__('Buscar', 'ait')) ?>" class="dir-searchsubmit" />
                        </div>
                        <input type="hidden" name="dir-search" value="yes" />
                        <input type="hidden" name="post_type" value="ait-dir-item" />
                    </form>
                </div>
            </div>
