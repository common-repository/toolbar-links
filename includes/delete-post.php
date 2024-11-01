<?php

// Add a link to Delete post
class pluginsclub_toolbar_links_delete_post_class {
	public function __construct(){
	    
		add_action('admin_bar_menu', array( $this, 'add_item'), 100);

	}
	
	public function add_item( $admin_bar ){
		if ( 
			!is_admin() && 
			current_user_can('manage_options')
		   ):

			$args = array( 
				'id'	=>		'delete-post',
				'title'	=>	'🗑️Delete',
				'href'	=>	get_delete_post_link( $post_ID )
			);

			$admin_bar->add_menu( $args );
		endif;
	}
}

$pluginsclub_toolbar_links_delete_post_class = new pluginsclub_toolbar_links_delete_post_class();