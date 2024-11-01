<?php
add_shortcode( 'tcf', 'iii_tcf' );
function iii_tcf() {
    $content = '';
    $site_title = get_bloginfo( 'name' );
    if ( ! current_user_can( 'publish_pages' ) ) $notice = ''; else $notice = '<br /><i>En tant qu&rsquo;administrateur/administratrice connecté·e, il est normal que le lien précédent ne fonctionne pas</i>.';
	if ( ! empty( get_option( 'iii_sirdata_cmp_id' ) ) ) $content .= '<h2>Transparency & Consent Framework</h2><p>' . $site_title . ' participe et est conforme à l&rsquo;ensemble des Spécifications et Politiques du Transparency & Consent Framework de l&rsquo;IAB Europe. ' . $site_title . ' utilise la Consent Management Platform n°92. Vous pouvez modifier vos choix à tout moment en <a href="javascript:Sddan.cmp.displayUI()">cliquant ici</a>.' . $notice;
    return $content;
}

add_shortcode( 'sirdata_cookies', 'iii_sirdata_cookies' );
function iii_sirdata_cookies() {
    $content = '';
    if ( ! empty( get_option( 'iii_sirdata_cmp_id' ) ) ) $content .= '<h3>Dépôt de cookies par Sirdata</h3><p>Sirdata est une entreprise de data marketing qui permet à ses Clients d&rsquo;adresser aux Utilisateurs des offres pertinentes adaptées à leurs centres d&rsquo;intérêt. Les Données collectées par Sirdata sont conservées pour une durée maximale de 365 jours, selon la finalité du traitement, conformément aux lois en vigueur et principe de minimisation. En savoir plus : <a href="https://www.sirdata.com/vie-privee/" target="_blank">https://www.sirdata.com/vie-privee/</a>. Vous souhaitez désactiver la collecte de vos données par Sirdata : <a href="https://www.sirdata.com/opposition/" target="_blank">https://www.sirdata.com/opposition/</a>.';
    return $content;
}