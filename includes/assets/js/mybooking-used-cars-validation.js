jQuery(document).ready(function ($) {
  // Suscribirse a los cambios en el estado del editor
  const unsubscribe = wp.data.subscribe(() => {
      const postType = wp.data.select('core/editor').getCurrentPostType();

      // Si el tipo de post es válido y es 'used-car', ejecuta la lógica
      if (postType === 'used-car') {
          // Desuscribirse para que no se ejecute más
          unsubscribe();

          // Validación de campos obligatorios
          const checkRequiredFields = function () {
              // Obtener los valores de los campos
              const price = $('#used-car-details-price').val();
              const brand = $('#used-car-details-brand').val();
              const model = $('#used-car-details-model').val();

              // Limpiar mensajes de validación previos
              $('.invalid-field').removeClass('invalid-field');
              $('.error-message').remove();

              let isValid = true;

              // Validar precio
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

              // Validar marca
              if (!brand) {
                  isValid = false;
                  const brandField = $('#used-car-details-brand');
                  brandField.addClass('invalid-field');
                  brandField.after('<p class="error-message">This field is required.</p>');
              }

              // Validar modelo
              if (!model) {
                  isValid = false;
                  const modelField = $('#used-car-details-model');
                  modelField.addClass('invalid-field');
                  modelField.after('<p class="error-message">This field is required.</p>');
              }

              return isValid;
          };

          // Sobrescribir savePost solo para 'used-car'
          const originalSavePost = wp.data.dispatch('core/editor').savePost;

          wp.data.dispatch('core/editor').savePost = function () {
              if (checkRequiredFields()) {
                  // Si pasa la validación, guardar el post
                  originalSavePost();
              } else {
                  // Si falla la validación, mostrar un mensaje
                  alert('Please fill in all required fields.');
              }
          };
      }
  });
});
