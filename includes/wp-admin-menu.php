<?php

// Replace the dropdown menu on the backend
function pluginsclub_toolbar_links_replace_wp_admin_bar_links_on_back()
{
    global $wp_admin_bar;
    if ( 
        current_user_can('manage_options')
    ){
        if ( is_admin() ) {
            // We're on the wp-admin dashboard
		$wp_admin_bar->add_menu(array(
			'parent' => 'site-name',
			'id'     => 'posts',
			'title'  => __('Posts'),
			'href'   => admin_url('edit.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'posts',
			'id'     => 'posts-all',
			'title'  => __('All Posts'),
			'href'   => admin_url('edit.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'posts',
			'id'     => 'posts-new',
			'title'  => __('Add New'),
			'href'   => admin_url('post-new.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'posts',
			'id'     => 'posts-categories',
			'title'  => __('Categories'),
			'href'   => admin_url('edit-tags.php?taxonomy=category'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'posts',
			'id'     => 'posts-tags',
			'title'  => __('Tags'),
			'href'   => admin_url('edit-tags.php?taxonomy=post_tag'),
		));

		//Media
		$wp_admin_bar->add_menu(array(
			'parent' => 'site-name',
			'id'     => 'media',
			'title'  => __('Media'),
			'href'   => admin_url('upload.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'media',
			'id'     => 'media-library',
			'title'  => __('Library'),
			'href'   => admin_url('upload.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'media',
			'id'     => 'media-new',
			'title'  => __('Add New'),
			'href'   => admin_url('media-new.php'),
		));


		$wp_admin_bar->add_menu(array(
			'parent' => 'site-name',
			'id'     => 'pages',
			'title'  => __('Pages'),
			'href'   => admin_url('edit.php?post_type=page'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'pages',
			'id'     => 'pages-all',
			'title'  => __('All Pages'),
			'href'   => admin_url('edit.php?post_type=page'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'pages',
			'id'     => 'pages-new',
			'title'  => __('Add New'),
			'href'   => admin_url('post-new.php?post_type=page'),
		));
		
		$wp_admin_bar->add_menu(array(
			'parent' => 'site-name',
			'id'     => 'themes',
			'title'  => __('Appearance'),
			'href'   => admin_url('themes.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'themes',
			'id'     => 'customize-link',
			'title'  => __('Customize'),
			'href'   => admin_url('customize.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'themes',
			'id'     => 'widgets',
			'title'  => __('Widgets'),
			'href'   => admin_url('widgets.php'),
		));
		
		$wp_admin_bar->add_menu(array(
			'parent' => 'themes',
			'id'     => 'menus',
			'title'  => __('Menus'),
			'href'   => admin_url('nav-menus.php'),
		));
		
		$wp_admin_bar->add_menu(array(
			'parent' => 'themes',
			'id'     => 'theme-editor',
			'title'  => __('Theme File Editor'),
			'href'   => admin_url('theme-editor.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'site-name',
			'id'     => 'plugins',
			'title'  => __('Plugins'),
			'href'   => admin_url('plugins.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'plugins',
			'id'     => 'plugins-installed',
			'title'  => __('Installed Plugins'),
			'href'   => admin_url('plugins.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'plugins',
			'id'     => 'plugins-new',
			'title'  => __('Add New'),
			'href'   => admin_url('plugin-install.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'plugins',
			'id'     => 'plugins-editor',
			'title'  => __('Plugin File Editor'),
			'href'   => admin_url('plugin-editor.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'site-name',
			'id'     => 'users',
			'title'  => __('Users'),
			'href'   => admin_url('users.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'users',
			'id'     => 'users-all',
			'title'  => __('All Users'),
			'href'   => admin_url('users.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'users',
			'id'     => 'users-new',
			'title'  => __('Add New'),
			'href'   => admin_url('user-new.php'),
		));
		
		$wp_admin_bar->add_menu(array(
			'parent' => 'users',
			'id'     => 'users-profile',
			'title'  => __('Profile'),
			'href'   => admin_url('profile.php'),
		));
		
		$wp_admin_bar->add_menu(array(
			'parent' => 'site-name',
			'id'     => 'tools',
			'title'  => __('Tools'),
			'href'   => admin_url('tools.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'tools',
			'id'     => 'available-tools',
			'title'  => __('Available Tools'),
			'href'   => admin_url('tools.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'tools',
			'id'     => 'import',
			'title'  => __('Import'),
			'href'   => admin_url('import.php'),
		));
		
		$wp_admin_bar->add_menu(array(
			'parent' => 'tools',
			'id'     => 'export',
			'title'  => __('Export'),
			'href'   => admin_url('export.php'),
		));
		
		$wp_admin_bar->add_menu(array(
			'parent' => 'tools',
			'id'     => 'site-health',
			'title'  => __('Site Health'),
			'href'   => admin_url('site-health.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'site-name',
			'id'     => 'options',
			'title'  => __('Settings'),
			'href'   => admin_url('options-general.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'options',
			'id'     => 'options-general',
			'title'  => __('General'),
			'href'   => admin_url('options-general.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'options',
			'id'     => 'options-writing',
			'title'  => __('Writing'),
			'href'   => admin_url('options-writing.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'options',
			'id'     => 'options-writing',
			'title'  => __('Writing'),
			'href'   => admin_url('options-writing.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'options',
			'id'     => 'options-reading',
			'title'  => __('Reading'),
			'href'   => admin_url('options-reading.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'options',
			'id'     => 'options-discussion',
			'title'  => __('Discussion'),
			'href'   => admin_url('options-discussion.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'options',
			'id'     => 'options-media',
			'title'  => __('Media'),
			'href'   => admin_url('options-media.php'),
		));

		$wp_admin_bar->add_menu(array(
			'parent' => 'options',
			'id'     => 'options-permalink',
			'title'  => __('Permalink'),
			'href'   => admin_url('options-permalink.php'),
		));
		
		$wp_admin_bar->add_menu(array(
			'parent' => 'options',
			'id'     => 'options-privacy',
			'title'  => __('Privacy'),
			'href'   => admin_url('options-privacy.php'),
		));
        }
    }
}
add_action('admin_bar_menu', 'pluginsclub_toolbar_links_replace_wp_admin_bar_links_on_back', 1000);
