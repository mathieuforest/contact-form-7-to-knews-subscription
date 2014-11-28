<?php
/*
 * Plugin Name: Contact Form 7 to Knews subscription
 * Version: 1.0
 * Plugin URI: http://mathieuforest.ca/
 * Description: This was develop for custom needs.
 * Author: Mathieu Forest
 * Author URI: http://mathieuforest.ca/
Contact form 7 form to knews subscriptions. You need to install Dynamic hidden text field plugin. Add this shortcodes with the list id: [dynamictext knews-subscription "Put the list id here"]. And add those field [email] [name] and [surname].
 */

function wpcf7_knews_subscription ($WPCF7_ContactForm) {
	
	$submission = WPCF7_Submission::get_instance();
	$posted_data =& $submission->get_posted_data();	   

	if(isset($posted_data['knews-subscription'])) {

		$email = $posted_data['email'];
		
		$id_list_news = $posted_data['knews-subscription'];
		$lang = ICL_LANGUAGE_CODE;
		$lang_locale = get_locale();
		
		$extra_fields = $posted_data;
		$custom_fields = array();
			foreach ($extra_fields as $field) {
				$custom_fields[1]=$posted_data['name'];
				$custom_fields[2]=$posted_data['surname'];
			}
	
		$bypass_confirmation = true;
		
		apply_filters('knews_add_user_db', 0, $email, $id_list_news, $lang, $lang_locale, $custom_fields, $bypass_confirmation);
			
	}	
}

add_action('wpcf7_before_send_mail', 'wpcf7_knews_subscription');

?>
