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
		wp_enqueue_style('leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
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
		wp_enqueue_script('leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), null, false);
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
		if (array_key_exists('rpg-map-latitude', $_POST)) {
			update_post_meta(
				$post_id,
				'_rpg_map_latitude',
				$_POST['rpg-map-latitude']
			);
		}

		if (array_key_exists('rpg-map-longitude', $_POST)) {
			update_post_meta(
				$post_id,
				'_rpg_map_longitude',
				$_POST['rpg-map-longitude']
			);
		}
	}

	public function rpg_map_location_meta_box_html($post)
	{
		$latitude = get_post_meta($post->ID, '_rpg_map_latitude', true) ?: 0;
		$longitude = get_post_meta($post->ID, '_rpg_map_longitude', true) ?: 0;
	?>

		<input name="rpg-map-latitude" id="rpg-map-latitude" type="hidden" value="<?php echo $latitude ?>" />
		<input name="rpg-map-longitude" id="rpg-map-longitude" type="hidden" value="<?php echo $longitude ?>" />
		<div id="rpg-map-meta-box" style="height: 180px;"></div>
		<script>
			var map = L.map('rpg-map-meta-box', {
				minZoom: 0,
				maxZoom: 2,
				scrollWheelZoom: 'center'
			});

			L.tileLayer('http://localhost/wp-content/uploads/2022/01/{z}{y}{x}.jpg', {
				minZoom: 0,
				maxZoom: 2,
				noWrap: true,
				bounds: L.latLngBounds(L.latLng(-90, -180), L.latLng(90, 180))
			}).addTo(map);
			map.setView([<?php echo $latitude . ', ' . $longitude ?>], 0);

			var oldMarker = L.marker([<?php echo $latitude . ', ' . $longitude ?>], {
					opacity: 0.5
				})
				.addTo(map);
			var centerMarker = L.marker([<?php echo $latitude . ', ' . $longitude ?>])
				.addTo(map);

			map.on('move', function() {
				centerMarker.setLatLng(map.getCenter());
			});

			//Dragend event of map for update centerMarker position
			map.on('dragend', function(e) {
				var cnt = map.getCenter();
				var position = centerMarker.getLatLng();
				document.getElementById("rpg-map-latitude").value = position["lat"];
				document.getElementById("rpg-map-longitude").value = position["lng"];
			});
		</script>
<?php
	}
}
