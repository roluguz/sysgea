$(document).ready(function() {

    $('.add_product').click(function(e) {
        e.preventDefault();
        var producto = $(this).attr('product'); /* Se toma el valor del atributo product(codigo del producto)*/
        var action = 'infoProducto';
        $.ajax({
            url: 'ajax.php',
            /* Donde se va a dirigir*/
            type: 'POST',
            /* Como se envian los datos*/
            async: true,
            /* */
            data: { action: action, producto: producto },
            /* */
            success: function(response) { /* En caso que todo salga bien */
                if (response != 'Error') {
                    var info = JSON.parse(response);
                    $('.bodyModal').html('<form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct();">' +
                        '<h1><i class="fas fa-cubes" style="font-size: 45pt;"></i><br>Adición de Cantidad producto</h1>' +
                        '<h2 class="nameProducto">' + info.descripcion + '</h2><br>' +
                        '<input type="number" name="cantidad" id="txtCantidad" placeholder="Cantidad adicionar" required><br>' +
                        '<input type="number" name="precio" id="txtPrecio" placeholder="Precio del producto" required>' +
                        '<input type="hidden" name="producto_id" id="producto_id" value="' + info.codproducto + '" required>' +
                        '<input type="hidden" name="action" value="addProducto" required>' +
                        '<div class="alert alertAddProduct"></div>' +
                        '<button type="submit" class="btn_new"><i class="fas fa-plus"></i> Agregar</button>' +
                        '<a href="#" class="btn_ok closeModal" onclick="colosemodal();"><i class="fas fa-ban"></i> Cerrar</a>' +
                        '</form>');
                }
            },
            error: function(error) { /* En caso de ocurrir un error*/
                console.log(error);
            }
        });
        $('.modal').fadeIn(); //Se muestra el modal  // formulario modal para adicionar cantidad a los productos
    });

    // Formulario Modal que elimina el producto
    $('.delTipodocument').click(function(e) {
        e.preventDefault();
        alert("estoy en function");
        var code = $(this).attr('datacode'); /* Se toma el valor del atributo product(codigo del producto)*/
        var action = 'infdeltipod';
        $.ajax({
            url: 'ajaxphp.php',
            /* Donde se va a dirigir*/
            type: 'POST',
            /* Como se envian los datos*/
            async: true,
            /* */
            data: { action: action, ncode: code },
            /* */
            success: function(response) { /* En caso que todo salga bien */
                if (response != 'Error') {
                    var info = JSON.parse(response);
                    $('.bodyModal').html('<form action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); deleteProducto();">' +
                        '<h1><i class="fas fa-cubes" style="font-size: 45pt;"></i><br>Eliminar producto</h1>' +
                        '<p>¿Seguro de eliminar el siguiente registro?</p>' +
                        '<h2 class="nameProducto">' + info.descripcion + '</h2><br>' +
                        '<input type="hidden" name="producto_id" id="producto_id" value="' + info.codproducto + '" required>' +
                        '<input type="hidden" name="action" value="delProducto" required>' +
                        '<div class="alert alertAddProduct"></div>' +
                        '<a href="#" class="btn_cancel" onclick="colosemodal();"><i class="fas fa-times-circle"></i> Cerrar</a>' +
                        '<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar</button>' +
                        '</form>');
                }
            },
            error: function(error) { /* En caso de ocurrir un error*/
                console.log(error);
            }
        });
        $('.modal').fadeIn(); //Se muestra el modal  // formulario modal para adicionar cantidad a los productos
    }); /**** Fin de eliminar*/

    $('#search_proveedor').change(function(e) {
        e.preventDefault();
        var sistema = getUrl();
        //alert("Sistema==>\n"+sistema);
        location.href = sistema + 'buscar_productos.php?proveedor=' + $(this).val();
    });
    //Activa campos para registrar cliente
    $('.btn_new_cliente').click(function(e) {
        e.preventDefault();
        $('#nom_cliente').removeAttr('disabled');
        $('#tel_cliente').removeAttr('disabled');
        $('#dir_cliente').removeAttr('disabled');

        $('#div_registro_cliente').slideDown();
    });
    // buscar cliente
    $('#nit_cliente').keyup(function(e) {
        e.preventDefault();
        var cl = $(this).val();
        var action = 'searchCliente';
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: { action: action, cliente: cl },
            success: function(response) { //console.log(response);           
                if (response == 0) { // Se blanquean-limpian los campos, se esconde el boton
                    $('#idcliente').val('');
                    $('#nom_cliente').val('');
                    $('#tel_cliente').val('');
                    $('#dir_cliente').val('');
                    $('.btn_new_cliente').slideDown();
                } else { // Se traen datos que regreso el JSON, se esconde el boton NUEVO CLIENTE 
                    var data = $.parseJSON(response);
                    $('#idcliente').val(data.idcliente);
                    $('#nom_cliente').val(data.nombre);
                    $('#tel_cliente').val(data.telefono);
                    $('#dir_cliente').val(data.direccion);
                    $('.btn_new_cliente').slideUp();
                    // se desactivan los campos, se esconde el boton GUARDAR
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#tel_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');
                    $('#div_registro_cliente').slideUp();
                }
            },
            error: function(error) {}
        });
    });

    // Nuevo cliente(se toma el evento del formulario de eventas): form_new_cliente_venta
    $('#form_new_cliente_venta').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: $('#form_new_cliente_venta').serialize(),
            success: function(response) { //console.log(response);               
                if (response != 'error') {

                    $('#idcliente').val(response);
                    $('#nom_cliente').attr('disabled', 'disabled');
                    $('#tel_cliente').attr('disabled', 'disabled');
                    $('#dir_cliente').attr('disabled', 'disabled');
                    //Se esconden los botones AGREGAR CLIENTE, el boton GUARDAR
                    $('.btn_new_cliente').slideUp();
                    $('#div_registro_cliente').slideUp();
                }
            },
            error: function(error) {}
        });
    });

    // Buscar producto(cuando se esta ingresando la venta)
    $('#txt_cod_producto').keyup(function(e) {
        e.preventDefault();
        var action = 'infoProducto';
        var producto = $(this).val();
        if (producto != '') {
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                async: true,
                data: { action: action, producto: producto },
                success: function(response) { //console.log(response);           
                    if (response != 'Error') {
                        var info = JSON.parse(response);
                        $('#txt_descripcion').html(info.descripcion);
                        $('#txt_existencia').html(info.existencia);
                        $('#txt_can_producto').val('1');
                        $('#txt_precio').html(info.precio);
                        $('#txt_precio_total').html(info.precio);
                        $('#txt_can_producto').removeAttr('disabled'); // Activar cantidad, quitar atributo disabled
                        $('#add_product_venta').slideDown(); // Mostrar boton agregar
                    } else {
                        $('#txt_descripcion').html('-');
                        $('#txt_existencia').html('-');
                        $('#txt_can_producto').val('0');
                        $('#txt_precio').html('0.00');
                        $('#txt_precio_total').html('0.00');
                        $('#txt_can_producto').attr('disabled', 'disabled'); // agregar atributo disable(desactivar)
                        $('#add_product_venta').slideUp(); // ocultar opcion agregar            
                    }
                },
                error: function(error) {}
            });
        } else { //No hay nada en el txt_cod_producto
            $('#txt_descripcion').html('-');
            $('#txt_existencia').html('-');
            $('#txt_can_producto').val('0');
            $('#txt_precio').html('0.00');
            $('#txt_precio_total').html('0.00');
            $('#txt_can_producto').attr('disabled', 'disabled');
            $('#add_product_venta').slideUp();
        }
    }); // Fin----Buscar producto(cuando se esta ingresando la venta)

    /*--------------------*/
    // Validar cantidad del producto a vender(antes de agregar)
    /*var existencia = parseInt($('#txt_existencia').html());
        if($(this).val() >  existencia ){
            $('#add_product_venta').slideUp();
        }else{
            $('#add_product_venta').slideDown();
        }*/
    $('#txt_can_producto').keyup(function(e) {
        e.preventDefault();
        var existencia = parseInt($('#txt_existencia').html()); // se toma el contendio de la celda que contiene la existencia       
        var precio_total = $(this).val() * $('#txt_precio').html();
        $('#txt_precio_total').html(precio_total);
        if ($(this).val() < 1 || isNaN($(this).val()) || ($(this).val() > existencia)) {
            $('#add_product_venta').slideUp();
        } else {
            $('#add_product_venta').slideDown();
        }
    });

    /* Agregar-Adicionar el producto al detalle*/
    $('#add_product_venta').click(function(e) {
        e.preventDefault();
        if ($('#txt_can_producto').val() > 0) {
            var codproducto = $('#txt_cod_producto').val();
            var cantidad = $('#txt_can_producto').val();
            var action = 'addProductoDetalle';
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                async: true,
                data: { action: action, producto: codproducto, cantidad: cantidad },
                success: function(response) {
                    if (response != 'error') {
                        var info = JSON.parse(response);
                        //console.log(info);

                        $('#detalle_venta').html(info.detalle); // se "pinta" el detalle
                        $('#detalle_totales').html(info.totales); // se "pinta" los totales
                        $('#txt_cod_producto').val('');
                        $('#txt_descripcion').html('-');
                        $('#txt_existencia').html('-');
                        $('#txt_can_producto').val('0');
                        $('#txt_precio').html('0.00');
                        $('#txt_precio_total').html('0.00');
                        $('#txt_can_producto').attr('disabled', 'disabled');
                        $('#add_product_venta').slideUp();
                    } else {
                        console.log('No data');
                    }
                    viewProcesar();
                },
                error: function(error) {}
            });
        }
    });

    $('#btn_anular_venta').click(function(e) { // Boton que anula la venta, quita todo..
        e.preventDefault();
        var rows = $('#detalle_venta tr').length;
        if (rows > 0) {
            var action = 'anularVenta';
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                async: true,
                data: { action: action },
                success: function(response) {
                    // console.log(response);
                    if (response != 'error') {
                        location.reload(); // refrescar toda la pagina
                    }
                },
                error: function(error) {}
            });
        }
    });

    $('#btn_facturar_venta').click(function(e) { // Boton hace la facturacion de la venta--Procesar..
        e.preventDefault();
        var rows = $('#detalle_venta tr').length;
        //alert("Estoy en btn_facturar_venta")
        if (rows > 0) {
            var codcliente = $('#idcliente').val();
            var action = 'procesarVenta';
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                async: true,
                data: { action: action, codcliente: codcliente },
                success: function(response) {
                    if (response != 'error') {
                        var info = JSON.parse(response);
                        generarPDF(info.codcliente, info.nofactura);
                        location.reload();
                    } else { console.log('no data'); }
                },
                error: function(error) {}
            });
        }
        /*else {
                   alert("no hay detalle");
               }*/
    });

    /* - Para anular la factura(boton anular del listado) */
    $('.anular_factura').click(function(e) {
        e.preventDefault();
        var nofactura = $(this).attr('fac'); /* Se toma el valor del atributo product(codigo del producto)*/
        var action = 'infoFactura';
        //alert("Anulando...."+nofactura)
        $.ajax({
            url: 'ajax.php',
            /* Donde se va a dirigir*/
            type: 'POST',
            /* Como se envian los datos*/
            async: true,
            /* */
            data: { action: action, nofactura: nofactura },
            /* */
            success: function(response) { /* En caso que todo salga bien */
                if (response != 'Error') {
                    var info = JSON.parse(response);
                    $('.bodyModal').html('<form action="" method="post" name="form_anular_factura" id="form_anular_factura" onsubmit="event.preventDefault(); anularFactura();">' +
                        '<h1><i class="fas fa-cubes" style="font-size: 45pt;"></i><br>Anular factura</h1><br>' +
                        '<p>¿Realmente desea ANULAR la factura?</p>' +

                        '<p><strong>Nro Factura: ' + info.nofactura + '</strong></p>' +
                        '<p><strong>Valor total: ' + info.totalfactura + '</strong></p>' +
                        '<p><strong>Fecha: ' + info.fecha + '</strong></p>' +
                        '<input type="hidden" name="action" value="anularFactura">' +
                        '<input type="hidden" name="no_factura" id="no_factura" value="' + info.nofactura + '" required>' +

                        '<div class="alert alertAddProduct"></div>' +
                        '<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Anular</button>' +
                        '<a href="#" class="btn_cancel" onclick="colosemodal();"><i class="fas fa-ban"></i> Cerrar</a>' +
                        '</form>');
                }
            },
            error: function(error) { /* En caso de ocurrir un error*/
                console.log(error);
            }
        });
        $('.modal').fadeIn(); //Se muestra el modal 
    }); /**** Fin anular factura-del listado de facturas*/

    $('.view_factura').click(function(e) { // Boton que muestra la factura, esta en lista_ventas
        e.preventDefault();
        var codcliente = $(this).attr('cl');
        var nofactura = $(this).attr('f');
        generarPDF(codcliente, nofactura);
    });
}); // fin del READY

