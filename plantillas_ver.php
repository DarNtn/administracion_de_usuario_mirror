<?php
include_once('header.php');
?>
<link href="assets/css/extra.css" rel="stylesheet" type="text/css"/>

<!-- truncar mensaje de html y colocar un boton de ver para colocar en un modal el contenido de la plantilla -->

<style>
</style>

<div class="" id="app">
  <div style="text-align: center; padding-bottom: 10px;">
    <h1>Plantillas</h1>
    <table class="table">
      <thead v-show="plantillas.length !== 0">
        <tr>
          <th>Asunto</th>
          <th>Plantilla</th>
          <!-- <th></th> -->
          <th> </th> 
        </tr>
      </thead>
      <tbody v-for="plantilla in plantillas">
        <tr>
          <td>{{plantilla.asunto}}</td>
          <td v-html="truncate(plantilla.plantilla, 50)"></td>
          <!-- <td style="width: 20px;">
            <b-button variant="primary"  v-on:click="editar(plantilla.id)"><i class="lnr lnr-pencil"></i></b-button>
          </td> -->
          <td style="width: 20px;">
            <b-button variant="danger"  v-on:click="eliminar(plantilla.id)"><i class="lnr lnr-trash"></i></b-button>
          </td>
          <!-- <td>{{mensaje.fecha}}</td> -->
          <!-- <td>
            <b-button variant="danger"  v-on:click="borrarCorreo(mensaje.id)"><i class="lnr lnr-trash"></i></b-button>
          </td> -->

        </tr>
      </tbody>
      <h1 v-show="plantillas.length === 0">Sin resultados</h1>
    </table>
  </div>
</div>

<script src="funciones/plantillas/plantillas_ver.js" type="text/javascript"></script>
<?php
// include_once('footer.php');