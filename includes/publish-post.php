<?php

// Add a link to Publish & Unpublish post
class pluginsclub_toolbar_links_unpublish_post_class {
	public function __construct(){
	    
		add_action('admin_bar_menu', array( $this, 'add_item'), 99);

	}
	
	public function add_item( $admin_bar ){
		if ( 
			!is_admin() && 
			current_user_can('manage_options')
		   ):

			global $post;
			$post_ID = $post->ID;

			$post_status = get_post_status( $post_ID );
			
			$args = array();

			if( $post_status == 'draft' ){
				$args = array( 
					'id'	=>		'publish-post',
					'title'	=>	'🟩 Publish',
					'href'	=>	wp_nonce_url( add_query_arg( 'publish_post', $post_ID, get_permalink( $post_ID ) ), 'publish_post_' . $post_ID )
				);
			}elseif( $post_status == 'publish' ){
				$args = array( 
					'id'	=>		'switch-to-draft',
					'title'	=>	'🟥 Switch to Draft',
					'href'	=>	wp_nonce_url( add_query_arg( 'switch_to_draft', $post_ID, get_permalink( $post_ID ) ), 'switch_to_draft_' . $post_ID )
				);
			}

			$admin_bar->add_menu( $args );
		endif;
	}
}

$pluginsclub_toolbar_links_unpublish_post_class = new pluginsclub_toolbar_links_unpublish_post_class();

// Handle nonce for publish/unpublish links
add_action( 'template_redirect', 'pluginsclub_toolbar_links_change_post_status' );
function pluginsclub_toolbar_links_change_post_status(){
	if( !is_admin() && current_user_can('manage_options') ){
		if( isset( $_GET['publish_post'] ) ){
			$post_ID = intval( $_GET['publish_post'] );
			$nonce = $_REQUEST['_wpnonce'];
			if ( ! wp_verify_nonce( $nonce, 'publish_post_' . $post_ID ) ) {
				wp_die( 'Invalid nonce' );
			}
			wp_update_post( array( 'ID' => $post_ID, 'post_status' => 'publish' ) );
			wp_redirect( get_permalink( $post_ID ) );
			exit();
		}elseif( isset( $_GET['switch_to_draft'] ) ){
			$post_ID = intval( $_GET['switch_to_draft'] );
			$nonce = $_REQUEST['_wpnonce'];
			if ( ! wp_verify_nonce( $nonce, 'switch_to_draft_' . $post_ID ) ) {
				wp_die( 'Invalid nonce' );
			}
			wp_update_post( array( 'ID' => $post_ID, 'post_status' => 'draft' ) );
			wp_redirect( get_permalink( $post_ID ) );
			exit();
		}
	}
}
