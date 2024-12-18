jQuery(document).ready(function ($) {
    $(document).ajaxSuccess(function (event, xhr, settings) {
        // Create the column to link to the models of the new added brand because
        // this column is not created when the new brand is created by Ajax
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

                        // Buscar si ya existe la columna "models"
                        var $modelsColumn = $termRow.find('.column-models');

                        // Si la columna "models" existe, añadir el enlace
                        if ($modelsColumn.length) {
                            $modelsColumn.html('<a href="' + modelsUrl + '">View Models</a>');
                        } else {
                            // Si la columna no existe, añadir una nueva columna "models"
                            var $newColumn = $('<td class="models column-models" data-colname="Models"></td>');
                            $newColumn.html('<a href="' + modelsUrl + '">View Models</a>');

                            // Insertar la nueva columna al final de la fila
                            $termRow.append($newColumn);
                        }
                    }
                }
            }
        }
    });
});
