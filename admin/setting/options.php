<?php
namespace reservation;

class  NTRA_OptionOfNavotar{

	function __construct(){
		add_action( 'admin_init', array(&$this, 'NTRAregisterMyCoolPluginSettings'));
		add_action( 'admin_init', array(&$this, 'NTRAregisterLayoutSettings' ) );
		add_action( 'admin_init', array(&$this, 'NTRAregisterFieldSettings' ) );
		add_action( 'admin_init', array(&$this, 'NTRAregisterGeneralSettings' ) );
		add_action( 'admin_init', array(&$this, 'NTRAregisterTermsSettings' ) );
	}
	
	
	
	public function NTRAregisterTermsSettings() {
		if ( is_user_logged_in() && current_user_can('manage_options')) {
			if(isset($_POST['terms_setting'])){
				if (!wp_verify_nonce($_REQUEST['terms_setting'], 'terms_setting_action' ) ) {
					wp_die('Nonce verification failed');
				}else{
					//register our settings
					register_setting('terms-settings-group', 'area2');
				}
			}
		}
	}
	
	
	
	function NTRAregisterMyCoolPluginSettings() {
		if ( is_user_logged_in() && current_user_can('manage_options')) {
			if(isset($_POST['my_cool_plugin'])){
				if (!wp_verify_nonce($_REQUEST['my_cool_plugin'], 'cool_pluign' ) ) {
					wp_die('Nonce verification failed');
				}else{
					//register our settings
					register_setting('my-cool-plugin-settings-group', 'box_form_background');
					register_setting('my-cool-plugin-settings-group', 'box_title_background');
					register_setting('my-cool-plugin-settings-group', 'box_button_background');
					register_setting('my-cool-plugin-settings-group', 'mv_cr_section_color');
					register_setting('my-cool-plugin-settings-group', 'form_heading_color');
					register_setting('my-cool-plugin-settings-group', 'box_form_heading_size');
					register_setting('my-cool-plugin-settings-group', 'box_form_font_size');
					
					// rec setting
					
					register_setting('my-cool-plugin-settings-group', 'rec_title_background');
					register_setting('my-cool-plugin-settings-group', 'rec_form_background');
					register_setting('my-cool-plugin-settings-group', 'rec_button_background');
					register_setting('my-cool-plugin-settings-group', 'rec_section_color');
					register_setting('my-cool-plugin-settings-group', 'rec_form_heading_color');
					register_setting('my-cool-plugin-settings-group', 'rec_form_heading_size');
					register_setting('my-cool-plugin-settings-group', 'rec_form_font_size');
					
					
					//listing
					
					register_setting('my-cool-plugin-settings-group', 'list_background_color');
					register_setting('my-cool-plugin-settings-group', 'list_header_color');
					register_setting('my-cool-plugin-settings-group', 'list_heading_color');
					register_setting('my-cool-plugin-settings-group', 'list_subheading_color');
					register_setting('my-cool-plugin-settings-group', 'list_font_color');
					register_setting('my-cool-plugin-settings-group', 'list_heading_size');
					register_setting('my-cool-plugin-settings-group', 'list_normal_size');
					register_setting('my-cool-plugin-settings-group', 'list_sub_title_size');
					register_setting('my-cool-plugin-settings-group', 'list_btn_color');
				}
			}
		}
	}
	
	

