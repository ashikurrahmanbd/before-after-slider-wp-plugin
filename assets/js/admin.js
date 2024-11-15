(function($) {

    jQuery(document).ready(function($){
        var file_frame_before;
    
        $('.before-image-upload-button').on('click', function(event){
            event.preventDefault();
    
            // If the media frame already exists, reopen it.
            if (file_frame_before) {
                file_frame_before.open();
                return;
            }
    
            // Create the media frame.
            file_frame_before = wp.media.frames.file_frame_before = wp.media({
                title: 'Select or Upload Image',
                button: {
                    text: 'Use this image',
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });
    
            // When an image is selected, run a callback.
            file_frame_before.on('select', function(){
                var attachment = file_frame_before.state().get('selection').first().toJSON();
                $('#pxls_bas_meta_box_before_image').val(attachment.url);
                $('.pxls-bas-image-wrap-before img').attr('src', attachment.url).show();
                $('.remove-image-button').show();
            });
    
            // Finally, open the modal
            file_frame_before.open();
        });
    
        $('.remove-image-button').on('click', function(event){
            event.preventDefault();
            $('#pxls_bas_meta_box_before_image').val('');
            $('.pxls-bas-image-wrap-before img').hide();
            $(this).hide();
        });
    });


})(jQuery);