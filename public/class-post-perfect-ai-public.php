<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://postperfectai.com
 * @since      1.0.0
 *
 * @package    Post_Perfect_Ai
 * @subpackage Post_Perfect_Ai/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Post_Perfect_Ai
 * @subpackage Post_Perfect_Ai/public
 * @author     PostPerfect AI <admin@postperfectai.com>
 */
class Post_Perfect_Ai_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Post_Perfect_Ai_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Perfect_Ai_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/post-perfect-ai-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Post_Perfect_Ai_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Post_Perfect_Ai_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/post-perfect-ai-public.js', array( 'jquery' ), $this->version, false );

	}
	public function aip_open_graph() {
		global $post;
		if (!$post) return;
		if (is_admin() || !is_single($post->ID) || $post->post_type !== "post") return;
		$use_og = get_option("aip_use_og",true);
		if (!$use_og) return;
		$url = get_permalink($post->ID);
		$cp = explode(" ",$post->post_content,50);
		$subcontent = implode(" ",$cp);
		$excerpt = $post->post_excerpt !== "" ? $post->post_excerpt : $subcontent;
		$img = get_the_post_thumbnail_url($post->ID);
		
		echo '<meta property="og:title" content="'.$post->post_title.'" />';
		echo '<meta property="og:type" content="website" />';
		echo '<meta property="og:image" content="'.$img.'" />';
		echo '<meta property="og:url" content="'.$url.'" />';
		echo '<meta property="og:description" content="'.$excerpt.'" />';
		
	}

}
