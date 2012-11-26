<?php
/** jetpack-twitter-via.php
 *
 * Plugin Name: Jetpack Twitter Via
 * Plugin URI:  http://en.wp.obenland.it/jetpack-twitter-via/?utm_source=wordpress&utm_medium=plugin&utm_campaign=jetpack-twitter-via
 * Description: Adds 'via @username' to the Jetpack Twitter share button
 * Version:     1.0.0
 * Author:      Konstantin Obenland
 * Author URI:  http://en.wp.obenland.it/#utm_source=wordpress&utm_medium=plugin&utm_campaign=jetpack-twitter-via
 * Text Domain: jetpack-twitter-via
 * Domain Path: /lang
 * License:     GPLv2
 */


load_plugin_textdomain( 'jetpack-twitter-via', false, 'jetpack-twitter-via/lang' );


/**
 * Returns the Twitter username to append to tweets
 *
 * @author Konstantin Obenland
 * @since  1.0
 *
 * @return string
 */
function jtv_jetpack_twitter_via() {
	return get_option( 'jtv-jetpack-twitter-via' );
}
add_filter( 'jetpack_sharing_twitter_via', 'jtv_jetpack_twitter_via' );


/**
 * Registers the form settings section and -field
 *
 * @author Konstantin Obenland
 * @since  1.0
 *
 * @return void
 */
function jtv_settings_init() {
	add_settings_section( 'jtv-settings', '', '__return_false', 'sharing' );
	add_settings_field( 'jtv-jetpack-twitter-via',  __( 'Twitter Username', 'jetpack-twitter-via' ), 'jtv_settings_field', 'sharing', 'jtv-settings', array(
		'label_for' => 'jtv-jetpack-twitter-via'
	) );
}
add_action( 'admin_init', 'jtv_settings_init' );


/**
 * Calls the jtv settings field
 *
 * @author Konstantin Obenland
 * @since  1.0
 *
 * @return void
 */
function jtv_sharing_global_options() {
	do_settings_fields( 'sharing', 'jtv-settings' );
}
add_action( 'sharing_global_options', 'jtv_sharing_global_options' );


/**
 * Renders the jtv settings field
 *
 * @author Konstantin Obenland
 * @since  1.0
 *
 * @return void
 */
function jtv_settings_field() {
	wp_nonce_field( 'jtv-settings', 'jtv_nonce', false ); ?>
	<input type="text" id="jtv-jetpack-twitter-via" class="regular-text" name="jtv-jetpack-twitter-via" value="<?php echo esc_attr( get_option( 'jtv-jetpack-twitter-via' ) ); ?>" />
	<p class="description" style="width: auto;"><?php _e( 'Screen name of the user to attribute the Tweet to.', 'jetpack-twitter-via' ); ?></p>
	<?php
}


/**
 * Validates the Twitter username
 *
 * @author Konstantin Obenland
 * @since  1.0
 *
 * @return void
 */
function jtv_settings_validate() {
	if ( wp_verify_nonce( $_POST['jtv_nonce'], 'jtv-settings' ) ) {
		update_option( 'jtv-jetpack-twitter-via', trim( ltrim( strip_tags( $_POST['jtv-jetpack-twitter-via'] ), '@' ) ) );
	}
}
add_action( 'sharing_admin_update', 'jtv_settings_validate' );


/* End of file jetpack-twitter-via.php */
/* Location: ./wp-content/plugins/jetpack-twitter-via/jetpack-twitter-via.php */