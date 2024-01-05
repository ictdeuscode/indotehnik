function initAutocomplete(element, table, column)
{
    $(element).autocomplete({
        source: function(request, response) {
            $.ajax({
                type: 'GET',
                url: "general/autocomplete",
                data: {
                    'table' : table,
                    'column' : column,
                    'filter' : request.term,
                },
                success: function(data) {
                    response(data);
                }
            });
        }
    });
}