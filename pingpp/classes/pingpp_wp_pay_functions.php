<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Pingpp_Wp_Pay_Functions' ) ) {
	class Pingpp_Wp_Pay_Functions {

		protected static $instance = null;

		private function __construct() {
            $this->_load_sdk();

			if ( isset( $_POST['create_charge'] ) && $_POST['create_charge'] == 1 ) {
				add_action( 'init', array( $this, 'create_charge' ) );
			}
		}

		public function _load_sdk() {
			if ( ! class_exists( 'Pingpp\Pingpp' ) ) {
				require_once( PINGPP_WP_PAY_PLUGIN_DIR . 'sdk/init.php' );
			}
		}

		public static function create_charge() {
                global $ppp_options;
				try {
                    $live_mode = $ppp_options->get_setting_value( 'live_mode' );
                    $key = ($live_mode) ? $ppp_options->get_setting_value( 'live_secret_key' ) :
                        $ppp_options->get_setting_value( 'test_secret_key' );

                    $app_id = $ppp_options->get_setting_value('app_id');

                    \Pingpp\Pingpp::setApiKey($key);
                    $ch = \Pingpp\Charge::create(
                        array(
                            'order_no'  => date('YmdHis').rand(1000, 9999),
                            'app'       => array('id' => $app_id),
                            'channel'   => $_POST['channel'],
                            'amount'    => $_POST['amount'],
                            'client_ip' => '127.0.0.1',
                            'currency'  => 'cny',
                            'subject'   => $_POST['subject'],
                            'body'      => $_POST['description'],
                            'extra'     => self::_getExtraUrl($_POST['channel']),
                        )
                    );

                    $GLOBALS['pingpp_charge_object'] = $ch;

                    if ($_POST['channel'] == 'wx_pub_qr')
                    {
                        $wx_pub_qr_pay_url = json_decode($ch)->credential->wx_pub_qr;

                        // @doc: http://phpqrcode.sourceforge.net/examples/index.php
                        require_once PINGPP_WP_PAY_PLUGIN_DIR . 'classes/phpqrcode/qrlib.php';
                        $qrcode_size = 10;
                        QRcode::png($wx_pub_qr_pay_url, FALSE, QR_ECLEVEL_L, $qrcode_size, 3);
                        exit;
                    }

                    $ppp_options->load_template( PINGPP_WP_PAY_PLUGIN_DIR . 'views/pay-pc.php' );
				} catch( Exception $e ) {
                    echo $e->getMessage();
				}

				exit;
		}

        private static function _getExtraUrl($channel)
        {
            global $ppp_options;

            if ($channel == 'upacp_pc')
            {
                return ['result_url'  => $ppp_options->get_setting_value('success_redirect_url')];
            }
            if ($channel == 'alipay_pc_direct')
            {
                return ['success_url' => $ppp_options->get_setting_value('success_redirect_url')];
            }
            if ($channel == 'cp_b2b')
            {
                return [];
            }
            if ($channel == 'wx_pub_qr')
            {
                return ['product_id' => date('YmdHis') . rand(100000, 999999)];
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
