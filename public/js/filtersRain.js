$(document).ready(function () {
    cargarLocalidades();

    function cargarLocalidades() {
        $.ajax({
            url: "/lluvia/localidades",
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('#locality').empty();
                $('#locality').append('<option value="">Todas las localidades</option>');
                $.each(data, function (index, localidad) {
                    $('#locality').append('<option value="' + localidad + '">' +
                        localidad + '</option>');
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    $('#resetFilters').click(function () {
        $('#from_date').val('');
        $('#to_date').val('');
        $('#locality').val('');
        $('#filterForm').submit();
    });
});
