var tblAdministradores;
$(document).ready(function() {
  // document.getElementById('ingresarNuevoBoton').click(); // usado para probar el modal
  var column = [];
  // var column = [{
  //         "searchable": false,
  //         "orderable": false,
  //         "targets": 0
  //     },
  //     {
  //         targets: [0],
  //         className: 'mdl-data-table__cell--non-numeric'
  //     }, {
  //         "orderable": false,
  //         "targets": 2,
  //         "visible": false,
  //         "searchable": false
  //     },{
  //         "orderable": false,
  //         "targets": 2
  //     },{
  //         "orderable": false,
  //         "targets": 2
  //     }];//opciones que tendran las columnas en la tabla

  tblAdministradores = inicializartable("#tblAdministradores", column, 0);

  tblAdministradores
    .buttons()
    .container()
    .appendTo("#example_wrapper .col-sm-6:eq(0)");

  tblAdministradores
    .on("order.dt search.dt", function() {
      tblAdministradores
        .column(0, { search: "applied", order: "applied" })
        .nodes()
        .each(function(cell, i) {
          cell.innerHTML = i + 1;
          tblAdministradores.cell(cell).invalidate("dom");
        });
    })
    .draw();

  refreshTablaUsuarios();

  function cargarTablaAdministradores() {
    var parametros = { opcion: "listaAdministradores" };
    $.ajax({
      data: parametros,
      url: "funciones/administradores/administradoresControlador.php",
      type: "POST",
      success: function(data) {
        for (var i = 0; i < data["data"].length; i++) {
          var estado = data["data"][i]["estado_id"];
          tblAdministradores.row
            .add([
              "",
              data["data"][i]["nombre"],
              data["data"][i]["apellido"],
              data["data"][i]["usuario"],
              data["data"][i]["correo"],
              data["data"][i]["cedula"],
              function() {
                if (estado === "1") {
                  return '<span class="label label-success">ACTIVO</span>';
                } else {
                  return '<span class="label label-danger">INACTIVO</span>';
                }
              },
              '<button href="#estado" id="cambiarEstado" type="button" class="btn btn-xs" data-toggle="modal" title="Estado">\
                            <i class="glyphicon glyphicon-off" id=" ' +
                data["data"][i]["usuario_id"] +
                "_" +
                estado +
                '"></i>\
                        </button>',
              '<button href="#editar" id="' +
                data["data"][i]["usuario_id"] +
                "_" +
                data["data"][i]["admin_id"] +
                '" type="button" class="modificar btn btn-warning btn-sm"  data-toggle="modal" title="Modificar"><i class="glyphicon glyphicon-edit" id=" ' +
                data["data"][i]["usuario_id"] +
                "_" +
                data["data"][i]["admin_id"] +
                '"></i></button>'
            ])
            .draw(false);
        }
        modificar();
      }
    });
  }

  function refreshTablaUsuarios() {
    tblAdministradores.clear().draw();
    cargarTablaAdministradores();
  }

  $("#registarAdministrador").submit(function(e) {
    console.log(validarCedula($("#cedula").val()));
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    var data = $("#registarAdministrador").serialize();
    //var fotoRaw = document.getElementById("imgFotografia").src
    //data = data + '&fotoRaw=' + " '" + fotoRaw  +"'"
    //console.log(data)
    $.ajax({
      type: "POST",
      url: "funciones/administradores/administradoresControlador.php", // El script a dónde se realizará la petición.
      data: data, // Adjuntar los campos del formulario enviado.
      // enctype: 'multipart/form-data',
      // contentType: false,
      // processData: false,
      success: function(data) {
        //document.getElementById("imgFotografia").removeAttribute("src")
        refreshTablaUsuarios();
        swal({
          title: "Mensaje",
          text: data["data"]["mensaje"],
          type: data["data"]["estado"],
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Cerrar"
        }).then(function() {
          if (data["data"]["estado"] == "success") {
            document.getElementById("registarAdministrador").reset();
            $("#nuevo").modal("hide");
          }
        });
      }
    });
    // if (validarCedula($("#ced").val())) {
    //   if (validar_clave($("#clave").val(), $("#re-clave").val())) {

    //   }
    // }
    return false; // Evitar ejecutar el submit del formulario.
  });

  function cargarDatosUsuario(id) {
    var parametros = { opcion: "idUsuario", id: id };
    $.ajax({
      data: parametros,
      url: "funciones/administradores/administradoresControlador.php",
      type: "POST",
      success: function(data) {
        console.log(data);
        $("#id").val(data["data"][0]["usuario_id"]);
        $("#usuario").val(data["data"][0]["usuario"]);
        $("#nombre").val(data["data"][0]["nombre"]);
        if (data["data"][0]["estado_id"] == "2") {
          $("#estadoInactivoEd").prop("checked", true);
        } else {
          $("#estadoActivoEd").prop("checked", true);
        }
      }
    });
  }

  // Funcion para cambiar estado de adminsitrador
  $("#tblAdministradores tbody").on("click", "#cambiarEstado", function() {
    var data = $(this)
      .children()
      .attr("id")
      .split("_");
    var usuarioId = data[0];
    var estadoId = data[1];

    var parametros = {
      opcion: "cambiarEstado",
      usuarioId: usuarioId,
      estadoId: estadoId
    };
    $.ajax({
      type: "POST",
      url: "funciones/administradores/administradoresControlador.php",
      data: parametros
    }).always(function() {
      refreshTablaUsuarios();
    });
  });

  function modificar() {
    $(".modificar").on("click", function(event) {
      var id = event.target.id.split("_")[0];
      var parametros = { opcion: "idUsuario", id: id };
      $.ajax({
        data: parametros,
        url: "funciones/administradores/administradoresControlador.php",
        type: "POST",
        success: function(data) {
          $("#usuario_id").val(data["data"][0]["usuario_id"]);
          $("#admin_id").val(data["data"][0]["admin_id"]);
          $("#cedula").val(data["data"][0]["cedula"]);
          $("#usuario").val(data["data"][0]["usuario"]);
          $("#nombre").val(data["data"][0]["nombre"]);
          $("#apellido").val(data["data"][0]["apellido"]);
          $("#correo").val(data["data"][0]["correo"]);
          $("#clave_edit").val(data["data"][0]["clave"]);
          $("#clavecorreo_edit").val(data["data"][0]["clave"]);
          $("#re_clave_edit").val(data["data"][0]["clave"]);
          if (data["data"][0]["estado_id"] == "2") {
            $("#estadoInactivoEd").prop("checked", true);
          } else {
            $("#estadoActivoEd").prop("checked", true);
          }
        }
      });
    });
  }

  $("#inputFotografia").on("input", function() {
    var reader = new FileReader();
    reader.readAsDataURL(event.srcElement.files[0]);
    reader.onload = function() {
      var fileContent = reader.result;
      document.getElementById("imgFotografia").src = fileContent;
    };
  });

  $("#editarAdministrador").submit(function(e) {
    e.preventDefault();
    var data = $("#editarAdministrador").serialize();
    if (validarCedula($("#cedula").val())) {
      if (validar_clave($("#clave_edit").val(), $("#re_clave_edit").val())) {
        $.ajax({
          type: "POST",
          url: "funciones/administradores/administradoresControlador.php",
          data,
          success: function(data) {
            refreshTablaUsuarios();
            swal({
              title: "Mensaje",
              text: data["data"]["mensaje"],
              type: data["data"]["estado"],
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Cerrar"
            }).then(function() {
              if (data["data"]["estado"] == "success") {
                $("#editar").modal("hide");
              }
            });
          }
        });
      }
    }
    return false; // Evitar ejecutar el submit del formulario.
  });
});
