<?php
/**
 * Plugin Name: Control WP Core Emails
 * Plugin URI: https://github.com/norcross/control-wp-core-emails
 * Description: Fine tune the emails sent by WP core.
 * Author: Andrew Norcross
 * Author URI: http://reaktivstudios.com/
 * Version: 0.0.1
 * Text Domain: control-wp-core-emails
 * Domain Path: languages
 * License: MIT
 * GitHub Plugin URI: https://github.com/norcross/control-wp-core-emails
 */

// Set my base for the plugin.
if ( ! defined( 'CONTROL_WP_CORE_EMAILS_BASE' ) ) {
	define( 'CONTROL_WP_CORE_EMAILS_BASE', plugin_basename( __FILE__ ) );
}

// Set my directory for the plugin.
if ( ! defined( 'CONTROL_WP_CORE_EMAILS_DIR' ) ) {
	define( 'CONTROL_WP_CORE_EMAILS_DIR', plugin_dir_path( __FILE__ ) );
}

// Set my version for the plugin.
if ( ! defined( 'CONTROL_WP_CORE_EMAILS_VER' ) ) {
	define( 'CONTROL_WP_CORE_EMAILS_VER', '0.0.1' );
}

/**
 * Set up and load our class.
 */
class ControlCoreEmails
{

	/**
	 * Load our hooks and filters.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'plugins_loaded',               array( $this, 'textdomain'          )           );
		add_action( 'plugins_loaded',               array( $this, 'load_files'          )           );
	}

	/**
	 * Load textdomain for international goodness.
	 *
	 * @return textdomain
	 */
	public function textdomain() {
		load_plugin_textdomain( 'control-wp-core-emails', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Call our files in the appropriate place.
	 *
	 * @return void
	 */
	public function load_files() {

		// Load our global file.
		require_once( 'lib/global.php' );

		// Load our settings file.
		if ( is_admin() ) {
			require_once( 'lib/settings.php' );
		}
	}

	// End the class.
}

// Instantiate our class.
$ControlCoreEmails = new ControlCoreEmails();
$ControlCoreEmails->init();
