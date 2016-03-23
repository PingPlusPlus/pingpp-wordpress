<?php

if ( ! defined( 'ABSPATH' ) )  exit;

if ( ! class_exists( 'Pingpp_Wp_Pay_Notices' ) ) {
	class Pingpp_Wp_Pay_Notices {
		
		public static $instance = null;
		
		private function __construct() {
			
			add_action( 'admin_notices', array( $this, 'admin_install_notice' ) );
		}
		
		public function admin_install_notice() {
			if ( false == get_option( 'ppp_show_admin_install_notice' ) ) {
				return;
			}

			if ( ! empty( $_REQUEST['ppp-dismiss-install-nag'] ) || Pingpp_Wp_Pay_Admin::get_instance()->viewing_this_plugin() ) {
				delete_option( 'ppp_show_admin_install_notice' );
				return;
			}

			if( 'plugins' == get_current_screen()->id ) {
				include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'views/admin-notice-install.php' );
			}
		}
		
		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}