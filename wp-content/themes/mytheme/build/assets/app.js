jQuery(function($) {
  if (typeof wc_add_to_cart_params === "undefined") {
    return false;
  }
  $(document).on("submit", "form.cart", function(e) {
    var form = $(this), button = form.find(".single_add_to_cart_button");
    e.preventDefault();
    if (!validateProductOptions(form)) {
      return false;
    }
    proceedWithAjaxAddToCart(form, button);
  });
  function validateProductOptions(form) {
    var isValid = true;
    form.find(".variations select").each(function() {
      if ($(this).attr("required") && $(this).val() === "") {
        isValid = false;
        return false;
      }
    });
    if (!isValid) {
      alert("Please choose product options.");
    }
    return isValid;
  }
  function proceedWithAjaxAddToCart(form, button) {
    var variationAttributes = {};
    form.find('.variations input[type="hidden"]').each(function() {
      var attributeName = $(this).attr("name");
      var attributeValue = $(this).val();
      if (attributeValue) {
        variationAttributes[attributeName] = attributeValue;
      }
    });
    if (!variationAttributes.hasOwnProperty("attribute_pa_size") || !variationAttributes.hasOwnProperty("attribute_pa_color")) {
      alert("Please choose product options.");
      return false;
    }
    var variationID = variationAttributes["attribute_pa_size"] + "-" + variationAttributes["attribute_pa_color"];
    var formData = {
      product_id: form.find('input[name="product_id"]').val(),
      variation_id: variationID,
      variation: variationAttributes,
      // Include variation attributes
      quantity: form.find('input[name="quantity"]').val() || 1
    };
    form.block({
      message: null,
      overlayCSS: {
        background: "#ffffff",
        opacity: 0.6
      }
    });
    $(document.body).trigger("adding_to_cart", [button, formData]);
    $.ajax({
      type: "POST",
      url: wc_add_to_cart_params.wc_ajax_url.toString().replace("%%endpoint%%", "add_to_cart"),
      data: formData,
      success: function(response) {
        if (!response) {
          return;
        }
        if (response.error && response.product_url) {
          window.location = response.product_url;
          return;
        }
        $(document.body).trigger("added_to_cart", [response.fragments, response.cart_hash, button]);
        $(document.body).trigger("update_cart_totals");
        alert("Product successfully added to cart!");
      },
      complete: function() {
        form.unblock();
      }
    });
  }
});
document.addEventListener("DOMContentLoaded", function() {
  const attributeOptions = document.querySelectorAll(".attribute-option");
  attributeOptions.forEach((option) => {
    option.addEventListener("click", function(e) {
      e.preventDefault();
      const attributeValue = this.getAttribute("data-value");
      const attributeName = this.closest("tr").querySelector('.value [name^="attribute_pa_"]').name.replace("attribute_pa_", "");
      const hiddenInput = document.querySelector('form.variations_form .variations input[name="attribute_pa_' + attributeName + '"]');
      if (hiddenInput) {
        hiddenInput.value = attributeValue;
        console.log(hiddenInput);
      } else {
        console.error("Hidden input not found for attribute:", attributeName);
      }
      if (attributeName === "size") {
        document.getElementById("value-of-the-option-size").textContent = attributeValue;
      } else if (attributeName === "color") {
        document.getElementById("value-of-the-option-color").textContent = attributeValue;
      }
      hiddenInput.dispatchEvent(new Event("change"));
    });
  });
});
jQuery(document).ready(function($) {
  $('label[for="billing_postcode"]').text("ZIP code");
});
