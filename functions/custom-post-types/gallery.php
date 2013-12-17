<?php

function gallery_register(){

	$args = array(
		'labels' => array(
			'name' => 'Galleries',
			'singular_name' => 'Gallery',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Gallery Project',
			'edit_item' => 'Edit Gallery Project',
			'new_item' => 'New Gallery Project',
			'view_item' => 'View Gallery Project',
			'search_items' => 'Search Gallery Projects',
			'not_found' =>  'No galleries projects found',
			'not_found_in_trash' => 'No gallery projects found in Trash', 
			'parent_item_colon' => '',
		),
		'singular_label' => 'gallery',
		'public' => true,
		'has_archive' => true,
		'exclude_from_search' => false,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array( 'with_front' => false ),
		'query_var' => false,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
	);

	register_post_type( 'gallery' , $args );
	flush_rewrite_rules( false );

	register_taxonomy('gallery_category','gallery',array(
		'hierarchical' => true,
		'labels' => array(
			'name' => 'Gallery Categories', 
			'singular_name' => 'Gallery Category',
			'search_items' =>  'Search Categories', 
			'popular_items' => 'Popular Categories', 
			'all_items' => 'All Categories', 
			'parent_item' => null,
			'parent_item_colon' => null,
			'edit_item' => 'Edit Gallery Category', 
			'update_item' => 'Update Gallery Category', 
			'add_new_item' => 'Add New Gallery Category', 
			'new_item_name' => 'New Gallery Category Name', 
			'separate_items_with_commas' => 'Separate Gallery category with commas',
			'add_or_remove_items' => 'Add or remove gallery category',
			'choose_from_most_used' => 'Choose from the most used gallery category', 
		),
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => false,
	));
}

add_action('init','gallery_register');

