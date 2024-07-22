<?php

use PowerpackElements\Classes\PP_Admin_Settings;

// this is the URL our updater / license checker pings. This should be the URL of the site with EDD installed
define( 'POWERPACK_SL_URL', 'https://powerpackelements.com' ); // you should use your own CONSTANT name, and be sure to replace it throughout this file

// the name of your product. This should match the download name in EDD exactly
define( 'POWERPACK_ITEM_NAME', 'PowerPack Pro for Elementor' ); // you should use your own CONSTANT name, and be sure to replace it throughout this file

// the name of the settings page for the license input to be displayed
define( 'POWERPACK_LICENSE_PAGE', 'powerpack-settings' );

if ( ! class_exists( 'PP_SL_Plugin_Updater' ) ) {
	// load our custom updater
	include dirname( __FILE__ ) . '/class-pp-plugin-updater.php';
}

function pp_get_license_key() {
	return defined( 'PP_ELEMENTS_LICENSE_KEY' ) ? PP_ELEMENTS_LICENSE_KEY : trim( get_option( 'pp_license_key' ) );
}

function pp_plugin_updater() {

	// retrieve our license key from the DB
	$license_key = pp_get_license_key();

	// setup the updater
	$updater = new PP_SL_Plugin_Updater( POWERPACK_SL_URL, POWERPACK_ELEMENTS_PATH . '/powerpack-elements.php',
		array(
			'version'   => POWERPACK_ELEMENTS_VER,  // current version number
			'license'   => $license_key,            // license key
			'item_name' => POWERPACK_ITEM_NAME,     // name of this plugin
			'author'    => 'IdeaBox Creations',     // author of this plugin
			'beta'      => false,
		)
	);

}
add_action( 'admin_init', 'pp_plugin_updater', 0 );

