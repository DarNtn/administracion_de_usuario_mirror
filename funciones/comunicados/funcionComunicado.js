$(document).ready(function() {
  //        $('#edito_txt').Editor();
  $(".summernote").summernote({
    height: 300
  });
  $("#correoPersonal").submit(function(e) {
    e.preventDefault();
    var texto = $(".summernote").val();
    var parametros = {
      correo: $("#correo").val(),
      contenido: texto,
      seleccion: $("#seleccion").val()
    };
    return false;
  });
});

window.Vue.use(window.VeeValidate);
let App = new Vue({
  el: "#app",
  data: function() {
    return {
      plantillas: [],
      plantilla: "",
      correo: ""
    };
  },
  created: function() {
    this.HTTP = axios.create({
      baseURL: "funciones/plantillas/plantillasControllador.php"
    });
    this.obtenerTodas();
  },
  computed: {},
  methods: {
    truncate(value, limit) {
      if (value.length > limit) {
        value = value.substring(0, limit - 3) + "...";
      }
      return value;
    },
    obtenerTodas(evt) {
      let self = this;
      this.HTTP.get("/plantillas").then(function(resp) {
        self.plantillas = resp.data.data.mensaje;
      });
    },
    plantillaSeleccionada(plantilla) {
      $("#contents").summernote("editor.pasteHTML", this.plantilla.plantilla);
    },
    enviar() {
      var plantilla = $("#contents").summernote("code");
      var correo = this.correo;
      var asunto = this.plantilla.asunto;
      axios
        .post("funciones/comunicados/comunicadoControlador.php/enviar", {
          plantilla,
          correo,
          asunto
        })
        .then(function(resp) {
          swal({
            type: resp.data.data.estado,
            title: "...",
            text: resp.data.data.mensaje
          });
        });
    }
  }
});
