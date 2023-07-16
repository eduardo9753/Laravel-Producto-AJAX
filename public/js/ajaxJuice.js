$(function () {

    //GUARDAR DATOS VIA AJAX FORMULARIO
    $('#form').on('submit', function (e) {
        e.preventDefault(); //PARA RETENER EL RECARGE DE LA PAGINA

        //variable del formulario
        var form = this;

        //metodo ajaz
        $.ajax({
            url: $(form).attr('action'), //lee la ruta del formulario
            method: $(form).attr('method'), //atributo del metodo "POST| GET ..."
            data: new FormData(form), //enviando los datos del fornulario
            processData: false,
            contentType: false,
            dataType: 'json', //tipo de dato como objeto "json"

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
                    fetchAllJuices(); //llamamos a la funcion para listar los datos
                }
            }
        });
    });



    //FETCH JUGOS PARA LISTARLOS EN LA TABLA LE PASAMOS LA RUTA MAS NO EL "name"
    fetchAllJuices();
    function fetchAllJuices() {
        $.get('/juice/fetch/juices', {}, function (data) {
            //console.log('datos jugos: '+data.result);
            $('#AllJuices').html(data.result);
        }, 'json');
    }



    //FUNCION PARA EDITAR VIA AJAX EN EL MODAL
    $(document).on('click', '#edit-juice-btn', function () {
        var juice_id = $(this).data('id');
        //console.log(juice_id);
        //Ruta: aqui se posa el id pero sin las llave
        var url = '/juice/show/' + juice_id + '';
        //pasamos los datos por ajax
        $.get(url, {}, function (data) {
            //alert(data.result.product_name);
            var edit_juice_modal = $('#edit-juice-modal');
            $(edit_juice_modal).find('#edit-juice-form').find('#id_juice').val(data.result.id);
            $(edit_juice_modal).find('#edit-juice-form').find('#nombre').val(data.result.nombre);
            $(edit_juice_modal).find('#edit-juice-form').find('#precio').val(data.result.precio);
            $(edit_juice_modal).find('#edit-juice-form').find('.img-old').attr('src', '/storage/files/' + data.result.imagen);
            $(edit_juice_modal).find('#edit-juice-form').find('#descripcion').val(data.result.descripcion);
            //mostrando el modal
            $(edit_juice_modal).modal('show');
        });
        /*Segundo metodo es no pasarle el id y el tu metodo de php capturarlo con un $request->id
        var url = '/product/show'
        $.get(url, { product_id: product_id }, function (data) {
            alert(data.result.product_name);
        });*/
    })


    /*FUNCION ACTUALIZAR DATOS VIA AJAX FORMULARIO*/
    $('#edit-juice-form').on('submit', function (e) {
        e.preventDefault();

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
                    fetchAllJuices();//recargarmos los datos de la tabla
                    $('#edit-juice-modal').modal('hide'); //escondemos el modal
                }
            }
        });
    });


    //ELIMINAR PRODUCTO FORMULARIO
    $(document).on('click', '#deleteBtn', function (e) {

        var product_id = $(this).data('id'); // data-id
        //Ruta: aqui se posa el id pero sin las llave
        var url = '/product/delete';

        if (confirm('Are you sure you want to delete this product')) {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : $ ( 'meta[name="csrf-token"]' ) . attr ( 'content' )
                },
                url: url,
                method: 'POST',
                data: { product_id: product_id },
                dataType: 'json',

                success: function (data) {
                    if (data.code == 1) {
                        fetchAllProducts();
                    } else {
                        console.log(data.msg);
                    }
                }
            });
        }
    });


})