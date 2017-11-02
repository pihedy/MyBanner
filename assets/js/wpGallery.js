jQuery(document).ready(function($){
    var mediaUploader;
    $('#upload-button').click(function(e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },      
            multiple: false 
        });
        mediaUploader.on('select', function() {
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#myBannerImage').prepend('<img style="max-width: 100%; width: auto; height: 100px;" src="'+attachment.url+'" />');
            $('#image-url').val(attachment.url);
        });
        mediaUploader.open();
    });
});
