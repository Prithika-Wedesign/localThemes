<?php

/**
 * Listing Options - Hover Style
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'Meni_El_Woo_Listing_Option_Hover_Style' ) ) {

    class Meni_El_Woo_Listing_Option_Hover_Style extends Meni_El_Woo_Listing_Option_Core {

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

            $this->option_slug          = 'product-hover-style';
            $this->option_name          = esc_html__('Hover Style', 'meni-el');
            $this->option_type          = array ( 'class', 'value-css' );
            $this->option_default_value = 'product-hover-fade-border';
            $this->option_value_prefix  = 'product-hover-';

            $this->render_backend();

        }

        /*
        Backend Render
        */
        function render_backend() {
            add_filter( 'meni_el_woo_custom_product_template_hover_options', array( $this, 'woo_custom_product_template_hover_options'), 5, 1 );
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

            $settings                                     =  array ();

            $settings['id']                               =  $this->option_slug;
            $settings['type']                             =  'select';
            $settings['title']                            =  $this->option_name;
            $settings['options']                          =  array (
                ''                                        => esc_html__('None', 'meni-el'),
                'product-hover-fade-border'               => esc_html__('Fade - Border', 'meni-el'),
                'product-hover-fade-skinborder'           => esc_html__('Fade - Skin Border', 'meni-el'),
                'product-hover-fade-gradientborder'       => esc_html__('Fade - Gradient Border', 'meni-el'),
                'product-hover-fade-shadow'               => esc_html__('Fade - Shadow', 'meni-el'),
                'product-hover-fade-inshadow'             => esc_html__('Fade - InShadow', 'meni-el'),
                'product-hover-thumb-fade-border'         => esc_html__('Fade Thumb Border', 'meni-el'),
                'product-hover-thumb-fade-skinborder'     => esc_html__('Fade Thumb SkinBorder', 'meni-el'),
                'product-hover-thumb-fade-gradientborder' => esc_html__('Fade Thumb Gradient Border', 'meni-el'),
                'product-hover-thumb-fade-shadow'         => esc_html__('Fade Thumb Shadow', 'meni-el'),
                'product-hover-thumb-fade-inshadow'       => esc_html__('Fade Thumb InShadow', 'meni-el')
            );
            $settings['default']                          =  $this->option_default_value;

            return $settings;

        }

    }

}

if( !function_exists('meni_el_woo_listing_option_hover_style') ) {
	function meni_el_woo_listing_option_hover_style() {
		return Meni_El_Woo_Listing_Option_Hover_Style::instance();
	}
}

meni_el_woo_listing_option_hover_style();