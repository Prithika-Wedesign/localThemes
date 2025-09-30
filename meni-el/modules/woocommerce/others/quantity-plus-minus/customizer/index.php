<?php

/**
 * WooCommerce - Others - Quantity Plus Minus - Customizer Settings
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'Meni_El_Shop_Customizer_Others_Quantity_Plus_Minus' ) ) {

    class Meni_El_Shop_Customizer_Others_Quantity_Plus_Minus {

        private static $_instance = null;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            add_filter( 'meni_el_woo_others_settings', array( $this, 'others_settings' ), 10, 1 );
            add_action( 'customize_register', array( $this, 'register' ), 15);

        }

        function others_settings( $settings ) {

            $enable_quantity_plusminus             = meni_el_customizer_settings('wdt-woo-others-enable-quantity-plusminus' );
            $settings['enable_quantity_plusminus'] = $enable_quantity_plusminus;

            return $settings;

        }

        function register( $wp_customize ) {

            /**
             * Option : Enable Quantity Plus Minus
             */

                $wp_customize->add_setting(
                    MENI_EL_CUSTOMISER_VAL . '[wdt-woo-others-enable-quantity-plusminus]', array(
                        'type' => 'option',
                        'sanitize_callback' => 'wp_filter_nohtml_kses'
                    )
                );

                $wp_customize->add_control(
                    new Meni_El_Customize_Control_Switch(
                        $wp_customize, MENI_EL_CUSTOMISER_VAL . '[wdt-woo-others-enable-quantity-plusminus]', array(
                            'type'    => 'wdt-switch',
                            'label'   => esc_html__( 'Enable Quantity Plus Minus', 'meni-el'),
                            'section' => 'woocommerce-others-section',
                            'choices' => array(
                                'on'  => esc_attr__( 'Yes', 'meni-el' ),
                                'off' => esc_attr__( 'No', 'meni-el' )
                            )
                        )
                    )
                );

        }

    }

}


if( !function_exists('meni_el_shop_customizer_others_quantity_plus_minus') ) {
	function meni_el_shop_customizer_others_quantity_plus_minus() {
		return Meni_El_Shop_Customizer_Others_Quantity_Plus_Minus::instance();
	}
}

meni_el_shop_customizer_others_quantity_plus_minus();