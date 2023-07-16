$(function () {

    //GUARDAR DATOS DEL PROVEDOR VIA AJAX FORMULARIO
    $('#form-provider').on('submit', function (e) {
        //QUITAR EL RECARGUE DE PAGINA
        e.preventDefault();

        //variable del form en donde te trae todos los datos
        var form = this;
        //console.log(form);
        //console.log($(form).attr('action'));

        //metofo AJAX
        $.ajax({
            url: $(form).attr('action'), //aqui va aparecer la url
            method: $(form).attr('method'), //metodo GET , POST 
            data: new FormData(form),
            processData: false,
            contentType: false,
            dataType: 'json', //formato jason

            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },

            success: function (data) {
                if (data.code == 0) {
                    $.each(data.error, function (prefix, val) {
                        $(form).find('span.' + prefix + '_error').text(val[0]);
                    });
                } else {
                    $(form)[0].reset(); //reseteamos los datos en el formulario
                    alert(data.msg); //alerta exitosa con la variable de respuesta de json
                    fetchAllProviders(); //siempre ponerle al ultimo
                }
            }

        });
    });

    //CARGAR DATOS EN LA TABLA
    fetchAllProviders();
    function fetchAllProviders() {
        $.get('/provider/fetch/providers', {}, function (data) {
            $('#AllProviders').html(data.result);

            //console.log('datos: ' + data.result);
        }, 'json');
    }


    //DATOS PARA MOSTRAR EN EL MODAL "el boton '#edit-provider-btn' 
    //esta en all-providers.blade.php"
    //BOTON
    $(document).on('click', '#edit-provider-btn', function () {
        var provider_id = $(this).data('id');
        //alert(provider_id);

        var url = '/provider/show/' + provider_id + '';
        //pasamos los datos por ajax
        $.get(url, {}, function (data) {
            //variable modal
            var edit_provider_modal = $('#edit-provider-modal');
            $(edit_provider_modal).find('#edit-provider-form').find('#id_provider').val(data.result.id);
            $(edit_provider_modal).find('#edit-provider-form').find('#nombre').val(data.result.nombre);
            $(edit_provider_modal).find('#edit-provider-form').find('#descripcion').val(data.result.descripcion);
            //mostramos el modal
            $(edit_provider_modal).modal('show');
        });
    });


    //ACTUALIZAR LOS DATOS DEL MODAL '#edit-provider-form' FORMULARIO DENTRO DEL MODAL
    //FORMULARIO
    $('#edit-provider-form').on('submit', function (e) {
        //QUITAR EL RECARGUE DE PAGINA
        e.preventDefault();
        //variable formulario
        var form = this;
        //console.log(form);

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
                    fetchAllProviders();
                    $('#edit-provider-modal').modal('hide');
                }
            }
        });
    });


    //ELIMINAR DATOS PROVEDOR DE LA TABLA 
    //BOTON
    $(document).on('click', '#delete-provider-btn', function () {
        var provider_id = $(this).data('id'); //ata-id
        //Ruta
        var url = '/provider/delete';

        if (confirm('Quieres eliminar este provedor de la Base de Datos')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                url: url,
                method: 'POST',
                data: { provider_id: provider_id },
                dataType: 'json',

                success: function (data) {
                    if (data.code == 1) {
                        fetchAllProviders();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        }
    });



})