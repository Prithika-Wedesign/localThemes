<?php
if ( ! function_exists( 'meni_el_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 */
	function meni_el_template_part( $module, $template, $slug = '', $params = array() ) {
		echo meni_el_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'meni_el_get_template_part' ) ) {
	/**
	 * Function that load module template part.
	 */
	function meni_el_get_template_part( $module, $template, $slug = '', $params = array() ) {

		$file_path = '';
		$html      =  '';

		$template_path = MENI_EL_MODULE_DIR . '/' . $module;
		$temp_path = $template_path . '/' . $template;

		if ( ! empty( $temp_path ) ) {
			if ( ! empty( $slug ) ) {
				$file_path = "{$temp_path}-{$slug}.php";
				if ( ! file_exists( $file_path ) ) {
					$file_path = $temp_path . '.php';
				}
			} else {
				$file_path = $temp_path . '.php';
			}
		}

		$file_path = apply_filters( 'meni_el_get_template_plugin_part', $file_path, $module, $template, $slug);

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		if ( $file_path && file_exists( $file_path ) ) {
			ob_start();
			include( $file_path );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'meni_el_get_page_id' ) ) {
	function meni_el_get_page_id() {

		$page_id = get_queried_object_id();

		if( is_archive() || is_search() || is_404() || ( is_front_page() && is_home() ) ) {
			$page_id = -1;
		}

		return $page_id;
	}
}

/* Convert hexdec color string to rgb(a) string */
if ( ! function_exists( 'meni_el_hex2rgba' ) ) {
	function meni_el_hex2rgba($color, $opacity = false) {

		$default = 'rgb(0,0,0)';

		if(empty($color)) {
			return $default;
		}

		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
				return $default;
		}

		$rgb =  array_map('hexdec', $hex);

		if($opacity){
			if(abs($opacity) > 1) {
				$opacity = 1.0;
			}
			$output = implode(",",$rgb).','.$opacity;
		} else {
			$output = implode(",",$rgb);
		}

		return $output;

	}
}

if ( ! function_exists( 'meni_el_html_output' ) ) {
	function meni_el_html_output( $html ) {
		return apply_filters( 'meni_el_html_output', $html );
	}
}


if ( ! function_exists( 'meni_el_theme_defaults' ) ) {
	/**
	 * Function to load default values
	 */
	function meni_el_theme_defaults() {

		$defaults = array (
			'primary_color' => '#7b5f43',
			'primary_color_rgb' => meni_el_hex2rgba('#7b5f43', false),
			'secondary_color' => '#050505',
			'secondary_color_rgb' => meni_el_hex2rgba('#050505', false),
			'tertiary_color' => '#705539',
			'tertiary_color_rgb' => meni_el_hex2rgba('#705539', false),
			'quaternary_color' => '#F5EFEE',
			'quaternary_color_rgb' => meni_el_hex2rgba('#F5EFEE', false),
			'body_bg_color' => '#ffffff',
			'body_bg_color_rgb' => meni_el_hex2rgba('#ffffff', false),
			'body_text_color' => '#555555',
			'body_text_color_rgb' => meni_el_hex2rgba('#555555', false),
			'headalt_color' => '#050505',
			'headalt_color_rgb' => meni_el_hex2rgba('#050505', false),
			'link_color' => '#050505',
			'link_color_rgb' => meni_el_hex2rgba('#050505', false),
			'link_hover_color' => '#7b5f43',
			'link_hover_color_rgb' => meni_el_hex2rgba('#7b5f43', false),
			'border_color' => '#ededed',
			'border_color_rgb' => meni_el_hex2rgba('#ededed', false),
			'accent_text_color' => '#ffffff',
			'accent_text_color_rgb' => meni_el_hex2rgba('#ffffff', false),

			'body_typo' => array (
				'font-family' => "Montserrat",
				'font-fallback' => '"Montserrat", sans-serif',
				'font-weight' => 500,
				'fs-desktop' => 16,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 2,
				'lh-desktop-unit' => ''
			),
			'h1_typo' => array (
				'font-family' => "Montserrat",
				'font-fallback' => '"Montserrat", sans-serif',
				'font-weight' => 500,
				'fs-desktop' => 56,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.28,
				'lh-desktop-unit' => ''
			),
			'h2_typo' => array (
				'font-family' => "Montserrat",
				'font-fallback' => '"Montserrat", sans-serif',
				'font-weight' => 500,
				'fs-desktop' => 52,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.28,
				'lh-desktop-unit' => ''
			),
			'h3_typo' => array (
				'font-family' => "Montserrat",
				'font-fallback' => '"Montserrat", sans-serif',
				'font-weight' => 500,
				'fs-desktop' => 32,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.28,
				'lh-desktop-unit' => ''
			),
			'h4_typo' => array (
				'font-family' => "Montserrat",
				'font-fallback' => '"Montserrat", sans-serif',
				'font-weight' => 500,
				'fs-desktop' => 28,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.28,
				'lh-desktop-unit' => ''
			),
			'h5_typo' => array (
				'font-family' => "Montserrat",
				'font-fallback' => '"Montserrat", sans-serif',
				'font-weight' => 500,
				'fs-desktop' => 24,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.28,
				'lh-desktop-unit' => ''
			),
			'h6_typo' => array (
				'font-family' => "Montserrat",
				'font-fallback' => '"Montserrat", sans-serif',
				'font-weight' => 500,
				'fs-desktop' => 22,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.28,
				'lh-desktop-unit' => ''
			),
			'extra_typo' => array (
				'font-family' => "Montserrat",
				'font-fallback' => '"Montserrat", sans-serif',
				'font-weight' => 500,
				'fs-desktop' => 14,
				'fs-desktop-unit' => 'px',
				'lh-desktop' => 1.28,
				'lh-desktop-unit' => ''
			),

		);

		return $defaults;

	}
}

/* Filter function to be used with number_format_i18n filter hook */
if( ! function_exists( 'meni_el_pagination_zero_prefix' ) ) {
    function meni_el_pagination_zero_prefix( $format ) {
        $number = intval( $format );
        if( intval( $number / 10 ) > 0 ) {
            return $format;
        }
        return '0' . $format;
    }
}