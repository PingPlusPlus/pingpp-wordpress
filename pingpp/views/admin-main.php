<?php
if ( ! defined( 'ABSPATH' ) ) exit;

global $ppp_options;
?>

<div class="wrap">
	<?php settings_errors(); ?>
	<div id="ppp-settings">
		<div id="ppp-settings-content">

			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<h2 class="nav-tab-wrapper">
				<?php
					foreach ( $ppp_options->get_tabs() as $key => $value ) {
				?>
						<a href="#<?php echo esc_attr( $key ); ?>" class="nav-tab ppp-nav-tab" data-tab-id="<?php echo esc_attr( $key ); ?>"><?php echo $value; ?></a>
				<?php
					}
				?>
			</h2>

			<div id="tab_container">
				<form method="post" action="options.php">
				<?php
					settings_fields( $ppp_options->get_option() );
                    $ppp_options->load_template( PINGPP_WP_PAY_PLUGIN_DIR . 'views/admin-main-tab-pingpp-keys.php' );
					$ppp_options->load_template( PINGPP_WP_PAY_PLUGIN_DIR . 'views/admin-main-tab-default.php' );


					do_action( 'ppp_admin_tab_content' );

					submit_button();
				?>
				</form>
			</div><!-- #tab_container-->
		</div><!-- #ppp-settings-content -->

	</div>
</div><!-- .wrap -->
