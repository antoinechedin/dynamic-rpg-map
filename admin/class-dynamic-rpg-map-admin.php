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
class Dynamic_RPG_Map_Admin {

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
	public function __construct( $dynamic_rpg_map, $version ) {

		$this->dynamic_rpg_map = $dynamic_rpg_map;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->dynamic_rpg_map, plugin_dir_url( __FILE__ ) . 'css/dynamic-rpg-map-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->dynamic_rpg_map, plugin_dir_url( __FILE__ ) . 'js/dynamic-rpg-map-admin.js', array( 'jquery' ), $this->version, false );

	}

}
