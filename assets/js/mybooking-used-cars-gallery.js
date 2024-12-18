// Usando jQuery para cambiar la imagen principal al hacer clic en una miniatura
jQuery(document).ready(function($) {
  
  $('.mybooking-used-cars_carousel-thumbnail').on('click', function() {
      var fullSizeImage = $(this).attr('data-full-size'); // Obtener la URL de la imagen completa
      $('.mybooking-used-cars-main-image img').attr('src', fullSizeImage); // Cambiar la imagen principal
  });

  // Seleccionamos todas las miniaturas
  const thumbnails = document.querySelectorAll('.mybooking-used-cars_carousel-thumbnail');

  // Seleccionamos el contenedor del carrusel de miniaturas
  const carouselContainer = document.querySelector('.mybooking-used-cars_carousel');

  thumbnails.forEach((thumbnail, index) => {
    // Añadimos un evento de clic a cada miniatura
    thumbnail.addEventListener('click', function () {
      // Calculamos la posición de la miniatura clickeada
      const targetOffset = thumbnail.offsetLeft;

      // Hacemos scroll suave hasta la posición de la miniatura
      carouselContainer.scrollTo({
        left: targetOffset - (carouselContainer.offsetWidth / 2) + (thumbnail.offsetWidth / 2), // Ajustamos la posición para centrar la imagen
        behavior: 'smooth' // Hace que el desplazamiento sea suave
      });
    });
  });

});