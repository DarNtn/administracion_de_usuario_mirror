window.Vue.use(window.VeeValidate);
Vue.filter("truncate", function(value, limit) {
  if (value.length > limit) {
    value = value.substring(0, limit - 3) + "...";
  }

  return value;
});
let App = new Vue({
  el: "#app",
  data: function() {
    return {
      plantillas: []
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
    eliminar(id) {
      let self = this;
      this.HTTP.post("/eliminar", { id }).then(function(resp) {
        self.plantillas = self.plantillas.filter(plantilla => {
          return plantilla.id !== id;
        });
        swal({
          type: "success",
          title: "Eliminado...",
          text: "Eliminado correctamente"
        });
      });
    },
    editar(evt) {
      let self = this;
      this.HTTP.get("/plantillas").then(function(resp) {
        self.plantillas = resp.data.data.mensaje;
      });
    }
  }
});
