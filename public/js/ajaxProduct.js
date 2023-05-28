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
                    fetchAllProducts(); //llamamos a la funcion para listar los datos
                }
            }
        });
    });



    //FETCH PRODUCTOS PARA LISTARLOS EN LA TABLA LE PASAMOS LA RUTA MAS NO EL "name"
    fetchAllProducts();
    function fetchAllProducts() {
        $.get('/product/fetch/products', {}, function (data) {
            $('#AllProducts').html(data.result);
        }, 'json');
    }



    //FUNCION PARA EDITAR VIA AJAX EN EL MODAL
    $(document).on('click', '#editBtn', function () {
        var product_id = $(this).data('id');
        //console.log(product_id);
        //Ruta: aqui se posa el id pero sin las llave
        var url = '/product/show/' + product_id + '';
        //pasamos los datos por ajax
        $.get(url, {}, function (data) {
            //alert(data.result.product_name);
            var edit_product_modal = $('#editProduct');
            //buscando el input  y asignandole el,valor traido de la base de datos via ajax
            $(edit_product_modal).find('#edit-form').find('input[name="pid"]').val(data.result.id);
            //buscando el input  y asignandole el,valor traido de la base de datos via ajax
            $(edit_product_modal).find('#edit-form').find('input[name="product_name"]').val(data.result.product_name);
            //buscando la img  y asignandole el,valor traido de la base de datos via ajax
            $(edit_product_modal).find('#edit-form').find('.img-old').attr('src', '/storage/files/' + data.result.product_image);
            //mostrando el modal
            $(edit_product_modal).modal('show');
        });

        /*Segundo metodo es no pasarle el id y el tu metodo de php capturarlo con un $request->id
        var url = '/product/show'
        $.get(url, { product_id: product_id }, function (data) {
            alert(data.result.product_name);
        });*/
    })


    //FUNCION ACTUALIZAR DATOS VIA AJAX FORMULARIO
    $('#edit-form').on('submit', function (e) {
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
                    fetchAllProducts();//recargarmos los datos de la tabla
                    $('#editProduct').modal('hide'); //escondemos el modal
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