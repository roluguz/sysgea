<?php
/*
  require_once('bdd.php');
  $sql = "SELECT id, title, start, end, color FROM events ";
  $req = $bdd->prepare($sql);
  $req->execute();
  $events = $req->fetchAll();*/
?>
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
<!-- <script src="../resources/bower_components/jquery/dist/jquery.min.js"></script> -->
<script src="../resources/bower_components/fullcalendar-5.3.0/lib/jquery-3.5.1.js"></script>
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
<!--
<script src="../resources/bower_components/fullcalendar-5.3.0/lib/moment.js"></script>
<script src="../resources/bower_components/fullcalendar-5.3.0/lib/main.min.js"></script> 
<script src="../resources/bower_components/fullcalendar-5.3.0/lib/locales/es.js"></script> -->
<script src="../resources/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="../resources/bower_components/fullcalendar/dist/locale/es.js"></script>
<!-- resources\bower_components\fullcalendar-5.3.0\lib\locales -->
<!-- DataTables -->
<script src="../resources/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../resources/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../resources/bower_components/fastclick/lib/fastclick.js"></script>


<script>
  $(document).ready(function() {
    $('#calendar').fullCalendar({
      header: {
        language: 'es',
        left: 'today, prev, next',
        center: 'title',
        right: 'month, basicWeek, basicDay, agendaWeek, agendaDay'
      },
      dayClick: function(date, jsEvent, view) {
        $(this).css('background-color', 'red');
        $("#modalgeneral").modal();
      },
      eventSources: [{
        events: [{
          title: 'Comelona', // contenido
          start: '2020-08-28', // Año, mes, dia
          color: "#5B2C6F",
          textColor: "#F5B041"
        }]
      }],
      color: "#A9CCE3",
      textColor: "#F5CBA7"
      //  editable: true,
      //  eventLimit: true, // allow "more" link when too many events
      //  selectable: true,
      //  selectHelper: true,
      //  select: function(start, end) {
      //    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
      //    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
      //    $('#ModalAdd').modal('show');
      //  },
      //  eventRender: function(event, element) {
      //    element.bind('dblclick', function() {
      //      $('#ModalEdit #id').val(event.id);
      //      $('#ModalEdit #title').val(event.title);
      //      $('#ModalEdit #color').val(event.color);
      //      $('#ModalEdit').modal('show');
      //    });
      //  },
      //  eventDrop: function(event, delta, revertFunc) { // si changement de position
      //    edit(event);
      //  },
      //  eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur
      //    edit(event);
      //  },
      //  events: [
      //    <?php //foreach ($events as $event):
            //      $start = explode(" ", $event['start']);
            //      $end = explode(" ", $event['end']);
            //      if ($start[1] == '00:00:00') {
            //        $start = $start[0];
            //      } else {
            //        $start = $event['start'];
            //      }
            //      if ($end[1] == '00:00:00') {
            //        $end = $end[0];
            //      } else {
            //        $end = $event['end'];
            //      }
            //    
            //      
            ?> {
      //        id:    '<?php //echo $event['id']; 
                        //                  
                        ?>',
      //        title: '<?php //echo $event['title']; 
                        //                  
                        ?>',
      //        start: '<?php //echo $start; 
                        //                  
                        ?>',
      //        end:   '<?php //echo $end; 
                        //                  
                        ?>',
      //        color: '<?php //echo $event['color']; 
                        //                  
                        ?>',
      //      },
      //    <?php //endforeach; 
            //      
            ?>
      //  ]
      //  
    });

    function edit(event) {
      start = event.start.format('YYYY-MM-DD HH:mm:ss');
      if (event.end) {
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
      } else {
        end = start;
      }
      id = event.id;
      Event = [];
      Event[0] = id;
      Event[1] = start;
      Event[2] = end;
      $.ajax({
        url: 'editEventDate.php',
        type: "POST",
        data: {
          Event: Event
        },
        success: function(rep) {
          if (rep == 'OK') {
            alert('Saved');
          } else {
            alert('Could not be saved. try again.');
          }
        }
      });
    }
  });
</script>

<script>
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
      editable: true, //permite la modificacion de los eventos del calendario
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

    function edit(event) {
      start = event.start.format('YYYY-MM-DD HH:mm:ss');
      if (event.end) {
        end = event.end.format('YYYY-MM-DD HH:mm:ss');
      } else {
        end = start;
      }
      id = event.id;
      Event = [];
      Event[0] = id;
      Event[1] = start;
      Event[2] = end;
      $.ajax({
        url: 'editEventDate.php',
        type: "POST",
        data: {
          Event: Event
        },
        success: function(rep) {
          if (rep == 'OK') {
            alert('Saved');
          } else {
            alert('Could not be saved. try again.');
          }
        }
      });
    }

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


<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({     
    "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        }
      },
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
</script>
</body>
</html>