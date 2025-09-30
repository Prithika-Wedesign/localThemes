<?php
add_action( 'meni_el_after_main_css', 'footer_style' );
function footer_style() {
    wp_enqueue_style( 'meni_el-footer', get_theme_file_uri('/modules/footer/assets/css/footer.css'), false, MENI_EL_THEME_VERSION, 'all');
}

add_action( 'meni_el_footer', 'footer_content' );
function footer_content() {
    meni_el_template_part( 'content', 'content', 'footer' );
}

add_action( 'meni_el_before_enqueue_js', 'meni_el_sticky_footer_js' );
if( !function_exists( 'meni_el_sticky_footer_js' ) ) {
    function meni_el_sticky_footer_js() {
        wp_enqueue_script('sticky-footer', get_theme_file_uri('/modules/footer/assets/js/footer.js'), array(), false, true);
    }
}