  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2017-2020 <a href="http://www.americana.edu.co/medellin/">Corporacion Universitaria Americana</a>.</strong> Todos los derechos
    reservados
  </footer>
  <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <!-- jQuery 3 -->
  <!-- <script type="text/javascript" src="../resources/function.js"></script> -->
  <script src="../resources/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="../resources/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../resources/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="../resources/dist/js/adminlte.min.js"></script>
  <!-- Sparkline -->
  <script src="../resources/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
  <!-- jvectormap  -->
  <script src="../resources/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="../resources/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- SlimScroll -->
  <script src="../resources/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- ChartJS -->
  <script src="../resources/bower_components/Chart.js/Chart.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../resources/dist/js/pages/dashboard2.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../resources/dist/js/demo.js"></script>
  <!-- fullCalendar -->
  <script src="../resources/bower_components/moment/moment.js"></script>
  <script src="../resources/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
  <script src="../resources/bower_components/fullcalendar/dist/locale/es.js"></script>
  <!-- DataTables -->
  <script src="../resources/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../resources/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="../resources/bower_components/fastclick/lib/fastclick.js"></script>


  <!-- aca va lo de fullcalendar, esta en el archivo parte_script_fullcalendar.html -->

  <script type="text/javascript">
    $(function() {

      /* initialize the external events
       -----------------------------------------------------------------*/
      function init_events(ele) {
        ele.each(function() {

          // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          }

          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject)

          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex: 1070,
            revert: true, // will cause the event to go back to its
            revertDuration: 0 //  original position after the drag
          })

        })
      }

      init_events($('#external-events div.external-event'))

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()
      $('#calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
          today: 'today',
          month: 'month',
          week: 'week',
          day: 'day'
        },
        //Random default events
        events: "../php/events.php"
          /*
            {
              title          : 'All Day Event',
              start          : new Date(y, m, 1),
              backgroundColor: '#f56954', //red
              borderColor    : '#f56954' //red
            },
          ],*/
          ,
        editable: false, //permite la modificacion de los eventos del calendario
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped

          // retrieve the dropped element's stored Event Object
          var originalEventObject = $(this).data('eventObject')

          // we need to copy it, so that multiple events don't have a reference to the same object
          var copiedEventObject = $.extend({}, originalEventObject)

          // assign it the date that was reported
          copiedEventObject.start = date
          copiedEventObject.allDay = allDay
          copiedEventObject.backgroundColor = $(this).css('background-color')
          copiedEventObject.borderColor = $(this).css('border-color')

          // render the event on the calendar
          // the last `true` argument determines if the event 
          //"sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
          $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

          // is the "remove after drop" checkbox checked?
          if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            $(this).remove()
          }

        }
      })
      /* ADDING EVENTS */
      var currColor = '#3c8dbc' //Red by default
      //Color chooser button
      var colorChooser = $('#color-chooser-btn')
      $('#color-chooser > li > a').click(function(e) {
        e.preventDefault()
        //Save color
        currColor = $(this).css('color')
        //Add color effect to button
        $('#add-new-event').css({
          'background-color': currColor,
          'border-color': currColor
        })
      })
      $('#add-new-event').click(function(e) {
        e.preventDefault()
        //Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
          return
        }

        //Create events
        var event = $('<div />')
        event.css({
          'background-color': currColor,
          'border-color': currColor,
          'color': '#fff'
        }).addClass('external-event')
        event.html(val)
        $('#external-events').prepend(event)

        //Add draggable funtionality
        init_events(event)

        //Remove event from text input
        $('#new-event').val('')
      })
    })
  </script>

  <script type="text/javascript">
    $(function() {
      //$('#example1').DataTable()
      $('#example2').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': false,
        'ordering': true,
        'info': true,
        'autoWidth': false,
        "language": {
          "sProcessing": "Procesando...",
          "sLengthMenu": "Mostrar _MENU_ registros",
          "sZeroRecords": "No se encontraron resultados",
          "sEmptyTable": "Ningún dato disponible en esta tabla",
          "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix": "",
          "sSearch": "Buscar:",
          "sUrl": "",
          "sInfoThousands": ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
          }
        }
      })
    })
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#entradafilter').keyup(function() {
        var rex = new RegExp($(this).val(), 'i');
        $('.contenidobusqueda tr').hide();
        $('.contenidobusqueda tr').filter(function() {
          return rex.test($(this).text());
        }).show();
      })
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      // Formulario Modal que elimina el producto
      $('.delTipodocument').click(function(e) {
        e.preventDefault();
        var code = $(this).attr('datacode'); /* Se toma el valor del atributo (codigo del tipo)*/
        var action = 'erasetipodoc';
        //alert("estoy en function->" + code);
        $.ajax({
          url: '../plantillas/ajaxphp.php',
          /* Donde se va a dirigir*/
          type: 'POST',
          /* Como se envian los datos*/
          async: true,
          /* */
          data: {
            action: action,
            ncode: code
          },
          /* */
          success: function(response) {
            console.log(response);
            if (response != 'Error') {
              /* En caso que todo salga bien */
              $('.bodyModal').html(response);
            }
          },
          error: function(error) {
            /* En caso de ocurrir un error*/
            console.log(error);
          }
        });
        $('#modaltipodoc').fadeIn(); //Se muestra el modal  // formulario modal para adicionar cantidad a los productos
      }); /**** Fin de eliminar*/

      $('.newTipodocument').click(function(e) {
        e.preventDefault();
        var code = $(this).attr('datacode'); /* Se toma el valor del atributo (codigo del tipo)*/
        var action = 'nuevotipodoc';
        //alert("estoy en function->" + code);
        $.ajax({
          url: '../plantillas/ajaxphp.php',
          /* Donde se va a dirigir*/
          type: 'POST',
          /* Como se envian los datos*/
          async: true,
          /* */
          data: {
            action: action,
            ncode: code
          },
          /* */
          success: function(response) {
            console.log(response);
            if (response != 'Error') {
              /* En caso que todo salga bien */
              $('.bodyModal').html(response);
            }
          },
          error: function(error) {
            /* En caso de ocurrir un error*/
            console.log(error);
          }
        });
        $('#modaltipodoc').fadeIn(); //Se muestra el modal  // formulario modal para adicionar cantidad a los productos
      }); /**** Fin de nuevo registro*/
    });

    function colosemodal() {
      $('.alertAddProduct').text('');
      $('#modaltipodoc').fadeOut();
    }
  </script>

  <script type="text/javascript">
    $(document).ready(function() { // boton para adicionar carreras(cambia a edicion...)
      $('#_btnaddcarrera').click(function(e) {
        e.preventDefault();
        var bttbl = $(this).attr('btntipo');
        var tblbutton = $(this).attr('tablebtn');
        var idprg = $(this).attr('btnprg');
        var iddata = $(this).attr('datavalue');
        $('#divdatos *').prop('disabled', true); // probar esto-> $("#myDiv").find("*").prop('disabled', true);
        tryAjax(bttbl, tblbutton, iddata, idprg, "showkras")
        $('#divCarreras').show(1000);
      });

      $('#botonaddSpecial').click(function(e) {
        e.preventDefault();
        tryAjax($(this).attr('btntipo'), $(this).attr('tablebtn'),
          $(this).attr('datavalue'), $(this).attr('btnprg'), 'showspec');
        $('#ModalCrear').modal({
          backdrop: 'static',
          keyboard: false
        });
      });

      $('.closebtnaddSpecial').on('click', function(e) {
        e.preventDefault();
        $('#divCarreras').hide(1000, function() {
          $('#divdatos *').prop('disabled', false);
        });
      });


      $('#addCarrera2').click(function(e) {
        e.preventDefault();
        var krachoise = $('#cbokrass').val();
        if (krachoise == -1) { // no ha seleccionado la profesion del combo
          alert("valor seleccionado " + krachoise);
        } else {
          opsearch = "";
          valstate = 0;
          switch ($(this).attr('tablebtn')) {
            case 'new':
              valstate = 1;
              break;
            case 'edit':
              opsearch = 'allasesor';
              valstate = 2;
              break;
            case 'erase':
              opsearch = 'showonly';
              valstate = 3;
              break;
            default:
              break;
          }
          ajax_trykra($(this).attr('btntipo'),
            $(this).attr('btnprg'),
            $(this).attr('usertoken'),
            krachoise,
            valstate,
            "emptyfillcbo", "kras");
        };
      });

      /*
      $('#nrodoc').blur(function(e) {
        e.preventDefault();
        enteroValidado = validarEntero($(this).val());
        if (enteroValidado == "") {
          //si era la cadena vacía es que no era válido. Lo aviso 
          alert("Debe escribir un entero!")
          //selecciono el texto 
          $('#nrodoc').select();
          //coloco otra vez el foco 
          $(this).focus();
          return false;
        } else
          $('#nrodoc').value = enteroValidado;

      });
      */
    });

    function tryAjax(bttbl, tblbutton, iddata, idprg, choise) {
      //  function tryAjax(bttbl, tblbutton, iddata, idprg, choisebutton, choise) {
      /* alert("Valores recibidos: " +
         "\nbttbl(tabla)" + bttbl +
         "\ntblbutton(tablebutton) " + tblbutton +
         "\niddata(valor a cambiar) " + iddata +
         "\nidprg() " + idprg +
         "\nchoisebutton(opcion) " + choisebutton +
         "\nchoise(opcion) " + choise
       );*/
      opsearch = "";
      valstate = 0;
      switch (tblbutton) {
        case 'new':
          opsearch = 'all';
          valstate = 1;
          break;
        case 'edit':
          opsearch = 'allasesor';
          valstate = 2;
          break;
        case 'erase':
          opsearch = 'showonly';
          valstate = 3;
          break;
        default:
          break;
      }
      var action = opsearch;
      $.ajax({
        url: '../plantillas/ajaxphp.php',
        type: 'POST',
        async: true,
        data: {
          action: action,
          tabla: bttbl,
          tablebutton: tblbutton,
          codeone: iddata,
          prgexecute: idprg,
          vrstate: valstate
        },
        success: function(response) {
          if (response != 'error') {
            //console.log(response);
            //console.log(info);

            var info = JSON.parse(response);
            switch (choise) {
              case 'showkras':
                $('#cbokras').html(info.cbo); // se "pinta" el combo en el modal
                break;
              case 'showspec':
                $('#cbospec').html(info.cbo); // se "pinta" el combo en el modal
                break;
            }
            //console.log(response);
            //$('#titModal').html(info.titmodal);
            /* $('#ModalCrear').modal({
                backdrop: 'static',
                keyboard: false
              });*/
          } else {
            console.log('No data');
          }
        },
        error: function(error) {}
      });
    }

    function btnaddSpecial() { // se pulsa boton adicionar especialidades(postgrados)
      var choisecbo = $('#cboSpecial').val();
      if (choisecbo == -1) { // no ha seleccionado la profesion del combo
        alert("valor seleccionado " + choisecbo);
      } else {
        opsearch = "";
        valstate = 0;
        switch ($('#addSpecial').attr('tablebtn')) {
          case 'new':
            opsearch = 'all';
            valstate = 1;
            break;
          case 'edit':
            opsearch = 'allasesor';
            valstate = 2;
            break;
          case 'erase':
            opsearch = 'showonly';
            valstate = 3;
            break;
          default:
            break;
        }
        ajax_trykra($('#addSpecial').attr('btntipo'),
          $('#addSpecial').attr('btnprg'),
          $('#addSpecial').attr('usertoken'),
          choisecbo,
          valstate,
          "emptyfillcbo", "newspec");
      }
    }

    function fndeletekra(valor) {
      var krachoise = valor;
      //var choisecbo = valor;
      ajax_trykra($('#addCarrera2').attr('btntipo'),
        $('#addCarrera2').attr('btnprg'),
        $('#addCarrera2').attr('usertoken'),
        krachoise, 0,
        "erasefillkra", "kras");
    }

    function ajax_trykra(tabla, btnprg, tk, choisecbo, valstate, action, choise) {
      $.ajax({
        url: '../plantillas/ajaxphp.php',
        type: 'POST',
        async: true,
        data: {
          tabla: tabla,
          prgexecute: btnprg,
          token: tk,
          datainsert: choisecbo,
          vrstate: valstate,
          action: action
        },
        success: function(response) {
          if (response != 'error') {
            //console.log(response);
            switch (choise) {
              case 'kras':
                var info = JSON.parse(response);
                $('#tblkra').html(info.tbtmp);
                $('#cbokras').html(info.cbo);
                $('#addCarrera2').attr('ctakra', info.kkra);
                $('#ckras').val(info.kkra);
                ckras
                break;
              case 'newspec':
                var info = JSON.parse(response);
                //console.log(response);
                $('#tblspecial').html(info.tbtmp);
                $('#cbospec').html(info.cbo);
                $('#cspec').val(info.kkra);
                break;
            }
            // console.log(info);
            //return (info);
          } else {
            console.log('No data');
          }
        },
        error: function(error) {}
      });
    }

    function fndeletespecial(valor) {
      var krachoise = valor;
      ajax_trykra($('#addSpecial').attr('btntipo'),
        $('#addSpecial').attr('btnprg'),
        $('#addSpecial').attr('usertoken'),
        krachoise, 0,
        "erasefillspecial", "newspec");
    }
    /*
        function verify00() {
          $('#nrodoc').focus();
          return false;
        }*/
    /*
    function validarEntero(valor) {
      //intento convertir a entero. 
      //si era un entero no le afecta, si no lo era lo intenta convertir 
      valor = parseInt(valor);
      //Compruebo si es un valor numérico 
      if (isNaN(valor)) {
        //entonces (no es numero) devuelvo el valor cadena vacia 
        return ""
      } else {
        //En caso contrario (Si era un número) devuelvo el valor 
        return valor
      }
    }
    */
    /*
        function valAsesor() {
          enteroValidado = validarEntero(nrodoc.value);
          if (enteroValidado == "") {
            //si era la cadena vacía es que no era válido. Lo aviso 
            alert("Debe escribir un entero!")
            //selecciono el texto 
            $('#nrodoc').select();
            //coloco otra vez el foco 
            $('#nrodoc').focus();
          } else
            $('#nrodoc').value = enteroValidado;
        }*/
  </script>
  </body>

  </html>