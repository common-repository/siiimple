<?php
/*
Plugin Name:	Siiimple
Plugin URI:		https://www.siiimple.fr
Description:	Personnalisation clé-en-main et ressources Siiimple.
Version:		3.1.2
Author:			Siiimple
Author URI:		https://www.siiimple.fr
License:		GPLv3
License URI:	https://www.gnu.org/licenses/gpl-3.0.html
Text Domain:	siiimple
Domain Path:	/languages

Siiimple Plugin
Copyright 2019, Siiimple - contact@siiimple.fr

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
if ( ! function_exists( 'add_filter' ) ) : header( 'Status: 403 Forbidden' ); header( 'HTTP/1.1 403 Forbidden' ); exit(); endif;
if ( ! defined( 'III_PLUGIN_FILE' ) ) : define( 'III_PLUGIN_FILE', __FILE__ ); endif;
require_once( dirname( III_PLUGIN_FILE ) . '/includes/init.php' );

add_action( 'upgrader_process_complete', 'iii_upgrader_process_complete', 10, 2 );
function iii_upgrader_process_complete( $upgrader_object, $options ) {
    $siiimple = plugin_basename( __FILE__ );
    if ( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) :
        foreach ( $options['plugins'] as $plugin ) :
            if ( $plugin == $siiimple ) set_transient( 'iii_siiimple_updated', 1 );
        endforeach;
    endif;
}

add_action( 'admin_notices', 'iii_admin_update_notices' );
function iii_admin_update_notices() {
    $theme = wp_get_theme();
    $plugin_back_to_top = dirname( III_PLUGIN_FILE ) . '/includes/partials/footer/back-to-top.php';
    $theme_back_to_top = get_stylesheet_directory() . '/includes/partials/footer/back-to-top.php';
    $plugin_nectar_btn = dirname( III_PLUGIN_FILE ) . '/includes/vc_templates/nectar_btn.php';
    $theme_nectar_btn = get_stylesheet_directory() . '/vc_templates/nectar_btn.php';
    $plugin_nectar_cta = dirname( III_PLUGIN_FILE ) . '/includes/vc_templates/nectar_cta.php';
    $theme_nectar_cta = get_stylesheet_directory() . '/vc_templates/nectar_cta.php';
    if ( get_transient( 'iii_siiimple_activated' ) && $theme->parent()->get( 'Name' ) == 'Salient' && $theme->get( 'Author' ) == 'Siiimple' ) :
        wp_mkdir_p( get_stylesheet_directory() . '/includes/partials/footer' );
        wp_mkdir_p( get_stylesheet_directory() . '/vc_templates' );
        copy( $plugin_back_to_top, $theme_back_to_top );
        copy( $plugin_nectar_btn, $theme_nectar_btn );
        copy( $plugin_nectar_cta, $theme_nectar_cta );
        echo '<div class="updated notice"><p>' . __( 'L&rsquo;activation de Siiimple a écrasé les fichiers /includes/partials/footer/back-to-top.php, /vc_templates/nectar_btn.php et /vc_templates/nectar_cta.php du thème enfant.', 'siiimple' ) . '</p></div>';
        delete_transient( 'iii_siiimple_activated' );
    endif;
    if ( get_transient( 'iii_siiimple_updated' ) && $theme->parent()->get( 'Name' ) == 'Salient' && $theme->get( 'Author' ) == 'Siiimple' ) :
        wp_mkdir_p( get_stylesheet_directory() . '/includes/partials/footer' );
        wp_mkdir_p( get_stylesheet_directory() . '/vc_templates' );
        copy( $plugin_back_to_top, $theme_back_to_top );
        copy( $plugin_nectar_btn, $theme_nectar_btn );
        copy( $plugin_nectar_cta, $theme_nectar_cta );
        echo '<div class="updated notice"><p>' . __( 'La mise à jour de Siiimple a écrasé le fichier /includes/partials/footer/back-to-top.php, /vc_templates/nectar_btn.php et /vc_templates/nectar_cta.php du thème enfant.', 'siiimple' ) . '</p></div>';
        delete_transient( 'iii_siiimple_updated' );
    endif;
}

register_activation_hook( __FILE__, 'iii_register_activation_hook' );
function iii_register_activation_hook() {
    set_transient( 'iii_siiimple_activated', 1 );
}