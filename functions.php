<?php

//Регистрация типа записи Фильмы

add_action( 'init', 'register_post_types' );

function register_post_types(){

	register_post_type( 'films', [
		'labels' => [
			'name'               => 'Фильмы', 
			'singular_name'      => 'Фильм', 
			'add_new'            => 'Добавить фильм', 
			'add_new_item'       => 'Добавление фильма', 
			'edit_item'          => 'Редактирование фильма', 
			'new_item'           => 'Новый фильм', 
			'view_item'          => 'Смотреть фильм',
			'search_items'       => 'Искать фильм',
			'not_found'          => 'Не найдено', 
			'not_found_in_trash' => 'Не найдено в корзине', 
			'parent_item_colon'  => '', 
			'menu_name'          => 'Фильмы', 
		],
		'description'         => '',
		'public'              => true,
		'show_in_menu'        => null, 
		'show_in_rest'        => null, 
		'rest_base'           => null, 
		'menu_position'       => null,
		'menu_icon'           => null,
		'hierarchical'        => false,
		'supports'            => [ 'title', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => [],
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	] );

}

//
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
    register_block_type( __DIR__ . '/blocks/test' );
}


add_filter( 'template_include', 'my_template' );
function my_template( $template ) {
	global $post;
	if( $post->post_type == 'films' ){
		return get_stylesheet_directory() . '/single-film.php';
	}

	return $template;

}