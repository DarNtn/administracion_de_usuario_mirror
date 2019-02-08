window.Vue.use(window.VeeValidate);
let App = new Vue({
  el: "#app",
  data: function() {
    return {
      form: {
        correo: "",
        clave: ""
      },
      citaciones: "",
      HTTP: {},
      content: ""
    };
  },
  created: function() {
    this.HTTP = axios.create({
      baseURL: "funciones/citaciones/citacionesControllador.php"
    });
    this.obtener();
  },
  computed: {},
  methods: {
    obtener(evt) {
      // citaciones
      let self = this;
      this.HTTP.get("/citaciones").then(function(resp) {
        self.citaciones = resp.data.data.mensaje;
      });
    }
  }
});
