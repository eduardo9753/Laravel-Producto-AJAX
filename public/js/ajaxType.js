$(function () {

    //FUNCION PARA EDITAR UN TIPO POR ID
    $(document).on('click', '#edit-type-btn', function () {
        var type_id = $(this).data('id');
        
        var url = '/tipo/show/' + type_id + '';

        $.get(url, {}, function (data) {
            var edit_type_modal = $('#edit-type-modal');
            $(edit_type_modal).find('#edit-type-form').find('#id_tipo').val(data.result.id);
            $(edit_type_modal).find('#edit-type-form').find('#nombre').val(data.result.nombre);
            //mostrando el modal y el formulario con los datos
            $(edit_type_modal).modal('show');
        });
    });


    //FUNCION PARA ACTUALIZAR LOS TIPOS
    $('#edit-type-form').on('submit', function (e) {
        e.preventDefault()

        var form = this;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            contentType: false,
            dataType: 'json',

            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },

            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    alert(data.msg);
                    window.location.reload();
                    $('#edit-type-modal').modal('hide');
                }
            }
        });
    });

   

})