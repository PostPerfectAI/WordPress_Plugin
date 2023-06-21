<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://postperfectai.com
 * @since      1.0.0
 *
 * @package    Post_Perfect_Ai
 * @subpackage Post_Perfect_Ai/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Post_Perfect_Ai
 * @subpackage Post_Perfect_Ai/admin
 * @author     PostPerfect AI <admin@postperfectai.com>
 */
class Post_Perfect_Ai_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	
	
	protected $endpoint = "https://perfect.postperfectai.com/process";
	
	protected $camera_types = array(
		"Nikon D7500",
		"Nikon D850",
		"Nikon D780",
		"Canon EOS-1D Mark III",
		"Canon EOS 5D Mark IV",
		"Canon EOS 6D Mark II",
		"Fujifilm XT3"
	); 
	
	protected $lens_types = array(
		"standard",
		"prime",
		"wide-angle",
		"zoom",
		"50mm wide",
		"85mm portrait",
		"telephoto",
		"fish-eye",
		"macro",
		"tilt-shift",
	);
	protected $image_styles = array(
		"Enhance",
		"Photographic",
		"Anime",
		"Digital art",
		"Comic book",
		"Fantasy art",
		"Line art",
		"Aanlog Film",
		"Neon Punk",
		"Isometric",
		"Low Poly",
		"Origami",
		"Modeling Compound",
		"Cinematic",
		"3d Model",
		"Pixel art",
		"Tile Texture"
	);
	protected $artists = array(
	  "Thomas Kinkade",
	  "Vincent Van Gogh",
	  "Leonid Afremov",
	  "Claude Monet",
	  "Edward Hopper",
	  "Norman Rockwell",
	  "William-Adolphe Bouguereau",
	  "Albert Bierstadt",
	  "John Singer Sargent",
	  "Pierre-Auguste Renoir",
	  "Frida Kahlo",
	  "John William Waterhouse",
	  "Winslow Homer",
	  "Walt Disney",
	  "Thomas Moran",
	  "Paul Cézanne",
	  "Camille Pissarro",
	  "Raphael",
	  "Pablo Picasso",
	  "Ansel Adams",
	  "Bob Ross",
	  "Mary Cassatt",
	  "Andy Warhol",
	  "Pixar",
	  "Salvador Dali",
	  "Rembrandt Van Rijn",
	  "Artgerm",
	  "Stan Lee",
	  "Frank Lloyd Wright",
	  "Tim Burton",
	  "George Lucas",
	  "Quentin Tarantino"
	);
	protected $artist_attributes = array(
		"landscape art",//0
		"painter",//1
		"cityscape",//2
		"portrait",//3
		"post-impressionism",//4
		"expressionism",//5
		"still life",//6
		"impressionism",//7
		"genre painting",//8
		"american realism",//9
		"architectural painting",//10
		"neorealism",//11
		"american scene painting",//12
		"figurative art",//13
		"genre art",//14
		"mythological painting",//15
		"acedemic art",//16
		"figurative painting",//17
		"portrait painting",//18
		"marine art",//19
		"religious art",//20
		"animal art",//21
		"figure",//22
		"surrealism",//23
		"magic realism",//24
		"neo-pompeian",//25
		"symbolism",//26
		"allegory",//27
		"high renaissance",//28
		"italian renaissance",//29
		"designer",//30
		"sculptor",//31
		"graphics",//32
		"cubism",//33
		"german romanticism",//34
		"photographer",//35
		"realism",//36
		"cartoon art",//37
		"neo-impressionism",//38
		"abstract art",//39
		"pop art",//40
		"digital animation",//41
		"digital art",//42
		"comic book art",//43
		"arhitecture",//44
		"film",//45
	);
	protected $artist_attribute_ids = array(
		array(0,1),
		array(2,0,3,20,1,4,5,6),
		array(1),
		array(0,3,7,1,6),
		array(8,9,10,11,1,12),
		array(36,17,9,14,1),
		array(15,16,22,3,1),
		array(0,1),
		array(0,3,7,1,18),
		array(15,0,19,20,21,3,14,22,7,1,18,6),
		array(23,3,24,1,18),
		array(25,3,26,7,1),
		array(36,19,9,3,14,1),
		array(37),
		array(0),
		array(0,8,3,1,4,6),
		array(0,38,22,3,7,6),
		array(15,27,28,20,3,1,29,18),
		array(31,1,15,27,23,4,30,6,39,0,19,22,32,13,21,3,33),
		array(35,0),
		array(0,1),
		array(0,14,3,22,7,1,18),
		array(3,40,6),
		array(41),
		array(0,27,23,20,8,3,1,6),
		array(15,0,8,3,1,20,18,6),
		array(42),
		array(43),
		array(44),
		array(42),
		array(45),
		array(45)
	);
	
	protected $penguin_icon = "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAyNy41LjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiDQoJIHZpZXdCb3g9IjAgMCAyMCAyMCIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjAgMjA7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+DQoJLnN0MHtmaWxsLXJ1bGU6ZXZlbm9kZDtjbGlwLXJ1bGU6ZXZlbm9kZDtmaWxsOiMyMzFGMjA7fQ0KCS5zdDF7ZmlsbDojMjMxRjIwO30NCgkuc3Qye2ZpbGw6I0ZGRkZGRjt9DQoJLnN0M3tmaWxsOiNGRkZGRkY7c3Ryb2tlOiNGRkZGRkY7c3Ryb2tlLW1pdGVybGltaXQ6NTI7fQ0KPC9zdHlsZT4NCjxwYXRoIGNsYXNzPSJzdDAiIGQ9Ik0xMy45MiwxNy42N2MyLjk5LTkuMi0wLjk2LTEyLjE1LTEuMTQtMTMuMzhjLTAuMDYtMC40NCwxLjE1LTEuMSwzLjg1LTEuNjZjLTAuMzYtMC40Ni0xLjE3LTEuMy0yLjQtMS4zOQ0KCWMtMS45Mi0yLjIyLTYuODYtMC43Ni02Ljk3LDQuNTZjMS43LTIuMSwyLjg5LTEuNDEsMi4yNCwwLjcyYy0xLjM1LDQuNC0yLjk0LDQuMzYtMC44MSw5LjI1YzAuOTksMC4zOSwyLjczLTYuMjYsMy41My00LjUNCgljMC4zLDEuNzctMS4wMSwzLjk0LTAuOTYsNS42NGMwLjA2LDIuMDQtMS42OSwxLjI1LTQuMDQsMy4wM2MzLjQ3LTEuMDIsNS44OC0wLjgxLDkuNjYtMC4xMUMxMy45OCwxOC44OSwxMy44NCwxNy45MywxMy45MiwxNy42N3oNCgkgTTEyLjA1LDIuNmMtMC4zNy0wLjAyLTAuNjYtMC4zNC0wLjY0LTAuNzFjMC4wMi0wLjM3LDAuMzQtMC42NiwwLjcxLTAuNjRjMC4zNywwLjAyLDAuNjYsMC4zNCwwLjY0LDAuNzENCglDMTIuNzQsMi4zMywxMi40MiwyLjYyLDEyLjA1LDIuNnoiLz4NCjxwYXRoIGNsYXNzPSJzdDEiIGQ9Ik02LjM3LDQuNDVjLTIsMS4yLTIuODMsMi4xNS0zLjA2LDMuOGMtMC4wNywwLjQ4LDAuMDUsMS42OCwwLjM4LDIuMTFsMC4xNywwLjIybDAuMjYtMC4wOQ0KCWMwLjI2LTAuMDksMC45OC0wLjM4LDEuMi0wLjc1TDUuNDQsOS42YzAuNC0xLjMsMS4yNy0zLjAyLDEuOTEtMy45M2wwLjQ2LTEuMzJDNy44MSw0LjM1LDguMzcsMy4yNSw2LjM3LDQuNDV6Ii8+DQo8L3N2Zz4NCg==";
	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/post-perfect-ai-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/post-perfect-ai-admin.js', array( 'jquery' ), $this->version, false );
		wp_register_script(
			'post-perfect-ai-js',
			plugin_dir_url( __FILE__ ) . 'js/post-perfect-ai-admin.js',
			array('jquery','wp-i18n','heartbeat'),
			$this->version,
			false
		);
		wp_enqueue_script('post-perfect-ai-js');
		wp_set_script_translations('post-perfect-ai-js','post-perfect-ai',plugin_dir_path(__FILE__).'languages');
	}
	protected function get_stripped_url() {
		$url = get_bloginfo("url");
		$url = str_replace("https://","",$url);
		$url = str_replace("http://","",$url);
		return $url;
	}
	protected function sign_data($data) {
		return AIP_API::SIGN($data);
	}
	public function call_api($endpoint, $data) {
		try {
			return AIP_API::CALL($endpoint, $data);
		} catch(Exception $ex) {
			error_log($ex);
			$dt = new stdClass;
			$dt->statusCode = 500;
			$dt->error = __("The request could not be completed.","post-perfect-ai");
			return $dt;
		}
	}
	public function is_waiting_for() {
		return array(
			"idea"=>$this->is_waiting("idea"),
			"article"=>$this->is_waiting("article"),
			"image"=>$this->is_waiting("image")
		);
	}
	public function is_waiting_any() {
		return $this->is_waiting("idea") === 1 || $this->is_waiting("article") === 1 || $this->is_waiting("image") === 1;
	}
	public function is_waiting($type="idea") {
		return intval(get_option("aip_is_waiting_$type",0));
	}
	public function set_waiting($type="idea",$waiting=1) {
		update_option("aip_is_waiting_$type",$waiting,false);
	}
	public function is_received($type="idea") {
		return intval(get_option("aip_is_received_$type",0));
	}
	public function set_received($type="idea",$received=1) {
		update_option("aip_is_received_$type",$received,false);
	}
	public function admin_main_menu() {
		//"dashicons-superhero-alt"
		add_menu_page("PostPerfect AI","PostPerfect AI","edit_posts","postperfect-ai",array($this,"admin_main_page"),$this->penguin_icon,5);
	}
	public function process_main_page() {
		
	}
	public function admin_main_page() {
		if (isset($_POST['aip_verify_credits_submit'])) $this->process_main_page(); 
		$imgpath = plugin_dir_url(__FILE__);
		$credits = array(
			get_option("ppai-idea-credits","?"),
			get_option("ppai-article-credits","?"),
			get_option("ppai-image-credits","?")
		);
		echo "<div class=\"wrap\"><div><img src=\"{$imgpath}images/PostPerfectLogoDk.png\" style=\"height:38px;\"></div>";
		echo "<div class=\"aip_graphic\">";
		echo '<div class="aip_graphic_col"><a href="/wp-admin/admin.php?page=postperfect-ai-ideas"><img src="'.$imgpath.'images/aip_ai_1684251344.png" class="aip_graphic_img" alt="'.__("Generate Ideas","post-perfect-ai").'"></a></div>';
		echo '<div class="aip_graphic_col sm"><img src="'.$imgpath.'images/arrow2.png" class="aip_graphic_img"></div>';
		echo '<div class="aip_graphic_col"><a href="/wp-admin/admin.php?page=postperfect-ai-articles"><img src="'.$imgpath.'images/aip_ai_1684252515.png" class="aip_graphic_img" alt="'.__("Create Articles","post-perfect-ai").'"></a></div>';
		echo '<div class="aip_graphic_col sm"><img src="'.$imgpath.'images/arrow2.png" class="aip_graphic_img"></div>';
		echo '<div class="aip_graphic_col"><a href="/wp-admin/admin.php?page=postperfect-ai-images"><img src="'.$imgpath.'images/design_images.png" class="aip_graphic_img" alt="'.__("Design Images","post-perfect-ai").'"></a></div>';
		echo "</div>";
		echo "<div class=\"aip_graphic\">";
		echo '<div class="aip_graphic_col"><h2><a href="/wp-admin/admin.php?page=postperfect-ai-ideas">'.__("Generate Ideas","post-perfect-ai").'</a></h2><div class="aip-credit-wrapper"><output class="aip-credit-output" data-type="idea">'.$credits[0].'</output></div><div class="aip-credit-wrapper"><span style="aip-credit-label">'.__("CREDITS","post-perfect-ai").'</span></div></div>';
		echo '<div class="aip_graphic_col sm">&nbsp;</div>';
		echo '<div class="aip_graphic_col"><h2><a href="/wp-admin/admin.php?page=postperfect-ai-articles">'.__("Create Articles","post-perfect-ai").'</a></h2><div class="aip-credit-wrapper"><output class="aip-credit-output" data-type="idea">'.$credits[1].'</output></div><div class="aip-credit-wrapper"><span style="aip-credit-label">'.__("CREDITS","post-perfect-ai").'</span></div></div>';
		echo '<div class="aip_graphic_col sm">&nbsp;</div>';
		echo '<div class="aip_graphic_col"><h2><a href="/wp-admin/admin.php?page=postperfect-ai-images">'.__("Design Images","post-perfect-ai").'</a></h2><div class="aip-credit-wrapper"><output class="aip-credit-output" data-type="idea">'.$credits[2].'</output></div><div class="aip-credit-wrapper"><span style="aip-credit-label">'.__("CREDITS","post-perfect-ai").'</span></div></div>';
		echo "</div>";
		echo "</div>";
	}
	public function custom_link_ideas_content() {
		echo "";
	}
	public function add_custom_link_ideas() {
		add_submenu_page("postperfect-ai",__("View Ideas","post-perfect-ai"),__("View Ideas","post-perfect-ai"),"edit_posts","postperfect-ai-ideas-view",array($this,"custom_link_ideas_content"),3);
	}
	public function add_custom_link_articles() {
		add_submenu_page("postperfect-ai",__("View Articles","post-perfect-ai"),__("View Articles","post-perfect-ai"),"edit_posts","postperfect-ai-articles-view",array($this,"custom_link_ideas_content"),5);
	}
	public function add_custom_link_images() {
		add_submenu_page("postperfect-ai",__("View Images","post-perfect-ai"),__("View Images","post-perfect-ai"),"edit_posts","postperfect-ai-images-view",array($this,"custom_link_ideas_content"),7);
	}
	public function filter_custom_url() {
		global $submenu;
		if (!isset($submenu["postperfect-ai"])) return;
		foreach($submenu["postperfect-ai"] as $k1 => $a2) {
			if ($a2[0] === "View Ideas") {
				$submenu["postperfect-ai"][$k1][2] = "edit.php?post_type=ppai-ideas";
			}
			if ($a2[0] === "View Articles") {
				$submenu["postperfect-ai"][$k1][2] = "edit.php";
			}
			if ($a2[0] === "View Images") {
				$submenu["postperfect-ai"][$k1][2] = "upload.php";
			}
		}
	}
	public function admin_ideas_menu() {
		add_submenu_page("postperfect-ai",__("Generate Ideas","post-perfect-ai"),__("Generate Ideas","post-perfect-ai"),"edit_posts","postperfect-ai-ideas",array($this,"admin_ideas_page"),2);
	}
	protected function check_empty_ideas($data) {
		$allempty = true;
		foreach($data as $arr) {
			if (!empty($arr)) $allempty = false;
		}
		return $allempty;
	}
	protected function process_admin_ideas() {
		$is_reg = get_option("aip_is_registered",0);
		if (!$is_reg) {
			$this->notice(__("Please register the plugin to generate ideas.","post-perfect-ai")." <a href=\"/wp-admin/admin.php?page=postperfect-ai-settings\">".__("Settings","post-perfect-ai")."</a>",2);
			return;
		}
		$data = new stdClass;
		$data->genres = $this->filter_json_array($_POST['aip_genre_hidden']);
		$data->keywords = $this->filter_json_array($_POST['aip_keywords_hidden']);
		
		//gpt4 required
		//$data->urls = $this->filter_json_array($_POST['aip_urls_hidden'],true);
		//$data->categories = $this->filter_array($_POST['aip_categories'],true);
		
		$data->urls = [];
		$data->categories = [];
		$data->optimize = intval($_POST['aip_goal']);
		if ($this->check_empty_ideas($data)) {
			$this->notice(__("You must add at least one form of context, a `Topic` or `Keywords` and remember to click the `Add` button.","post-perfect-ai"));
			return;
		}
		$data->action = 0;
		$data->url = $this->get_stripped_url();
		$data->timestamp = time();
		$data->clientID = get_option("aip_client_id","");
		$data->signature = $this->sign_data($data);
		$output = $this->call_api($this->endpoint,$data);
		if ($output->statusCode === 200) {
			$this->set_waiting("idea");
			$this->notice(__("Your ideas are being generated. Please allow 1-2 minutes for new ideas to become available.","post-perfect-ai")." <a href=\"/wp-admin/edit.php?post_type=ppai-ideas\">".__("View Ideas","post-perfect-ai")."</a>",2);
		} else {
			$path = "/wp-admin/admin.php?page=postperfect-ai-help";
			$this->notice(sprintf(_x("The ideas could not be generated, please try again. If you continue to experience problems, use the <a href=\"%s\">help</a> section to contact support.","Replacement is a URL and can be ignored.","post-perfect-ai"),$path),0);
		}
		
	}
	public function admin_ideas_page() {
		if (isset($_POST['aip_generate_ideas_submit'])) $this->process_admin_ideas();
		$inputs = array();
		$tp_desc = __("The general idea that you want your article to be about, whether it's travel, business, or anything else, the AI adapts to your chosen Topic.","post-perfect-ai");
		$inputs[] = array(
			"aip_genre",
			__("Topic","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$tp_desc\"></span>",
			$this->generate_input("aip_genre")
		);
		$kw_desc = __("These can be brands, places, or concepts you want to incorporate to help the AI generate more tailored ideas just for you. Keywords provide additional context and narrow down the focus of your article.","post-perfect-ai");
		$inputs[] = array(
			"aip_keywords",
			__("Keywords","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$kw_desc\"></span>",
			$this->generate_input("aip_keywords")
		);
		/*
		$inputs[] = array(
			"aip_urls",
			"URLs",
			$this->generate_input("aip_urls")
		);
		
		$inputs[] = array(
			"aip_categories",
			"Categories",
			$this->generate_input("aip_categories")
		);
		*/
		$ip_desc = __("Allows you to select the goal you want to achieve with your article. Adding an optimization helps the AI create content aligned with your objectives.","post-perfect-ai");
		$inputs[] = array(
			"aip_goal",
			__("Optimize","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$ip_desc\"></span>",
			$this->generate_input("aip_goal")
		);
		
		$inputs[] = array(
			"aip_generate_ideas",
			"",
			$this->generate_input("aip_generate_ideas", __("Generate Ideas","post-perfect-ai"))
		);
		
		$imgpath = plugin_dir_url(__FILE__);
		echo "<img class=\"ppai-heading-image\" src=\"".$imgpath."images/aip_ai_1684251344.png\">";
		echo "<div class=\"wrap\"><h1>".__("Generate Ideas","post-perfect-ai")."</h1>";
		echo "<h2>".__("Select Context","post-perfect-ai")."</h2>";
		echo "<form action=\"/wp-admin/admin.php?page=postperfect-ai-ideas\" id=\"aip-gen-ideas-form\" method=\"post\">";
		echo $this->format_table($inputs);
		echo "</form>";
	}
	public function admin_content_menu() {
		add_submenu_page("postperfect-ai",__("Create Articles","post-perfect-ai"),__("Create Articles","post-perfect-ai"),"edit_posts","postperfect-ai-articles",array($this,"admin_content_page"),4);
	}
	protected function get_idea_details($post_id) {
		return array(get_the_title($post_id),get_the_excerpt($post_id));
	}
	protected function process_content_page() {
		$is_reg = get_option("aip_is_registered",0);
		if (!$is_reg) {
			$this->notice(__("Please register the plugin to create articles.","post-perfect-ai")." <a href=\"/wp-admin/admin.php?page=postperfect-ai-settings\">".__("Settings","post-perfect-ai")."</a>",2);
			return;
		}
		$data = new stdClass;
		$data->action = 1;
		$data->url = $this->get_stripped_url();
		$data->timestamp = time();
		$data->clientID = get_option("aip_client_id","");
		$data->title = filter_input(INPUT_POST,'aip_title',FILTER_SANITIZE_STRING);
		$data->description = filter_input(INPUT_POST,'aip_description',FILTER_SANITIZE_STRING);
		if ($data->title === false || $data->title ==="" || $data->description === false || $data->description === "") {
			$this->notice(__("Please provide a `Title` and a `Description` for your article.","post-perfect-ai"),0);
			return;
		}
		//$data->urls = $this->filter_json_array($_POST['aip_urls_hidden'],true);
		$data->urls = [];
		$data->signature = $this->sign_data($data);
		$output = $this->call_api($this->endpoint,$data);
		if ($output->statusCode === 200) {
			$this->set_waiting("article");
			$this->notice(__("The article is being created. Please allow 1-2 minutes for new articles to become available.","post-perfect-ai")." <a href=\"/wp-admin/edit.php\">".__("View Articles","post-perfect-ai")."</a>",2);
		} else {
			$path = "/wp-admin/admin.php?page=postperfect-ai-help";
			$this->notice(sprintf(_x("The article could not be created, please try again. If you continue to experience problems, use the <a href=\"%s\">help</a> section to contact support.","The replacement is a URL and can be ignored.","post-perfect-ai"),$path),0);
		}
		
	}
	public function admin_content_page() {
		if (isset($_POST['aip_generate_article_submit'])) $this->process_content_page();
		$title = "";
		$desc = "";
		if (isset($_GET['aip_post_id'])) {
			$details = $this->get_idea_details(filter_input(INPUT_GET,'aip_post_id',FILTER_VALIDATE_INT));
			$title = $details[0];
			$desc = $details[1];
		}
		
		
		$inputs = array();
		$at_desc = __("This will be the Title of the article you want the AI to create.","post-perfect-ai");
		$inputs[] = array(
			"aip_title",
			__("Article Title","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$at_desc\"></span>",
			$this->generate_input("aip_title",$title)
		);
		$ar_desc = __("This is a brief description of what the article will be about. This is also where you can add additional context for the AI, whether it be information about a product that has not been released yet or specific services that your company provides. This allows the AI to create the most accurate content tailored to your specific needs.","post-perfect-ai");
		$inputs[] = array(
			"aip_description",
			__("Article Description","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$ar_desc\"></span>",
			$this->generate_input("aip_description",$desc)
		);
		/*
		$inputs[] = array(
			"aip_urls",
			"URLs",
			$this->generate_input("aip_urls")
		);
		*/
		$inputs[] = array(
			"aip_generate_article",
			"",
			$this->generate_input("aip_generate_article","Create Article")
		);
		$imgpath = plugin_dir_url(__FILE__);
		echo "<img class=\"ppai-heading-image\" src=\"".$imgpath."images/aip_ai_1684252515.png\">";
		echo "<div class=\"wrap\"><h1>".__("Create Articles","post-perfect-ai")."</h1>";
		echo "<h2>".__("Basic Details","post-perfect-ai")."</h2>";
		echo "<form action=\"/wp-admin/admin.php?page=postperfect-ai-articles\" id=\"aip-gen-articles-form\" method=\"post\">";
		echo $this->format_table($inputs);
		echo "</form></div>";
	}
	public function admin_images_menu() {
		add_submenu_page("postperfect-ai",__("Design Images","post-perfect-ai"),__("Design Images","post-perfect-ai"),"edit_posts","postperfect-ai-images",array($this,"admin_images_page"),6);
	}
	protected function process_admin_images() {
		$is_reg = get_option("aip_is_registered",0);
		if (!$is_reg) {
			$this->notice(__("Please register the plugin to design images.","post-perfect-ai")." <a href=\"/wp-admin/admin.php?page=postperfect-ai-settings\">".__("Settings","post-perfect-ai")."</a>",2);
			return;
		}
		$data = new stdClass;
		$data->action = 2;
		$data->url = $this->get_stripped_url();
		$data->samples = filter_input(INPUT_POST,"aip_batch_size",FILTER_VALIDATE_INT);
		$data->enhance = isset($_POST['aip_image_enhance']) ? 1 : 0;
		if ($data->enhance) {
			$data->style = filter_input(INPUT_POST,"aip_image_style",FILTER_VALIDATE_INT);
			$data->subject = filter_input(INPUT_POST,"aip_image_subject",FILTER_SANITIZE_STRING);
			$data->image_action = filter_input(INPUT_POST,"aip_image_action",FILTER_SANITIZE_STRING);
			$data->setting = filter_input(INPUT_POST,"aip_image_setting",FILTER_SANITIZE_STRING);
			$data->tod = filter_input(INPUT_POST,"aip_image_time",FILTER_SANITIZE_STRING);
			$data->camera = filter_input(INPUT_POST,"aip_image_camera",FILTER_SANITIZE_STRING);
			$data->lens = filter_input(INPUT_POST,"aip_image_lens",FILTER_SANITIZE_STRING);
			$data->artists = $this->filter_json_array($_POST['aip_image_artist_hidden']);
			$data->negative = filter_input(INPUT_POST,"aip_image_negative",FILTER_SANITIZE_STRING);
			if ($data->subject === "" && $data->image_action === "" && $data->setting === "" && $data->tod === "") {
				$this->notice(__("You must specify a `Subject` or `Action` or `Setting` to create an enhanced image.","post-perfect-ai"),0);
				return;
			}
		} else {
			$data->prompt = filter_input(INPUT_POST,"aip_image_prompt",FILTER_SANITIZE_STRING);
			if ($data->prompt === "") {
				$this->notice(__("Please enter text for the image prompt. The prompt cannot be empty.","post-perfect-ai"),0);
				return;
			}
		}
		$plurals = "image is";
		$plur = "image";
		if ($data->samples > 1) {
			$plurals = "images are";
			$plur = "images";
		}
		
		$i18n_plural_image = _n("image is", "images are",$data->samples,"post-perfect-ai");
		$i18n_plural_single_image = _n("image", "images",$data->samples,"post-perfect-ai");
		
		$data->timestamp = time();
		$data->clientID = get_option("aip_client_id","");
		$data->signature = $this->sign_data($data);
		$output = $this->call_api($this->endpoint,$data);
		if ($output->statusCode === 200) {
			$this->set_waiting("image");
			$this->notice(sprintf(_x("Your %s being designed. Please allow 1-2 minutes for new images to become available.","Values are: `image is` or `images are`","post-perfect-ai"),$i18n_plural_image)." <a href=\"/wp-admin/upload.php\">".__("View Images","post-perfect-ai")."</a>",2);
		} else {
			$path = "/wp-admin/admin.php?page=postperfect-ai-help";
			$this->notice(sprintf(_x('The %1$s could not be design, please try again. If you continue to experience problems, use the <a href=\"%2$s\">help</a> section to contact support.',"First replacement values are: `image` or `images`, Second replacement is a URL and can be ignored","post-perfect-ai"),$i18n_plural_single_image,$path),0);
		}
	}
	public function admin_images_page() {
		if (isset($_POST['aip_submit_image_submit'])) $this->process_admin_images();
		$planid = get_option("aip-planid",1);
		$basic_inputs = array();
		$pr_desc = __("Design Images by crafting your own prompt to send directly to our image generation AI.","post-perfect-ai");
		$basic_inputs[] = array(
			"aip_image_prompt",
			__("Prompt","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$pr_desc\"></span>",
			$this->generate_input("aip_image_prompt")
		);
		
		$inputs = array();
		$is_desc = __("Select the style you want your image to be. For life-like images select \"Photographic\" or \"Cinematic\", for cartoon style images select \"Anime\" or \"Comic Book\".","post-perfect-ai");
		$inputs[] = array(
			"aip_image_style",
			__("Style","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt='$is_desc'></span>",
			$this->generate_input("aip_image_style")
		);
		$isu_desc = __("This will be the main focus of your image, whether it is an animal, a mountain range, or a stack of pancakes, the AI will produce an image that is centered around your chosen \"Subject\".","post-perfect-ai");
		$inputs[] = array(
			"aip_image_subject",
			__("Subject","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt='$isu_desc'></span>",
			$this->generate_input("aip_image_subject")
		);
		$ia_desc = __("This is what the \"Subject\" of your image is currently doing. Things like playing baseball, hiking, or flying a kite are a few examples for what could go in this field.","post-perfect-ai");
		$inputs[] = array(
			"aip_image_action",
			__("Action","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt='$ia_desc'></span>",
			$this->generate_input("aip_image_action")
		);
		$ist_desc = __("This is where everything in your image is taking place. For example, the beach, downtown Tokyo, or Mount Everest.","post-perfect-ai");
		$inputs[] = array(
			"aip_image_setting",
			__("Setting","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$ist_desc\"></span>",
			$this->generate_input("aip_image_setting")
		);
		$it_desc = __("This field will determine the lighting for your image. For example, an image with \"Sunset\" as the \"Time of Day\" will likely produce an image with a warm, orange sky as the sun sets in the background.","post-perfect-ai");
		$inputs[] = array(
			"aip_image_time",
			__("Time of day","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt='$it_desc'></span>",
			$this->generate_input("aip_image_time")
		);
		$ia_desc = __("If you would like your image to be created in the style of a certain artist or artists, add them here.","post-perfect-ai");
		$inputs[] = array(
			"aip_image_artist",
			__("Artist Style","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$ia_desc\"></span>",
			$this->generate_input("aip_image_artist")
		);
		$ic_desc = __("Allows the AI to produce images that appear as if they were taken with a specific brand and model of camera. This setting is only available with \"Photographic\" and \"Cinematic\" Styles.","post-perfect-ai");
		$inputs[] = array(
			"aip_image_camera",
			__("Camera","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt='$ic_desc'></span>",
			$this->generate_input("aip_image_camera")
		);
		$il_desc = __("Allows the AI to produce images that appear as if they were taken with a particular camera lens such as a \"Wide Angle Lens\" in order to capture the entirety of an image or \"Macro Lens\" to get a close-up shot. This setting is only available with \"Photographic\" and \"Cinematic\" Styles.","post-perfect-ai");
		$inputs[] = array(
			"aip_image_lens",
			__("Camera Lens","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt='$il_desc'></span>",
			$this->generate_input("aip_image_lens")
		);
		$in_desc = __("The negative prompt should include elements NOT to include in the image.","post-perfect-ai");
		$inputs[] = array(
			"aip_image_negative",
			__("Negative Prompt","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt='$in_desc'></span>",
			$this->generate_input("aip_image_negative")
		);
		$all_inputs = array();
		if ($planid > 1) {
		$ib_desc = __("Select between 1-4 image variations for the AI to generate from your prompt.","post-perfect-ai");	
		$all_inputs[] = array(
			"aip_batch_size",
			__("Variations","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$ib_desc\"></span>",
			$this->generate_input("aip_batch_size")
		);
		}
		$ie_desc = __("Allow AI to help create your image prompt to generate stunning imagery.","post-perfect-ai");
		$all_inputs[] = array(
			"aip_image_enhance",
			__("Enhance Prompt","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$ie_desc\"></span>",
			$this->generate_input("aip_image_enhance")
		);
		$all_inputs[] = array(
			"aip_submit_image",
			"",
			$this->generate_input("aip_submit_image", __("Design Image","post-perfect-ai"))
		);
		$imgpath = plugin_dir_url(__FILE__);
		echo "<img class=\"ppai-heading-image\" src=\"".$imgpath."images/design_images.png\">";
		echo "<div class=\"wrap\"><h1>".__("Design Images","post-perfect-ai")."</h1>";
		echo "<h2>".__("Image Details","post-perfect-ai")."</h2>";
		echo "<form action=\"/wp-admin/admin.php?page=postperfect-ai-images\" id=\"aip-gen-images-form\" method=\"post\">";
		echo "<div id=\"aip_image_basic\">";
		echo $this->format_table($basic_inputs);
		echo "</div>";
		echo "<div id=\"aip_image_advanced\">";
		echo $this->format_table($inputs);
		echo "</div>";
		echo $this->format_table($all_inputs);
		echo "</form>";
		echo "</div>";
	}
	public function admin_help_menu() {
		add_submenu_page("postperfect-ai","PostPerfect AI ".__("Help","post-perfect-ai"), __("Help","post-perfect-ai"), "edit_posts","postperfect-ai-help",array($this,"admin_help_page"),9);
	}
	protected function process_admin_help() {
		$is_reg = get_option("aip_is_registered",0);
		if (!$is_reg) {
			$this->notice(__("Please register the plugin to enable `help`.","post-perfect-ai")." <a href=\"/wp-admin/admin.php?page=postperfect-ai-settings\">".__("Settings","post-perfect-ai")."</a>",2);
			return;
		}
		$type = filter_input(INPUT_POST,'aip_help_type',FILTER_VALIDATE_INT);
		$desc = filter_input(INPUT_POST,'aip_help_desc',FILTER_SANITIZE_STRING);
		if ($type === false || $type === 0 || $desc === false || $desc === "") {
			$this->notice(__("Please select a service type and provide a description of the problem.","post-perfect-ai"),2);
			return;
		}
		$data = new stdClass;
		$data->action = 4;
		$data->type = $type;
		$data->details = $desc;
		$data->timestamp = time();
		$data->url = $this->get_stripped_url();
		$data->clientID = get_option("aip_client_id","");
		$data->signature = $this->sign_data($data);
		$res = $this->call_api($this->endpoint,$data);
		if ($res->statusCode === 200) {
				$credits = new stdClass;
				$credits->idea = $res->idea;
				$credits->article = $res->article;
				$credits->image = $res->image;
				$this->update_credits($credits);
				update_option("aip-planid",$res->planid,false);
			
			$this->notice($res->message,2);
		} else {
			$support_message = urlencode(__("Please login for support.","post-perfect-ai"));
			$support_url = "https://postperfectai.com/index.html?signin=1&info=".$support_message."&path=support";
			$support_notice = sprintf(_x("There was an error reporting your problem, please try again. If the problem persists, please contact our primary <a href=\"%s\" target=\"_blank\">support team</a>.","Replacement is a URL and can be ignored","post-perfect-ai"),$support_url);
			$this->notice($support_notice,0);
		}
	}
	public function admin_help_page() {
		if (isset($_POST['aip_help_submit_submit'])) $this->process_admin_help();
		$inputs = array();
		$st_desc = __("Select the service you encountered an issue with.","post-perfect-ai");
		$inputs[] = array(
			"aip_help_type",
			__("Service Type","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$st_desc\"></span>",
			$this->generate_input("aip_help_type")
		);
		$d_desc = __("Give a brief description of the problem so our development team can make further improvements to the plugin.","post-perfect-ai");
		$inputs[] = array(
			"aip_help_desc",
			__("Description","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$d_desc\"></span>",
			$this->generate_input("aip_help_desc")
		);
		$inputs[] = array(
			"aip_help_submit",
			"",
			$this->generate_input("aip_help_submit", __("Send Data","post-perfect-ai"))
		);
		
		$inp2 = array();
		$inp2[] = array(
			"here_to_help",
			__("Here to Help","post-perfect-ai"),
			__("Let us know if you have a problem using the PostPerfect AI Plugin for WordPress.","post-perfect-ai")
		);
		
		$inp3 = array();
		$do_url = "https://postperfectai.com/documentation.html";
		$do_desc = sprintf(_x('View the full <a href="%1$s" target="%2$s">documentation</a>.',"Replacements are URL parameters and can be ignored","post-perfect-ai"),$do_url,"_blank");
		$inp3[] = array(
			"help_docs",
			__("Documentation","post-perfect-ai"),
			$do_desc
		);
		$support_message = urlencode(__("Please login for support.","post-perfect-ai"));
		$li_url = "https://postperfectai.com/index.html?signin=1&info=".$support_message."&path=support";
		$li_desc = sprintf(_x('Login to your account to contact the PostPerfect AI <a href="%1$s" target="%2$s">support team</a>.',"Replacements are URL parameters and can be ignored","post-perfect-ai"),$li_url,"_blank");
		$inp3[] = array(
			"other_issue",
			__("Still Have a Question?","post-perfect-ai"),
			$li_desc
		);
		
		
		echo "<div class=\"wrap\"><h1>PostPerfect AI ".__("Help","post-perfect-ai")."</h1><h2>".__("Customer Service","post-perfect-ai")."</h2>";
		echo "<form action=\"/wp-admin/admin.php?page=postperfect-ai-help\" id=\"ppai-help-form\" method=\"post\">";
		echo $this->format_table($inp2);
		echo "<h2>".__("Report a Problem","post-perfect-ai")."</h2>";
		echo $this->format_table($inputs);
		echo "</form>";
		echo "<h2>".__("Additional Support","post-perfect-ai")."</h2>";
		echo $this->format_table($inp3);
		echo "</div>";
	}
	
	public function admin_settings_menu() {
		add_submenu_page("postperfect-ai","PostPerfect AI ".__("Settings","post-perfect-ai"), __("Settings","post-perfect-ai"), "edit_posts", "postperfect-ai-settings", array($this,"admin_settings_page"),8);
	}
	protected function process_admin_settings() {
		if (isset($_POST['aip_update_settings_submit'])) {
			$current_client_id = get_option("aip_client_id","");
			$current_api_key = get_option("aip_api_key","");
			
			
			$confirm = isset($_POST['aip_always_confirm']) ? 1 : 0;
			$useog = isset($_POST['aip_use_og']) ? true : false;
			$client_id = filter_input(INPUT_POST,'aip_client_id',FILTER_SANITIZE_STRING);
			$api_key = filter_input(INPUT_POST,'aip_api_key',FILTER_SANITIZE_STRING);
			
			if ($client_id !== $current_client_id || $api_key !== $current_api_key) {
				update_option("aip_is_registered",0,false);
			}
			
			$cu = update_option("aip_always_confirm",$confirm,false);
			$cidu = update_option("aip_client_id",$client_id,false);
			$au = update_option("aip_api_key",$api_key,false);
			
			$ogu = update_option("aip_use_og",$useog,false);
			

			$this->notice(__("The settings were updated.","post-perfect-ai"),2);
			return;
		}
		if (isset($_POST['aip_api_register_submit'])) {
			$data = new stdClass;
			$data->action = 3;
			$data->clientID = get_option("aip_client_id","");
			$data->user = get_option("aip_api_user","");
			$data->pass = get_option("aip_application_password","");
			$data->url = $this->get_stripped_url();
			$data->timestamp = time();
			$data->signature = $this->sign_data($data);

			$response = $this->call_api($this->endpoint,$data);
			if ($response->statusCode === 200) {
				$credits = new stdClass;
				$credits->idea = $response->idea;
				$credits->article = $response->article;
				$credits->image = $response->image;
				$this->update_credits($credits);
				update_option("aip_planid",$response->planid,false);
				update_option("aip_is_registered",1,false);
				$this->notice(__("Your plugin has been registered.","post-perfect-ai"),2);
			} else {
				$this->notice(__("Your plugin could not be registered. Please try again.","post-perfect-ai"),0);
			}
		}
	}
	protected function obscure_password($pass) {
		$out = "";
		for($i=0;$i<strlen($pass);$i++) {
			$out.="*";
		}
		return $out;
	}
	public function admin_settings_page() {
		if (isset($_POST['aip_update_settings_submit']) || isset($_POST['aip_api_register_submit'])) $this->process_admin_settings();
		
		$client_id = get_option("aip_client_id", "");
		$api_key = get_option("aip_api_key","");
		$always_confirm = get_option("aip_always_confirm",1);
		$status = get_option("aip_is_registered",0);
		$stat_label = $status ? "Registered" : "Un-registered";
		
		$api_username = get_option("aip_api_user","");
		$application_password = get_option("aip_application_password","");

		$obscured = $this->obscure_password($application_password);
		
		$plugin_registered = get_option("aip_registered",false);
		
		$confirm_checked = $always_confirm ? "checked" : "";
		
		$allow_register = $client_id !== "" && $api_key !== "" && $api_username !== "" && $application_password !== "" ? "" : "disabled";
		
		$og = get_option("aip_use_og",true);
		$useog = $og ? " checked" : "";
		
		$inputs = array();
		$cid_desc = __("You can obtain your Client ID by acquiring a subscription at PostPerfectAI.com.","post-perfect-ai");
		$inputs[] = array(
			"aip_client_id",
			"API Client ID <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$cid_desc\"></span>",
			$this->generate_input("aip_client_id",$client_id)
		);
		$key_desc = __("You can obtain your API Key by acquiring a subscription at PostPerfectAI.com REMEMBER: Never share your API key with anyone.","post-perfect-ai");
		$inputs[] = array(
			"aip_api_key",
			"API Key <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$key_desc\"></span>",
			$this->generate_input("aip_api_key",$api_key)
		);
		$og_desc = __("OpenGraph data is used by social media sites to display information about a post when it is linked on social media. We recommend leaving this option set enabled, unless you have another plugin or theme adding the data.","post-perfect-ai");
		$inputs[] = array(
			"aip_use_og",
			__("Use","post-perfect-ai")." OpenGraph <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$og_desc\"></span>",
			$this->generate_input("aip_use_og",$useog),
		);
		$ac_desc = __("Prevents neglegent entries by adding a pop up box that allows you to confirm whether you want to submit a form before it has been submitted.","post-perfect-ai");
		$inputs[] = array(
			"aip_always_confirm",
			__("Always Confirm","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$ac_desc\"></span>",
			$this->generate_input("aip_always_confirm",$confirm_checked)
		);
		$inputs[] = array(
			"aip_update_settings",
			"",
			$this->generate_input("aip_update_settings",__("Update Settings","post-perfect-ai"))
		);
		
		$reg_inputs = array();
		$un_desc = __("This is the name of the user created by the PostPerfect AI plugin in order to create posts for your website. WARNING: Deleting this user will prevent the plugin from working properly.","post-perfect-ai");
		$reg_inputs[] = array(
			"aip_api_username",
			"API User <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$un_desc\"></span>",
			$this->generate_input("aip_api_username",$api_username)
		);
		$ap_desc = __("This is the password that the plugin will use to connect to your website.","post-perfect-ai");
		$reg_inputs[] = array(
			"aip_api_application_password",
			__("Application Password","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$ap_desc\"></span>",
			$this->generate_input("aip_api_application_password",$obscured)
		);
		$url_desc = __("The home URL of your WordPress website. This is the URL you will provide PostPerfect AI when generating your API key.","post-perfect-ai");
		$reg_inputs[] = array(
			"aip_api_siteurl",
			__("Site URL","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt=\"$url_desc\"></span>",
			$this->generate_input("aip_api_siteurl",get_bloginfo("url"))
		);
		$st_desc = __("Will show as \"Registered\" once your plugin has been successfully registered. To register your plugin, please provide the API Client ID and API Key distributed by PostPerfect AI and click the \"Update Settings\" button, followed by the \"Register Plugin\" button.","post-perfect-ai");
		$reg_inputs[] = array(
			"aip_registration_status",
			__("Status","post-perfect-ai")." <span class=\"dashicons dashicons-info-outline aip-small-icon\" alt='$st_desc'></span>",
			$this->generate_input("aip_registration_status",$stat_label)
		);
		if (!$status) {
			$reg_inputs[] = array(
				"aip_api_register",
				"",
				$this->generate_input("aip_api_register",__("Register Plugin","post-perfect-ai"), $allow_register)
			);
		}
		echo "<div class=\"wrap\"><h1>PostPerfect AI ".__("Settings","post-perfect-ai")."</h1><h2>".__("Basic Settings","post-perfect-ai")."</h2>";
		echo "<form action=\"/wp-admin/admin.php?page=postperfect-ai-settings\" id=\"update-settings-form\" method=\"post\">";
		echo $this->format_table($inputs);
		echo "</form>";
		echo "<form action=\"/wp-admin/admin.php?page=postperfect-ai-settings\" id=\"register-plugin-form\" method=\"post\">";
		echo "<h2>".__("Plugin Registration","post-perfect-ai")."</h2>";
		echo $this->format_table($reg_inputs);
		echo "</form>";
		echo "</div>";
	}
	
	
	protected function get_cat_array() {
		$categories = get_categories();
		$catdata = [];
		foreach($categories as $category) {
			$catdata[] = array(
				$category->cat_ID,
				$category->cat_name,
				get_category_link($category->cat_ID)
			);
		}
		return $catdata;
	}
	protected function filter_array($input,$url=false) {
		$out = array();
		if ($input === "") return $out;
		foreach($input as $in) {
			if ($url) {
				if (substr($in,0,4) !== "http") $in = "https://".$in;
				$out[] = filter_var($in,FILTER_VALIDATE_URL);
			} else {
				$out[] = filter_var($in,FILTER_SANITIZE_STRING);
			}
		}
		return $out;
	}
	protected function notice($message,$type=0,$echo=true) {
		switch($type) {
			case 0:
			default:
				$class = "notice-error is-dismissible";
			break;
			case 1:
				$class = "notice-waring is-dismissible";
			break;
			case 2:
				$class = "notice-info is-dismissible";
			break;
		}
		$txt = "<div class=\"notice {$class}\"><p>{$message}</p></div>";
		if (!$echo) return $txt;
		echo $txt;
	}
	protected function filter_json_array($input,$url=false) {
		$out = array();
		if ($input === "") return $out;
		$input = stripcslashes($input);
		$arr = json_decode($input);
		if ($arr === null) return $out;
		foreach($arr as $in) {
			if ($url) {
				if (substr($in,0,4) !== "http") $in = "https://".$in;
				$out[] = filter_var($in,FILTER_VALIDATE_URL);
			} else {
				$out[] = filter_var($in,FILTER_SANITIZE_STRING);
			}
		}
		return $out;
	}
	
	protected function generate_input($name,$value="",$disabled="") {
		$confirm = get_option("aip_always_confirm",1);
		$cfm = " data-confirm=\"$confirm\"";
		$ph = "";
		$pv = "";
		$pl = "";
		switch($name) {
			case "aip_genre":
				$ph = __("Add Topic","post-perfect-ai");
				$pl = __("Selected Topics:","post-perfect-ai");
				break;
			case "aip_keywords":
				$ph = __("Enter Keyword or Phrase","post-perfect-ai");
				$pv = __("Add Keyword","post-perfect-ai");
				$pl = __("Selected Keywords:","post-perfect-ai");
				break;
			case "aip_urls":
				$ph = __("Enter URL","post-perfect-ai");
				$pv = __("Add URL","post-perfect-ai");
				$pl = __("Selected URLs:","post-perfect-ai");
				break;
			case "aip_help_desc":
				$ph = __("Tell us what happened...","post-perfect-ai");
				break;
			case "aip_image_prompt":
				$ph = __("A detailed description of your desired image...","post-perfect-ai");
				break;
			case "aip_image_subject":
				$ph = __("A person, place, or thing...","post-perfect-ai");
				break;
			case "aip_image_action":
				$ph = __("Doing something...","post-perfect-ai");
				break;
			case "aip_image_setting":
				$ph = __("In a place...","post-perfect-ai");
				break;
			case "aip_image_time":
				$ph = __("At a specific time...","post-perfect-ai");
				break;
			case "aip_image_negative":
				$ph = __("Things NOT to include...","post-perfect-ai");
				break;
			case "aip_image_artist":
				$ph = __("Artist name","post-perfect-ai");
				$pv = __("Add Artist","post-perfect-ai");
				$pl = __("Selected Artists:","post-perfect-ai");
				break;
			default:
				$ph = "";
				$pv = "";
				$pl = "";
				break;
		}
		switch($name) {
			case "aip_genre":
				return "<input type=\"text\" name=\"$name\" id=\"$name\" value=\"$value\" placeholder=\"$ph\" class=\"regular-text aip-focus-enter\" data-buttonid=\"{$name}_button\"> <input type=\"button\" name=\"{$name}_button\" id=\"{$name}_button\" data-slug=\"{$name}\" class=\"aip-add-button\" value=\"$ph\"><br>
				<p class=\"description\">$pl<br><span id=\"{$name}_output\">".__("None","post-perfect-ai")."</span></p><input type=\"hidden\" value=\"\" id=\"{$name}_hidden\" name=\"{$name}_hidden\">";
				break;
			case "aip_keywords":
				return "<input type=\"text\" name=\"$name\" id=\"$name\" value=\"$value\" placeholder=\"$ph\" class=\"regular-text aip-focus-enter\" data-buttonid=\"{$name}_button\"> <input type=\"button\" name=\"{$name}_button\" id=\"{$name}_button\" data-slug=\"{$name}\" class=\"aip-add-button\" value=\"$pv\"><br>
				<p class=\"description\">$pl<br><span id=\"{$name}_output\">".__("None","post-perfect-ai")."</span></p><input type=\"hidden\" value=\"\" id=\"{$name}_hidden\" name=\"{$name}_hidden\">";
				break;
			case "aip_urls":
				return "<input type=\"text\" name=\"$name\" id=\"$name\" value=\"$value\" placeholder=\"$ph\" class=\"regular-text aip-focus-enter\" data-buttonid=\"{$name}_button\"> <input type=\"button\" name=\"{$name}_button\" id=\"{$name}_button\" data-slug=\"{$name}\" class=\"aip-add-button\" value=\"$pv\"><br>
				<p class=\"description\">$pl<br><span id=\"{$name}_output\">".__("None","post-perfect-ai")."</span></p><input type=\"hidden\" value=\"\" id=\"{$name}_hidden\" name=\"{$name}_hidden\">";
				break;
			case "aip_categories":
				return $this->format_category_inputs($this->get_cat_array());
				break;
			case "aip_help_type":
				//return '<select name="'.$name.'"><option value="0">Select a type</option><option value="1">Idea Generation</option><option value="2">Article Creation</option><option value="3">Image Design</option></select>';
				return '<select name="'.$name.'">'.$this->generate_options(array(
					__("Select a type","post-perfect-ai"),
					__("Idea Generation","post-perfect-ai"),
					__("Article Creation","post-perfect-ai"),
					__("Image Design","post-perfect-ai")
				)).'</select>';
				break;
			case "aip_help_desc":
				return '<textarea name="'.$name.'" rows="6" cols="50" class="code" placeholder="'.$ph.'"></textarea>';
				break;
			case "aip_help_submit":
			case "aip_verify_credits":
			case "aip_update_settings":
			case "aip_generate_article":
			case "aip_submit_image":
			case "aip_generate_ideas":
				return '<input type="hidden" name="'.$name.'_submit" value="1"><button type="submit" value="'.$value.'" class="aip-button" name="'.$name.'" id="'.$name.'"'.$cfm.'>'.$value.'</button>';
				break;
			case "aip_api_register":
				return '<input type="hidden" name="'.$name.'_submit" value="1"><button type="submit" value="'.$value.'" class="aip-button" name="'.$name.'" id="'.$name.'"'.$cfm.' '.$disabled.'>'.$value.'</button>';
				break;
			case "aip_goal":
				return "<select name=\"$name\" id=\"$name\">".$this->generate_options(array(
					__("No Optimization","post-perfect-ai"),
					__("Social Media Reach","post-perfect-ai"),
					__("Lead Generation","post-perfect-ai"),
					__("Brand Representation","post-perfect-ai"),
					__("Search Engine Placement","post-perfect-ai"),
					__("Audience Engagement","post-perfect-ai"),
				))."</select>";
				break;
			case "aip_image_prompt":
				return '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$ph.'" class="regular-text">';
				break;
			case "aip_image_enhance":
				return '<input type="checkbox" name="'.$name.'" value="1">';
				break;
			case "aip_api_key":
				return '<input type="text" name="'.$name.'" value="'.$value.'" class="regular-text">';
				break;
			case "aip_always_confirm":
			case "aip_use_og":
				return '<input type="checkbox" name="'.$name.'" value="1" '.$value.'>';
				break;
			case "aip_api_username":
				return '<input type="text" name="'.$name.'" value="'.$value.'" class="regular-text" disabled>';
				break;
			case "aip_api_application_password":
				return '<input type="text" name="'.$name.'" value="'.$value.'" class="regular-text" disabled>';
				break;
			case "aip_api_siteurl":
				return '<input type="text" name="'.$name.'" value="'.$value.'" class="regular-text" disabled>';
				break;
			case "aip_client_id":
			case "aip_title":
				return '<input type="text" name="'.$name.'" value="'.$value.'" class="regular-text">';
				break;
			case "aip_registration_status":
				return $value;
				break;
			case "aip_image_subject":
				return '<input type="text" name="'.$name.'" value="'.$value.'" placeholder="'.$ph.'" class="regular-text">';
				break;
			case "aip_image_action":
				return '<input type="text" class="regular-text" name="'.$name.'" value="'.$value.'" placeholder="'.$ph.'">';
				break;
			case "aip_image_setting":
				return '<input type="text" class="regular-text" name="'.$name.'" value="'.$value.'" placeholder="'.$ph.'">';
				break;
			case "aip_image_time":
				return '<input type="text" class="regular-text" name="'.$name.'" value="'.$value.'" placeholder="'.$ph.'">';
				break;
			case "aip_image_camera":
				return '<input list="'.$name.'_list" name="'.$name.'" id="'.$name.'"><datalist id="'.$name.'_list">'.$this->generate_options($this->camera_types,true).'</datalist>';
				break;
			case "aip_image_lens":
				return '<input list="'.$name.'_list" name="'.$name.'" id="'.$name.'"><datalist id="'.$name.'_list">'.$this->generate_options($this->lens_types,true).'</datalist>';
				//return '<select name="'.$name.'" id="'.$name.'">'.$this->generate_options($this->lens_types).'</select>';
				break;
			case "aip_image_style":
				return '<select name="'.$name.'" id="'.$name.'">'.$this->generate_options($this->image_styles).'</select>';
				break;
			case "aip_description":
				return '<textarea name="'.$name.'" rows="8" cols="60" class="code">'.$value.'</textarea>';
				break;
			case "aip_image_negative": 
				return '<input type="text" class="regular-text" name="'.$name.'" value="'.$value.'" placeholder="'.$ph.'">';
				break;
			case "aip_batch_size":
				return '<input type="range" min="1" max="4" step="1" value="1" name="'.$name.'" oninput="this.nextElementSibling.value=this.value"><output class="aip-range-label">1</output>';
				break;
			case "aip_image_artist":
				return '<input list="'.$name.'_list" name="'.$name.'" id="'.$name.'" value="'.$value.'" placeholder="'.$ph.'" class="regular-text aip-focus-enter" data-buttonid="'.$name.'_button"> <input type="button" name="'.$name.'_button" id="'.$name.'_button" data-slug="'.$name.'" class="aip-add-button" value="'.$pv.'"><br><p class="description">'.$pl.'<br><span id="'.$name.'_output">'.__("None","post-perfect-ai").'</span></p><input type="hidden" name="'.$name.'_hidden" value="" id="'.$name.'_hidden"><datalist id="'.$name.'_list">'.$this->generate_options($this->artists,true,true).'</datalist>';
				break;
		}
	}
	protected function generate_label_string($id) {
		$str = ' label="';
		$ids = $this->artist_attribute_ids[$id];
		foreach($ids as $lab) {
			$str .= $this->artist_attributes[$lab].", ";
		}
		$str = rtrim($str,", ");
		$str .= '"';
		return $str;
	}
	protected function generate_options($data,$onlyval=false,$artist = false) {
		$str = "";
		$lab_str = "";
		foreach($data as $key => $val) {
			if ($onlyval) { 
				if ($artist) $lab_str = $this->generate_label_string($key);
				$str .= '<option value="'.$val.'"'.$lab_str.'>'.$val.'</option>';
			} else {
				$str .= '<option value="'.$key.'"'.$lab_str.'>'.$val.'</option>';
			}
		}
		return $str;
	}
	protected function format_category_inputs($data) {
		$cats = "";
		foreach($data as $dat) {
			$cats .= "<input type=\"checkbox\" name=\"aip_categories[]\" value=\"{$dat[2]}\"> {$dat[1]}<br>";
		}
		return $cats;
	}
	protected function format_table($data) {
		$table = "<table class=\"form-table\" role=\"presentation\"><tbody>";
		foreach($data as $dat) {
			$table .= "<tr>";
			$table .= "<th scope=\"row\"><label for=\"{$dat[0]}\">{$dat[1]}</label></th>";
			$table .= "<td>{$dat[2]}</td>";
			$table .= "</tr>";
		}
		$table .= "</tbody></table>";
		return $table;
	}
	public function add_ideas_type() {
		$labels = array(
			'name'                  => _x( 'PostPerfect AI Ideas', 'Post type general name', 'post-perfect-ai' ),
			'singular_name'         => _x( 'PostPerfect AI Idea', 'Post type singular name', 'post-perfect-ai' ),
			'menu_name'             => _x( 'PostPerfect AI Ideas', 'Admin Menu text', 'post-perfect-ai' ),
			'name_admin_bar'        => _x( 'Idea', 'Add New on Toolbar', 'post-perfect-ai' ),
			'add_new'               => __( 'Add New', 'post-perfect-ai' ),
			'add_new_item'          => __( 'Add New Idea', 'post-perfect-ai' ),
			'new_item'              => __( 'New Idea', 'post-perfect-ai' ),
			'edit_item'             => __( 'Edit Idea', 'post-perfect-ai' ),
			'view_item'             => __( 'View Idea', 'post-perfect-ai' ),
			'all_items'             => __( 'All Ideas', 'post-perfect-ai' ),
			'search_items'          => __( 'Search Ideas', 'post-perfect-ai' ),
			'parent_item_colon'     => __( 'Parent Ideas:', 'post-perfect-ai' ),
			'not_found'             => __( 'No ideas found.', 'post-perfect-ai' ),
			'not_found_in_trash'    => __( 'No ideas found in Trash.', 'post-perfect-ai' ),
			'featured_image'        => _x( 'Idea Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'post-perfect-ai' ),
			'set_featured_image'    => _x( 'Set idea image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'post-perfect-ai' ),
			'remove_featured_image' => _x( 'Remove idea image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'post-perfect-ai' ),
			'use_featured_image'    => _x( 'Use as idea image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'post-perfect-ai' ),
			'archives'              => _x( 'Idea archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'post-perfect-ai' ),
			'insert_into_item'      => _x( 'Insert into idea', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'post-perfect-ai' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this idea', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'post-perfect-ai' ),
			'filter_items_list'     => _x( 'Filter ideas list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'post-perfect-ai' ),
			'items_list_navigation' => _x( 'Ideas list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'post-perfect-ai' ),
			'items_list'            => _x( 'Idea list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'post-perfect-ai' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'ppai-ideas' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 4,
			'supports'           => array( 'title', 'editor', 'excerpt' ),
		);

		register_post_type( 'ppai-ideas', $args );
	}
	
	protected function generate_image_directory($dir) {
		if (is_dir($dir)) return;
		if (!mkdir($dir,0775)) throw new Exception("Cannot create directory.");
	}
	protected function put_file($path, $data) {
		if (file_put_contents($path,$data) === false) throw new Exception("Cannot put file.");
	}
	protected function add_media($path) {
		$url = get_bloginfo("url").$path;
		require_once ABSPATH.'wp-admin/includes/file.php';
		$temp_file = download_url($url);
		if (is_wp_error($temp_file)) throw new Exception("Could not get download url.");
		$file = array(
			'name'=>basename($url),
			'type'=>mime_content_type($temp_file),
			'tmp_name'=>$temp_file,
			'size'=>filesize($temp_file)
		);
		$sideload = wp_handle_sideload(
			$file,
			array(
				'test_form'=>false
			)
		);
		if (!empty($sideload['error'])) throw new Exception("Could not sideload file.");
		$attachment_id = wp_insert_attachment(
			array(
				'guid'=>$sideload['url'],
				'post_mime_type'=>$sideload['type'],
				'post_title'=>basename($sideload['file']),
				'post_content'=>'',
				'post_status'=>'inherit'
			),
			$sideload['file']
		);
		if (is_wp_error($attachment_id) || !$attachment_id) throw new Exception("Could not insert attachment.");
		require_once ABSPATH.'wp-admin/includes/image.php';
		wp_update_attachment_metadata(
			$attachment_id,
			wp_generate_attachment_metadata($attachment_id,$sideload['file'])
		);
		return $attachment_id;
	}
	public function process_route_article(WP_REST_Request $request) {
		try {
			$ts = intval($request->get_param('timestamp'));
			$message = $request->get_param('message');
			$credits = new stdClass;
			$credits->idea = $request->get_param('idea');
			$credits->article = $request->get_param('article');
			$credits->image = $request->get_param('image');
			$this->update_credits($credits);
			$planid = $request->get_param('planid');
			update_option("aip-planid",$planid);
			$title = $request->get_param('title');
			$desc = $request->get_param('description');
			
			$params = array(
					'post_content'=>$message,
					'post_excerpt'=>$desc,
					'post_title'=>$title
				);
			$result = wp_insert_post($params);
			if (is_wp_error($result)) throw new Exception("Could not create post.");
			$this->set_received("article");
			return array("status"=>200);
			
		} catch(Exception $ex) {
			return array("status"=>500,"error"=>$ex->getMessage());
		}
	}
	public function register_route_article() {
		register_rest_route('aip/v1','article',array(
			'methods'=>'POST',
			'callback'=>array($this,"process_route_article"),
			'permission_callback'=>function () {
				return current_user_can('edit_posts');
			},
			'args'=>array(
				'timestamp'=>array(
					'validate_callback'=>function($param,$request,$key) {
						return is_numeric($param);
					}
				),
				'message'=>array(
					'validate_callback'=>function($param,$request,$key) {
						return is_string($param);
					}
				),
				'title'=>array(
					'validate_callback'=>function($param,$request,$key) {
						return is_string($param);
					}
				),
				'description'=>array(
					'validate_callback'=>function($param,$request,$key) {
						return is_string($param);
					}
				)
			)
		));
	}
	
	public function process_route_image(WP_REST_Request $request) {
		try {
			$dir = "/opt/bitnami/wordpress/wp-content/uploads/post-perfect-ai";
			$webpath = "/wp-content/uploads/post-perfect-ai";
			$ts = intval($request->get_param('timestamp'));
			$credits = new stdClass;
			$credits->idea = $request->get_param('idea');
			$credits->article = $request->get_param('article');
			$credits->image = $request->get_param('image');
			$this->update_credits($credits);
			$planid = $request->get_param('planid');
			update_option("aip-planid",$planid);
			$prompt = strip_tags($request->get_param('prompt'));
			$prompt = html_entity_decode($prompt,ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
			$img = $request->get_param('img');
			$png = base64_decode($img);
			$this->generate_image_directory($dir);
			$filename = "postperfect_ai_".time().".png";
			$this->put_file($dir."/".$filename,$png);
			$attachment_id = $this->add_media($webpath."/".$filename);
			$out = array(
				'ID'=>$attachment_id,
				'post_content'=>$prompt
			);
			wp_update_post($out);
			$this->set_received("image");
			return array('status'=>200);
			
		} catch(Exception $ex) {
			return array('status'=>500,'error'=>$ex->getMessage());
		}
	}
	public function register_route_images() {
		register_rest_route('aip/v1','image',array(
			'methods'=>'POST',
			'callback'=>array($this,"process_route_image"),
			'permission_callback'=>function () {
				return current_user_can('edit_posts');
			},
			'args'=>array(
				'timestamp'=>array(
					'validate_callback'=>function($param,$request,$key) {
						return is_numeric($param);	
					}
				),
				'img'=>array(
					'validate_callback'=>function($param,$request,$key) {
						return true;
					}
				),
				'prompt'=>array(
					'validate_callback'=>function($param,$request,$key) {
						return is_string($param);
					}
				)
			)	
		));	
	}
	protected function generate_post($data,$type=0) {
		switch($type) {
			case 0:
				$params = array(
					'post_type'=>'ppai-ideas',
					'post_excerpt'=>$data->description,
					'post_title'=>$data->title
				);
				break;
			case 1:
				$params = array(
					'post_type'=>'ppai-ideas',
					'post_content'=>$data,
					'post_title'=>"New Ideas"
				);
				break;
		}
		$result = wp_insert_post($params);
		if (is_wp_error($result)) throw new Exception("Could not create post.");
		return true;
	}
	public function update_credits($credits) {
		update_option("ppai-idea-credits",$credits->idea,false);
		update_option("ppai-article-credits",$credits->article,false);
		update_option("ppai-image-credits",$credits->image,false);
	}
	public function process_route_ideas(WP_REST_Request $request) {
		try {
			$ts = intval($request->get_param('timestamp'));
			$message = $request->get_param('message');
			$credits = new stdClass;
			$credits->idea = $request->get_param('idea');
			$credits->article = $request->get_param('article');
			$credits->image = $request->get_param('image');
			$this->update_credits($credits);
			$planid = $request->get_param('planid');
			update_option("aip-planid",$planid);
			if (is_string($message) && $this->is_valid_json($message)) $message = json_decode($message);
			if (is_array($message)) {
				$ect = 0;
				$lastError = "";
				foreach($message as $mes) {
					try {
						$this->generate_post($mes);
					} catch(Exception $ex) {
						$ect++;
						$lastError = $ex->getMessage();
					}
				}
				if ($ect) return array("status"=>500,"error"=>$lastError);
			} else {
				$this->generate_post($message,1);
			}
			$this->set_received("idea");
			return array("status"=>200);
		} catch(Exception $ex) {
			return array("status"=>500,"error"=>$ex->getMessage());
		}	
	}
	public function register_route_ideas() {
		register_rest_route('aip/v1','ideas',array(
			'methods'=>'POST',
			'callback'=>array($this,"process_route_ideas"),
			'permission_callback'=>function () {
				return current_user_can('edit_posts');
			},
			'args'=>array(
				'timestamp'=>array(
					'validate_callback'=>function($param,$request,$key) {
						return is_numeric($param);	
					}
				),
				'message'=>array(
					'validate_callback'=>function($param,$request,$key) {
						return true;
					}
				)
			)	
		));
	}
	protected function is_valid_json($string) {
		json_decode($string);
		return json_last_error() === JSON_ERROR_NONE;
	}
	
	public function custom_post_type_headers($cols) {
		$ct = 0;
		$out = array();
		foreach($cols as $key => $val) {
			if ($ct === 2) { 
				$out["aip_idea_description"] = "Description";
				//$out["aip_generate_content"] = "Create Articles";
			}
			$out[$key] = $val;
			$ct++;
		}
		return $out;
	}
	public function custom_post_type_data($column_name,$post_id) {
		if ($column_name === "aip_idea_description") {
			echo "<p>".get_the_excerpt($post_id)."</p>";
		}
		/*
		if ($column_name === "aip_generate_content") {
			echo "<p><a href=\"/wp-admin/admin.php?page=postperfect-ai-articles&aip_post_id=$post_id\">Create</a></p>";
		}
		*/
	}
	public function custom_post_row_actions($actions, $post) {
		if ($post->post_type === "ppai-ideas") {
			$actions['aip_generate_content'] = '<a href="/wp-admin/admin.php?page=postperfect-ai-articles&aip_post_id='.$post->ID.'">'.__("Create","post-perfect-ai").'</a>';
		}
		return $actions;
	}
	public function add_loading_animation($echo = true) {
		$str = '<div class="load-3">';
		$str .= '<div class="aip-line"></div>';
		$str .= '<div class="aip-line"></div>';
		$str .= '<div class="aip-line"></div>';
		$str .= '</div>';
		if (!$echo) return $str;
		echo $str;
	}
	public function aip_postbox($post) {
		if ($post->post_type !== "ppai-ideas" && $post->post_type !== "post") return;
		if ($post->post_type === "ppai-ideas") {
			echo '<div class="misc-pub-section misc-pub-post-create"><a href="/wp-admin/admin.php?page=postperfect-ai-articles&aip_post_id='.$post->ID.'">'.__("Create Article","post-perfect-ai").'</a></div>';
			return;
		}
		if ($post->post_type === "post") {
			echo '<div class="misc-pub-section misc-pub-post-design"><a href="/wp-admin/admin.php?page=postperfect-ai-images">'.__("Design Image","post-perfect-ai").'</a></div>';
		}
		
	}
	public function aip_add_meta_box() {
		add_meta_box(
			'ppai-post-meta',
			__('Design Images',"post-perfect-ai"),
			array($this,'aip_generate_meta_box'),
			'post',
			'side',
			'high'
		);
	}
	public function aip_generate_meta_box() {
		echo '<div class="misc-pub-section misc-pub-post-design"><a href="/wp-admin/admin.php?page=postperfect-ai-images">'.__("Design Image","post-perfect-ai").'</a></div>';
	}
	protected function process_heartbeat($type) {
		$this->set_waiting($type,0);
		$this->set_received($type,0);
		switch($type) {
			case "idea":
			default:
				$path = "/wp-admin/edit.php?post_type=ppai-ideas";
				break;
			case "article":
				$path = "/wp-admin/edit.php";
				break;
			case "image":
				$path = "/wp-admin/upload.php";
				break;
		}
		$vl = sprintf(_x("View %ss", "Values are `Image`,`Article`, or `Idea`","post-perfect-ai"),ucfirst($type));
		$message = sprintf(_x("Your new %s(s) are ready!", "Values are `Image`,`Article`, or `Idea`","post-perfect-ai"),$type)." <a href=\"$path\">".$vl."s</a><br>";
		return $message;
	}
	public function ppai_heartbeat_received() {
		if (!$this->is_waiting_any()) {
			echo json_encode(array("message"=>""));
			wp_die();
		}
		$waiting_for = $this->is_waiting_for();
		$message = "";
		foreach($waiting_for as $type => $ele) {
			if ($ele === 0) continue;
			if ($this->is_received($type) === 1) {
				$message .= $this->process_heartbeat($type);
			}
		}
		echo json_encode(array("message"=>$message));
		wp_die();
	}
	public function add_ppai_links() {
		global $menu, $submenu;
		array_push($submenu["upload.php"], array(
			__("Design Images","post-perfect-ai"),
			"upload_files",
			"admin.php?page=postperfect-ai-images"
		));
		array_push($submenu["edit.php"],array(
			__("Generate Ideas","post-perfect-ai"),
			"edit_posts",
			"admin.php?page=postperfect-ai-ideas"
		), array(
			__("Create Articles","post-perfect-ai"),
			"edit_posts",
			"admin.php?page=postperfect-ai-articles"
		));
	}
}