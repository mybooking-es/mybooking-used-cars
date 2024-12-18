jQuery(document).ready(function ($) {
    $(document).ajaxSuccess(function (event, xhr, settings) {
        // Crear la columna para vincular a los modelos de la nueva marca añadida porque
        // esta columna no se crea cuando se añade la nueva marca por Ajax
        if (settings.data && settings.data.indexOf('action=add-tag') !== -1) {
            // Obtener la respuesta XML
            var responseXML = xhr.responseXML;

            if (responseXML) {
                // Buscar el nodo <parents> en la respuesta XML que contiene el código HTML
                var parentsHTML = $(responseXML).find('parents').text();

                if (parentsHTML) {
                    // Buscar el enlace en el HTML extraído
                    var $modelsLink = $(parentsHTML).find('.models a');

                    if ($modelsLink.length) {
                        // Obtener el enlace
                        var modelsUrl = $modelsLink.attr('href');

                        // Obtener el ID de la taxonomía insertada
                        var termId = $(responseXML).find('term_id').text();

                        // Buscar la fila que corresponde al término insertado
                        var $termRow = $('#the-list tr#tag-' + termId);

                        // Buscar la columna de "slug"
                        var $slugColumn = $termRow.find('.column-slug');

                        // Si la columna "slug" existe, insertar la nueva columna a la derecha de ella
                        if ($slugColumn.length) {
                            // Crear la nueva columna "models"
                            var $newColumn = $('<td class="models column-models" data-colname="Models"></td>');
                            $newColumn.html('<a href="' + modelsUrl + '">View Models</a>');

                            // Insertar la nueva columna después de la columna "slug"
                            $slugColumn.after($newColumn);
                        }
                    }
                }
            }
        }
    });
});
