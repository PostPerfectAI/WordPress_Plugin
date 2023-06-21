<?php

/**
 * Fired during plugin activation
 *
 * @link       https://postperfectai.com
 * @since      1.0.0
 *
 * @package    Post_Perfect_Ai
 * @subpackage Post_Perfect_Ai/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Post_Perfect_Ai
 * @subpackage Post_Perfect_Ai/includes
 * @author     PostPerfect AI <admin@postperfectai.com>
 */
class Post_Perfect_Ai_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
			$username = 'postperfect-ai';
			$password = wp_generate_password();
			$url = get_bloginfo("url");
			$url = str_replace("https://","",$url);
			$url = str_replace("http://","",$url);
			$up = explode(".",$url);
			$upc = count($up);
			$domain = $up[$upc-2].".".$up[$upc-1];
			$email = $username."@".$domain;

			if (username_exists($username) === false && email_exists($email) === false) {
				$user_id = wp_create_user($username, $password, $email);
				if (is_wp_error($user_id)) {
					error_log("Errors: ".var_dump($user_id->errors));
					error_log("ErrorData: ".var_dump($user_id->error_data));
					return;
				}
				$user = get_user_by('id',$user_id);
				$user->remove_role('subscriber');
				$user->add_role('editor');

				update_option("aip_api_user",$username,false);
				update_option("aip_api_user_id",$user_id,false);
				
				
				if (!WP_Application_Passwords::application_name_exists_for_user($user_id,'aip-ai-generator')) {
					$app_pass = WP_Application_Passwords::create_new_application_password($user_id,array('name'=>'aip-ai-generator'));
					if (is_wp_error($app_pass)) {
						error_log("Application Pass Error: ".var_dump($app_pass->error_data));
						return;	
					}
					$new_pass = WP_Application_Passwords::chunk_password($app_pass[0]);
					update_option("aip_application_password",$new_pass,false);
				}	
			}
	}

}
