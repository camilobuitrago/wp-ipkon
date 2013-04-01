<?php

/**
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Template Name: Directory Homepage Template
 * Description: This template show content, top level categories list and alternative content defined in Directory general settings 
 */

$latteParams['post'] = WpLatte::createPostEntity(
	$GLOBALS['wp_query']->post,
	array(
		'meta' => $GLOBALS['pageOptions'],
	)
);
// get top categories
$subcategories = array();
if(isset($aitThemeOptions->directory->showTopCategories)){
	//$catNumber = ($aitThemeOptions->directory->topCategoriesNumber) ? $aitThemeOptions->directory->topCategoriesNumber : 9;
	$subcategories = get_terms( 'ait-dir-item-category', array('number' => 100000 ,'hide_empty' => false, 'parent' => 0) );
	// add category links
	foreach ($subcategories as $category) {
		$category->link = get_term_link(intval($category->term_id), 'ait-dir-item-category');
		$category->icon = getCategoryMeta("icon", intval($category->term_id));
		$category->excerpt = getCategoryMeta("excerpt", intval($category->term_id));
	}
} 
$latteParams['subcategories'] = $subcategories;

$latteParams['sidebarType'] = 'home';

/**
 * Fire!
 */
WPLatte::createTemplate(basename(__FILE__, '.php'), $latteParams)->render();
