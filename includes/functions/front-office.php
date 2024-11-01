<?php
// Action: login_head
add_action( 'login_head', 'iii_login_head' );
function iii_login_head() {
	wp_enqueue_style( 'iii', esc_url( plugin_dir_url( III_PLUGIN_FILE ) ) . 'assets/css/login.css' );
}

// Action: wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'iii_wp_enqueue_scripts', PHP_INT_MAX );
function iii_wp_enqueue_scripts() {
	$theme = wp_get_theme();
	if ( $theme->parent()->get( 'Name' ) == 'Salient' && $theme->get( 'Author' ) == 'Siiimple' ) :
		wp_enqueue_style( 'iii-salient', esc_url( plugin_dir_url( III_PLUGIN_FILE ) ) . 'assets/css/salient-front-office.css' );
        if ( ! empty( get_option( 'iii_salient_cta_text_01' ) ) || ! empty( get_option( 'iii_salient_cta_text_02' ) ) ) :
            wp_register_script( 'iii-salient', esc_url( plugin_dir_url( III_PLUGIN_FILE ) ) . 'assets/js/salient-iii.js', 'nectar-frontend', '', true );
            wp_enqueue_script( 'iii-salient' );
        endif;
	endif;
    if ( get_option( 'iii_micromodal' ) == 1 ) :
        wp_enqueue_style( 'micromodal', esc_url( plugin_dir_url( III_PLUGIN_FILE ) ) . 'assets/css/micromodal.css' );
        wp_register_script( 'micromodal', 'https://unpkg.com/micromodal/dist/micromodal.min.js', 'nectar-frontend', '', true );
        wp_register_script( 'iii-micromodal', esc_url( plugin_dir_url( III_PLUGIN_FILE ) ) . 'assets/js/micromodal-iii.js', 'micromodal', '', true );
        wp_enqueue_script( 'micromodal' );
        wp_enqueue_script( 'iii-micromodal' );
		if ( get_option( 'iii_automatic_modal_content' ) == 1 ) :
			wp_register_script( 'iii-micromodal-cookie', esc_url( plugin_dir_url( III_PLUGIN_FILE ) ) . 'assets/js/micromodal-cookie-iii.js', 'iii-micromodal', '', true );
			wp_enqueue_script( 'iii-micromodal-cookie' );
		endif;
    endif;
    if ( get_option( 'iii_feed_links' ) != 1 ) :
        remove_action( 'wp_head', 'feed_links', 2 );
        remove_action( 'wp_head', 'feed_links_extra', 3 );
    endif;
}

// Action: wp_body_open
add_action( 'wp_body_open', 'iii_wp_body_open' );
function iii_wp_body_open() {
    if ( get_option( 'iii_micromodal' ) == 1 ) include_once( dirname( III_PLUGIN_FILE ) . '/includes/partials/header/micromodal.php' );
}

// Action: wp_footer
add_action( 'wp_footer', 'iii_wp_footer', 999 );
function iii_wp_footer() {
	if ( ! current_user_can( 'publish_pages' ) ) :
        if ( in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && ! empty( get_option( 'iii_ga_cf7_events' ) ) ) include_once( dirname( III_PLUGIN_FILE ) . '/services/googletagmanager-contact-form-7.php' );
        if ( in_array( 'leadin/leadin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && ! empty( get_option( 'iii_ga_hs_events' ) ) ) include_once( dirname( III_PLUGIN_FILE ) . '/services/googletagmanager-leadin.php' );
    endif;
}

// Action: wp_head
add_action( 'wp_head', 'iii_wp_head', 0 );
function iii_wp_head() {
	if ( ! current_user_can( 'publish_pages' ) ) :
        if ( ! empty( get_option( 'iii_sirdata_cmp_id' ) ) ) include_once( dirname( III_PLUGIN_FILE ) . '/services/sirdata-cmp.php' );
        if ( empty ( get_option( 'iii_ga_third_party' ) ) && ! empty( get_option( 'iii_ga_tracking_id' ) ) ) include_once( dirname( III_PLUGIN_FILE ) . '/services/googletagmanager.php' );
    endif;
}

// Filter: login_headertitle
add_filter( 'login_headertitle', 'iii_login_headertitle' );
function iii_login_headertitle() {
	return get_bloginfo( 'name' ) . ' &bull; par Siiimple';
}

// Filter: login_headerurl
add_filter( 'login_headerurl', 'iii_login_headerurl' );
function iii_login_headerurl() {
	return get_bloginfo( 'url' );
}

// Filter: nav_menu_link_attributes
add_filter( 'nav_menu_link_attributes', 'iii_nav_menu_link_attributes', 10, 3 );
function iii_nav_menu_link_attributes( $atts, $item, $args ) {
    if ( ! empty( get_option( 'iii_modal_nav_menu_link' ) ) )  :
        $menu_target = get_option( 'iii_modal_nav_menu_link' );
        if ( $item->ID == $menu_target ) $atts['data-micromodal-open'] = 'modal';
    endif;
    return $atts;
}

// Filter: script_loader_tag
add_filter( 'script_loader_tag', 'iii_script_loader_tag', 10, 3 );
function iii_script_loader_tag( $tag, $handle, $src ) {
    if ( ( ! empty( get_option( 'iii_sirdata_cmp_id' ) ) ) && ( 'leadin-script-loader-js' === $handle ) ) {
        $tag = "<script type='text/javascript' data-cmp-src='" . esc_url( $src ) . "' async defer id='hs-script-loader'></script>\n";
    }
    return $tag;
}