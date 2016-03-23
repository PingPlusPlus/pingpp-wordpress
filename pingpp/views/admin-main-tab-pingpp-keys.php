<?php 

	global $ppp_options;
?>

<!-- Ping++ Keys tab HTML -->
<div class="ppp-admin-hidden" id="pingpp-keys-settings-tab">
    <div>
        <label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'live_mode' ) ); ?>"></label>
        <?php $ppp_options->checkbox( 'live_mode' ); ?> Live/Test模式 (勾选时产生真实的交易)
    </div>

    <div>
        <label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'app_id' ) ); ?>">
            APP ID</label>
        <span class="ppp-code"><?php $ppp_options->textbox( 'app_id', 'regular-text' ); ?></span>
    </div>

    <div>
        <label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'test_secret_key' ) ); ?>">
            Test Secret Key (格式如: sk_test_***)</label>
        <span class="ppp-code"><?php $ppp_options->textbox( 'test_secret_key', 'regular-text' ); ?></span>
    </div>

	<div>
		<label for="<?php echo esc_attr( $ppp_options->get_setting_id( 'live_secret_key' ) ); ?>">
            Live Secret Key (格式如: sk_live_***)</label>
		<span class="ppp-code"><?php $ppp_options->textbox( 'live_secret_key', 'regular-text' ); ?></span>
	</div>
</div>

