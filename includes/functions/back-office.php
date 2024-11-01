<?php
// Action: admin_bar_menu
add_action( 'admin_bar_menu', 'iii_admin_bar_menu', 500 );
function iii_admin_bar_menu( WP_Admin_Bar $admin_bar ) {
    $current_user = wp_get_current_user();
	$current_user_name = $current_user->user_login;
    if ( ( $current_user_name != 'francoisdubois' ) && ( $current_user_name != 'marcdubois' ) && ( $current_user_name != 'segolenemochon' ) ) :
        return;
    endif;
    $admin_bar->add_menu( array(
        'id'        => 'notiiion',
        'parent'    => null,
        'group'     => null,
        'title'     => 'Notiiion',
        'href'      => 'https://www.notion.so/siiimple/8fb3a1c2986b4dc7963f757cf687599d?v=aed4c0b64f054ae09cee054d4e69f960',
        'meta'      => [
            'title'     => __( 'FAQ Siiimple', 'siiimple' ),
            'target'    => '_blank'
        ]
    ) );
}

// Action: admin_enqueue_scripts
add_action( 'admin_enqueue_scripts', 'iii_admin_enqueue_scripts' );
function iii_admin_enqueue_scripts() {
	wp_register_style( 'iii_back_office', esc_url( plugin_dir_url( III_PLUGIN_FILE ) ) . 'assets/css/back-office.css' );
	wp_enqueue_style( 'iii_back_office' );
}

// Action: admin_head
add_action( 'admin_head', 'iii_admin_head', 1 );
function iii_admin_head() {
	$current_user = wp_get_current_user();
	$current_user_name = $current_user->user_login;
    if ( ( $current_user_name != 'francoisdubois' ) && ( $current_user_name != 'marcdubois' ) && ( $current_user_name != 'segolenemochon' ) ) :
		add_filter( 'pre_option_update_core', '__return_null' );
		add_filter( 'pre_site_transient_update_core', '__return_null' );
		add_filter( 'pre_site_transient_update_plugins', '__return_null' );
		remove_action( 'load-update-core.php', 'wp_update_plugins' );
        remove_action( 'admin_notices', 'update_nag', 3);
		remove_submenu_page( 'index.php', 'update-core.php' );
		remove_menu_page( 'edit.php?post_type=blocks' );
		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'vc-welcome' );
		if ( ! current_user_can( 'manage_options' ) ) :
			remove_menu_page( 'edit-comments.php' );
			remove_menu_page( 'tools.php' );
			remove_menu_page( 'wpcf7' );
		endif;
	endif;
}

// Action: admin_footer_text
add_filter( 'admin_footer_text', 'iii_admin_footer_text' );
function iii_admin_footer_text() {
	echo _e( 'Merci de faire confiance à Siiimple pour développer votre activité.', 'siiimple' );
}

// Action: admin_notices
add_action( 'admin_notices', 'iii_admin_notices' );
function iii_admin_notices() {
	$current_user = wp_get_current_user();
	$current_user_name = $current_user->user_login;
	$screen = get_current_screen();
	$blog_public = get_option( 'blog_public' );
    $ga_third_party = get_option( 'iii_ga_third_party' );
	$tracking_id = get_option( 'iii_ga_tracking_id' );
    if ( ( $current_user_name == 'francoisdubois' ) || ( $current_user_name == 'marcdubois' ) || ( $current_user_name == 'segolenemochon' ) ) :
		if ( $blog_public == 1 ) : ?>
			<?php if ( empty( $ga_third_party ) && empty( $tracking_id ) ) : ?>
				<div class="notice notice-error is-dismissible">
					<p><strong><?php _e( bloginfo( 'name' ) . ' ' . 'est visible pour les moteurs de recherche mais l&rsquo;ID de suivi GA n&rsquo;est pas configuré.', 'siiimple' ) ?></strong><?php if ( $screen->id !== 'toplevel_page_siiimple' ) : _e( ' <a href="' . home_url() . '/wp-admin/admin.php?page=siiimple">Ajouter un ID de suivi GA</a>.', 'siiimple' ); endif; ?></p>
				</div>
            <?php elseif ( ! empty( $ga_third_party ) ) : ?>
                <div class="notice notice-warning is-dismissible">
                    <p><strong><?php _e( bloginfo( 'name' ) . ' ' . 'est visible pour les moteurs de recherche et dispose d&rsquo;un ID de suivi GA intégré par un tiers.', 'siiimple' ) ?></strong></p>
                </div>
			<?php endif; ?>
		<?php else : ?>
			<div class="notice notice-warning is-dismissible">
				<p><strong><?php _e( bloginfo( 'name' ) . ' ' . 'n&rsquo;est pas visible pour les moteurs de recherche.', 'siiimple' ) ?></strong></p>
			</div>
		<?php endif;
	endif;
    if ( $screen->id !== 'toplevel_page_siiimple' ) return;
    if ( isset( $_GET['settings-updated'] ) ) :
		if ( 'true' === $_GET['settings-updated'] ) : ?>
			<div class="notice notice-success is-dismissible">
				<p><strong><?php _e( 'Réglages enregistrés.', 'siiimple' ) ?></strong></p>
            </div>
        <?php else : ?>
            <div class="notice notice-error is-dismissible">
                <p><?php _e( 'Erreur lors de l&rsquo;enregistrement des réglages.', 'siiimple' ) ?></p>
			</div>
        <?php endif;
    endif;
}

