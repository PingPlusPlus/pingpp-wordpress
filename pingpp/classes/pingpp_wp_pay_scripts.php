<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Pingpp_Wp_Pay_Scripts' ) ) {
	
	class Pingpp_Wp_Pay_Scripts {
		
		public static $instance = null;

		private function __construct() {

			// 加载文章时, 如果文章包含了 Ping++ shortcode, 则加载 js
			add_filter( 'the_posts', array( $this, 'load_scripts' ) );

            // 初始化时, 加载公共 css
			add_action( 'init', array( $this, 'enqueue_public_styles' ) );

            // 加载 admin css
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		}
		
		public function load_scripts( $posts ) {

			global $ppp_options, $ppp_base_class;

			if ( empty( $posts ) ) {
				return $posts;
			}

			foreach ( $posts as $post ) {
				if ( ( false !== strpos( $post->post_content, '['.$ppp_options->get_setting_value('shortcode_name') ) )
					|| ( null !== $ppp_options->get_setting_value( 'always_enqueue' ) ) ) {
					wp_enqueue_style( $ppp_base_class->plugin_slug . '_public' );
					break;
				}
			}

			return $posts;
		}
		
		public function enqueue_public_styles() {

			global $ppp_options, $ppp_base_class;

			if ( null === $ppp_options->get_setting_value( 'disable_css' ) ) {
				wp_register_style( $ppp_base_class->plugin_slug . '_public', PINGPP_WP_PAY_PLUGIN_URL . 'assets/css/public_main.css', array() );
			}
		}

		public function enqueue_admin_styles() {
			
			global $ppp_base_class;

            if ( Pingpp_Wp_Pay_Admin::get_instance()->viewing_this_plugin() ) {
                wp_enqueue_style( $ppp_base_class->plugin_slug .'_toggle_switch', PINGPP_WP_PAY_PLUGIN_URL . 'assets/css/vendor/toggle_switch.css', array() );
                wp_enqueue_style( $ppp_base_class->plugin_slug .'_admin_styles', PINGPP_WP_PAY_PLUGIN_URL . 'assets/css/admin_main.css', array( $ppp_base_class->plugin_slug .'_toggle_switch' ) );
            }
			
			wp_enqueue_script( $ppp_base_class->plugin_slug . '_admin', PINGPP_WP_PAY_PLUGIN_URL . 'assets/js/admin_main.js', array(), false, true );
		}
		
		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}
