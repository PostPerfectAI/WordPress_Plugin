<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://postperfectai.com
 * @since      1.0.0
 *
 * @package    Post_Perfect_Ai
 * @subpackage Post_Perfect_Ai/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Post_Perfect_Ai
 * @subpackage Post_Perfect_Ai/includes
 * @author     PostPerfect AI <admin@postperfectai.com>
 */
class Post_Perfect_Ai {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Post_Perfect_Ai_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'POST_PERFECT_AI_VERSION' ) ) {
			$this->version = POST_PERFECT_AI_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'post-perfect-ai';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Post_Perfect_Ai_Loader. Orchestrates the hooks of the plugin.
	 * - Post_Perfect_Ai_i18n. Defines internationalization functionality.
	 * - Post_Perfect_Ai_Admin. Defines all hooks for the admin area.
	 * - Post_Perfect_Ai_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-post-perfect-ai-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-post-perfect-ai-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-post-perfect-ai-api.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-post-perfect-ai-admin.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-post-perfect-ai-public.php';
		
		

		$this->loader = new Post_Perfect_Ai_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Post_Perfect_Ai_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Post_Perfect_Ai_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Post_Perfect_Ai_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_admin, 'add_ideas_type' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_main_menu' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_ideas_menu' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_custom_link_ideas' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_content_menu' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_custom_link_articles' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_images_menu' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_custom_link_images' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_settings_menu' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_help_menu' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'filter_custom_url' );
		$this->loader->add_action('rest_api_init', $plugin_admin, 'register_route_images');
		$this->loader->add_action('rest_api_init', $plugin_admin, 'register_route_ideas');
		$this->loader->add_action('rest_api_init', $plugin_admin, 'register_route_article');
		$this->loader->add_filter('manage_ppai-ideas_posts_columns', $plugin_admin, 'custom_post_type_headers', 10, 1);
		$this->loader->add_filter('manage_ppai-ideas_posts_custom_column',$plugin_admin, 'custom_post_type_data', 10, 2);
		$this->loader->add_filter('post_row_actions',$plugin_admin,'custom_post_row_actions',10,2);
		$this->loader->add_action('post_submitbox_misc_actions',$plugin_admin,'aip_postbox',10,1);
		$this->loader->add_action('add_meta_boxes',$plugin_admin,'aip_add_meta_box');
		$this->loader->add_action('wp_ajax_ppai_heartbeat_received',$plugin_admin,'ppai_heartbeat_received');
		$this->loader->add_action('admin_menu',$plugin_admin,'add_ppai_links');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Post_Perfect_Ai_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_head', $plugin_public, 'aip_open_graph');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Post_Perfect_Ai_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
