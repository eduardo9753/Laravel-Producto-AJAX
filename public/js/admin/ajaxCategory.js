$(function () {

    count_category = $('#count_category').val();
    if(count_category >= 1){ setInterval(contador,1000); }
    function contador(){ fecthAllCategories(); console.log('desde category');}
    


    //GUARDAR DATOS VIA AJAX
    $('#form-category').on('submit', function (e) {
        e.preventDefault(); //PARA TETENER EL RECARGE DE LA PAGINA

        //variable formulario
        var form = this;

        //metodo ajax
        $.ajax({
            url: $(form).attr('action'), //lee la ruta del formulario
            method: $(form).attr('method'), //metodo de envio GET|POST
            data: new FormData(form), //datos del formulario
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
                    $(form)[0].reset(); //reseteamos los datos en el formulario
                    alert(data.msg);
                    fecthAllCategories();
                }
            }
        });
    });


    //FECTH DE PRODUCTOS EN LA TABLA 
    fecthAllCategories();
    function fecthAllCategories() {
        $.get('/category/fetch/categories', {}, function (data) {
            $('#AllCategories').html(data.result).fadeIn();
            //console.log('datos: ' + data.result);
        }, 'json');
    }


    //FUNCION PARA EDITAR UN PRODUCTO POR ID
    $(document).on('click', '#edit-category-btn', function () {
        var category_id = $(this).data('id');
        //console.log(category_id);
        var url = '/category/show/' + category_id + '';

        $.get(url, {}, function (data) {
            var edit_category_modal = $('#edit-category-modal');
            $(edit_category_modal).find('#edit-category-form').find('#id_category').val(data.result.id);
            $(edit_category_modal).find('#edit-category-form').find('#nombre').val(data.result.nombre);
            //mostrando el modal y el formulario con los datos
            $(edit_category_modal).modal('show');
        });
    });


    //FUNCION PARA ACTUALIZAR LOS PRODUCTOS
    $('#edit-category-form').on('submit', function (e) {
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
                    fecthAllCategories();
                    $('#edit-category-modal').modal('hide');
                }
            }
        });
    });

    //ELIMINAR DATOS CATEOORIA DE LA TABLA 
    //BOTON
    $(document).on('click', '#delete-category-btn', function () {
        var category_id = $(this).data('id'); //ata-id
        //Ruta
        var url = '/category/delete';

        if (confirm('Quieres eliminar esta categoria de la Base de Datos')) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                url: url,
                method: 'POST',
                data: { category_id: category_id },
                dataType: 'json',

                success: function (data) {
                    if (data.code == 1) {
                        fecthAllCategories();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        }
    });

})