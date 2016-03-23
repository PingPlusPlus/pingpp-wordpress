<?php

if ( ! defined( 'ABSPATH' ) ) exit;

global $ppp_base_class;

?>

<style>
	#ppp-install-notice .button-primary,
	#ppp-install-notice .button-secondary {
		margin-left: 15px;
	}
</style>

<div id="ppp-install-notice" class="updated">
	<p>
		<?php echo $ppp_base_class->get_plugin_title() . '已成功安装'; ?>
		<a href="<?php echo esc_url( add_query_arg( 'page', $ppp_base_class->plugin_slug, admin_url( 'admin.php' ) ) ); ?>" class="button-primary">开始配置Ping++ Keys</a>
		<a href="<?php echo esc_url( add_query_arg( 'ppp-dismiss-install-nag', 1 ) ); ?>" class="button-secondary">隐藏</a>
	</p>
</div>
