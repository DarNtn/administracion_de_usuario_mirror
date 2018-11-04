window.Vue.use(window.VeeValidate)
let App = new Vue({
  el: '#app',
  data: function() {
    return {
      HTTP: {},
      response: false,
      search: '',
      remitente: null,
      fecha: null,
      mensajes: [],
      cargo: false
    }
  },
  created: function() {
    this.HTTP = axios.create({
      baseURL: 'funciones/mail/bandeja.controlador.php'
    })
    this.obtenerCorreos()
  },
  computed: {
    filtrarPorRemitente() {
      let fecha = ''
      if (this.fecha) {
        let [anio, mes, dia] = this.fecha.split('-')
        fecha = `${dia}/${mes}/${anio}`
      }
      return this.mensajes.filter(mensaje => {
        if (this.search) {
          return mensaje.remitente.toLowerCase().includes(this.search)
        } else if (this.fecha) {
          return mensaje.fecha.toLowerCase().includes(fecha)
        } else {
          return mensaje
        }
      })
    }
  },
  methods: {
    borrarCorreo (correoId) {
      let self = this
      self.response = true
      this.HTTP.post('/borrar', { id: correoId }).then(function (resp) {
        var datos = resp.data.data
        if (datos['estado'] === 'error') {
          swal({
            type: 'error',
            title: 'Oops...',
            text: datos.mensaje
          })
        } else {
          self.mensajes = self.mensajes.filter(mensaje => {
            if(mensaje.id !== correoId) {
              return mensaje
            }
          })
          self.response = false
          swal({
            type: 'success',
            title: 'Bien...',
            text: 'El correo fue eliminado'
          })
        }
      })
    },
    obtenerCorreos() {
      let self = this

      // self.cargo = true
      // self.mensajes = [{"id":328,"remitente":"privacy-noreply@policies.google.com","fecha":"14/05/2018","mensaje":"","from":"Google <privacy-noreply@policies.google.com>","subject":"=?UTF-8?Q?Mejoras_a_nuestra_Pol=C3=ADtica_de_Pri?= =?UTF-8?Q?vacidad_y_Controles_de_Privacidad?="},{"id":329,"remitente":"info@mailer.netflix.com","fecha":"14/05/2018","mensaje":"","from":"Netflix <info@mailer.netflix.com>","subject":"Prueba Netflix gratis por 1 mes."},{"id":330,"remitente":"info@mailer.netflix.com","fecha":"03/06/2018","mensaje":"","from":"Netflix <info@mailer.netflix.com>","subject":"=?UTF-8?Q?Comienza_tu_mes_gratis_y_ve_pel=C3=ADcula?= =?UTF-8?Q?s_y_programas_cuando_y_donde_quieras.?="},{"id":331,"remitente":"info@mailer.netflix.com","fecha":"23/06/2018","mensaje":"","from":"Netflix <info@mailer.netflix.com>","subject":"Disfruta Netflix con un mes gratis."},{"id":332,"remitente":"no-reply@accounts.google.com","fecha":"05/07/2018","mensaje":"","from":"Google <no-reply@accounts.google.com>","subject":"Alerta de seguridad"},{"id":333,"remitente":"info@mailer.netflix.com","fecha":"13/07/2018","mensaje":"","from":"Netflix <info@mailer.netflix.com>","subject":"Netflix: 1 mes gratis."},{"id":334,"remitente":"no-reply@accounts.google.com","fecha":"22/07/2018","mensaje":"","from":"Google <no-reply@accounts.google.com>","subject":"=?UTF-8?Q?Ay=C3=BAdanos_a_protegerte:_consejos_de_seguridad_de_Google?="},{"id":335,"remitente":"info@mailer.netflix.com","fecha":"02/08/2018","mensaje":"","from":"Netflix <info@mailer.netflix.com>","subject":"=?UTF-8?Q?Prueba_Netflix_gratis:_programas_?= =?UTF-8?Q?y_pel=C3=ADculas_cuando_y_donde_quieras?="},{"id":336,"remitente":"info@mailer.netflix.com","fecha":"22/08/2018","mensaje":"","from":"Netflix <info@mailer.netflix.com>","subject":"Comienza hoy mismo tu mes gratis de Netflix."},{"id":337,"remitente":"no-reply@accounts.google.com","fecha":"14/10/2018","mensaje":"","from":"Google <no-reply@accounts.google.com>","subject":"Alerta de seguridad importante"},{"id":338,"remitente":"no-reply@accounts.google.com","fecha":"14/10/2018","mensaje":"","from":"Google <no-reply@accounts.google.com>","subject":"Alerta de seguridad"},{"id":339,"remitente":"no-reply@accounts.google.com","fecha":"14/10/2018","mensaje":"","from":"Google <no-reply@accounts.google.com>","subject":"Google APIs Explorer se ha conectado a tu cuenta de Google"},{"id":340,"remitente":"no-reply@accounts.google.com","fecha":"14/10/2018","mensaje":"","from":"Google <no-reply@accounts.google.com>","subject":"Alerta de seguridad importante"},{"id":341,"remitente":"no-reply@accounts.google.com","fecha":"14/10/2018","mensaje":"","from":"Google <no-reply@accounts.google.com>","subject":"Alerta de seguridad importante"},{"id":342,"remitente":"mailer-daemon@googlemail.com","fecha":"16/10/2018","mensaje":"--00000000000044712305785c3b8d\r\nContent-Type: text/plain; charset=\"UTF-8\"\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n\r\n** No se ha encontrado la direcci=C3=B3n **\r\n\r\nTu mensaje no se ha entregado a casa@gmail.com porque no se ha encontrado l=\r\na direcci=C3=B3n o esta no puede recibir correo.\r\n\r\nEncontrar=C3=A1s m=C3=A1s informaci=C3=B3n en el siguiente enlace: https://=\r\nsupport.google.com/mail/?p=3DNoSuchUser\r\n\r\nLa respuesta fue:\r\n\r\nThe email account that you tried to reach does not exist. Please try double=\r\n-checking the recipient's email address for typos or unnecessary spaces. Le=\r\narn more at https://support.google.com/mail/?p=3DNoSuchUser u48-v6sor169216=\r\n36qta.13 - gsmtp\r\n\r\n--00000000000044712305785c3b8d\r\nContent-Type: text/html; charset=\"UTF-8\"\r\nContent-Transfer-Encoding: quoted-printable\r\n\r\n\r\n<html>\r\n<head>\r\n<style>\r\n* {\r\nfont-family:Roboto, \"Helvetica Neue\", Helvetica, Arial, sans-serif;\r\n}\r\n</style>\r\n</head>\r\n<body>\r\n<table cellpadding=3D\"0\" cellspacing=3D\"0\" class=3D\"email-wrapper\" style=3D=\r\n\"padding-top:32px;background-color:#ffffff;\"><tbody>\r\n<tr><td>\r\n<table cellpadding=3D0 cellspacing=3D0><tbody>\r\n<tr><td style=3D\"max-width:560px;padding:24px 24px 32px;background-color:#f=\r\nafafa;border:1px solid #e0e0e0;border-radius:2px\">\r\n<img style=3D\"padding:0 24px 16px 0;float:left\" width=3D72 height=3D72 alt=\r\n=3D\"Icono de error\" src=3D\"cid:icon.png\">\r\n<table style=3D\"min-width:272px;padding-top:8px\"><tbody>\r\n<tr><td><h2 style=3D\"font-size:20px;color:#212121;font-weight:bold;margin:0=\r\n\">\r\nNo se ha encontrado la direcci=C3=B3n\r\n</h2></td></tr>\r\n<tr><td style=3D\"padding-top:20px;color:#757575;font-size:16px;font-weight:=\r\nnormal;text-align:left\">\r\nTu mensaje no se ha entregado a <a style=3D'color:#212121;text-decoration:n=\r\none'><b>casa@gmail.com</b></a> porque no se ha encontrado la direcci=C3=B3n=\r\n o esta no puede recibir correo.\r\n</td></tr>\r\n<tr><td style=3D\"padding-top:24px;color:#4285F4;font-size:14px;font-weight:=\r\nbold;text-align:left\">\r\n<a style=3D\"text-decoration:none\" href=3D\"https://support.google.com/mail/?=\r\np=3DNoSuchUser\">M=C3=81S INFORMACI=C3=93N</a>\r\n</td></tr>\r\n</tbody></table>\r\n</td></tr>\r\n</tbody></table>\r\n</td></tr>\r\n<tr style=3D\"border:none;background-color:#fff;font-size:12.8px;width:90%\">\r\n<td align=3D\"left\" style=3D\"padding:48px 10px\">\r\nLa respuesta fue:<br/>\r\n<p style=3D\"font-family:monospace\">\r\nThe email account that you tried to reach does not exist. Please try double=\r\n-checking the recipient&#39;s email address for typos or unnecessary spaces=\r\n. Learn more at https://support.google.com/mail/?p=3DNoSuchUser u48-v6sor16=\r\n921636qta.13 - gsmtp\r\n</p>\r\n</td>\r\n</tr>\r\n</tbody></table>\r\n</body>\r\n</html>\r\n\r\n--00000000000044712305785c3b8d--","from":"Mail Delivery Subsystem <mailer-daemon@googlemail.com>","subject":"Delivery Status Notification (Failure)"},{"id":343,"remitente":"no-reply@accounts.google.com","fecha":"28/10/2018","mensaje":"","from":"Google <no-reply@accounts.google.com>","subject":"=?UTF-8?Q?Ay=C3=BAdanos_a_protegerte:_consejos_de_seguridad_de_Google?="},{"id":344,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"},{"id":345,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"},{"id":346,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"},{"id":347,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"},{"id":348,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"},{"id":349,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"},{"id":350,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"},{"id":351,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"},{"id":352,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"},{"id":353,"remitente":"darichiliao@gmail.com","fecha":"02/11/2018","mensaje":"","from":"Escuelas <darichiliao@gmail.com>","subject":"Clave y usuario"}]
      this.HTTP.get('/correos').then(function (resp) {
        var datos = resp.data.data
        if (datos['estado'] === 'error') {
          swal({
            type: 'error',
            title: 'Oops...',
            text: datos.mensaje
          })
        } else {
          self.mensajes = datos.mensaje
        }
        self.cargo = true
      })
    }
  }
})


      