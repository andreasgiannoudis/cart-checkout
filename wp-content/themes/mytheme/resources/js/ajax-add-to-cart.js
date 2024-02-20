jQuery(function($) {
    $('form.variations_form').on('submit', function(e) {
        e.preventDefault();
        
        var addToCartButton = $(this).find('.single_add_to_cart_button');
        
        addToCartButton.on('click', function(e) {
            e.preventDefault();
            
            var ajaxUrl = ajax_object.ajax_url;
            
            var formData = $(this).closest('form').serialize(); 
            var product_id = $(this).closest('form').data('product_id');
            
            $.ajax({
                type: 'POST',
                url: ajaxUrl,
                data: formData + '&action=add_to_cart',
                success: function(response) {
                    console.log(response);
                }
            });
        });
    });
});
