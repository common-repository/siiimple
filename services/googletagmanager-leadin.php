
<!-- HubSpot events tracking by Siiimple -->
<script>
window.addEventListener( 'message', function( event ) {
    if ( event.data.type === 'hsFormCallback' && event.data.eventName === 'onFormSubmitted' ) {
        gtag( 'event', 'generate_lead', { 'event_category': 'Prise de contact', 'event_action': 'Envoi de formulaire', 'event_label': 'Soumission du formulaire ' + event.data.id } );
        gtag( 'event', 'hubspot_submission', { 'form_id': event.data.id } );
    }
}, false );
</script>