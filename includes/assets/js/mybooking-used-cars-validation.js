jQuery(document).ready(function ($) {
    // Required fields validation
    const checkRequiredFields = function () {

      // Get the values of the fields
      const price = $('#used-car-details-price').val();
      const brand = $('#used-car-details-brand').val();
      const model = $('#used-car-details-model').val();

      // Clear previous validation messages
      $('.invalid-field').removeClass('invalid-field');
      $('.error-message').remove();

      let isValid = true;

      // Validate price
      if (!price) {
          isValid = false;
          const priceField = $('#used-car-details-price');
          priceField.addClass('invalid-field');
          priceField.after('<p class="error-message">This field is required.</p>');
      } else if (isNaN(price)) {
          isValid = false;
          const priceField = $('#used-car-details-price');
          priceField.addClass('invalid-field');
          priceField.after('<p class="error-message">This field must be a number.</p>');
      }

      // Validate brand
      if (!brand) {
          isValid = false;
          const brandField = $('#used-car-details-brand');
          brandField.addClass('invalid-field');
          brandField.after('<p class="error-message">This field is required.</p>');
      }

      // Validate model
      if (!model) {
          isValid = false;
          const modelField = $('#used-car-details-model');
          modelField.addClass('invalid-field');
          modelField.after('<p class="error-message">This field is required.</p>');
      }

      return isValid;
  };

  const originalSavePost = wp.data.dispatch('core/editor').savePost;

  // Listen to the save event
  wp.data.dispatch('core/editor').savePost = function () {
      if (checkRequiredFields()) {
          // If it passes validation, proceed with saving
          originalSavePost();
      } else {
          // If it fails validation, show an alert
          alert('Please fill in all required fields.');
      }
  };
});
