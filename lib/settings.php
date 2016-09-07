<?php
/**
 * Control WP Core Emails - Settings Module
 *
 * Contains the specific settings page configuration
 *
 * @package Control WP Core Emails
 */

/**
 * Set up and load our class.
 */
class ControlCoreEmails_Settings
{

	/**
	 * Load our hooks and filters.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'admin_init',                   array( $this, 'load_settings'       )           );
	}

	/**
	 * Register our new settings and load our settings fields.
	 *
	 * @return void
	 */
	public function load_settings() {

		// Register our setting for emails.
		register_setting( 'general', 'core-control-emails', array( $this, 'data_sanitize' ) );

		// And create our settings section.
		add_settings_section( 'core-control-emails', '', array( $this, 'settings' ), 'general' );
	}

	/**
	 * Our settings section.
	 *
	 * @param  array $args  The arguments from the add_settings_section call.
	 */
	public function settings( $args ) {

		// Fetch our stored settings data.
		$stored     = ControlCoreEmails_Global::get_stored_settings();

		// Parse each one.
		$success    = in_array( 'success', $stored ) ? 'checked="checked"' : '';
		$manual     = in_array( 'manual', $stored ) ? 'checked="checked"' : '';
		$fail       = in_array( 'fail', $stored ) ? 'checked="checked"' : '';
		$critical   = in_array( 'critical', $stored ) ? 'checked="checked"' : '';

		// Add a div to wrap our whole thing for clean.
		echo '<div class="' . esc_attr( $args['id'] ) . '-wrap">';

		// Now set up the table with each value.
		echo '<table id="' . esc_attr( $args['id'] ) . '" class="core-control-emails-settings-table form-table">';
		echo '<tbody>';

			echo '<tr>';

				// The field label.
				echo '<th scope="row">';
					echo '<label>' . esc_html__( 'Update Emails', 'control-wp-core-emails' ) . '</label>';
				echo '</th>';

				// The input field.
				echo '<td>';

					echo '<label for="core-control-email-success">';
					echo '<input type="checkbox" id="core-control-email-success" name="core-control-emails[]" value="success" ' . $success  . ' />';
					echo ' ' . esc_html__( 'Success', 'control-wp-core-emails' ) . '</label>';

					echo '<br>';

					echo '<label for="core-control-email-manual">';
					echo '<input type="checkbox" id="core-control-email-manual" name="core-control-emails[]" value="manual" ' . $manual  . ' />';
					echo ' ' . esc_html__( 'Manual', 'control-wp-core-emails' ) . '</label>';

					echo '<br>';

					echo '<label for="core-control-email-fail">';
					echo '<input type="checkbox" id="core-control-email-fail" name="core-control-emails[]" value="fail" ' . $fail  . ' />';
					echo ' ' . esc_html__( 'Failure', 'control-wp-core-emails' ) . '</label>';

					echo '<br>';

					echo '<label for="core-control-email-critical">';
					echo '<input type="checkbox" id="core-control-email-critical" name="core-control-emails[]" value="critical" ' . $critical  . ' />';
					echo ' ' . esc_html__( 'Critical', 'control-wp-core-emails' ) . '</label>';

					echo '<br>';

					// Add our intro content.
					echo '<p class="description">' . esc_html__( 'Select the notification emails you want to suppress.', 'control-wp-core-emails' ) . '</p>';

				echo '</td>';

			echo '</tr>';

		// Close the table.
		echo '</tbody>';
		echo '</table>';
	}

	/**
	 * Sanitize the user data inputs.
	 *
	 * @param  array $input  The data entered in a settings field.
	 *
	 * @return array $input  The sanitized data.
	 */
	public function data_sanitize( $input ) {

		// Make sure we have an array.
		$input  = (array) $input;

		// Set an empty array.
		$data   = array();

		// Loop and sanitize each item.
		foreach ( $input as $single ) {
			$data[] = sanitize_key( $single );
		}

		// And send it back.
		return $data;
	}

	// End class.
}

// Instantiate our class.
$ControlCoreEmails_Settings = new ControlCoreEmails_Settings();
$ControlCoreEmails_Settings->init();
