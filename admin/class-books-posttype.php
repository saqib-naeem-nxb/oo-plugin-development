<?php

class Books_Posttype{


    public function __construct(){

    }



    public function create_posttype(){
        register_post_type( "books", array(
			'labels' 			=> array(
				'name'	=> 'books',
				'featured_image' => 'Book cover image',
				'singular_name' => 'Book',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Book',
				'not_found' => 'No books found',
				'not_found_in_trash' => 'No books found in the trash'
			),
			'show_ui' 			=> true,
			'show_in_menu' 		=> true,
			'show_in_nav_menus' => true,
			'menu_position' 	=> 99,
			'capabilities' 		=> array(),
			'supports' 			=> array(
				'title',
				'thumbnail'
			),
			'reqrite' 			=> array(),
            'can_export' 		=> false
        ) );
    }
}