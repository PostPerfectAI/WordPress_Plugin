<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://postperfectai.com
 * @since             1.0.0
 * @package           Post_Perfect_Ai
 *
 * @wordpress-plugin
 * Plugin Name:       PostPerfect AI
 * Plugin URI:        https://postperfectai.com
 * Description:       Supercharge your content creation with PostPerfect AI - the ultimate WordPress plugin harnessing AI for compelling articles and stunning images.
 * Version:           1.0.0
 * Author:            PostPerfect AI
 * Author URI:        https://postperfectai.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       post-perfect-ai
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'POST_PERFECT_AI_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-post-perfect-ai-activator.php
 */
function activate_post_perfect_ai() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-post-perfect-ai-activator.php';
	Post_Perfect_Ai_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-post-perfect-ai-deactivator.php
 */
function deactivate_post_perfect_ai() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-post-perfect-ai-deactivator.php';
	Post_Perfect_Ai_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_post_perfect_ai' );
register_deactivation_hook( __FILE__, 'deactivate_post_perfect_ai' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-post-perfect-ai.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_post_perfect_ai() {

	$plugin = new Post_Perfect_Ai();
	$plugin->run();

}
run_post_perfect_ai();
