<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      0.1.0
 *
 * @package    Dynamic_RPG_Map
 * @subpackage Dynamic_RPG_Map/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Dynamic_RPG_Map
 * @subpackage Dynamic_RPG_Map/public
 * @author     Your Name <email@example.com>
 */
class Dynamic_RPG_Map_Public
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
	 * @param      string    $dynamic_rpg_map       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($dynamic_rpg_map, $version)
	{

		$this->dynamic_rpg_map = $dynamic_rpg_map;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style($this->dynamic_rpg_map, plugin_dir_url(__FILE__) . 'css/dynamic-rpg-map-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script($this->dynamic_rpg_map, plugin_dir_url(__FILE__) . 'js/dynamic-rpg-map-public.js', array('jquery'), $this->version, false);
	}

	function rpg_map_custom_post_type()
	{
		register_post_type(
			'rpg_map_location',
			array(
				'labels' => array(
					'name' => 'Locations',
					'singular_name' => 'Location',
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'location'),
				'menu_postion' => 5,
				'taxonomies' => array('post_tag'),
				'supports' => array(
					'title',
					'editor',
					'revision',
					'excerpt'
				),
			)
		);

		register_post_type(
			'rpg_map_quest',
			array(
				'labels' => array(
					'name' => 'Quests',
					'singular_name' => 'Quest',
				),
				'public' => true,
				'has_archive' => true,
				'rewrite' => array('slug' => 'quest'),
				'menu_postion' => 5,
				'taxonomies' => array('post_tag'),

			)
		);
	}
}
