<?php
/**
 * Plugin Name:       Toolbar Links
 * Plugin URI:        https://plugins.club/free-wordpress-plugins/
 * Description:       Adds a "Publish" or "Switch to Draft", and "Delete" links in toolbar to publish/unpublish or delete posts & pages from frontend.
 * Version:           1.4
 * Author:            plugins.club
 * Author URI:        https://plugins.club
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Requires at least: 5.0
 * Tested up to:      6.4.2
*/

// CUrrently there is no setting to disable this, so just load it
require_once(dirname(__FILE__) . '/includes/disable-wp-logo.php');

// Include plugin helper
include 'includes/PluginHelperClass.php';

// Include files for each option enabled
if (get_option('pluginsclub_toolbar_links_enable_menu') == 'yes') {
  require_once(dirname(__FILE__) . '/includes/toolbar-off.php');
}
if (get_option('pluginsclub_toolbar_links_enable_admin_menu') == 'yes') {
  require_once(dirname(__FILE__) . '/includes/admin-menu.php');
}
if (get_option('pluginsclub_toolbar_links_enable_admin_menu_wp_admin') == 'yes') {
  require_once(dirname(__FILE__) . '/includes/wp-admin-menu.php');
}
if (get_option('pluginsclub_toolbar_links_enable_delete_post') == 'yes') {
  require_once(dirname(__FILE__) . '/includes/delete-post.php');
}
if (get_option('pluginsclub_toolbar_links_enable_publish_post') == 'yes') {
  require_once(dirname(__FILE__) . '/includes/publish-post.php');
}

// Add settings page for the plugin
add_action('admin_menu', 'pluginsclub_toolbar_links_add_settings_page');
function pluginsclub_toolbar_links_add_settings_page() {
  add_options_page(
    'Toolbar Links Settings',
    'Toolbar Links',
    'manage_options',
    'tl-settings',
    'pluginsclub_toolbar_links_settings_page'
  );
}


