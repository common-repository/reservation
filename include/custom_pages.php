<?php
namespace reservation;
class NTRA_PagesOfNavotar{
	
	
	function NTRApageInstall() {
		//Page listing
		$new_page_title     = __('Listing','text-domain');
		$new_page_content   = '';                        
		$new_page_template  = dirname( __FILE__ ).'templates/listing.php';
		$page_check = get_page_by_title($new_page_title);
		$new_page = array(
				'post_type'     => 'page', 
				'post_title'    => $new_page_title,
				'post_content'  => $new_page_content,
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_slug'     => 'listing'
		);
		// If the page doesn't already exist, create it
		if(!isset($page_check->ID)){
			$new_page_id = wp_insert_post($new_page);
			if(!empty($new_page_template)){
				update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				//update_option('show_on_front', 'page');
				//update_option('page_on_front', $new_page_id);
			}
		}
		
		// listing page end
		
		//Page Main
		$title     = __('Thankyou','text-domain');
		$content   = '';                        
		$template  = dirname( __FILE__ ).'templates/thankyou.php';
		$check = get_page_by_title($title);
		$page = array(
				'post_type'     => 'page', 
				'post_title'    => $title,
				'post_content'  => $content,
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_slug'     => 'extra'
		);
		if(!isset($check->ID)){
			$id = wp_insert_post($page);
			if(!empty($template)){
				update_post_meta($id, '_wp_page_template', $template);
				//update_option('show_on_front', 'page');
				//update_option('page_on_front', $new_page_id);
			}
		}
		
		
		
		//Mis-Charges
		
		$title     = __('Mis Charges','text-domain');
		$content   = '';                        
		$template  = dirname( __FILE__ ).'templates/mis-charges.php';
		$check = get_page_by_title($title);
		$page = array(
				'post_type'     => 'page', 
				'post_title'    => $title,
				'post_content'  => $content,
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_slug'     => 'mis-charges'
		);
		if(!isset($check->ID)){
			$id = wp_insert_post($page);
			if(!empty($template)){
				update_post_meta($id, '_wp_page_template', $template);
				//update_option('show_on_front', 'page');
				//update_option('page_on_front', $new_page_id);
			}
		}
		
		
		
		//Mis-Charges
		
		$title     = __('Summary','text-domain');
		$content   = '';                        
		$template  = dirname( __FILE__ ).'templates/summary.php';
		$check = get_page_by_title($title);
		$page = array(
				'post_type'     => 'page', 
				'post_title'    => $title,
				'post_content'  => $content,
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_slug'     => 'summary'
		);
		if(!isset($check->ID)){
			$id = wp_insert_post($page);
			if(!empty($template)){
				update_post_meta($id, '_wp_page_template', $template);
				//update_option('show_on_front', 'page');
				//update_option('page_on_front', $new_page_id);
			}
		}
		
		
		
		// Term and Condition
		
		$title     = __('term-and-condition','text-domain');
		$content   = '';                        
		$template  = dirname( __FILE__ ).'templates/term-condition.php';
		$check = get_page_by_title($title);
		$page = array(
				'post_type'     => 'page', 
				'post_title'    => $title,
				'post_content'  => $content,
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_slug'     => 'term-and-condition'
		);
		if(!isset($check->ID)){
			$id = wp_insert_post($page);
			if(!empty($template)){
				update_post_meta($id, '_wp_page_template', $template);
				//update_option('show_on_front', 'page');
				//update_option('page_on_front', $new_page_id);
			}
		}
		
		
		
	}


}