function anularFactura() {
    var noFactura = $('#no_factura').val();
    var action = 'anularFactura';
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, noFactura: noFactura },
        success: function(response) {
            //console.log(response)
            if (response != 'error') {
                $('#row_' + noFactura + ' .estado').html('<span class="anulada">Anulada</spana>');
                $('#form_anular_factura .btn_ok').remove();
                $('#row_' + noFactura + ' .div_factura').html('<button type="button" class="btn_anular inactive"><i class="fas fa-ban"></i></button>');
                $('.alertAddProduct').html('<p>Factura Anulada</p>');
            } else {
                $('.alertAddProduct').html('<p style="color:red;">Error al anular factura</p>');
            }
        },
        error: function(error) {}
    });
}

function generarPDF(cliente, factura) {
    var ancho = 1000;
    var alto = 800;
    var x = parseInt((window.screen.width / 2) - (ancho / 2));
    var y = parseInt((window.screen.height / 2) - (alto / 2));
    $url = 'factura/generaFactura.php?cl=' + cliente + '&f=' + factura;
    window.open($url, "Factura", "left=" + x + ",top=" + y + ",height=" + alto + ",width=" + ancho + ",scrollbar=si,location=no,resizable=si,menubar=no");
}

function del_product_detalle(nro) {
    var action = 'delproductoDetalle';
    var id_detalle = nro;
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_detalle: id_detalle },
        success: function(response) {
            if (response != 'error') {
                var info = JSON.parse(response);
                $('#detalle_venta').html(info.detalle);
                $('#detalle_totales').html(info.totales);
                $('#txt_cod_producto').val('');
                $('#txt_descripcion').html('-');
                $('#txt_existencia').html('-');
                $('#txt_can_producto').val('0');
                $('#txt_precio').html('0.00');
                $('#txt_precio_total').html('0.00');
                $('#txt_can_producto').attr('disabled', 'disabled');
                $('#add_product_venta').slideUp();
            } else {
                $('#detalle_venta').html('');
                $('#detalle_totales').html('');
            }
            viewProcesar();
        },
        error: function(error) {}
    });
}

