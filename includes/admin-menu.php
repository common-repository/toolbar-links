<?php

// Replace the dropdown menu on the frontend
function pluginsclub_toolbar_links_replace_wp_admin_bar_links()
{
	global $wp_admin_bar;
	if ( 
			!is_admin() && 
			current_user_can('manage_options')
		   ){
		$wp_admin_bar->remove_menu('themes');
		// We're on the front end
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

		/**
		 * Add third party plugin support
		 *
		 * @since 1.0.1
		 */
		//Check for third party plugins
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');

		//Check for WooCommerce
		if (is_plugin_active('woocommerce/woocommerce.php')) {
			//If plugin is activated then
			$wp_admin_bar->add_menu(array(
				'parent' => 'site-name',
				'id'     => 'woocomm',
				'title'  => __('WooCommerce'),
				'href'   => admin_url('admin.php?page=wc-admin'),
			));

			$wp_admin_bar->add_menu(array(
				'parent' => 'woocomm',
				'id'     => 'woocomm-orders',
				'title'  => __('Orders'),
				'href'   => admin_url('edit.php?post_type=shop_order'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'woocomm',
				'id'     => 'woocomm-customers',
				'title'  => __('Customers'),
				'href'   => admin_url('admin.php?page=wc-admin&path=%2Fcustomers'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'woocomm',
				'id'     => 'woocomm-reports',
				'title'  => __('Reports'),
				'href'   => admin_url('admin.php?page=wc-reports'),
			));
			$wp_admin_bar->add_menu(array(
				'parent' => 'woocomm',
				'id'     => 'woocomm-settings',
				'title'  => __('Settings'),
				'href'   => admin_url('admin.php?page=wc-settings'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'woocomm',
				'id'     => 'woocomm-status',
				'title'  => __('Status'),
				'href'   => admin_url('admin.php?page=wc-status'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'woocomm',
				'id'     => 'woocomm-extensions',
				'title'  => __('Extensions'),
				'href'   => admin_url('admin.php?page=wc-addons'),
			));
			
			//WooCommerce Products 
			$wp_admin_bar->add_menu(array(
				'parent' => 'site-name',
				'id'     => 'products',
				'title'  => __('Products'),
				'href'   => admin_url('edit.php?post_type=product'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'products',
				'id'     => 'products-all',
				'title'  => __('All Products'),
				'href'   => admin_url('edit.php?post_type=product'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'products',
				'id'     => 'products-new',
				'title'  => __('Add New'),
				'href'   => admin_url('post-new.php?post_type=product'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'products',
				'id'     => 'products-categories',
				'title'  => __('Categories'),
				'href'   => admin_url('edit-tags.php?taxonomy=product_cat&post_type=product'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'products',
				'id'     => 'products-tags',
				'title'  => __('Tags'),
				'href'   => admin_url('edit-tags.php?taxonomy=product_tag&post_type=product'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'products',
				'id'     => 'products-attributes',
				'title'  => __('Attributes'),
				'href'   => admin_url('edit.php?post_type=product&page=product_attributes'),
			));
			
			$wp_admin_bar->add_menu(array(
				'parent' => 'products',
				'id'     => 'products-reviews',
				'title'  => __('Reviews'),
				'href'   => admin_url('edit.php?post_type=product&page=product-reviews'),
			));
		}
	}
}
add_action('admin_bar_menu', 'pluginsclub_toolbar_links_replace_wp_admin_bar_links', 1000);