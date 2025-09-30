<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Maruthi for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once MARUTHI_THEME_DIR . '/framework/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'maruthi_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function maruthi_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */

	$plugins = array(

		array(
			'name'     => esc_html__('DesignThemes Core Features Plugin', 'maruthi'),
			'slug'     => 'designthemes-core-features',
			'source'   => MARUTHI_THEME_DIR . '/framework/plugins/designthemes-core-features.zip',
			'required' => true,
			'version'  => '2.2',
		),

		array(
			'name'     => esc_html__('DesignThemes Class Addon', 'maruthi'),
			'slug'     => 'designthemes-class-addon',
			'source'   => MARUTHI_THEME_DIR . '/framework/plugins/designthemes-class-addon.zip',
			'required' => true,
			'version'  => '1.5',
		),

		array(
			'name'     => esc_html__('Simple Events Manager', 'maruthi'),
			'slug'     => 'dt-event-manager',
			'source'   => MARUTHI_THEME_DIR . '/framework/plugins/dt-event-manager.zip',
			'required' => true,
			'version'  => '1.7',
		),

		array(
			'name'     => esc_html__('Contact Form 7', 'maruthi'),
			'slug'     => 'contact-form-7',
			'required' => false,
		),

		array(
            'name'               => esc_html__('WDT Demo Importer', 'maruthi'),
            'slug'               => 'wdt-demo-importer',
            'source'             => MARUTHI_THEME_DIR . '/framework/plugins/wdt-demo-importer.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),

		array(
			'name'     => esc_html__('WooCommerce - excelling eCommerce', 'maruthi'),
			'slug'     => 'woocommerce',
			'required' => false,
		),

		array(
			'name'     => esc_html__('Kirki Toolkit', 'maruthi'),
			'slug'     => 'kirki',
			'required' => true,
		)
	);




		      $args = array(
          'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . network_site_url(),
          'timeout'    => 30,
      );
      $theme_support_domain = THEME_SUPPORT_DOMAIN;
          $plugin_endpoint_path = PLUGIN_ENDPOINT_PATH;
      $theme_specific_plugins = 'revslider,layerslider,js_composer,ultimate-vc-addons,envato-market';
      $secure_token           = 'e431215ade65c75d3ada5a39';	

      $plugin_info_url = trailingslashit($theme_support_domain) . ltrim($plugin_endpoint_path, '/') .
              '?plugins=' . urlencode($theme_specific_plugins) .
              '&token=' . urlencode($secure_token);
      $response = wp_remote_get($plugin_info_url, $args);
      $data     = json_decode(wp_remote_retrieve_body($response), true);
      $updated_plugin_list = (is_array($data) && !empty($data)) ? array_merge($data, $plugins) : $plugins;



	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'maruthi',               // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $updated_plugin_list, $config );
}?>