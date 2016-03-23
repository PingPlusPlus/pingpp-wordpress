<?php

/**
 * @author: phoenix
 * @date: 16/3/16
 * @time: 下午1:38
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Pingpp_Wp_Pay' ) ) {
    class Pingpp_Wp_Pay {

        protected static $instance = null;

        public $plugin_slug = 'pingpp_wp_pay';

        private function __construct() {
            // 加载依赖类
            $this->_includes();

            // 注册设置
            add_action( 'init', array( $this, 'register_settings' ), 0 );

            add_action( 'init', array( $this, 'init' ), 1 );
        }

        public function register_settings() {
            global $ppp_options;

            $ppp_options = new Pingpp_Wp_Pay_Settings_Extended( 'ppp_settings' );
        }

        public function init() {
            Pingpp_Wp_Pay_Scripts::get_instance();
            Pingpp_Wp_Pay_Shortcodes::get_instance();

            if ( is_admin() ) {
                Pingpp_Wp_Pay_Admin::get_instance();
                Pingpp_Wp_Pay_Notices::get_instance();
            } else {
                Pingpp_Wp_Pay_Functions::get_instance();
            }
        }

        public static function get_instance() {
            if ( null == self::$instance ) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        public static function activate() {
            update_option( 'ppp_show_admin_install_notice', 1 );
        }

        private function _includes() {
            include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'classes/mm_settings.php' );
            include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'classes/mm_settings_output.php' );
            include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'classes/pingpp_wp_pay_settings_extended.php' );
            include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'classes/pingpp_wp_pay_scripts.php' );
            include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'classes/pingpp_wp_pay_shortcodes.php' );

            // 管理界面
            include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'classes/pingpp_wp_pay_admin.php' );
            include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'classes/pingpp_wp_pay_notices.php' );

            // 公共界面
            include_once( PINGPP_WP_PAY_PLUGIN_DIR . 'classes/pingpp_wp_pay_functions.php' );
        }

        public static function get_plugin_title() {
            return 'Ping++ 支付集成插件';
        }

        public static function get_plugin_menu_title() {
            return 'Ping++';
        }
    }
}
