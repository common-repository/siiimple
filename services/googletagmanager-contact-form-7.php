
<!-- CF7 events tracking by Siiimple -->
<script>
document.addEventListener( 'wpcf7mailsent', function( event ) {
    gtag( 'event', 'generate_lead', { 'event_category': 'Prise de contact', 'event_action': 'Envoi de formulaire', 'event_label': 'Soumission de formulaire de contact' } );
    gtag( 'event', 'wpcf7_submission', { 'form_id': event.detail.contactFormId, 'post_id': event.detail.containerPostId } );
}, false );
</script>