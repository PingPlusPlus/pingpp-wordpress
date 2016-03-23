<?php 
	global $ppp_options; 
?>

<!-- Default Settings tab HTML -->
<div class="ppp-admin-hidden" id="default-settings-tab">
	<div>
		<a href="<?php echo 'https://help.pingxx.com'; ?>" target="_blank">
			查看 shortcode 例子
		</a>
		<?php // $ppp_options->description( 'Shortcode 属性会覆盖默认设置' ); ?>
	</div>

    <div>
        <label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'shortcode_name' ) ); ?>">
            Shortcode</label>
        <?php
        $ppp_options->textbox( 'shortcode_name', 'regular-text' ); ?>
    </div>

    <div>
        <label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'button_name' ) ); ?>">
           按钮文字</label>
        <?php
        $ppp_options->textbox( 'button_name', 'regular-text' );
        $ppp_options->description( '支付按钮的文本' );?>
    </div>

	<div>
		<label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'success_redirect_url' ) ); ?>">支付成功回调URL</label>
		<?php 
			$ppp_options->textbox( 'success_redirect_url', 'regular-text' );
			$ppp_options->description( '支付成功后, 跳转到的地址' );
		?>
	</div>

	<div>
		<label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'default_channel' ) ); ?>">默认渠道</label>
		<?php 
			$ppp_options->selectbox( 'default_channel', array(
												'支付宝即时到账' => 'alipay_pc_direct',
												'微信公众号扫码' => 'wx_pub_qr',
                                                '银联网关支付' => 'upacp_pc',
                                                '企业网银支付' =>'cp_b2b')
                                        );
			$ppp_options->description( '默认使用的支付渠道' );
		?>
	</div>

	<div>
		<label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'always_enqueue' ) ); ?>">总是加载</label>
		<?php $ppp_options->checkbox( 'always_enqueue' ); ?>
		<span>在每个页面加载插件所需脚本</span>
	</div>

	<div>
		<label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'selectable' ) ); ?>">启用渠道可选</label>
		<?php $ppp_options->checkbox( 'selectable' ); ?>
		<span>允许用户选择支付方式</span>
	</div>

    <div>
        <label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'show_channel' ) ); ?>">显示渠道</label>
        <?php $ppp_options->checkbox( 'show_channel_alipay_pc_direct' ); ?>支付宝即时到账
        <?php $ppp_options->checkbox( 'show_channel_wx_pub_qr' ); ?>微信公众号扫码
        <?php $ppp_options->checkbox( 'show_channel_upacp_pc' ); ?>银联网关支付
        <?php $ppp_options->checkbox( 'show_channel_cp_b2b' ); ?>企业网银支付
    </div>


    <?php do_action( 'ppp_settings_tab_default' ); ?>
</div>
