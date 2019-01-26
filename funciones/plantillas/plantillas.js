// $("body").append("<div id='loading' class='loading'></div>");
// $(".loading").remove();
$(document).ready(function() {
  $(".summernote").summernote({
    height: 300
  });
});

window.Vue.use(window.VeeValidate);
let App = new Vue({
  el: "#app",
  data: function() {
    return {
      form: {
        correo: "",
        clave: ""
      },
      correoActual: "",
      HTTP: {},
      content: ""
    };
  },
  created: function() {
    this.HTTP = axios.create({
      baseURL: "funciones/plantillas/plantillasControllador.php"
    });
    // this.obtenerCorreoActual();
  },
  computed: {},
  methods: {
    enviar(evt) {
      var plantilla = $("#contents").summernote("code");
      var asunto = $("#asunto").val();
      this.HTTP.post("/crear", { plantilla, asunto }).then(function(resp) {
        var estado = resp.data.data.estado;
        if (estado === "success") {
          swal({
            type: "success",
            title: "Bien...",
            text: resp.data.data.mensaje
          });
        } else {
          swal({
            type: "error",
            title: "Oops...",
            text: resp.data.data.mensaje
          });
        }
      });
    }
  }
});

// id;
// asunto;
// fechaCreacion;
// plantilla;
// adminId
