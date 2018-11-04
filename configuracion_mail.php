<?php
include_once('header.php');
?>
<link href="assets/css/extra.css" rel="stylesheet" type="text/css"/>

<style>
.loader {
  font-size: 10px;
  margin: 50px auto;
  text-indent: -9999em;
  width: 11em;
  height: 11em;
  border-radius: 50%;
  background: #8606d6;
  background: -moz-linear-gradient(left, #8606d6 10%, rgba(134,6,214, 0) 42%);
  background: -webkit-linear-gradient(left, #8606d6 10%, rgba(134,6,214, 0) 42%);
  background: -o-linear-gradient(left, #8606d6 10%, rgba(134,6,214, 0) 42%);
  background: -ms-linear-gradient(left, #8606d6 10%, rgba(134,6,214, 0) 42%);
  background: linear-gradient(to right, #8606d6 10%, rgba(134,6,214, 0) 42%);
  position: relative;
  -webkit-animation: load3 1.4s infinite linear;
  animation: load3 1.4s infinite linear;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
}
.loader:before {
  width: 50%;
  height: 50%;
  background: #8606d6;
  border-radius: 100% 0 0 0;
  position: absolute;
  top: 0;
  left: 0;
  content: '';
}
.loader:after {
  background: #ebf5f5;
  width: 75%;
  height: 75%;
  border-radius: 50%;
  content: '';
  margin: auto;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}
@-webkit-keyframes load3 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes load3 {
  0% {
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}


</style>

<div class="container" id="app">
  <h3>Correo actual: {{ correoActual }}</h3>
  <b-form @submit="guardarCorreoNuevo">
    <b-form-group id="exampleInputGroup1"
                    label="Correo: "
                    label-for="exampleInput1"
                    description="Solo se aceptan correos de GMAIL">
      <b-form-input id="exampleInput1"
                    type="email"
                    v-model="form.correo"
                    required
                    v-validate="{ required: true, email: true, regex: /[0-9]+/ }"
                    placeholder="Ingrese el correo">
      </b-form-input>
    </b-form-group>
    <b-form-group id="claveGroup"
                    label="Clave: "
                    label-for="claveGroupInput"
                    >
      <b-form-input id="claveGroupInput"
                    type="password"
                    v-model="form.clave"
                    required
                    placeholder="Ingrese la clave del correo">
      </b-form-input>
    </b-form-group>
    <b-button type="submit" variant="primary">Enviar</b-button>
    <!-- <div class="loader">Loading...</div> -->
  </b-form>
</div>

<script src="funciones/mail/mailconfiguration.js" type="text/javascript"></script>
<?php
include_once('footer.php');