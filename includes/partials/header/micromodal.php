<?php
$modal_title = get_option( 'iii_modal_title' );
$modal_content = get_option( 'iii_modal_content' );
?>
<div class="modal micromodal-slide" id="modal" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
            <header class="modal__header">
                <h2 class="modal__title" id="modal-1-title"><?php echo $modal_title; ?></h2>
                <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
            </header>
            <main class="modal__content" id="modal-1-content">
                <?php echo do_shortcode( $modal_content ); ?>
            </main>
        </div>
    </div>
</div>