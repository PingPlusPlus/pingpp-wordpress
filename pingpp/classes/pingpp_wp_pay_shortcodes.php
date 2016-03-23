<?php
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Pingpp_Wp_Pay_Shortcodes' ) ) {
	
	class Pingpp_Wp_Pay_Shortcodes {
		
		 private static $instance = null;
		
		 private function __construct() {
             global $ppp_options;
             add_shortcode( $ppp_options->get_setting_value('shortcode_name'), array( $this, 'pingpp_shortcode' ) );
         }

         // [pingpp amount="20" channel="alipay_pc_direct"]
	     function pingpp_shortcode( $attrs, $content = null ) {
             global $ppp_options;

             // 默认值
             $customized_atts = shortcode_atts( array(
                 'subject'     => '商品名称',
                 'description' => '商品描述',
                 'amount'      => '1',
                 'channel'     => $ppp_options->get_setting_value('default_channel'),
				 'selectable'  => true,
                ), $attrs, $ppp_options->get_setting_value('shortcode_name'));

             $html = "<form method='post' action='' class='wp_pingxx_form'>
                            <input type='hidden' name='create_charge' value='1' />
                            <input type='hidden' name='amount' value='{$customized_atts['amount']}' />";

             if ($ppp_options->get_setting_value('selectable'))
             {
                 if ($ppp_options->get_setting_value('show_channel_alipay_pc_direct'))
                 {
                     $html .= "<input class='wp_pingxx_channel' type='radio' name='channel' value='alipay_pc_direct' id='alipay_pc_direct' />";
                     $html .= '<label class="wp_pingxx_channel_box" for="alipay_pc_direct">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAQAAADZc7J/AAABFElEQVR4Ad2US4GEMBBEn4JYaA2xgIe2kSsWoiAe8BABUYCDWOC4//APLDCn3VenGZhKuqt7+N94um8pD3kvCjwkFwP/qoHjEpaw0VAMIu1GlgqO98sKVDDIRv30umxkuES62oMZwS4038BOEuRK8mcaOEFXahaa7xNfnQrlEXqlgAZXRsjRrJs1FdBxQKi0qyegGECm7ywVzHd9iUD7KU8gMiy6Hn9rYK44G5S4u1NztANCHSGQV0X5fRH9p87ws0HdZiBdiG+vTIdDIJ1kO6+4ItWkEujBvgndlIPOfzo7g7K2Hlkk0CxeTMjG2E8hT8HGUlUi0q9moKWGoSWvJ8ORd71uMZyhc4LrXfA4LNew/H0+ACUpEQHjy8YPAAAAAElFTkSuQmCC" width="16" height="16" alt="">
                                支付宝即时到账
                            </label>';
                 }

                 if ($ppp_options->get_setting_value('show_channel_wx_pub_qr'))
                 {
                     $html .= "<input class='wp_pingxx_channel' type='radio' name='channel' value='wx_pub_qr' id='wx_pub_qr' />";
                     $html
                         .= '<label class="wp_pingxx_channel_box" for="wx_pub_qr">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAAAM1BMVEVMaXEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADlf1jlAAAAEHRSTlMAv7Atgh4SQOuW4dFhbgZXwGqQ8wAAAMNJREFUeAHF0AWOxTAQA1CHOfX9L/spUwbx7hMVrCH8MTfZlGw1uORtpojJ46gn7uhDJPCkYqPxgsai8lKAMLxi0R0GxZPYAMN4N2CpgNdzE5PGx6WOCgAsvxI+WpGZRzA5ACFKFh9JXhwCY+sA/FIs/wLL1OgdUl3E33teX5bqouCjzgXbUn2hZIshL9UXdn8HXXhg8KN5I2FwvBY9ROClgIUr9/9F5kFxeArEisUyp530iEU94ShQeXx4E4zDhdDwf97J/B2yRrSrNAAAAABJRU5ErkJggg==" width="16" height="16" alt="">
                                微信公众号扫码
                            </label>';
                 }

                 if ($ppp_options->get_setting_value('show_channel_upacp_pc'))
                 {
                     $html .= "<input class='wp_pingxx_channel' type='radio' name='channel' value='upacp_pc' id='upacp_pc' />";
                     $html
                         .= '<label class="wp_pingxx_channel_box" for="upacp_pc">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAQAAADZc7J/AAABKUlEQVR4Ae3TV7mgMBQGwJGBAxTEQATwGAOxgINIiAM04AMBCOAVB2fz3bK99/YPvXOS+J/fLN35SYeXHvaTl9nFV9gBJvFVOsAivkoFaOKrzAC3LgtFF+9VzNJblbrwsgKzIkweLnE7hJecOM3K+0tYBHaXrJsUXbWbbDpWO4rFKluHOtw6QBc41WE1q4qsDtkiqcPsGLJl2FGFDHAIM/LLhxRNlXR1aA/74ZRMmgMxvMzl4T/FW+6Xy/tlLQ6hDC8rQBIf0Kw2VZOcVsWi6ZJbaACrD3fTVTYP2S7JqowuhgVgE++1oSoSdt0ka6bh4WdNgIfd96kmTVEll2yyaC+/+ACYxQdsFpusWF2qZVgffN9h1L91GO3iKxxeJruH6wuE3eR/fqO8APZ7vEZY6Q30AAAAAElFTkSuQmCC" width="17" height="17" alt="">
                                银联网关
                            </label>';
                 }

                 if ($ppp_options->get_setting_value('show_channel_cp_b2b'))
                 {
                     $html .= "<input class='wp_pingxx_channel' type='radio' name='channel' value='cp_b2b' id='cp_b2b' />";
                     $html
                         .= '<label class="wp_pingxx_channel_box" for="cp_b2b">
                                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAQAAADZc7J/AAABKUlEQVR4Ae3TV7mgMBQGwJGBAxTEQATwGAOxgINIiAM04AMBCOAVB2fz3bK99/YPvXOS+J/fLN35SYeXHvaTl9nFV9gBJvFVOsAivkoFaOKrzAC3LgtFF+9VzNJblbrwsgKzIkweLnE7hJecOM3K+0tYBHaXrJsUXbWbbDpWO4rFKluHOtw6QBc41WE1q4qsDtkiqcPsGLJl2FGFDHAIM/LLhxRNlXR1aA/74ZRMmgMxvMzl4T/FW+6Xy/tlLQ6hDC8rQBIf0Kw2VZOcVsWi6ZJbaACrD3fTVTYP2S7JqowuhgVgE++1oSoSdt0ka6bh4WdNgIfd96kmTVEll2yyaC+/+ACYxQdsFpusWF2qZVgffN9h1L91GO3iKxxeJruH6wuE3eR/fqO8APZ7vEZY6Q30AAAAAElFTkSuQmCC" width="17" height="17" alt="">
                                企业付款
                            </label>';
                 }
             }
             else
             {
                 $html .= "<input type='hidden' name='channel' value='{$customized_atts['channel']}' />";
             }

             $html .= "<input type='hidden' name='subject' value='{$customized_atts['subject']}' />
                            <input type='hidden' name='description' value='{$customized_atts['description']}' />
                            <input class='wp_pingxx_submit' type='submit' value='{$ppp_options->get_setting_value('button_name')}' />
                        </form>";
             return $html;
	    }

		public static function get_instance() {

			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}
	}
}
