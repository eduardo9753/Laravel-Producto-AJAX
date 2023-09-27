window.addEventListener('DOMContentLoaded', () => {

    $('#form-cart-venta-suscripcion').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "/mercadopago/suscription/pay",
            method: "POST",
            data: $('#form-cart-venta-suscripcion').serialize(),
            dataType: "JSON",

            beforeSend: function () { $('#form-cart-venta-suscripcion').find('#checkout-btn').attr('disabled', true) }, //desabilitamos

            success: function (data) {
                //console.log('Datos init_point: ', data.msg.init_point);
                //CREANDO EL BOTON DE PAGO MERCADOPAGO
                var link = data.msg.init_point;
                $('#link-suscripcion-mercadopago').attr('href', link);
            }
        });
    });
});



