<?php

/**
 * Base settings class
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MM_Settings' ) ) {
	
	class MM_Settings {
		
		// Class version
		public static $class_version = '1.0.0';
		
		// class variables
		protected $settings = array();
		protected $option;
		
		// public variables
		public $tabs;
		
		/**
		 * Class constructor
		 */
		public function __construct( $option ) {
			$this->option = $option;
			
			add_action( 'admin_init', array( $this, 'register_settings' ) );
		}
		
		/**
		 * Register the settings
		 */
		public function register_settings() {
			register_setting( $this->option, $this->option, array( $this, 'sanitize' ) );
		}
		
		/**
		 * Sanitization function
		 */
		public function sanitize( $input ) {

			// Clean up the API keys
			if ( isset( $_POST['sc_settings'] ) ) {
				foreach( $input as $k => $v ) {
					
					if ( $k == 'test_secret_key' || $k == 'test_publish_key' || $k == 'live_secret_key' || $k == 'live_publish_key' ) {
						// Trim first
						$key = trim( $v );

						// Now search for a space
						$space = strpos( $key, ' ' );

						if( $space !== false ) {
							$key = substr( $key, 0, $space );
						}

						// Just trimming again to remove any possible leftover spaces from the string replace
						$input[$k] = trim( $key );
					}
				}
			}
			
			return $input;
		}
		
		/*
		 * Function to set default options on a fresh install
		 */
		public function set_defaults( $settings = array() ) {
			
			if ( false === get_option( $this->option ) ) {
				
				$this->settings = $settings;
			
				update_option( $this->option, $this->settings );
			}
		}
		
		/*
		 * Loads the specified template file
		 */
		public function load_template( $file ) {
			include_once( $file );
		}
		
		/*
		 * Add a specific setting with a specified value
		 */
		public function add_setting( $setting, $value ) {
			$settings = get_option( $this->option );
			$settings[ $setting ] = $value;
			
			$this->update_settings( $settings );
		}
		
		/*
		 * Return all the settings
		 */
		public function get_settings() {
			$saved_settings = is_array( get_option( $this->option ) ) ? get_option( $this->option ) : array();
			
			return array_merge( $this->settings, $saved_settings );
		}
		
		public function delete_setting( $setting ) {
			$settings = get_option( $this->option );
			
			if ( isset( $settings[ $setting ] ) ) {
				unset( $settings[ $setting ] );
			}
			
			// Since the class method update_settings merges the arrays together we need to update manually here to fully rid of the deleted setting
			$this->settings = $settings;
			update_option( $this->option, $this->settings );
		}
		
		/*
		 * Updates the settings in the database
		 */
		public function update_settings( $settings = array() ) {
			
			$old_settings = get_option( $this->option );
			
			if ( false === $old_settings ) {
				$old_settings = $this->settings;
			}
			
			$this->settings = array_merge( $old_settings, $settings );
			
			foreach ( $this->settings as $setting ) {
				if ( empty( $setting ) ) {
					unset( $this->settings[ $setting ] );
				}
			}
			
			update_option( $this->option, $this->settings );
		}
		
		/*
		 * Print out the settings to the screen. Mostly used for debugging.
		 */
		public function print_settings() {
			$settings = get_option( $this->option );
			
			echo '<pre>' . print_r( $settings, true ) . '</pre>';
		}
		
		/*
		 * Set the tabs for this class instance
		 */
		public function set_tabs( $tabs ) {
			$this->tabs = $tabs;
		}
		
		/*
		 * Return the tabs of this class instance
		 */
		public function get_tabs() {
			return $this->tabs;
		}
		
		/*
		 * Return a specific setting
		 * 
		 * Will return the setting if successful or will return null if not successful.
		 */
		public function get_setting_value( $id ) {
			
			$settings = is_array( get_option( $this->option ) ) ? get_option( $this->option ) : array();
			
			$this->settings = $settings;
			
			// Only return it if it is set and it is not empty
			if ( isset( $settings[ $id ] ) && ! empty( $settings[ $id ] ) ) {
				return $settings[ $id ];
			}
			
			return null;
		}
		
		/*
		 * Create an ID for the specified $id
		 */
		public function get_setting_id( $id ) {
			return $this->option . '[' . $id . ']';
		}
		
		/*
		 * Returns this class' option value
		 */
		public function get_option() {
			return $this->option;
		}
		
		/*
		 * Delete the option out of the database
		 */
		public function delete_option() {
			delete_option( $this->option );
		}
	}
}