function pp_sanitize_license( $new ) {
	$old = pp_get_license_key();
	if ( $old && $old != $new ) {
		delete_option( 'pp_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

function pp_do_license_action( $action ) {
	if ( ! in_array( $action, array( 'activate_license', 'deactivate_license' ) ) ) {
		return;
	}

	// retrieve the license.
	$license = pp_get_license_key();

	// data to send in our API request
	$api_params = array(
		'edd_action' => $action,
		'license'    => $license,
		'item_name'  => urlencode( POWERPACK_ITEM_NAME ), // the name of our product in EDD
		'url'        => network_home_url(),
	);

	// Call the custom API.
	$response = wp_remote_post(
		POWERPACK_SL_URL,
		array(
			'timeout' => 15,
			'sslverify' => apply_filters( 'ppe_https_ssl_verify', false ),
			'body' => $api_params,
		)
	);

	return $response;
}

function pp_activate_license() {
	// listen for our activate button to be clicked
	if ( ! isset( $_POST['pp_license_activate'] ) ) {
		return;
	}

	// run a quick security check
	if ( ! check_admin_referer( 'pp_license_activate_nonce', 'pp_license_activate_nonce' ) ) {
		return; // get out if we didn't click the Activate button
	}

	// Call the custom API.
	$response = pp_do_license_action( 'activate_license' );

	// make sure the response came back okay
	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

		if ( is_wp_error( $response ) ) {
			$message = $response->get_error_message();
		} else {
			$code = wp_remote_retrieve_response_code( $response );
			$response_msg = wp_remote_retrieve_response_message( $response );
			if ( 403 === $code ) {
				$message = __( 'An error occurred while activating license. The request is getting blocked by a security plugin or security settings on server.', 'powerpack' );
			} else {
				$message = sprintf( __( 'An error occurred, please try again. Status: %1$s %2$s', 'powerpack' ), $code, $response_msg );
			}
		}
	} else {

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if ( false === $license_data->success ) {

			$message = pp_get_license_error( $license_data );

		}
	}

	// Check if anything passed on a message constituting a failure
	if ( ! empty( $message ) ) {
		$base_url = PP_Admin_Settings::get_form_action();
		$redirect = add_query_arg( array(
			'sl_activation' => 'false',
			'message' => urlencode( $message ),
		), $base_url );

		wp_redirect( $redirect );
		exit();
	}

	// $license_data->license will be either "valid" or "invalid"

	update_option( 'pp_license_status', $license_data->license );
	wp_redirect( PP_Admin_Settings::get_form_action() );
	exit();
}
add_action( 'admin_init', 'pp_activate_license' );

function pp_deactivate_license() {
	// listen for our activate button to be clicked
	if ( ! isset( $_POST['pp_license_deactivate'] ) ) {
		return;
	}

	// run a quick security check
	if ( ! check_admin_referer( 'pp_license_deactivate_nonce', 'pp_license_deactivate_nonce' ) ) {
		return; // get out if we didn't click the Deactivate button
	}

	// Call the custom API.
	$response = pp_do_license_action( 'deactivate_license' );

	// make sure the response came back okay
	if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {

		if ( is_wp_error( $response ) ) {
			$message = $response->get_error_message();
		} else {
			$code = wp_remote_retrieve_response_code( $response );
			$response_msg = wp_remote_retrieve_response_message( $response );
			if ( 403 === $code ) {
				$message = __( 'An error occurred while deactivating license. The request is getting blocked by a security plugin or security settings on server.', 'powerpack' );
			} else {
				$message = sprintf( __( 'An error occurred, please try again. Status: %1$s %2$s', 'powerpack' ), $code, $response_msg );
			}
		}

		$base_url = PP_Admin_Settings::get_form_action();
		$redirect = add_query_arg( array(
			'sl_activation' => 'false',
			'message' => urlencode( $message ),
		), $base_url );

		wp_redirect( $redirect );
		exit();
	}

	// decode the license data
	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	// $license_data->license will be either "deactivated" or "failed"
	if ( $license_data->license == 'deactivated' ) {
		delete_option( 'pp_license_status' );
	}

	wp_redirect( PP_Admin_Settings::get_form_action( '&sl_status=' . $license_data->license ) );
	exit();
}
add_action( 'admin_init', 'pp_deactivate_license' );


/************************************
* this illustrates how to check if
* a license key is still valid
* the updater does this for you,
* so this is only needed if you
* want to do something custom
*************************************/

function pp_check_license() {

	global $wp_version;

	$license = pp_get_license_key();

	$api_params = array(
		'edd_action' => 'check_license',
		'license' => $license,
		'item_name' => urlencode( POWERPACK_ITEM_NAME ),
		'url'       => home_url(),
	);

	// Call the custom API.
	$response = wp_remote_post( POWERPACK_SL_URL, array(
		'timeout' => 15,
		'sslverify' => false,
		'body' => $api_params,
	) );

	if ( is_wp_error( $response ) ) {
		return false;
	}

	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	// if ( $license_data->license !== 'valid' ) {
	// 	// this license is no longer valid
	// 	// delete license status.
	// 	if ( in_array( $license_data->license, array( 'deactivated', 'inactive', 'site_inactive' ) ) ) {
	//      delete_option( 'pp_license_status' );
	// 	} else {
	// 		update_option( 'pp_license_status', $license_data->license );
	// 	}
	// }

	return $license_data;
}

/**
* Show update message on plugins page
*/
function pp_in_plugin_update_message( $plugin_data, $response ) {
	$data = pp_check_license();

	if ( 'valid' !== $data->license ) {
		?>
		<style>
		tr[data-plugin="<?php echo POWERPACK_ELEMENTS_BASE; ?>"] .update-message {
			padding: 0;
		}
		tr[data-plugin="<?php echo POWERPACK_ELEMENTS_BASE; ?>"] .update-message p:first-of-type {
			border-bottom: 1px solid #ffb922;
			padding-bottom: 8px;
			padding-left: 12px;
		}
		tr[data-plugin="<?php echo POWERPACK_ELEMENTS_BASE; ?>"] .pp-update-message {
			padding: 5px 15px;
		}
		tr[data-plugin="<?php echo POWERPACK_ELEMENTS_BASE; ?>"] .pp-update-message:before {
			display: none !important;
		}
		tr[data-plugin="<?php echo POWERPACK_ELEMENTS_BASE; ?>"] .pp-update-message + p:empty{
			display: none;
		}
		tr[data-plugin="<?php echo POWERPACK_ELEMENTS_BASE; ?>"] .pp-buy-button {
			text-decoration: none;
			font-weight: bold;
		}
		</style>
		<?php

		$main_msg = sprintf( __( 'Please activate the license to enable automatic updates for this plugin. License status: %s', 'powerpack' ), $data->license );

		$message  = '';
		$message .= '<p class="pp-update-message">';
		$message .= __( '<strong>UPDATE UNAVAILABLE!</strong>', 'powerpack' );
		$message .= '&nbsp;&nbsp;';
		$message .= $main_msg;
		$message .= ' <a href="' . POWERPACK_SL_URL . '" class="pp-buy-button" target="_blank">';
		$message .= __( 'Buy Now', 'powerpack' );
		$message .= ' &raquo;</a>';
		$message .= '</p>';

		echo $message;
	}
}
add_action( 'in_plugin_update_message-' . POWERPACK_ELEMENTS_BASE, 'pp_in_plugin_update_message', 1, 2 );

function pp_get_license_error( $license_data ) {
	$message = '';

	switch ( $license_data->error ) {

		case 'expired':
			$message = sprintf(
				__( 'Your license key expired on %s.', 'powerpack' ),
				date_i18n( get_site_option( 'date_format' ), strtotime( $license_data->expires, current_time( 'timestamp' ) ) )
			);
			break;

		case 'revoked':
			$message = __( 'Your license key has been disabled.', 'powerpack' );
			break;

		case 'missing':
			$message = __( 'Invalid license.', 'powerpack' );
			break;

		case 'invalid':
		case 'site_inactive':
			$message = __( 'Your license is not active for this URL.', 'powerpack' );
			break;

		case 'item_name_mismatch':
			$message = sprintf( __( 'This appears to be an invalid license key for %s.', 'powerpack' ), POWERPACK_ITEM_NAME );
			break;

		case 'no_activations_left':
			$message = __( 'Your license key has reached its activation limit.', 'powerpack' );
			break;

		default:
			$message = sprintf( __( 'An error occurred, please try again. Status: %s', 'powerpack' ), $license_data->error );
			break;
	}

	return $message;
}

/**
 * This is a means of catching errors from the activation method above and displaying it to the customer
 */
function pp_admin_notices() {
	$start_el = '<div class="notice error" style="background: #fbfbfb; border-top: 1px solid #eee; border-right: 1px solid #eee;"><p>';
	$end_el = '</p></div>';

	if ( isset( $_GET['sl_activation'] ) && ! empty( $_GET['message'] ) ) {

		switch ( $_GET['sl_activation'] ) {

			case 'false':
				echo $start_el;
				echo esc_html( wp_unslash( $_GET['message'] ) );
				echo $end_el;
				break;

			case 'true':
			default:
				break;
		}
	}

	if ( current_user_can( 'update_plugins' ) ) {

		$license_data = get_transient( 'powerpack_elements_license_data' );
		if ( ! $license_data ) {
			$license_data = pp_check_license();
			set_transient( 'powerpack_elements_license_data', $license_data, 12 * HOUR_IN_SECONDS );
		}

		if ( is_object( $license_data ) && 'expired' === $license_data->license ) {
			$settings = PP_Admin_Settings::get_settings();
			$admin_label = PP_Admin_Settings::get_admin_label();
			if ( 'off' === $settings['hide_wl_settings'] && 'off' === $settings['hide_plugin'] ) {
				echo $start_el;
				echo $admin_label . ': ' . pp_get_license_error( $license_data );
				echo $end_el;
			}
		}
	}
}
add_action( 'admin_notices', 'pp_admin_notices', 10 );