// Action: user_register
add_action( 'user_register', 'iii_user_register' );
function iii_user_register( $user_id ) {
    $args = array( 'ID' => $user_id, 'admin_color' => 'midnight' );
    wp_update_user( $args );
}

// Action: wp_before_admin_bar_render
add_action( 'wp_before_admin_bar_render', 'iii_wp_before_admin_bar_render' );
function iii_wp_before_admin_bar_render() {  
    global $wp_admin_bar;
	$wp_admin_bar->remove_menu( 'comments' ); 
    $wp_admin_bar->remove_menu( 'new-content' );
	$wp_admin_bar->remove_menu( 'wp-logo' );
	if ( in_array( 'wordpress-seo/wp-seo.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) : $wp_admin_bar->remove_menu( 'wpseo-menu' ); endif;
}  

// Action: wp_dashboard_setup
add_action( 'wp_dashboard_setup', 'iii_wp_dashboard_setup', 999 );
remove_action( 'welcome_panel', 'wp_welcome_panel' );
function iii_wp_dashboard_setup() {
	global $wp_meta_boxes;
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
	unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] );
	unset( $wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget'] );
	wp_add_dashboard_widget( 'iii_wp_dashboard_widget', 'Service client Siiimple', 'iii_dashboard_customer_support');
}

// Filter: auto_update_plugin
add_filter( 'auto_update_plugin', 'iii_auto_update_plugin', 10, 2 );
function iii_auto_update_plugin ( $update, $item ) {
	$plugins = array ( 'woocommerce' );
	if ( in_array( $item->slug, $plugins ) ) :
		return false;
	else :
		return $update; 
	endif;
}

// Dashboard customer support
function iii_dashboard_customer_support() {
	echo '<p>Un problème ? Une question ? Vous pouvez nous contacter directement du lundi au vendredi, de 9h30 à 18h00.</p><ul><li>François Dubois au <span class="dashicons dashicons-smartphone"></span> <a href="' . esc_url( 'tel:0624099696' ) . '">06 24 09 96 96</a></li><li>Ségolène Mochon au <span class="dashicons dashicons-smartphone"></span> <a href="' . esc_url( 'tel:0669907351' ) . '">06 69 90 73 51</a></li></ul>';
}

// Micromodal trigger for nectar_btn
$theme = wp_get_theme();
if ( function_exists( 'vc_add_param' ) && $theme->parent()->get( 'Name' ) == 'Salient' && $theme->get( 'Author' ) == 'Siiimple' ) :
    $attributes = array(
        'type'			=> 'checkbox',
        'heading'		=> __( 'Déclencheur de la fenêtre contextuelle', 'siiimple' ),
        'param_name'	=> 'micromodal',
        'save_always'	=> true,
    );
    vc_add_param( 'nectar_btn', $attributes );
endif;

// Micromodal trigger for nectar_cta
$theme = wp_get_theme();
if ( function_exists( 'vc_add_param' ) && $theme->parent()->get( 'Name' ) == 'Salient' && $theme->get( 'Author' ) == 'Siiimple' ) :
    $attributes = array(
        'type'			=> 'checkbox',
        'heading'		=> __( 'Déclencheur de la fenêtre contextuelle', 'siiimple' ),
        'param_name'	=> 'micromodal',
        'save_always'	=> true,
    );
    vc_add_param( 'nectar_cta', $attributes );
endif;