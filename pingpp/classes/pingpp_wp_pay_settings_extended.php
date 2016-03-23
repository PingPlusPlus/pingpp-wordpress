<?php

/**
 * Settings extension for additional controls not available in the base class
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Pingpp_Wp_Pay_Settings_Extended' ) ) {
	class Pingpp_Wp_Pay_Settings_Extended extends MM_Settings_Output {
		
		public function __construct( $option ) {
			parent::__construct( $option );
		}
		
		/**
		 * The function used to create the toggle control
		 * 
		 * @param string $id ID of the control
		 * @param array $options The available options for the switch (needs exactly 2 options)
		 * @param string $classes The CSS classes for the control
		 */
		public function toggle_control( $id, $options, $classes = null ) {
			
			// If there are not exactly 2 options then we return an error
			if ( 2 != count( $options ) ) {
				echo __( 'You must include 2 options for a toggle switch!', 'sc' ) . '<br>';
				return;
			}
			
			// Default classes
			if( null === $classes ) {
				$classes = 'switch-light switch-candy switch-candy-blue';
			}

			$value = $this->get_setting_value( $id );

			$checked = ( ! empty( $value ) ? checked( 1, $value, false ) : '' );

			$html  = '<div class="' . esc_attr( $this->option ) . '-toggle-switch-wrap">';
			$html .= '<label class="' . esc_attr( $classes ) . '">';
			$html .= '<input type="checkbox" id="' . esc_attr( $this->get_setting_id( $id ) ) . '" name="' . esc_attr( $this->get_setting_id( $id ) ) . '" value="1" ' . $checked . '/>';
			$html .= '<span>';

			foreach ( $options as $o ) {
				$html .= '<span>' . esc_html( $o ) . '</span>';
			}

			$html .= '</span>';
			$html .= '<a></a>';
			$html .= '</label></div>';

			echo $html;
		}
	}
}
