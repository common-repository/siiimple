<?php
$cmp_id = get_option( 'iii_sirdata_cmp_id' );
if ( ! empty( $cmp_id ) ) : $src_attribute = 'data-cmp-src'; else : $src_attribute = 'src'; endif;
$tracking_id = get_option( 'iii_ga_tracking_id' );
if ( get_option( 'iii_ga_linker_domains' ) ) : $host = explode( '.', $_SERVER['HTTP_HOST'] ); $linker_domains = $host[count( $host )-2] . '.' . $host[count( $host )-1]; else : $linker_domains = ''; endif;
?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async <?php echo $src_attribute; ?>="https://www.googletagmanager.com/gtag/js?id=<?php echo $tracking_id; ?>"></script>
<script>   
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '<?php echo $tracking_id; ?>', {
        'linker': {
            'domains': ['<?php echo $linker_domains; ?>']
        }
    });
</script>