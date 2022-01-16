<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/antoinechedin/dynamic-rpg-map
 * @since             0.1.0
 * @package           Dynamic_RPG_Map
 *
 * @wordpress-plugin
 * Plugin Name:       Dynamic RPG map
 * Plugin URI:        https://github.com/antoinechedin/dynamic-rpg-map
 * Description:       Dynamic RPG map wordpress plugin.
 * Version:           0.1.1
 * Author:            Antoine Chedin
 * Author URI:        https://antoinechedin.github.io/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dynamic-rpg-map
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Rename this for your plugin and update it as you release new versions.
 */
define('DYNAMIC_RPG_MAPVERSION', '0.1.1');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dynamic-rpg-map-activator.php
 */
function activate_dynamic_rpg_map()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-dynamic-rpg-map-activator.php';
	Dynamic_RPG_Map_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dynamic-rpg-map-deactivator.php
 */
function deactivate_dynamic_rpg_map()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-dynamic-rpg-map-deactivator.php';
	Dynamic_RPG_Map_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_dynamic_rpg_map');
register_deactivation_hook(__FILE__, 'deactivate_dynamic_rpg_map');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-dynamic-rpg-map.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.1.0
 */
function run_dynamic_rpg_map()
{
	$plugin = new Dynamic_RPG_Map();
	$plugin->run();
}
run_dynamic_rpg_map();
