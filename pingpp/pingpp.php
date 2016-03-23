<?php
/*
Plugin Name: Ping++ 支付集成插件
Plugin URI: https://pingxx.com
Description: 使用Ping++, 让你的博客一键集成支付宝, 微信, 银联等支付方式
Version: 0.1.0
Author: Phx
Author URI: http://github.com/phoenixg
License: MIT

+++++++++++++++    +    +++++++++++++++   +++++++++++++++        ++             ++
+++++++++++++++    +    +++++++++++++++   +++++++++++++++        ++             ++
              +    +    +            ++   ++                     ++             ++
              +    +    +            ++   ++                     ++             ++
              +    +    +            ++   ++                     ++             ++
+++++++++++++++    +    +            ++   ++     ++++++++   ++++++++++++   ++++++++++++
+++++++++++++++    +    +            ++   ++     ++++++++   ++++++++++++   ++++++++++++
++                 +    +            ++   ++           ++        ++             ++
++                 +    +            ++   ++           ++        ++             ++
++                 +    +            ++   ++           ++        ++             ++
++                 +    +            ++   +++++++++++++++        ++             ++
++                 +    +            ++   +++++++++++++++        ++             ++
*/

if ( ! defined( 'ABSPATH' ) ) exit('Please do not call this script directly.');

define( 'PINGPP_WP_PAY_PLUGIN_VERSION', '0.1.0' );
define( 'PINGPP_WP_PAY_OFFICIAL_URL', 'https://pingxx.com/' );
define( 'PINGPP_WP_PAY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'PINGPP_WP_PAY_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );


// 加载插件
require_once PINGPP_WP_PAY_PLUGIN_DIR . 'classes/pingpp_wp_pay.php';

// 激活插件时, 调用 activate 方法
register_activation_hook( __FILE__, array( 'Pingpp_Wp_Pay', 'activate' ) );

// 设置全局变量
global $ppp_base_class;

$ppp_base_class = Pingpp_Wp_Pay::get_instance();