function pluginsclub_toolbar_links_settings_page() {
  if (!current_user_can('manage_options')) {
    wp_die('You do not have sufficient permissions to access this page.');
  }
  
  // Load CSS only on the settings page
  $screen = get_current_screen();
    if ( $screen->id === 'settings_page_tl-settings'){
            wp_enqueue_style( 'settings_page_tl-settings', plugin_dir_url( __FILE__ ) . 'includes/css/settings-page.css', array(), '1.0.1' );
            //wp_enqueue_script( 'manage_options_page_tl-settings', plugin_dir_url( __FILE__ ) . 'includes/js/emails-page.js', array(), '1.9.0', true );

    }
  
  // Check if form is submitted
  if (isset($_POST['pluginsclub_toolbar_links_submit'])) {
    update_option('pluginsclub_toolbar_links_enable_menu', sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_menu']));
    update_option('pluginsclub_toolbar_links_enable_admin_menu', sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_admin_menu']));
    update_option('pluginsclub_toolbar_links_enable_admin_menu_wp_admin', sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_admin_menu_wp_admin']));
    update_option('pluginsclub_toolbar_links_enable_delete_post', sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_delete_post']));
    update_option('pluginsclub_toolbar_links_enable_publish_post', sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_publish_post']));
  }
  
  // Get the current values of options
  $pluginsclub_toolbar_links_enable_menu = get_option('pluginsclub_toolbar_links_enable_menu', 'yes');
  $pluginsclub_toolbar_links_enable_admin_menu = get_option('pluginsclub_toolbar_links_enable_admin_menu', 'yes');
  $pluginsclub_toolbar_links_enable_admin_menu_wp_admin = get_option('pluginsclub_toolbar_links_enable_admin_menu_wp_admin', 'yes');
  $pluginsclub_toolbar_links_enable_delete_post = get_option('pluginsclub_toolbar_links_enable_delete_post', 'yes');
  $pluginsclub_toolbar_links_enable_publish_post = get_option('pluginsclub_toolbar_links_enable_publish_post', 'yes');
?>


<div id="pluginsclub-cpanel">
					<div id="pluginsclub-cpanel-header">
			<div id="pluginsclub-cpanel-header-title">
				<div id="pluginsclub-cpanel-header-title-image">
<h1><a href="http://plugins.club/" target="_blank" class="logo"><img src="<?php echo plugins_url('includes/images/pluginsclub_logo_black.png', __FILE__) ?>" style="height:27px"></a></h1></div>

				<div id="pluginsclub-cpanel-header-title-image-sep">
				</div>

<div id="pluginsclub-cpanel-header-title-nav">
	<?php
// Get our API endpoint and from it build the menu
$plugins_club_api_link = 'https://api.plugins.club/list_of_wp_org_plugins.php';
$remote_data = file_get_contents($plugins_club_api_link);
$menuItems = json_decode($remote_data, true);

foreach ($menuItems as $menuItem) :
    $isActive = isset($_GET['page']) && ($_GET['page'] === $menuItem['page']);
    $activeClass = $isActive ? 'active' : '';
    $isInstalled = function_exists($menuItem['check_function']) && function_exists($menuItem['check_callback']);
    $name = $menuItem['name'];
    if (!$isInstalled) {
        $name = ' <span class="dashicons dashicons-plus-alt"></span> '.$name;
    } else {
        $name .= ' <span class="dashicons dashicons-plugins-checked"></span>';
    }
?>
    <div class="pluginsclub-cpanel-header-nav-item <?php echo $activeClass; ?>">
        <?php if ($isInstalled) : ?>
            <a href="<?php echo $menuItem['url']; ?>" class="tab"><?php echo $name; ?></a>
        <?php else : ?>
            <a href="<?php echo $menuItem['fallback_url']; ?>" target="_blank" class="tab"><?php echo $name; ?></a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
</div>

</div>
</div>

				<div id="pluginsclub-cpanel-admin-wrap" class="wrap">
			<h1 class="pluginsclub-cpanel-hide">Toolbar Links Settings</h1>
			<form id="pluginsclub-cpanel-form" method="POST">
				<h2>Toolbar Links Settings</h2>
		<p>
			Enable / Disable options that you want.</p>
			
			
		<div class="pluginsclub-cpanel-sep"></div>
  <div class="table-container">
		
<table class="form-table" role="presentation">
    <tbody>
      <tr>
        <th scope="row" style="width: 450px;">
          <label for="pluginsclub_toolbar_links_enable_admin_menu">Replace the toolbar menu with wp-admin menu on the frontend:</label>
        </th>
        <td>
          <input type="radio" id="pluginsclub_toolbar_links_enable_admin_menu_yes" name="pluginsclub_toolbar_links_enable_admin_menu" value="yes" <?php echo ($pluginsclub_toolbar_links_enable_admin_menu == 'yes') ? 'checked' : ''; ?>>
          <label for="pluginsclub_toolbar_links_enable_admin_menu_yes">Yes</label>
          <input type="radio" id="pluginsclub_toolbar_links_enable_admin_menu_no" name="pluginsclub_toolbar_links_enable_admin_menu" value="no" <?php echo ($pluginsclub_toolbar_links_enable_admin_menu == 'no') ? 'checked' : ''; ?>>
          <label for="pluginsclub_toolbar_links_enable_admin_menu_no">No</label>
        </td>
      </tr>
      <tr>
        <th scope="row" style="width: 450px;">
          <label for="pluginsclub_toolbar_links_enable_admin_menu_wp_admin">Add the toolbar menu on the wp-admin:</label>
        </th>
        <td>
          <input type="radio" id="pluginsclub_toolbar_links_enable_admin_menu_wp_admin_yes" name="pluginsclub_toolbar_links_enable_admin_menu_wp_admin" value="yes" <?php echo ($pluginsclub_toolbar_links_enable_admin_menu_wp_admin == 'yes') ? 'checked' : ''; ?>>
          <label for="pluginsclub_toolbar_links_enable_admin_menu_wp_admin_yes">Yes</label>
          <input type="radio" id="pluginsclub_toolbar_links_enable_admin_menu_wp_admin_no" name="pluginsclub_toolbar_links_enable_admin_menu_wp_admin" value="no" <?php echo ($pluginsclub_toolbar_links_enable_admin_menu_wp_admin == 'no') ? 'checked' : ''; ?>>
          <label for="pluginsclub_toolbar_links_enable_admin_menu_wp_admin_no">No</label>
        </td>
      </tr>
       <tr>
        <th scope="row" style="width: 450px;">
          <label for="pluginsclub_toolbar_links_enable_publish_post">Enable Publish / Switch to Draft links:</label>
        </th>
        <td>
          <input type="radio" id="pluginsclub_toolbar_links_enable_publish_post_yes" name="pluginsclub_toolbar_links_enable_publish_post" value="yes" <?php echo ($pluginsclub_toolbar_links_enable_publish_post == 'yes') ? 'checked' : ''; ?>>
		  <label for="pluginsclub_toolbar_links_enable_publish_post_yes">Yes</label>
<input type="radio" id="pluginsclub_toolbar_links_enable_publish_post_no" name="pluginsclub_toolbar_links_enable_publish_post" value="no" <?php echo ($pluginsclub_toolbar_links_enable_publish_post == 'no') ? 'checked' : ''; ?>>
<label for="pluginsclub_toolbar_links_enable_publish_post_no">No</label>
</td>
</tr>
     
      
      <tr>
        <th scope="row" style="width: 450px;">
          <label for="pluginsclub_toolbar_links_enable_delete_post">Enable Delete post links:</label>
        </th>
        <td>
          <input type="radio" id="pluginsclub_toolbar_links_enable_delete_post_yes" name="pluginsclub_toolbar_links_enable_delete_post" value="yes" <?php echo ($pluginsclub_toolbar_links_enable_delete_post == 'yes') ? 'checked' : ''; ?>>
          <label for="pluginsclub_toolbar_links_enable_delete_post_yes">Yes</label>
          <input type="radio" id="pluginsclub_toolbar_links_enable_delete_post_no" name="pluginsclub_toolbar_links_enable_delete_post" value="no" <?php echo ($pluginsclub_toolbar_links_enable_delete_post == 'no') ? 'checked' : ''; ?>>
          <label for="pluginsclub_toolbar_links_enable_delete_post_no">No</label>
        </td>
      </tr>
       <tr>
        <th scope="row" style="width: 450px;">
          <label for="pluginsclub_toolbar_links_enable_menu">Enable disable Toolbar button:</label>
        </th>
        <td>
          <input type="radio" id="pluginsclub_toolbar_links_enable_menu_yes" name="pluginsclub_toolbar_links_enable_menu" value="yes" <?php echo ($pluginsclub_toolbar_links_enable_menu == 'yes') ? 'checked' : ''; ?>>
          <label for="pluginsclub_toolbar_links_enable_menu_yes">Yes</label>
          <input type="radio" id="pluginsclub_toolbar_links_enable_menu_no" name="pluginsclub_toolbar_links_enable_menu" value="no" <?php echo ($pluginsclub_toolbar_links_enable_menu == 'no') ? 'checked' : ''; ?>>
          <label for="pluginsclub_toolbar_links_enable_menu_no">No</label>
        </td>
      </tr>
</tbody>
</table>

<div class="pluginsclub-cpanel-sep pluginsclub-cpanel-sep-last"></div>


<img class="preview-image-class" src=""></img>
 </div>
 
<div class="pluginsclub-cpanel-sep pluginsclub-cpanel-sep-last"></div>


<?php submit_button(); ?> 
</form>

</div>
				</div>
				
</div>

</div>
<?php
}

// Update on save
function pluginsclub_toolbar_links_save_settings() {
  if (!current_user_can('manage_options')) {
    wp_die('Unauthorized user');
  }

  if (!isset($_POST['pluginsclub_toolbar_links_enable_menu']) || !isset($_POST['pluginsclub_toolbar_links_enable_admin_menu']) || !isset($_POST['pluginsclub_toolbar_links_enable_delete_post']) || !isset($_POST['pluginsclub_toolbar_links_enable_publish_post'])) {
    return;
  }

  $pluginsclub_toolbar_links_enable_menu = sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_menu']);
  $pluginsclub_toolbar_links_enable_admin_menu = sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_admin_menu']);
  $pluginsclub_toolbar_links_enable_admin_menu_wp_admin = sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_admin_menu_wp_admin']);
  $pluginsclub_toolbar_links_enable_delete_post = sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_delete_post']);
  $pluginsclub_toolbar_links_enable_publish_post = sanitize_text_field($_POST['pluginsclub_toolbar_links_enable_publish_post']);
  
  update_option('pluginsclub_toolbar_links_enable_menu', $pluginsclub_toolbar_links_enable_menu);
  update_option('pluginsclub_toolbar_links_enable_admin_menu', $pluginsclub_toolbar_links_enable_admin_menu);
  update_option('pluginsclub_toolbar_links_enable_admin_menu_wp_admin', $pluginsclub_toolbar_links_enable_admin_menu_wp_admin);
  update_option('pluginsclub_toolbar_links_enable_delete_post', $pluginsclub_toolbar_links_enable_delete_post);
  update_option('pluginsclub_toolbar_links_enable_publish_post', $pluginsclub_toolbar_links_enable_publish_post);
  
}

function pluginsclub_toolbar_links_include_files() {
  $pluginsclub_toolbar_links_enable_menu = get_option('pluginsclub_toolbar_links_enable_menu', 'yes');
  $pluginsclub_toolbar_links_enable_admin_menu = get_option('pluginsclub_toolbar_links_enable_admin_menu', 'yes');
  $pluginsclub_toolbar_links_enable_admin_menu_wp_admin = get_option('pluginsclub_toolbar_links_enable_admin_menu_wp_admin', 'yes');
  $pluginsclub_toolbar_links_enable_delete_post = get_option('pluginsclub_toolbar_links_enable_delete_post', 'yes');
  $pluginsclub_toolbar_links_enable_publish_post = get_option('pluginsclub_toolbar_links_enable_publish_post', 'yes');

  if ($pluginsclub_toolbar_links_enable_menu == 'yes') {
    require_once(dirname(__FILE__) . '/includes/toolbar-off.php');
  }

  if ($pluginsclub_toolbar_links_enable_admin_menu == 'yes') {
    require_once(dirname(__FILE__) . '/includes/admin-menu.php');
  }
  
  if ($pluginsclub_toolbar_links_enable_admin_menu_wp_admin == 'yes') {
    require_once(dirname(__FILE__) . '/includes/wp-admin-menu.php');
  }

  if ($pluginsclub_toolbar_links_enable_delete_post == 'yes') {
    require_once(dirname(__FILE__) . '/includes/delete-post.php');
  }

  if ($pluginsclub_toolbar_links_enable_publish_post == 'yes') {
    require_once(dirname(__FILE__) . '/includes/publish-post.php');
}
}

add_action('admin_menu', 'pluginsclub_toolbar_links_add_settings_page');
add_action('admin_init', 'pluginsclub_toolbar_links_save_settings');
add_action('plugins_loaded', 'pluginsclub_toolbar_links_include_files');

// Add the hover event to the table rows to indicate each toolbar link
function pluginsclub_toolbar_links_add_hover_event() {
    ?>
    <script>
    jQuery(document).ready(function($) {
        $('table.form-table tr').hover(
            function() {
                var index = $(this).index();
                $('.preview-image-class').attr('src', '<?php echo plugin_dir_url( __FILE__ ); ?>includes/images/' + (index + 2) + '.png');
            },
            function() {
                $('.preview-image-class').attr('src', '<?php echo plugin_dir_url( __FILE__ ); ?>includes/images/1.png');
            }
        );
    });
    </script>
    <?php
}
add_action( 'admin_head', 'pluginsclub_toolbar_links_add_hover_event' );

?>