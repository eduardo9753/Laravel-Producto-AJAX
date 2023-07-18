$(function () {

    count_supply = $('#count_supply').val();
    if(count_supply >= 1){ setInterval(contador,1000); }
    function contador(){ fetchAllSupplies(); console.log('desde supply:'+count_supply);}

    /*GUARDAR DATOS VIA AJAX FORMULARIO*/
    $('#form-supply').on('submit', function (e) {
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
                    fetchAllSupplies(); //llamamos a la funcion para listar los datos
                }
            }
        });
    });



    //FETCH SUMINISTROS PARA LISTARLOS EN LA TABLA LE PASAMOS LA RUTA MAS NO EL "name"
    fetchAllSupplies();
    function fetchAllSupplies() {
        $.get('/supply/fetch/supply', {}, function (data) {
            $('#AllSupplies').html(data.result);
        }, 'json');
    }



    //FUNCION PARA EDITAR VIA AJAX EN EL MODAL
    $(document).on('click', '#edit-supply-btn', function () {
        var supply_id = $(this).data('id');
        //console.log(supply_id);
        var url = '/supply/show/' + supply_id + '';
       
        $.get(url, {}, function (data) {
            console.log(data);
            var edit_supply_modal = $('#edit-supply-modal');
            $(edit_supply_modal).find('#edit-supply-form').find('#supply_id').val(data.result.id);
            $(edit_supply_modal).find('#edit-supply-form').find('#nombre').val(data.result.nombre);
            $(edit_supply_modal).find('#edit-supply-form').find('#precio').val(data.result.precio);
            $(edit_supply_modal).find('#edit-supply-form').find('#stock').val(data.result.stock);
            //mostrando el modal y el formulario con los datos
            $(edit_supply_modal).modal('show');
        });
        /*Segundo metodo es no pasarle el id y el tu metodo de php capturarlo con un $request->id
        var url = '/product/show'
        $.get(url, { product_id: product_id }, function (data) {
            alert(data.result.product_name);
        });*/
    })


    //FUNCION ACTUALIZAR DATOS VIA AJAX FORMULARIO
    $('#edit-supply-form').on('submit', function (e) {
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
                    fetchAllSupplies();//recargarmos los datos de la tabla
                    $('#edit-supply-modal').modal('hide'); //escondemos el modal
                }
            }
        });
    });


    //ELIMINAR PRODUCTO FORMULARIO
    $(document).on('click', '#delete-supply-btn', function (e) {

        var supply_id = $(this).data('id'); // data-id
        
        var url = '/supply/delete';

        if (confirm('Seguro que quiere eliminar este suministro')) {
            $.ajax({
                headers : {
                    'X-CSRF-TOKEN' : $ ( 'meta[name="csrf-token"]' ) . attr ( 'content' )
                },
                url: url,
                method: 'POST',
                data: { supply_id: supply_id },
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