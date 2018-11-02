window.Vue.use(window.VeeValidate)
let App = new Vue({
  el: '#app',
  data: function() {
    return {
      form: {
        correo: '',
        clave: ''
      },
      correoActual: '',
      HTTP: {}
    }
  },
  created: function() {
    this.HTTP = axios.create({
      baseURL: 'funciones/mail/configuracionControlador.php'
    })
    this.obtenerCorreoActual()
  },
  computed: {
  },
  methods: {
    obtenerCorreoActual() {
      let self = this   
      this.HTTP.get('/correo').then(function (resp) {
        var datos = resp.data.data
        self.correoActual = datos['correo']
      })
    },
    guardarCorreoNuevo(evt) {
      evt.preventDefault()
      let correo = this.form.correo
      let clave = this.form.clave
      let self = this
      if (correo.split('@') && correo.split('@')[1] !== 'gmail.com') {
        swal({
          type: 'error',
          title: 'Oops...',
          text: 'El correo no es válido, debe ser de gmail'
        })
      } else {
        this.HTTP.post('/correo', { correo, clave }).then(function (resp) {
          var datos = resp.data.data
          if (datos['estado'] === 'success') {
            self.correoActual = correo
            swal({
              type: 'success',
              title: 'Bien...',
              text: 'El correo fue cambiado exitosamente'
            })
            self.form.clave = ''
            self.form.correo = ''
          } else {
            swal({
              type: 'error',
              title: 'Oops...',
              text: 'El correo no existe o la clave no es la correcta'
            })
          }
          // self.correoActual = datos['correo']
        })
      }
    },
    actualizarCorreoActual(correo) {
      this.correoActual = correo
    }
  }
})

/*
TODO: rollback si el correo no es valido
TODO: loader mientras confirma correo
*/