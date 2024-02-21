import "./ajax-add-to-cart";



jQuery(document).ready(function($) {
    //i am changing label for the billing postcode field
    $('label[for="billing_postcode"]').text('ZIP code');
});


jQuery(document).ready(function($) {
    //find the element containing the label and replace its text
    $('.up-sells').find('h2').text('Related Products');
});


