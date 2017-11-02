jQuery(function($){
    $('.myBanner').click(function() {
        var parent = $(this).find('img');
        var attr = parent.attr('mybannerid');
        var Data = {
            action : 'myBannerAjax',
            'bannerid' : attr,
        }
        $.ajax({
            type: 'POST',
            url: ajaxObject.ajaxUrl,
            data: Data,
            success: function(event) {
                console.log('Banner ID: ' + attr);
            }
        });
    });
});
