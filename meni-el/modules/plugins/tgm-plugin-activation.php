<?php
/**
 * Recommends plugins for use with the theme via the TGMA Script
 *
 * @package Meni_El WordPress theme
 */

function meni_el_tgmpa_plugins_register() {

	// Get array of recommended plugins.

	$plugins_list = array(
        array(
            'name'               => esc_html__('Meni El Plus', 'meni-el'),
            'slug'               => 'meni-el-plus',
            'source'             => MENI_EL_MODULE_DIR . '/plugins/meni-el-plus.zip',
            'required'           => true,
            'version'            => '1.0.2',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__('Meni El Pro', 'meni-el'),
            'slug'               => 'meni-el-pro',
            'source'             => MENI_EL_MODULE_DIR . '/plugins/meni-el-pro.zip',
            'required'           => true,
            'version'            => '1.0.3',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('Elementor', 'meni-el'),
            'slug'     => 'elementor',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Elementor Addon', 'meni-el'),
            'slug'               => 'wedesigntech-elementor-addon',
            'source'             => MENI_EL_MODULE_DIR . '/plugins/wedesigntech-elementor-addon.zip',
            'required'           => true,
            'version'            => '1.0.5',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Portfolio', 'meni-el'),
            'slug'               => 'wedesigntech-portfolio',
            'source'             => MENI_EL_MODULE_DIR . '/plugins/wedesigntech-portfolio.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__('WeDesignTech Ultimate Booking Addon', 'meni-el'),
            'slug'               => 'wedesigntech-ultimate-booking-addon',
            'source'             => MENI_EL_MODULE_DIR . '/plugins/wedesigntech-ultimate-booking-addon.zip',
            'required'           => true,
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'     => esc_html__('WooCommerce', 'meni-el'),
            'slug'     => 'woocommerce',
            'required' => true,
        ),
        array(
            'name'               => esc_html__('Meni El Shop', 'meni-el'),
            'slug'               => 'meni-el-shop',
            'source'             => MENI_EL_MODULE_DIR . '/plugins/meni-el-shop.zip',
            'required'           => true,
            'version'            => '1.0.1',
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
       array(
			'name'                  => esc_html__('One Click Demo Importer', 'iva'),
			'slug'                  => 'one-click-demo-import',
			'required'              => true,
       ),
        array(
            'name'     => esc_html__('Variation Swatches for WooCommerce', 'meni-el'),
            'slug'     => 'woo-variation-swatches',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Wishlist', 'meni-el'),
            'slug'     => 'yith-woocommerce-wishlist',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Compare', 'meni-el'),
            'slug'     => 'yith-woocommerce-compare',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('YITH WooCommerce Quick View', 'meni-el'),
            'slug'     => 'yith-woocommerce-quick-view',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('Contact Form 7', 'meni-el'),
            'slug'     => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name'     => esc_html__('Date Time Picker for Contact Form 7', 'meni-el'),
            'slug'     => 'date-time-picker-for-contact-form-7',
            'required' => true,
        )
	);

       $args = array(
    'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . network_site_url(),
    'timeout'    => 30,
);

$theme_support_domain = THEME_SUPPORT_DOMAIN;
$plugin_endpoint_path = PLUGIN_ENDPOINT_PATH;

$theme_specific_plugins = 'revslider';
$secure_token           = 'e431215ade65c75d3ada5a39';

$plugin_info_url = trailingslashit( $theme_support_domain ) . ltrim( $plugin_endpoint_path, '/' ) . '?plugins=' . urlencode( $theme_specific_plugins ) . '&token=' . urlencode( $secure_token );

$response = wp_remote_get( $plugin_info_url, $args );

if ( is_wp_error( $response ) ) { $data = array(); } else {

    $body = wp_remote_retrieve_body( $response );
    
    $data = json_decode( $body, true );

    if ( json_last_error() !== JSON_ERROR_NONE ) {
        $data = array();
    }
}

$plugins_list        = isset( $plugins_list ) && is_array( $plugins_list ) ? $plugins_list : array();

$updated_plugin_list = ( is_array( $data ) && ! empty( $data ) )? array_merge( (array) $data, $plugins_list ): $plugins_list;

	tgmpa( $updated_plugin_list, array(
		'id'           => 'meni_el_theme',
		'domain'       => 'meni-el',
		'menu'         => 'install-required-plugins',
		'has_notices'  => true,
		'is_automatic' => true,
		'dismissable'  => true,
	) );


}
add_action( 'tgmpa_register', 'meni_el_tgmpa_plugins_register' );