function viewProcesar() { // Ocultar/Mostrar boton procesar:almacenar la factura
    if ($('#detalle_venta tr').length > 0) {
        $('#btn_facturar_venta').show();
    } else {
        $('#btn_facturar_venta').hide();
    }
}

function searchForDetalle(id) {
    var action = 'searchForDetalle';
    var user = id;
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, user: user },
        success: function(response) { // console.log(response); 
            if (response != 'error') {
                var info = JSON.parse(response);
                $('#detalle_venta').html(info.detalle);
                $('#detalle_totales').html(info.totales);
            } else {
                console.log('No data');
            }
            viewProcesar();
        },
        error: function(error) {}
    });
}

function getUrl() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    /*
    alert("loc==>\n"+loc);
    alert("pathName==>\n"+pathName);
    alert("loc.pathname==>\n"+loc.pathname);
    alert("loc.search==>\n"+loc.search);
    alert("loc.hash==>\n"+window.location.hash);
    alert("loc.href.length==>\n"+loc.href.length);*/
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}
/*
function getUrl(){
    var loc = window.location;
    var pathName = loc.pathName.substring(0, loc.pathName.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.lenght - ((loc.pathName + loc.search + loc.hash).lenght - pathName.lenght)); 
}*/

function sendDataProduct() {
    $('.alertAddProduct').text('');
    $.ajax({
        url: 'ajax.php',
        /* Donde se va a dirigir*/
        type: 'POST',
        /* Como se envian los datos*/
        async: true,
        /* */
        data: $('#form_add_product').serialize(),
        /* todos los input del formulario, */
        success: function(response) { /* En caso que todo salga bien */
            //console.log(response); alert('Regrese del ajax');
            if (response == 'Error') {
                $('.alertAddProduct').html('<p style="color:red;">Error al Agregar cantidad y/o Precio.</p>');
            } else {
                var info = JSON.parse(response);
                $('.row' + info.producto_id + ' .celValor').html(info.nuevo_precio);
                $('.row' + info.producto_id + ' .celStock').html(info.nueva_existencia);
                $('#txtCantidad').val('');
                $('#txtPrecio').val('');
                $('.alertAddProduct').html('<p>Precio/Cantidad Almacenados correctamente.</p>');
            }
        },
        error: function(error) { /* En caso de ocurrir un error*/
            console.log(error);
        }
    });
}
// Para eliminar el registro
function deleteProducto() {
    $('.alertAddProduct').text('');
    var pr = $('#producto_id').val();
    $.ajax({
        url: 'ajax.php',
        /* Donde se va a dirigir*/
        type: 'POST',
        /* Como se envian los datos*/
        async: true,
        /* */
        data: $('#form_del_product').serialize(),
        /* todos los input del formulario, */
        success: function(response) { /* En caso que todo salga bien */
            console.log(response);
            //alert('Regrese del ajax');
            if (response == 'Error') {
                $('.alertAddProduct').html('<p style="color:red;">Error al Eliminar el Producto.</p>');
            } else {
                //var info = JSON.parse(response);
                $('.row' + pr).remove();
                $('#form_del_product .btn_ok').remove();
                //$('#form_del_product .btn_cancel').html('Aceptar');
                $('.alertAddProduct').html('<p>producto Eliminado correctamente.</p>');
            }
        },
        error: function(error) { /* En caso de ocurrir un error*/
            console.log(error);
        }
    });
}

function colosemodal() {
    $('.alertAddProduct').text('');
    $('#txtCantidad').val('');
    $('#txtPrecio').val('');
    $('.modal').fadeOut();
}