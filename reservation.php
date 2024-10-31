<?php
namespace reservation;
/**
 * Plugin Name: Reservation
 * Plugin URI:  
 * Description: Navotar Car Rental Reservation Plugin enables you to get your car rental reservations directly from your website which is synced real time with the Car Rental Software. 
 * Version:     1.0
 * Author:      Navotar Software
 * Author URI:  https://navotar.com/
 * License:     
 * License URI:
 * Text Domain: 
 * Domain Path: /languages
   Local Version:1.V25
 */
require_once dirname(__FILE__).'/include/token.php';
require_once dirname(__FILE__).'/include/vehicle.php';
require_once dirname(__FILE__).'/include/location.php';
require_once dirname(__FILE__).'/include/country.php';
require_once dirname(__FILE__).'/include/vicheleList.php';
require_once dirname(__FILE__).'/include/get_hour.php';
require_once dirname(__FILE__).'/include/mscharges.php';
require_once dirname(__FILE__).'/include/promocode.php';
require_once dirname(__FILE__).'/include/summary.php';
require_once dirname(__FILE__).'/include/reserve.php';
require_once dirname(__FILE__).'/include/createReservation.php';
require_once dirname(__FILE__).'/include/terms.php';
require_once dirname(__FILE__).'/include/login.php';


 Class NTRA_MainControllerOfNavotar{
	 
	public function __construct(){
		
		
		
		add_action( 'init',array( &$this, 'NTRAfileInclude' ) );
		add_action ( 'wp_head',array(&$this, 'NTRAhookInHeader' ));
		add_action( 'init',array( &$this, 'NTRAfrontendFiles' ) );
		add_action( 'admin_menu', array( &$this, 'NTRAaddAdminMenu' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'NTRAaddFrontendScripts' ) );
		add_action( 'admin_init',array( &$this, 'NTRAloadAdminStyle' ) );
		add_filter( 'template_include',array( &$this, 'NTRAcontactPageTemplate') );
		add_action('admin_enqueue_scripts', array( &$this, 'NTRAcstmCssAndJs'));
		add_action('admin_enqueue_scripts', array( &$this, 'NTRAadminUrl'));
		add_action("wp_head", array( &$this,"NTRAmyPrintCustomStyle"));
		register_activation_hook(__FILE__,array(&$this, 'NTRAcustomPages'));
	}
	
	

	function NTRAhookInHeader() {
	?>
	<script> 
	var site_url ="<?php echo site_url(); ?>" ;  
	var plugin_url ="<?php echo plugins_url( '', __FILE__ ); ?>" ;  
	
	</script>
	<?php
	
	}
	
	
	function NTRAadminUrl() {
	?>
	<script> 
	var plugin_url ="<?php echo plugins_url( '', __FILE__ ); ?>" ;  
	</script>
	<?php
	
	}
	
	//add admin menu and submenu
	function NTRAaddAdminMenu(){
		if (current_user_can( 'manage_options' )){
			add_menu_page('CR_resercation', 'CR Reservation', 'manage_options', 'plugin-options', array( $this, 'NTRAwpsThemeFunc' ));
			if(!empty( esc_attr( get_option('clientIDs')))){
			
				add_submenu_page( 'plugin-options', 'Settings page title', 'Layout Settings', 'manage_options', 'layout-settings',  array( $this, 'NTRAlayoutSettings' ));
				add_submenu_page( 'plugin-options', 'Settings page title', 'Colour & font Settings', 'manage_options', 'color-settings',  array( $this, 'NTRAcolorSettings' ));
				
				add_submenu_page( 'plugin-options', 'Settings page title', 'Fields Settings', 'manage_options', 'fields-settings',  array( $this, 'NTRAfieldsSettings' ));
				add_submenu_page( 'plugin-options', 'Settings page title', 'General Settings', 'manage_options', 'plugin-op-settings',  array( $this, 'NTRAwpsThemeFuncSettings' ));
				add_submenu_page( 'plugin-options', 'Settings page title', 'Term & Condition', 'manage_options', 'term-and-condition-editor',  array( $this, 'NTRAtermConditionEditor' ));
			}
		}
	}
	
	function NTRAwpsThemeFunc(){
        include_once('admin/check.php');
	}
	function NTRAwpsThemeFuncSettings(){
		include_once('admin/setting/general_setting.php');
		NTRAgeneralSetting();
	}
	function NTRAtermConditionEditor(){
		include_once('admin/setting/term_editor.php');
		NTRAtermConditionEditor();
	}
	function NTRAcolorSettings(){
		include_once('admin/setting/color.php');
		 NTRAmyCoolPluginSettingsPage();  
	}
	function NTRAlayoutSettings(){
		include_once('admin/setting/layout.php');
		NTRAlayoutSetting();   
	}
	function NTRAfieldsSettings(){
		include_once('admin/setting/myfields.php');
		 $field->NTRAfieldSetting(); 
	}
	
	
	//add dynamic style and javascript here
	function NTRAaddFrontendScripts(){
		//wp_register_style('myStyleSheet',plugins_url('css/styelecss.php', __FILE__));
		wp_enqueue_style( 'pawan-fontawsome',plugins_url('css/font.css', __FILE__));
		//wp_enqueue_style( 'pawan-dynamic', plugins_url('css/styelecss.php', __FILE__));
		//wp_enqueue_style( 'pawan-responsive', plugins_url('css/responsive.css', __FILE__));
		wp_enqueue_style( 'pawan-bootcss', plugins_url('css/jquery.datetimepicker.min.css', __FILE__));
		wp_enqueue_script( 'pawan-ajaxjs', plugins_url('js/ajax.js', __FILE__), array('jquery'));
		wp_enqueue_script( 'pawan-datejs', plugins_url('js/datepick.js', __FILE__), array('pawan-ajaxjs'));
		wp_enqueue_script( 'pawan-datepickerjs', plugins_url('js/jquery.datetimepicker.js', __FILE__),array('pawan-datejs'));
		wp_localize_script( 'jquery', 'MS_Ajax', array(
			'ajaxurl'       => admin_url( 'admin-ajax.php' ),
			'nextNonce'     => wp_create_nonce( 'navotardevelopebypawanajaxnounce' ))
		);
	}
	

	//add admin styles
    function NTRAloadAdminStyle() {
		  
        wp_register_style( 'admin_css', plugins_url('css/adminstyle.css', __FILE__), false, '1.0.0' );
		wp_enqueue_style( 'admin_css' );
		wp_register_script( 'adminJS', plugins_url('js/my-script.js', __FILE__));
		wp_enqueue_script('adminJS');
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_style( 'wp-color-picker' );
		wp_localize_script( 'jquery', 'MS_Ajax', array(
			'ajaxurl'       => admin_url( 'admin-ajax.php' ),
			'nextNonce'     => wp_create_nonce( 'navotardevelopebypawanajaxnounce' ))
		);
		
	}

	
	 
	function NTRAcstmCssAndJs($hook) {
		wp_enqueue_script('customeditor_js', plugins_url('/js/nicEdit.js',__FILE__ ));
	}
	

	function NTRAcontactPageTemplate( $template ) {
		if ( is_page( 'listing' ) ) {
			if ( locate_template( 'listing.php' ) ) {
				$template = locate_template( 'listing.php' );
			} else {
				$template = dirname( __FILE__ ) .'/templates/' . 'listing.php';
			}
		}
		
		if ( is_page( 'mis-charges' ) ) {
			if ( locate_template( 'mis-charges.php' ) ) {
				$template = locate_template( 'mis-charges.php' );
			} else {
				$template = dirname( __FILE__ ) .'/templates/' . 'mis-charges.php';
			}
		}
		
		if ( is_page( 'summary' ) ) {
			if ( locate_template( 'summary.php' ) ) {
				$template = locate_template( 'summary.php' );
			} else {
				$template = dirname( __FILE__ ) .'/templates/' . 'summary.php';
			}
		}
		
		if ( is_page( 'term-and-condition' ) ) {
			if ( locate_template( 'term-condition.php' ) ) {
				$template = locate_template( 'term-condition.php' );
			} else {
				$template = dirname( __FILE__ ) .'/templates/' . 'term-condition.php';
			}
		}
		
		if ( is_page( 'thankyou' ) ) {
			if ( locate_template( 'thankyou.php' ) ) {
				$template = locate_template( 'thankyou.php' );
			} else {
				$template = dirname( __FILE__ ) .'/templates/' . 'thankyou.php';
			}
		}
		
		return $template;
	}
	
 

	function NTRAfileInclude(){
		include_once('admin/setting/options.php');
		include_once('admin/setting/layout.php');
	}
	
	function NTRAfrontendFiles(){
		include_once('include/shortcode.php');
	}
	
	
	
	
	function NTRAcustomPages(){
		include_once('include/custom_pages.php');
		$obj = new NTRA_PagesOfNavotar();
		$obj->NTRApageInstall();
	}
	

	
	function NTRAmyPrintCustomStyle(){
		include_once('css/styelecss.php');
		include_once('css/responsive.php');
	}
	
	

	
}
 
$obj = new NTRA_MainControllerOfNavotar;
