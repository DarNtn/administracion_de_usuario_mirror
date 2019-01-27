<?php
include_once('header.php');
?>
<link href="Plugins/EditorJquery/summernote.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/extra.css" rel="stylesheet" type="text/css"/>

<div id="app">
  <!-- Inicio del Cabecera-->
  <div class="panel" style="background: #50BFE6">
      <div class="panel-heading" style="color: white">

          <div class="row">

              <div class="col-md-2">
                  <center><img src="assets/img/email.png" class="img-profile img-polaroid" width="70" height="65"></center>
              </div>
              <div class="col-md-8">
                  <center><h3>Notificaciones</h3></center>
              </div>
          </div>
      </div>
  </div>
  <!-- Fin del Cabecera-->
  <!-- Inicio del Comunicado-->
  <form id="correoPersonal" style="max-width: 100%">
      <input name="correo" id="correo" v-model="correo" class="form-control" style="max-width: 100%;" placeholder="Correo electronico. Ejemplo: Ejemplo@gmail.com"><br>
      <label for="">Asunto</label>
      <select id="seleccion" name="seleccion" class="form-control" v-model="plantilla" v-on:change="plantillaSeleccionada()">
          <option  v-for="plantilla in plantillas" v-bind:value="plantilla" >{{plantilla.asunto}}</option>
          <!-- <option value="todos">Todos los representantes activos del período</option> -->
      </select><br>
      <textarea name="contenido" class="summernote" id="contents" title="Contents"></textarea><br>
      <button type="submit" class="btn btn-block btn-info" v-on:click="enviar()">Enviar</button>
  </form>
  <!-- Fin del Comunicado-->
</div>
<script src="Plugins/EditorJquery/summernote.min.js" type="text/javascript"></script>
<script src="funciones/comunicados/funcionComunicado.js" type="text/javascript"></script>
<?php
include_once('footer.php');
