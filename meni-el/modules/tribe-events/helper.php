<?php

if( ! function_exists('meni_el_event_breadcrumb_title') ) {
    function meni_el_event_breadcrumb_title($title) {
        if( get_post_type() == 'tribe_events' && is_single()) {
            $etitle = esc_html__( 'Event Detail', 'meni-el' );
            return '<h1>'.$etitle.'</h1>';
        } else {
            return $title;
        }
    }

    add_filter( 'meni_el_breadcrumb_title', 'meni_el_event_breadcrumb_title', 20, 1 );
}

?>