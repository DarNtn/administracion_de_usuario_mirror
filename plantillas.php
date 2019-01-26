<?php
include_once('header.php');
?>
<script src="Plugins/EditorJquery/summernote.min.js" type="text/javascript"></script>
<link href="Plugins/EditorJquery/summernote.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/extra.css" rel="stylesheet" type="text/css"/>

<style>
</style>

<div class="" id="app">
  <div style="text-align: center; padding-bottom: 10px;">
    <h1>Nueva plantilla</h1>
    <div style="    margin: 15px">
      
      <!-- <label for="asunto" style="margin-left: 10px;s">Nombre de la plantilla</label> -->
      <input type="text" id="asunto" class="form-control" placeholder="Asunto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
    </div>
    <b-button id="enviar" variant="primary" v-on:click="enviar">Enviar</b-button>
  </div>
  <textarea name="contenido" class="summernote" id="contents" title="Contents"></textarea><br>
</div>

<script src="funciones/plantillas/plantillas.js" type="text/javascript"></script>
<?php
include_once('footer.php');