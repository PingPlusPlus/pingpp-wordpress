<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Pingpp_Wp_Pay_Admin' ) ) {
	class Pingpp_Wp_Pay_Admin {
		
		public static $instance = null;
		
		public $plugin_screen_hook_suffix = null;
		
		private function __construct() {
			// 初始化默认设置
			if ( false === get_option( 'ppp_set_defaults' ) ) {
				add_action( 'admin_init', array( $this, 'set_default_settings' ), 12 );
			}

            // 设置管理后台标签
			add_action( 'admin_init', array( $this, 'set_admin_tabs' ) );

			// 添加 options 模版
			add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ), 2 );
		}
		
		// 设置默认的 options
		public function set_default_settings() {
			global $ppp_options;

			$ppp_options->add_setting( 'always_enqueue', 1 );
            $ppp_options->add_setting( 'selectable', 0 );
            $ppp_options->add_setting( 'show_channel_alipay_pc_direct', 1 );
            $ppp_options->add_setting( 'show_channel_wx_pub_qr', 1 );
            $ppp_options->add_setting( 'show_channel_upacp_pc', 0 );
            $ppp_options->add_setting( 'show_channel_cp_b2b', 0 );
            $ppp_options->add_setting( 'button_name', '去支付' );
            $ppp_options->add_setting( 'shortcode_name', 'pingpp' );
            $ppp_options->add_setting( 'success_redirect_url', site_url() );

            add_option( 'ppp_set_defaults', 1 );
		}
		
        // 设置管理后台的标签
		public function set_admin_tabs( $tabs ) {
			global $ppp_options;
			
			$tabs = array(
				'pingpp-keys'    => 'Ping++ Keys',
				'default'        => '默认设置',
			);
			
			$tabs = apply_filters( 'ppp_admin_tabs', $tabs );
			
			$ppp_options->set_tabs( $tabs );
		}
		
		// 设置插件菜单
		public function add_plugin_admin_menu() {
			
			global $ppp_base_class;

            // 创建顶级菜单
			$this->plugin_screen_hook_suffix[] = add_menu_page(
				$ppp_base_class->get_plugin_title() . ' ' .'设置',
				$ppp_base_class->get_plugin_menu_title(),
				'manage_options',
				$ppp_base_class->plugin_slug,
				array( $this, 'display_plugin_admin_page' ),
				PINGPP_WP_PAY_PLUGIN_URL. 'assets/img/logo-16x16.png'
			);

            // 创建子菜单
            /*
			$this->plugin_screen_hook_suffix[] = add_submenu_page(
				// ...
			);
            */
		}

        public function viewing_this_plugin() {

            $screen = get_current_screen();

            if ( ! empty( $this->plugin_screen_hook_suffix ) && in_array( $screen->id, $this->plugin_screen_hook_suffix ) ) {
                return true;
            }

            return false;
        }

        // 显示插件的管理模版
		public function display_plugin_admin_page() {
			include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'views/admin-main.php' );
		}

		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}
