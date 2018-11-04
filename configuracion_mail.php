<?php
include_once('header.php');
?>
<link href="assets/css/extra.css" rel="stylesheet" type="text/css"/>

<style>
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