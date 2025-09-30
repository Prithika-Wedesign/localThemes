<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( !class_exists( 'Meni_El_Shop_Metabox_Single_Upsell_Related' ) ) {
    class Meni_El_Shop_Metabox_Single_Upsell_Related {

        private static $_instance = null;

        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        function __construct() {

			add_filter( 'meni_el_shop_product_custom_settings', array( $this, 'meni_el_shop_product_custom_settings' ), 10 );

		}

        function meni_el_shop_product_custom_settings( $options ) {

			$ct_dependency      = array ();
			$upsell_dependency  = array ( 'show-upsell', '==', 'true');
			$related_dependency = array ( 'show-related', '==', 'true');
			if( function_exists('meni_el_shop_single_module_custom_template') ) {
				$ct_dependency['dependency'] 	= array ( 'product-template', '!=', 'custom-template');
				$upsell_dependency 				= array ( 'product-template|show-upsell', '!=|==', 'custom-template|true');
				$related_dependency 			= array ( 'product-template|show-related', '!=|==', 'custom-template|true');
			}

			$product_options = array (

				array_merge (
					array(
						'id'         => 'show-upsell',
						'type'       => 'select',
						'title'      => esc_html__('Show Upsell Products', 'meni-el'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-upsell' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'meni-el' ),
							'true'         => esc_html__( 'Show', 'meni-el'),
							null           => esc_html__( 'Hide', 'meni-el'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'upsell-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Column', 'meni-el'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'meni-el' ),
						1              => esc_html__( 'One Column', 'meni-el' ),
						2              => esc_html__( 'Two Columns', 'meni-el' ),
						3              => esc_html__( 'Three Columns', 'meni-el' ),
						4              => esc_html__( 'Four Columns', 'meni-el' ),
					),
					'dependency' => $upsell_dependency
				),

				array(
					'id'         => 'upsell-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Upsell Limit', 'meni-el'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'meni-el' ),
						1              => esc_html__( 'One', 'meni-el' ),
						2              => esc_html__( 'Two', 'meni-el' ),
						3              => esc_html__( 'Three', 'meni-el' ),
						4              => esc_html__( 'Four', 'meni-el' ),
						5              => esc_html__( 'Five', 'meni-el' ),
						6              => esc_html__( 'Six', 'meni-el' ),
						7              => esc_html__( 'Seven', 'meni-el' ),
						8              => esc_html__( 'Eight', 'meni-el' ),
						9              => esc_html__( 'Nine', 'meni-el' ),
						10              => esc_html__( 'Ten', 'meni-el' ),
					),
					'dependency' => $upsell_dependency
				),

				array_merge (
					array(
						'id'         => 'show-related',
						'type'       => 'select',
						'title'      => esc_html__('Show Related Products', 'meni-el'),
						'class'      => 'chosen',
						'default'    => 'admin-option',
						'attributes' => array( 'data-depend-id' => 'show-related' ),
						'options'    => array(
							'admin-option' => esc_html__( 'Admin Option', 'meni-el' ),
							'true'         => esc_html__( 'Show', 'meni-el'),
							null           => esc_html__( 'Hide', 'meni-el'),
						)
					),
					$ct_dependency
				),

				array(
					'id'         => 'related-column',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Column', 'meni-el'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'meni-el' ),
						2              => esc_html__( 'Two Columns', 'meni-el' ),
						3              => esc_html__( 'Three Columns', 'meni-el' ),
						4              => esc_html__( 'Four Columns', 'meni-el' ),
					),
					'dependency' => $related_dependency
				),

				array(
					'id'         => 'related-limit',
					'type'       => 'select',
					'title'      => esc_html__('Choose Related Limit', 'meni-el'),
					'class'      => 'chosen',
					'default'    => 4,
					'options'    => array(
						'admin-option' => esc_html__( 'Admin Option', 'meni-el' ),
						1              => esc_html__( 'One', 'meni-el' ),
						2              => esc_html__( 'Two', 'meni-el' ),
						3              => esc_html__( 'Three', 'meni-el' ),
						4              => esc_html__( 'Four', 'meni-el' ),
						5              => esc_html__( 'Five', 'meni-el' ),
						6              => esc_html__( 'Six', 'meni-el' ),
						7              => esc_html__( 'Seven', 'meni-el' ),
						8              => esc_html__( 'Eight', 'meni-el' ),
						9              => esc_html__( 'Nine', 'meni-el' ),
						10              => esc_html__( 'Ten', 'meni-el' ),
					),
					'dependency' => $related_dependency
				)

			);

			$options = array_merge( $options, $product_options );

			return $options;

		}

    }
}

Meni_El_Shop_Metabox_Single_Upsell_Related::instance();