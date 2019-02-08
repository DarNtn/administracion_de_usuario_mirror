var calendar;
var fechaActual = new Date().toJSON().slice(0, 10);
$(document).ready(function () {
     eventoActividades = function (start, end, timezone, callback) {
        var parametros = {'opcion': 'listaActividades'};
        $.ajax({
            type: 'POST',
            url: "funciones/actividad/actividadControlador.php", // El script a dónde se realizará la petición.
            data: parametros, // Adjuntar los campos del formulario enviado.
            success: function (data) {
                var datos = [];

                if (data !== null || data !== '') {
                    if (data['data'] !== null && data['data'] !== '') {
                        for (var i = 0; i < data['data'].length; i++) {


                            datos.push({
                                id: data['data'][i]['id_actividad'],
                                title:  data['data'][i]['descripcion'],
                                start: moment(data['data'][i]['fecha_inicio']),
                                end: moment(data['data'][i]['fecha_fin']).add(1, "days"),
                                actividad:data['data'][i]['tipo_actividad'],
                                allDay: true,
                                color: data['data'][i]['color'],
                                description:data['data'][i]['descripcion'] + "<br>" +
                                        "Fecha inicio: " + data['data'][i]['fecha_inicio'] + "<br>" +
                                        "Fecha fin: " + data['data'][i]['fecha_fin'] + "<br>" +
                                        'Total de dias: ' + (moment(data['data'][i]['fecha_fin']).diff(moment(data['data'][i]['fecha_inicio']), 'days') + 1)
                            });
                        }
                    }
                }
                callback(datos);
            }
        });
    }
    
    calendar = $('#calendar').fullCalendar({
        locale: 'es',
        header: {
            left: 'prev,next today',
            center: 'title',
            //right: 'month,agendaWeek,agendaDay'
            right: 'month,agendaWeek,listMonth'
        },
        views: {
            list: {
                //duration: {days: 90},
                listDayAltFormat: 'dddd',
            }
        },
        eventLimit: true, // allow "more" link when too many events
        selectable: true,
        selectHelper: true,
        editable: true,
        eventResize: function (event, delta, revertFunc, jsEvent, ui, view) { // si changement de longueur
            $('#textEditActividad').text(event.title);
            $('#inicioEd').val(event.start.format('YYYY-MM-DD'));
            $('#finEd').val(event.end.subtract(1, "days").format('YYYY-MM-DD'));
            $('#id_actividad').val(event.id);
            $('#ModalEdit').modal('show');
        },
        eventDrop: function (event, delta, revertFunc, jsEvent, ui, view) { // si changement de position
            $('#textEditActividad').text(event.title);
            $('#inicioEd').val(event.start.format('YYYY-MM-DD'));
            $('#finEd').val(event.end.subtract(1, "days").format('YYYY-MM-DD'));
            $('#id_actividad').val(event.id);
            $('#ModalEdit').modal('show');
        },
        events: eventoActividades,
        eventMouseover: function (calEvent, jsEvent) {
            var tooltip = '<div class="tooltipevent" style="width:420px;height:100px;padding-left:10px;padding-top:10px;color:white;background-color:' + calEvent.color + ';position:absolute;z-index:10001;">' + calEvent.description + '</div>';
            $("body").append(tooltip);
            $(this).mouseover(function (e) {
                $(this).css('z-index', 10000);
                $('.tooltipevent').fadeIn('500');
                $('.tooltipevent').fadeTo('10', 1.9);
            }).mousemove(function (e) {
                $('.tooltipevent').css('top', e.pageY + 10);
                $('.tooltipevent').css('left', e.pageX + 20);
            });
        },
        eventMouseout: function (calEvent, jsEvent) {
            $(this).css('z-index', 8);
            $('.tooltipevent').remove();
        },
        select: function (start, end) {
//            var inicioSelected = start.format('YYYY-MM-DD');
//            if (inicioSelected >= fechaActual) {
                var event = {'start': start, 'end': end, 'title': ''};
                llamarModalAdd(event);
//            } else {
//                swal("Mensaje", "No puede seleccionar fechas pasadas!", "error");
//            }

        },
        eventClick: function (calEvent, jsEvent, view) {
            var event = {'id': calEvent.id, 'start': calEvent.start, 'end': calEvent.end, 'title': calEvent.title,'actividad':calEvent.actividad};
//            $('#diasTotal').text("# Días seleccionados: " + fin.diff(inicio, 'days'));
            llamarModalEdit(event);

//            $('#ModalAdd').modal('show');
        }

    });

    function llamarModalEdit(event) {

        $('#myModalLabel').text(event.title);
        $('#id_actividad').val(event.id);
        $('#tipoActividad').val(event.actividad);
        $('#inicioEd').val(event.start.format('YYYY-MM-DD'));
        $('#finEd').val(event.end.subtract(1, "days").format('YYYY-MM-DD'));
        $('#ModalEdit').modal('show');
    }
    function llamarModalAdd(event) {
        $('#inicioAdd').val(event.start.format('YYYY-MM-DD'));
        $('#finAdd').val(event.end.subtract(1, "days").format('YYYY-MM-DD'));
        $('#ModalAdd').modal('show');
    }
    function refreshCalendarActividad() {
        calendar.fullCalendar('removeEventSource', eventoActividades);
        calendar.fullCalendar('addEventSource', eventoActividades);
        calendar.fullCalendar('refetchEventSources', eventoActividades);
        $('#ModalAdd,#ModalEdit').modal('hide');
    }

    $('#btnAdd').on('click', function () {
//        var parametros = {'opcion': 'GuardarAguaje','fecha_inicio':$('#inicioAdd').val(),'fecha_fin':$('#finAdd').val()};
//        console.log(parametros);
        $.ajax({
            type: 'POST',
            url: "funciones/actividad/actividadControlador.php", // El script a dónde se realizará la petición.
            data: $('#formAddActividad').serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data) {

                 if (data['data']['tipo'] === "error") {
                    swal("", data['data']['texto'], data['data']['tipo']);
                } else {
                    swal("", data['data']['texto'], data['data']['tipo']);
                    refreshCalendarActividad();
                }

            },
            error: function (data) {
                alert("Ocurrió un error, intente más tarde.");
            }
        });
    });
    
    $('#btnEditar').on('click', function () {
//        var parametros = {'opcion': 'EditarActividad', 'id_actividad': $('#id_actividad').val(), 'fecha_inicio': $('#inicioEd').val(), 'fecha_fin': $('#finEd').val()};

        $.ajax({
            type: 'POST',
            url: "funciones/actividad/actividadControlador.php", // El script a dónde se realizará la petición.
            data: $('#formEditActividad').serialize(), // Adjuntar los campos del formulario enviado.
            success: function (data) {

                if (data['data']['tipo'] === "error") {
                    swal("", data['data']['texto'], data['data']['tipo']);
                } else {
                    swal("", data['data']['texto'], data['data']['tipo']);
                    refreshCalendarActividad();
                }

            },
            error: function (data) {
                alert("Ocurrió un error, intente más tarde.");
            }
        });
    });

    $('#btnBorrar').on('click', function () {
        var parametros = {'opcion': 'EliminarActividad', 'id_actividad': $('#id_actividad').val(), 'fecha_inicio': $('#inicioEd').val(), 'fecha_fin': $('#finEd').val()};

        $.ajax({
            type: 'POST',
            url: "funciones/actividad/actividadControlador.php", // El script a dónde se realizará la petición.
            data: parametros, // Adjuntar los campos del formulario enviado.
            success: function (data) {

                 if (data['data']['tipo'] === "error") {
                    swal("", data['data']['texto'], data['data']['tipo']);
                } else {
                    swal("", data['data']['texto'], data['data']['tipo']);
                    refreshCalendarActividad();
                }

            },
            error: function (data) {
                alert("Ocurrió un error, intente más tarde.");
            }
        });
    });

});






