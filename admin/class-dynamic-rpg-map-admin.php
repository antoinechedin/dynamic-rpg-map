<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      0.1.0
 *
 * @package    Dynamic_RPG_Map
 * @subpackage Dynamic_RPG_Map/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dynamic_RPG_Map
 * @subpackage Dynamic_RPG_Map/admin
 * @author     Your Name <email@example.com>
 */
class Dynamic_RPG_Map_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $dynamic_rpg_map    The ID of this plugin.
	 */
	private $dynamic_rpg_map;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.1.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.1.0
	 * @param      string    $dynamic_rpg_map       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($dynamic_rpg_map, $version)
	{

		$this->dynamic_rpg_map = $dynamic_rpg_map;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dynamic_RPG_Map_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dynamic_RPG_Map_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->dynamic_rpg_map, plugin_dir_url(__FILE__) . 'css/dynamic-rpg-map-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dynamic_RPG_Map_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dynamic_RPG_Map_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->dynamic_rpg_map, plugin_dir_url(__FILE__) . 'js/dynamic-rpg-map-admin.js', array('jquery'), $this->version, false);
	}

	function dynamic_rpg_map_options_page()
	{
		add_menu_page(
			'Dynamic RPG map',
			'RPG map',
			'manage_options',
			'dynamic_rpg_map',
			[$this, 'dynamic_rpg_map_options_page_html'],
			plugin_dir_url(__FILE__) . 'images/icon_wporg.png',
			100
		);
	}

	function dynamic_rpg_map_options_page_html()
	{
?>
		<div class="wrap">
			<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
			<form action="options.php" method="post">
				<?php
				// output security fields for the registered setting "dynamic_rpg_map_options"
				settings_fields('dynamic_rpg_map_options');
				// output setting sections and their fields
				// (sections are registered for "wporg", each field is registered to a specific section)
				do_settings_sections('dynamic_rpg_map');
				// output save settings button
				submit_button(__('Save Settings', 'textdomain'));
				?>
			</form>
		</div>
	<?php
	}

	public function rpg_map_add_meta_box()
	{
		add_meta_box(
			'rpg_map_location_meta_box',
			'Location',
			[$this, 'rpg_map_location_meta_box_html'],
			'rpg_map_location'
		);
	}

	public function rpg_map_save_post_meta(int $post_id)
	{
		if (array_key_exists('rpg_map_latitude', $_POST)) {
			update_post_meta(
				$post_id,
				'_rpg_map_latitude',
				$_POST['rpg_map_latitude']
			);
		}

		if (array_key_exists('rpg_map_longitude', $_POST)) {
			update_post_meta(
				$post_id,
				'_rpg_map_longitude',
				$_POST['rpg_map_longitude']
			);
		}
	}

	public function rpg_map_location_meta_box_html($post)
	{
		$latitude = get_post_meta($post->ID, '_rpg_map_latitude', true);
		$longitude = get_post_meta($post->ID, '_rpg_map_longitude', true);
	?>

		<label for="rpg_map_latitude">Latitude</label>
		<input name="rpg_map_latitude" id="rpg_map_latitude" type="number" step="0.01" placeholder="[-90.0, 90.0]" value="<?php echo $latitude ?>" />
		<label for="rpg_map_longitude">Longitude</label>
		<input name="rpg_map_longitude" id="rpg_map_longitude" type="number" step="0.01" placeholder="[-180.0, 180.0]" value="<?php echo $longitude ?>" />
<?php
	}
}
