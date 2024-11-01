<?php
/**
 * Back to top button
 *
 * @package Salient WordPress Theme
 * @subpackage Partials
 * @version 10.5
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
$nectar_options = get_nectar_theme_options();
$salient_cta_text_01 = get_option( 'iii_salient_cta_text_01' );
$salient_cta_icon_01 = get_option( 'iii_salient_cta_icon_01' );
$salient_cta_url_01 = get_option( 'iii_salient_cta_url_01' );
$salient_cta_target_01 = get_option( 'iii_salient_cta_target_01' );
$salient_cta_text_02 = get_option( 'iii_salient_cta_text_02' );
$salient_cta_icon_02 = get_option( 'iii_salient_cta_icon_02' );
$salient_cta_url_02 = get_option( 'iii_salient_cta_url_02' );
$salient_cta_target_02 = get_option( 'iii_salient_cta_target_02' );
$salient_cta_exclude = explode( ',', trim( get_option( 'iii_salient_cta_exclude' ) ) );
// Micromodal
$salient_cta_micromodal_01 = get_option( 'iii_salient_cta_micromodal_01' );
$salient_cta_micromodal_02 = get_option( 'iii_salient_cta_micromodal_02' );
if ( $salient_cta_micromodal_01 === 'true' ) $salient_cta_href_01 = 'data-micromodal-open="modal" '; else $salient_cta_href_01 = 'href="' . $salient_cta_url_01 . '"';
if ( $salient_cta_micromodal_02 === 'true' ) $salient_cta_href_02 = 'data-micromodal-open="modal" '; else $salient_cta_href_02 = 'href="' . $salient_cta_url_02 . '"';
if ( ! is_page( $salient_cta_exclude ) ) :
    if ( ! empty( $salient_cta_text_01 ) ) : ?>
        <a <?php echo $salient_cta_href_01; ?> id="to-iii_01" class="accent-color nectar-button regular-button
        <?php if ( ! empty( $nectar_options['back-to-top-mobile'] ) && $nectar_options['back-to-top-mobile'] === '1' ) echo 'mobile-enabled'; ?>
        " data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff" target="<?php echo $salient_cta_target_01; ?>"><?php if ( ! empty( $salient_cta_icon_01 ) ) : ?><i class="fa fa-<?php echo $salient_cta_icon_01; ?>"></i><?php endif; ?><span><?php echo $salient_cta_text_01; ?></span></a>
    <?php endif;
    if ( ! empty( $salient_cta_text_02 ) ) : ?>
        <a <?php echo $salient_cta_href_02; ?> id="to-iii_02" class="extra-color-1 nectar-button regular-button
        <?php if ( ! empty( $nectar_options['back-to-top-mobile'] ) && $nectar_options['back-to-top-mobile'] === '1' ) echo 'mobile-enabled'; ?>
        " data-color-override="false" data-hover-color-override="false" data-hover-text-color-override="#fff" target="<?php echo $salient_cta_target_02; ?>"><?php if ( ! empty( $salient_cta_icon_02 ) ) : ?><i class="fa fa-<?php echo $salient_cta_icon_02; ?>"></i><?php endif; ?><span><?php echo $salient_cta_text_02; ?></span></a>
    <?php endif;
endif;
if ( ! empty( $nectar_options['back-to-top'] ) && $nectar_options['back-to-top'] === '1' ) : ?>
	<a id="to-top" class="
	<?php if ( ! empty( $nectar_options['back-to-top-mobile'] ) && $nectar_options['back-to-top-mobile'] === '1' ) echo 'mobile-enabled'; ?>
	"><i class="fa fa-angle-up"></i></a>
<?php endif;