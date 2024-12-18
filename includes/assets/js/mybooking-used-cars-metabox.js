jQuery(document).ready(function ($) {
  $('#used-car-details-brand').on('change', function () {
      var brandId = $(this).val();
      var $modelSelect = $('#used-car-details-model');

      // Limpiar y deshabilitar el selector de modelos mientras se carga
      $modelSelect.empty().append('<option value="">' + mybookingUsedCar.loading_text + '</option>').prop('disabled', true);

      if (brandId) {
          // Realizar una solicitud AJAX para obtener los modelos
          $.post(mybookingUsedCar.ajax_url, {
              action: 'mybooking_get_models',
              brand_id: brandId,
          }, function (response) {
              if (response.success) {
                  $modelSelect.empty().append('<option value="">' + mybookingUsedCar.select_model_text + '</option>');
                  $.each(response.data, function (index, model) {
                      $modelSelect.append('<option value="' + model.id + '">' + model.name + '</option>');
                  });
                  $modelSelect.prop('disabled', false);
              }
          });
      } else {
          $modelSelect.empty().append('<option value="">' + mybookingUsedCar.select_brand_first_text + '</option>').prop('disabled', true);
      }
  });
});