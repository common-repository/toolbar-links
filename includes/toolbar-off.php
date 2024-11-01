<?php


// Register and enqueue the plugin's stylesheet
function pluginsclub_toggle_toolbar_styles() {
    wp_register_style( 'wp-toolbar-toggle', plugin_dir_url( __FILE__ ) . '/css/toolbar-toggle-s.css' );
    wp_enqueue_style( 'wp-toolbar-toggle' );
}
add_action( 'admin_enqueue_scripts', 'pluginsclub_toggle_toolbar_styles' );
add_action( 'wp_enqueue_scripts', 'pluginsclub_toggle_toolbar_styles' );

add_action( 'admin_bar_menu', 'add_admin_toolbar_switch', 100 );

function add_admin_toolbar_switch( $wp_admin_bar ) {
	$user_id = get_current_user_id();
	$show_admin_bar = get_user_meta( $user_id, 'show_admin_bar_front', true );

	if ( $show_admin_bar === 'false' ) {
		$title = __( 'Toolbar is OFF' );
		$href = add_query_arg( 'show_admin_bar', 'true' );
		$class = 'on';
	} else {
		$title = __( 'Toolbar is ON' );
		$href = add_query_arg( 'show_admin_bar', 'false' );
		$class = 'off';
	}

	$wp_admin_bar->add_node( array(
		'id'    => 'toolbar-switch',
		'title' => $title,
		'href'  => $href,
		'parent' => 'top-secondary',
		'meta'  => array( 'class' => $class ),
	) );
}

add_action( 'wp_footer', 'add_toolbar_toggle_button' );

function add_toolbar_toggle_button() {
	$user_id = get_current_user_id();
	$show_admin_bar = get_user_meta( $user_id, 'show_admin_bar_front', true );

	if ( $show_admin_bar === 'false' ) {
		$show_admin_bar_url = add_query_arg( 'show_admin_bar', 'true' );
		echo '<a href="' . esc_url( $show_admin_bar_url ) . '" class="toolbar-toggle-button">Enable toolbar</a>';
	}
}

add_action( 'init', 'update_toolbar_visibility' );

function update_toolbar_visibility() {
	if ( ! is_user_logged_in() ) {
		return;
	}

	$user_id = get_current_user_id();
	$show_admin_bar = get_user_meta( $user_id, 'show_admin_bar_front', true );

	if ( isset( $_GET['show_admin_bar'] ) ) {
		$show_admin_bar = 'true' === $_GET['show_admin_bar'] ? 'true' : 'false';
		update_user_meta( $user_id, 'show_admin_bar_front', $show_admin_bar );
	}
}
