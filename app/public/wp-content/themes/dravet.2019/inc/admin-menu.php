<?php

#------------------------------------------------------------------------------------
# Custom Menu Add Search Icon
#------------------------------------------------------------------------------------

add_filter('wp_nav_menu_1-hauptmenu_items', 'add_search_to_nav', 10, 2);
function add_search_to_nav($items, $args){

		$search_icon = '<li class="menu-item"><a href="">' . get_svg_icon('search') . '</a></li>';

    	$search = '<li class="menu-item hide-for-small">
    				<a href="javascript:void(0)" class="search-trigger tcon tcon-search--xcross" aria-label="toggle search">
    				<span class="tcon-search__item" aria-hidden="true"></span>
    				<span class="tcon-visuallyhidden">toggle search</span>
    				</a></li>';

    	$newitems = $items . $search_icon;	
    	
    	

    	return $newitems;
}