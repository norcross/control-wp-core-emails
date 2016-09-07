<?php
/**
 * Control WP Core Emails - Global Module
 *
 * Contains the overall global functions to use.
 *
 * @package Control WP Core Emails
 */

/**
 * Set up and load our class.
 */
class ControlCoreEmails_Global
{

	/**
	 * Load our hooks and filters.
	 *
	 * @return void
	 */
	public function init() {
		add_filter( 'auto_core_update_send_email',  array( $this, 'control_core_emails' ),  10, 4   );
	}

	/**
	 * Filters whether to send an email following an automatic background core update.
	 *
	 * @param bool   $send         Whether to send the email. Default true.
	 * @param string $type         The type of email to send. Can be one of 'success', 'fail', 'critical'.
	 * @param object $core_update  The update offer that was attempted.
	 * @param mixed  $result       The result for the core update. Can be WP_Error.
	 *
	 * @return bool   $send         Whether to send the email.
	 */
	public function control_core_emails( $send, $type, $core_update, $result ) {

		// Fetch our stored settings data, and return true if nothing is checked.
		if ( false === $stored = self::get_stored_settings() ) {
			return true;
		}

		// If we have a type, and it's one of the ones we set, then bypass the email.
		return ! empty( $type ) && in_array( $type, $stored ) ? false : true;
	}

	/**
	 * Get our stored setting data.
	 *
	 * @param  string $key      The option key.
	 *
	 * @return array  The stored settings, or false if none exist.
	 */
	public static function get_stored_settings( $key = 'core-control-emails' ) {

		// Bail without a key.
		if ( empty( $key ) ) {
			return false;
		}

		// Fetch the option.
		$option = get_option( $key );

		// Return the option data or false.
		return ! empty( $option ) ? $option : false;
	}

	// End class.
}

// Instantiate our class.
$ControlCoreEmails_Global = new ControlCoreEmails_Global();
$ControlCoreEmails_Global->init();
