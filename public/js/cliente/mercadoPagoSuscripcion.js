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
                console.log('Datos init_point: ', data.msg.init_point);
                //CREANDO EL BOTON DE PAGO MERCADOPAGO
                var link = data.msg.init_point;
                $('#link-suscripcion-mercadopago').attr('href', link);
            }
        });
    });



    //<a mp-mode="dftl" href="https://www.mercadopago.com.pe/subscriptions/checkout?preapproval_plan_id=2c9380848ab2cb05018aba814d4c05a0" name="MP-payButton" class='blue-ar-l-rn-none'>Suscribirme</a>

    (function () {
        function $MPC_load() {
            window.$MPC_loaded !== true && (function () {
                var s = document.createElement("script");
                s.type = "text/javascript";
                s.async = true;
                s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
                window.$MPC_loaded = true;
            })();
        }
        window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;
    })();



});



