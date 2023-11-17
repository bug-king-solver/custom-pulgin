jQuery(document).ready(function($) {
    $('#custom-highlighter-save').on('click', function() {
        var text = $('#custom-highlighter-text').val();

        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'custom_highlighter_save',
                text: text,
            },
            success: function(response) {
                // Check if the response is successful
                if (response.success) {
                    // Display a success notice
                    $('.wrap').prepend('<div class="notice notice-success is-dismissible"><p>Text saved successfully!</p></div>');
                } else {
                    // Display an error notice
                    $('.wrap').prepend('<div class="notice notice-error is-dismissible"><p>Error saving text. Please try again.</p></div>');
                }
            },
        });
    });
});