	public function NTRAregisterLayoutSettings() {
		if ( is_user_logged_in() && current_user_can('manage_options')) {
			if(isset($_POST['layout_setting'])){
				if (!wp_verify_nonce($_REQUEST['layout_setting'], 'layout_setting_action' ) ) {
					wp_die('Nonce verification failed');
				}else{
					//register our settings
					register_setting('layout-settings-group', 'searchLayout');
					register_setting('layout-settings-group', 'listingLayout');
					register_setting('layout-settings-group', 'searchHeight');
					register_setting('layout-settings-group', 'searchWidth');
					register_setting('layout-settings-group', 'rectsearchHeight');
					register_setting('layout-settings-group', 'rectsearchWidth');
				}
			}
		}
	}
	
	
	public function NTRAregisterFieldSettings() {
		
		if ( is_user_logged_in() && current_user_can('manage_options')) {
			if(isset($_POST['field_setting'])){
				if (!wp_verify_nonce($_REQUEST['field_setting'], 'field_setting_action' ) ) {
					wp_die('Nonce verification failed');
				}else{
					
					//register our settings
					register_setting('field-settings-group', 'dropoffon');
					register_setting('field-settings-group', 'dropoffMandatory');
					
					register_setting('field-settings-group', 'vehType');
					register_setting('field-settings-group', 'vehicleTypeMandatory');
					
					register_setting('field-settings-group', 'age');
					register_setting('field-settings-group', 'ageMandatory');
					
					register_setting('field-settings-group', 'promo');
					register_setting('field-settings-group', 'promoMandatory');
					
					register_setting('field-settings-group', 'sample');
					register_setting('field-settings-group', 'sampleMand');
					
					register_setting('field-settings-group', 'seats');
					register_setting('field-settings-group', 'seatsMand');
					
					register_setting('field-settings-group', 'doors');
					register_setting('field-settings-group', 'doorsMand');
					
					register_setting('field-settings-group', 'baggage');
					register_setting('field-settings-group', 'baggageMand');
					
					register_setting('field-settings-group', 'feature');
					register_setting('field-settings-group', 'featureMand');
					
					register_setting('field-settings-group', 'transmission');
					register_setting('field-settings-group', 'transmissionMand');
					
					register_setting('field-settings-group', 'tax');
					register_setting('field-settings-group', 'taxMand');
					
					register_setting('field-settings-group', 'total');
					register_setting('field-settings-group', 'totalMand');
					
					//filter 
					
					register_setting('field-settings-group', 'priceHightoLow');
					register_setting('field-settings-group', 'vehicletypeMand');
					
					register_setting('field-settings-group', 'priceLowtoHigh');
					register_setting('field-settings-group', 'passengerCapacityMand');
					
					register_setting('field-settings-group', 'AtoZ');
					register_setting('field-settings-group', 'baggageOptionalMand');
					
					
					// addon
					
					register_setting('field-settings-group', 'chargeDesc');
					register_setting('field-settings-group', 'chargeDescMand');
					
					
					//checkout
					
					register_setting('field-settings-group', 'dobon');
					register_setting('field-settings-group', 'dobMand');
					
					register_setting('field-settings-group', 'addresson');
					register_setting('field-settings-group', 'addressMand');
					
					register_setting('field-settings-group', 'cityon');
					register_setting('field-settings-group', 'cityMand');
					
					register_setting('field-settings-group', 'stateon');
					register_setting('field-settings-group', 'stateMand');
					
					register_setting('field-settings-group', 'zipon');
					register_setting('field-settings-group', 'zipMand');
					
					register_setting('field-settings-group', 'countryon');
					register_setting('field-settings-group', 'countryMand');
					
					register_setting('field-settings-group', 'companyName');
					register_setting('field-settings-group', 'companyMand');
					
					register_setting('field-settings-group', 'emergency');
					register_setting('field-settings-group', 'emergencyMand');
					
					register_setting('field-settings-group', 'license');
					register_setting('field-settings-group', 'licenseMand');
					
					register_setting('field-settings-group', 'licenseIssue');
					register_setting('field-settings-group', 'licenseIssueMand');
					
					register_setting('field-settings-group', 'licenseExpiry');
					register_setting('field-settings-group', 'licenseExpiryMand');
					
					register_setting('field-settings-group', 'passportNumber');
					register_setting('field-settings-group', 'passportNumberMand');
					
					register_setting('field-settings-group', 'passportIssue');
					register_setting('field-settings-group', 'passportIssueMand');
					
					register_setting('field-settings-group', 'passportExpiry');
					register_setting('field-settings-group', 'passportExpiryMand');
					
					register_setting('field-settings-group', 'drivingExp');
					register_setting('field-settings-group', 'drivingExpMand');
					
					register_setting('field-settings-group', 'Notes');
					register_setting('field-settings-group', 'NotesMand');
					
				}
			}
		}
	}
	
	
	
	public function NTRAregisterGeneralSettings() {
		if ( is_user_logged_in() && current_user_can('manage_options')) {
			if(isset($_POST['name_of_nonce_field'])){
				if (!wp_verify_nonce($_REQUEST['name_of_nonce_field'], 'name_of_my_action' ) ) {
					wp_die('Nonce verification failed');
				}else{
					//register our settings
					register_setting('general-settings-group', 'enablepayment');
				}
			}
		}
	}
}

$Option = new NTRA_OptionOfNavotar();

