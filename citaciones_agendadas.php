<?php
include_once('header.php');
?>
<link href="assets/css/extra.css" rel="stylesheet" type="text/css"/>


<div class="" id="app">
<h1>Citaciones</h1>
    <table class="table">
      <thead v-show="citaciones.length !== 0">
        <tr>
          <th>Curso</th>
          <th>Asunto</th>
          <th>Materia</th>
          <th>Fecha</th>
          <th>Hora</th>
          <!-- <th></th> -->
          <th> </th> 
        </tr>
      </thead>
      <tbody v-for="citacion in citaciones">
        <tr>
          <td>{{citacion.curso_nombre}}</td>
          <td>{{citacion.asunto}}</td>
          <td>{{citacion.materia}}</td>
          <td>{{citacion.fecha}}</td>
          <td>{{citacion.hora}}</td>
        </tr>
      </tbody>
      <h1 v-show="citaciones.length === 0">Sin resultados</h1>
    </table>
</div>

<script src="funciones/citaciones/citaciones.js" type="text/javascript"></script>
<?php
include_once('footer.php');