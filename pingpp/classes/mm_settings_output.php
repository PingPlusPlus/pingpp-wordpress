<?php

/**
 * Base settings output class - displays the fields HTML
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MM_Settings_Output' ) ) {
	class MM_Settings_Output extends MM_Settings {

		/**
		 * Class constructor
		 */
		public function __construct( $option ) {
			parent::__construct( $option );
		}
		
		/**
		 * Function to output text inputs
		 */
		public function textbox( $id, $classes = '' ) {

			$html = '<input type="text" class="' . esc_attr( $classes ) . '" name="' . esc_attr( $this->get_setting_id( $id ) ) . '" ' .
			        'id="' . esc_attr( $this->get_setting_id( $id ) ) . '" value="' . esc_attr( $this->get_setting_value( $id ) ) . '" />';

			echo $html;
		}

		/**
		 * Function to output checkbox inputs
		 */
		public function checkbox( $id, $classes = '' ) {

			$value = $this->get_setting_value( $id );

			$checked = ( ! empty( $value ) ? checked( 1, $value, false ) : '' );

			$html = '<input type="checkbox" class="' . esc_attr( $classes ) . '" id="' . esc_attr( $this->get_setting_id( $id ) ) . '" ' .
			        'name="' . esc_attr( $this->get_setting_id( $id ) ) . '" value="1" ' . $checked . '/>';

			echo $html;
		}

		/**
		 * Function to output text without any inputs
		 */
		public function description( $text = '', $classes = null ) {
			
			// Default classes
			if ( null === $classes ) {
				$classes = 'description';
			}

			$html = '<p class="' . esc_attr( $classes ) . '">' . $text . '</p>';
			
			echo $html;
		}

		/**
		 * Function to output radio button inputs
		 */
		public function radio_button( $id, $label, $value, $section = '' ) {

			$html = '';

			if ( ! empty( $section ) ) {
				$id   = $this->get_setting_id( $id );
				$name = $this->option . '[' . $section . ']';

				$saved_value =  $this->get_setting_value( $section );

				$checked = null !== $saved_value ? ( ( $saved_value == $value ) ? true : false ) : false;

			} else {
				$id = $this->get_setting_id( $id );

				$checked = ( null !== $this->get_setting_value( $id ) ? true : false );
			}

			$html  = '<input name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" type="radio" ' .
			         'value="' . esc_attr( $value ) . '" ' . checked( true, $checked, false ) . '/>&nbsp;';
			$html .= '<label for="' . esc_attr( $id ) . '">' . $label . '</label><br/>';

			echo $html;
		}

		/**
		 * Function to output select box inputs
		 */
		public function selectbox( $id, $options, $classes = '' ) {
			// Return empty string if no options.
			if ( empty( $options ) ) {
				if ( current_user_can( 'manage_options' ) ) {
					echo '<p><strong>Warning:</strong> You have not included any options for this select setting.</p>';
				} else {
					echo '';
				}

				return;
			}

			$selected = null !== $this->get_setting_value( $id ) ? $this->get_setting_value( $id ) : '';

			$html = '<select id="' . esc_attr( $this->get_setting_id( $id ) ) . '" name="' . esc_attr( $this->get_setting_id( $id ) )  . '" />';

			foreach ( $options as $option => $value ) {
				$html .= '<option value="' . esc_attr( $value) . '" ' . selected( $value, $selected, false ) . '>' . esc_html( $option ) . '</option>';
			}

			$html .= '</select>';

			echo $html;
		}

		/**
		 * Function to output textarea inputs
		 */
		public function textarea( $id, $classes = null ) {
			if ( null !== $this->get_setting_value( $id ) ) {
				$value = $this->get_setting_value( $id );
			} else {
				$value = '';
			}
			
			// Default classes
			if ( null === $classes ) {
				$classes = 'large-text';
			}

			// Ignoring size at the moment.
			$html = '<textarea class="' . esc_attr( $classes ) . '" cols="50" rows="10" id="' . esc_attr( $this->get_setting_id( $id ) ) . '" ' .
			        'name="' . esc_attr( $this->get_setting_id( $id ) ) . '">' . esc_textarea( $value ) . '</textarea>';

			echo $html;
		}

		/**
		 * Function to output number (HTML5) inputs
		 */
		public function number( $id, $classes = '' ) {

			if ( null !== $this->get_setting_id( $id ) ) {
				$value = $this->get_setting_value( $id );
			} else {
				$value = '';
			}
			
			// Default classes
			if ( empty( $classes ) ) {
				$classes = 'regular-text';
			}

			$html = '<input type="number" class="' . esc_attr( $classes ) . '" id="' . esc_attr( $this->get_setting_id( $id ) ) . '" ' .
			        'name="' . esc_attr( $this->get_setting_id( $id ) ) . '" step="1" value="' . esc_attr( $value ) . '"/>';

			echo $html;
		}
	}
}
