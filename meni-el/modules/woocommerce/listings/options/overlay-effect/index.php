<?php

/**
 * Listing Options - Overlay Effect
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'Meni_El_Woo_Listing_Option_Overlay_Effect' ) ) {

    class Meni_El_Woo_Listing_Option_Overlay_Effect extends Meni_El_Woo_Listing_Option_Core {

        private static $_instance = null;

        public $option_slug;

        public $option_name;

        public $option_type;

        public $option_default_value;

        public $option_value_prefix;

        public static function instance() {

            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;

        }

        function __construct() {

            $this->option_slug          = 'product-overlay-effect';
            $this->option_name          = esc_html__('Overlay Effect', 'meni-el');
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_default_value = '';
            $this->option_value_prefix  = 'product-overlay-';

            $this->render_backend();

        }

        /*
        Backend Render
        */

            function render_backend() {

                /* Custom Product Templates - Options */
                    add_filter( 'meni_el_woo_custom_product_template_hover_options', array( $this, 'woo_custom_product_template_hover_options'), 20, 1 );

            }

        /*
        Custom Product Templates - Options
        */
            function woo_custom_product_template_hover_options( $template_options ) {

                array_push( $template_options, $this->setting_args() );

                return $template_options;

            }

        /*
        Setting Group
        */
            function setting_group() {

                return 'hover';

            }

        /*
        Setting Arguments
        */
            function setting_args() {

                $settings                                 =  array ();

                $settings['id']                           =  $this->option_slug;
                $settings['type']                         =  'select';
                $settings['title']                        =  $this->option_name;
                $settings['options']                      =  array (
                    ''                                    => esc_html__('None', 'meni-el'),
                    'product-overlay-fixed'               => esc_html__('Fixed', 'meni-el'),
                    'product-overlay-toptobottom'         => esc_html__('Top to Bottom', 'meni-el'),
                    'product-overlay-bottomtotop'         => esc_html__('Bottom to Top', 'meni-el'),
                    'product-overlay-righttoleft'         => esc_html__('Right to Left', 'meni-el'),
                    'product-overlay-lefttoright'         => esc_html__('Left to Right', 'meni-el'),
                    'product-overlay-middle'              => esc_html__('Middle', 'meni-el'),
                    'product-overlay-middleradial'        => esc_html__('Middle Radial', 'meni-el'),
                    'product-overlay-gradienttoptobottom' => esc_html__('Gradient - Top to Bottom', 'meni-el'),
                    'product-overlay-gradientbottomtotop' => esc_html__('Gradient - Bottom to Top', 'meni-el'),
                    'product-overlay-gradientrighttoleft' => esc_html__('Gradient - Right to Left', 'meni-el'),
                    'product-overlay-gradientlefttoright' => esc_html__('Gradient - Left to Right', 'meni-el'),
                    'product-overlay-gradientradial'      => esc_html__('Gradient - Radial', 'meni-el'),
                    'product-overlay-flash'               => esc_html__('Flash', 'meni-el'),
                    'product-overlay-scale'               => esc_html__('Scale', 'meni-el'),
                    'product-overlay-horizontalelastic'   => esc_html__('Horizontal - Elastic', 'meni-el'),
                    'product-overlay-verticalelastic'     => esc_html__('Vertical - Elastic', 'meni-el')
                );
                $settings['default']                      =  $this->option_default_value;

                return $settings;

            }

    }

}

if( !function_exists('meni_el_woo_listing_option_overlay_effect') ) {
	function meni_el_woo_listing_option_overlay_effect() {
		return Meni_El_Woo_Listing_Option_Overlay_Effect::instance();
	}
}

meni_el_woo_listing_option_overlay_effect();