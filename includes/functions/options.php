<?php
add_action( 'admin_menu', 'iii_admin_menu' );
function iii_admin_menu() {
	if ( class_exists( 'woocommerce' ) ) : $capability = 'manage_woocommerce'; else : $capability = 'publish_pages'; endif;
	add_action( 'admin_init', 'iii_register_options' );
	add_menu_page( 'Personnalisation Siiimple et services tiers', 'Siiimple', $capability, 'siiimple', 'iii_options', 'dashicons-chart-area', 999 );
}

function iii_options() {
    $current_user = wp_get_current_user();
	$current_user_name = $current_user->user_login;
    $theme = wp_get_theme(); ?>
    <div class="wrap">
		<h1 class="wp-heading-inline">Personnalisation Siiimple et services tiers</h1>
		<form method="post" action="options.php">
			<?php settings_fields( 'iii-options' ); ?>
			<?php do_settings_sections( 'iii-options' ); ?>
			<?php if ( ! current_user_can( 'administrator' ) ) : $disabled = 'disabled="disabled"'; $readonly = 'readonly'; else : $disabled = $readonly = ''; endif; ?>
            <h2 class="wp-heading-inline">Librairies additionnelles</h2>
            <table class="form-table">
                <tr valign="top">
                    <?php $micromodal = get_option( 'iii_micromodal' ); ?>
					<th scope="row">Librairie Micromodal.js</th>
					<td><input type="checkbox" id="iii_micromodal" name="iii_micromodal" value="1" <?php checked( 1, get_option( 'iii_micromodal' ), true); ?> /></td>
				</tr>
            </table>
            <hr />
			<?php if ( class_exists( 'woocommerce' ) ) : ?>
				<h2 class="wp-heading-inline">Catalogue de produits</h2>
				<table class="form-table">
					<tr valign="top">
						<?php $gs_products_database = get_option( 'iii_gs_products_database' ); ?>
						<th scope="row">Google Sheets</th>
						<td><input type="text" id="iii_gs_products_database" name="iii_gs_products_database" value="<?php echo esc_url( $gs_products_database ); ?>" <?php echo $readonly; ?> /> <a class="button button-secondary" href="<?php echo esc_url( $gs_products_database ); ?>" target="_blank">Ouvrir</a></td>
					</tr>
				</table>
                <hr />
			<?php endif; ?>
            <?php if ( $theme->parent()->get( 'Name' ) == 'Salient' && $theme->get( 'Author' ) == 'Siiimple' ) : ?>
                <h2 class="wp-heading-inline">Boutons flottants</h2>
                <table class="form-table">
                    <p>Pour pointer vers une section intra-page, utiliser <i>#iii_01</i> et <i>#iii_02</i> comme URL de destination puis <i>iii_01</i> et <i>iii_02</i> comme attribut universel <i>id</i> permet un défilement fluide.</p>
                    <tr valign="top">
                        <?php $salient_cta_text_01 = get_option( 'iii_salient_cta_text_01' ); ?>
                        <th scope="row">Ancre du bouton #1</th>
                        <td><input type="text" id="iii_salient_cta_text_01" name="iii_salient_cta_text_01" value="<?php echo $salient_cta_text_01; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <?php $salient_cta_icon_01 = get_option( 'iii_salient_cta_icon_01' ); ?>
                        <th scope="row">Icône - ex. : <i>phone</i> -</th>
                        <td><input type="text" id="iii_salient_cta_icon_01" name="iii_salient_cta_icon_01" value="<?php echo $salient_cta_icon_01; ?>" /> <a class="button button-secondary" href="https://fontawesome.com/v5.15/icons" target="_blank">Catalogue Font Awesome</a></td>
                    </tr>
                    <tr valign="top">
                        <?php $salient_cta_url_01 = get_option( 'iii_salient_cta_url_01' ); ?>
                        <th scope="row">URL de destination</th>
                        <td><input type="text" id="iii_salient_cta_url_01" name="iii_salient_cta_url_01" value="<?php echo $salient_cta_url_01; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Ouvrir dans un nouvel onglet</th>
                        <td><input type="checkbox" id="iii_salient_cta_target_01" name="iii_salient_cta_target_01" value="_blank" <?php checked( '_blank', get_option( 'iii_salient_cta_target_01' ), true); ?> /></td>
                    </tr>
                    <?php if ( $micromodal == 1 ) : ?>
                        <tr valign="top">
                            <th scope="row">Fenêtre modale</th>
                            <td><input type="checkbox" id="iii_salient_cta_micromodal_01" name="iii_salient_cta_micromodal_01" value="true" <?php checked( 'true', get_option( 'iii_salient_cta_micromodal_01' ), true); ?> /></td>
                        </tr>
                    <?php endif; ?>
                    <tr class="bordered" valign="top">
                        <?php $salient_cta_text_02 = get_option( 'iii_salient_cta_text_02' ); ?>
                        <th scope="row">Ancre du bouton #2</th>
                        <td><input type="text" id="iii_salient_cta_text_02" name="iii_salient_cta_text_02" value="<?php echo $salient_cta_text_02; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <?php $salient_cta_icon_02 = get_option( 'iii_salient_cta_icon_02' ); ?>
                        <th scope="row">Icône - ex. : <i>pencil</i> -</th>
                        <td><input type="text" id="iii_salient_cta_icon_02" name="iii_salient_cta_icon_02" value="<?php echo $salient_cta_icon_02; ?>" /> <a class="button button-secondary" href="https://fontawesome.com/v5.15/icons" target="_blank">Catalogue Font Awesome</a></td>
                    </tr>
                    <tr valign="top">
                        <?php $salient_cta_url_02 = get_option( 'iii_salient_cta_url_02' ); ?>
                        <th scope="row">URL de destination</th>
                        <td><input type="text" id="iii_salient_cta_url_02" name="iii_salient_cta_url_02" value="<?php echo $salient_cta_url_02; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Ouvrir dans un nouvel onglet</th>
                        <td><input type="checkbox" id="iii_salient_cta_target_02" name="iii_salient_cta_target_02" value="_blank" <?php checked( '_blank', get_option( 'iii_salient_cta_target_02' ), true); ?> /></td>
                    </tr>
                    <?php if ( $micromodal == 1 ) : ?>
                        <tr valign="top">
                            <th scope="row">Fenêtre modale</th>
                            <td><input type="checkbox" id="iii_salient_cta_micromodal_02" name="iii_salient_cta_micromodal_02" value="true" <?php checked( 'true', get_option( 'iii_salient_cta_micromodal_02' ), true); ?> /></td>
                        </tr>
                    <?php endif; ?>
                    <tr class="bordered" valign="top">
                        <?php $salient_cta_exclude = get_option( 'iii_salient_cta_exclude' ); ?>
                        <th scope="row">ID ou slugs des pages exclues</th>
                        <td><input type="text" id="iii_salient_cta_exclude" name="iii_salient_cta_exclude" value="<?php echo $salient_cta_exclude; ?>" /></td>
                    </tr>
                </table>
                <hr />
            <?php endif; ?>
            <?php if ( $micromodal == 1 ) : ?>
                <h2 class="wp-heading-inline">Fenêtre contextuelle</h2>
                <table class="form-table">
                    <p>Définir l'attribut <i>data-micromodal-open="modal"</i> sur un élément HTML, tel qu'un bouton ou un lien, permet d'afficher la fenêtre modale.</p>
                    <tr valign="top">
                        <?php $modal_title = get_option( 'iii_modal_title' ); ?>
                        <th scope="row">Titre</th>
                        <td><input type="text" id="iii_modal_title" name="iii_modal_title" value="<?php echo $modal_title; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <?php $modal_content = get_option( 'iii_modal_content' ); ?>
                        <th scope="row">Contenu</th>
                        <td><input type="text" id="iii_modal_content" name="iii_modal_content" value="<?php echo esc_html( $modal_content ); ?>" /></td>
                    </tr>
					<tr valign="top">
						<?php $micromodal = get_option( 'iii_automatic_modal_content' ); ?>
						<th scope="row">Déclenchement automatique</th>
						<td><input type="checkbox" id="iii_automatic_modal_content" name="iii_automatic_modal_content" value="1" <?php checked( 1, get_option( 'iii_automatic_modal_content' ), true); ?> /></td>
					</tr>
                </table>
                <hr />
            <?php endif; ?>
            <h2 class="wp-heading-inline">Maximalisation</h2>
			<table class="form-table">
                <tr valign="top">
					<?php $feed_links = get_option( 'iii_feed_links' ); ?>
					<th scope="row">Flux RSS dans l'en-tête</th>
					<td><input type="checkbox" id="iii_feed_links" name="iii_feed_links" value="1" <?php checked( 1, get_option( 'iii_feed_links' ), true); ?> /></td>
				</tr>
			</table>
            <hr />
            <?php if ( $micromodal == 1 ) : ?>
                <h2 class="wp-heading-inline">Navigation modale</h2>
                <table class="form-table">
                    <tr valign="top">
                        <?php $modal_nav_menu_link = get_option( 'iii_modal_nav_menu_link' ); ?>
                        <th scope="row">ID de menu</th>
                        <td><input type="text" id="iii_modal_nav_menu_link" name="iii_modal_nav_menu_link" value="<?php echo $modal_nav_menu_link; ?>" /></td>
                    </tr>
                </table>
                <hr />
            <?php endif; ?>
			<h2 class="wp-heading-inline">Règlement Général sur la Protection des Données</h2>
			<table class="form-table">
                <tr valign="top">
					<?php $cmp_id = get_option( 'iii_sirdata_cmp_id' ); ?>
					<th scope="row">ID de CMP Sirdata</th>
					<td><input type="text" id="iii_sirdata_cmp_id" name="iii_sirdata_cmp_id" value="<?php echo $cmp_id; ?>" <?php echo $readonly; ?> /> <?php if ( ( $current_user_name == 'francoisdubois' ) || ( $current_user_name == 'marcdubois' ) || ( $current_user_name == 'segolenemochon' ) ) : ?><a class="button button-secondary" href="https://cmp.sirdata.io/cmp" target="_blank">Ouvrir</a><?php endif; ?></td>
				</tr>
			</table>
            <hr />
			<h2 class="wp-heading-inline">Suivi et analyse d'audience</h2>
			<table class="form-table">
				<tr valign="top">
					<?php $ga_third_party = get_option( 'iii_ga_third_party' ); ?>
					<th scope="row">Configuration GA tierce</th>
					<td><input type="checkbox" id="iii_ga_third_party" name="iii_ga_third_party" value="1" <?php checked( 1, get_option( 'iii_ga_third_party' ), true); ?> <?php echo $disabled; ?> /></td>
				</tr>
                <?php if ( empty( $ga_third_party ) ) : ?>
                    <tr valign="top">
                        <?php $tracking_id = get_option( 'iii_ga_tracking_id' ); ?>
                        <th scope="row">ID de suivi GA</th>
                        <td><input type="text" id="iii_ga_tracking_id" name="iii_ga_tracking_id" value="<?php echo $tracking_id; ?>" <?php echo $readonly; ?> /> <a class="button button-secondary" href=" https://analytics.google.com/analytics/web/" target="_blank">Ouvrir</a></td>
                    </tr>
                    <tr valign="top">
                        <?php $linker_domains = get_option( 'iii_ga_linker_domains' ); ?>
                        <th scope="row">Suivi multi-domaines</th>
                        <td><input type="checkbox" id="iii_ga_linker_domains" name="iii_ga_linker_domains" value="1" <?php checked( 1, get_option( 'iii_ga_linker_domains' ), true); ?> <?php echo $disabled; ?> /></td>
                    </tr>
                <?php endif; ?>
				<?php if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) : ?>
					<tr valign="top">
						<th scope="row">Événements CF7</th>
						<td><input type="checkbox" id="iii_ga_cf7_events" name="iii_ga_cf7_events" value="1" <?php checked( 1, get_option( 'iii_ga_cf7_events' ), true); ?> <?php echo $disabled; ?> /></td>
					</tr>
				<?php endif; ?>
                <?php if ( is_plugin_active( 'leadin/leadin.php' ) ) : ?>
					<tr valign="top">
						<th scope="row">Événements HubSpot</th>
						<td><input type="checkbox" id="iii_ga_hs_events" name="iii_ga_hs_events" value="1" <?php checked( 1, get_option( 'iii_ga_hs_events' ), true); ?> <?php echo $disabled; ?> /></td>
					</tr>
				<?php endif; ?>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php }

