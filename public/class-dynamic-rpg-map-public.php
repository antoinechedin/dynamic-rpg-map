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
		wp_enqueue_style($this->dynamic_rpg_map, plugin_dir_url(__FILE__) . 'css/dynamic-rpg-map-public.css', array(), $this->version, 'all');
		wp_enqueue_style('leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.1.0
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->dynamic_rpg_map, plugin_dir_url(__FILE__) . 'js/dynamic-rpg-map-public.js', array('jquery'), $this->version, false);
		wp_enqueue_script('leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js', array(), null, false);
	}

	public function add_style_attributes($html, $handle)
	{
		if ('leaflet' === $handle) {
			return str_replace('media="all"', 'integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""', $html);
		}
		return $html;
	}

	public function add_sctipt_attributes($tag, $handle, $src)
	{
		if ('leaflet' == $handle) {
			return '<script src="' . $src . '" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>' . "\n";
		}
		return $tag;
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