add_filter( 'option_page_capability_iii-options', 'iii_options_capability' );
function iii_options_capability( $capability ) {
    if ( class_exists( 'woocommerce' ) ) : $capability = 'manage_woocommerce'; else : $capability = 'publish_pages'; endif;
	return $capability;
}

function iii_register_options() {
	register_setting( 'iii-options', 'iii_micromodal' );
    register_setting( 'iii-options', 'iii_gs_products_database' );
	register_setting( 'iii-options', 'iii_salient_cta_text_01' );
    register_setting( 'iii-options', 'iii_salient_cta_icon_01' );
    register_setting( 'iii-options', 'iii_salient_cta_url_01' );
    register_setting( 'iii-options', 'iii_salient_cta_target_01' );
    register_setting( 'iii-options', 'iii_salient_cta_micromodal_01' );
    register_setting( 'iii-options', 'iii_salient_cta_text_02' );
    register_setting( 'iii-options', 'iii_salient_cta_icon_02' );
    register_setting( 'iii-options', 'iii_salient_cta_url_02' );
    register_setting( 'iii-options', 'iii_salient_cta_target_02' );
    register_setting( 'iii-options', 'iii_salient_cta_micromodal_02' );
    register_setting( 'iii-options', 'iii_salient_cta_exclude' );
    register_setting( 'iii-options', 'iii_modal_title' );
    register_setting( 'iii-options', 'iii_modal_content' );
	register_setting( 'iii-options', 'iii_automatic_modal_content' );
    register_setting( 'iii-options', 'iii_feed_links' );
    register_setting( 'iii-options', 'iii_modal_nav_menu_link' );
    register_setting( 'iii-options', 'iii_sirdata_cmp_id' );
    register_setting( 'iii-options', 'iii_ga_third_party' );
	register_setting( 'iii-options', 'iii_ga_tracking_id' );
    register_setting( 'iii-options', 'iii_ga_linker_domains' );
	register_setting( 'iii-options', 'iii_ga_cf7_events' );
    register_setting( 'iii-options', 'iii_ga_hs_events' );
}