</section><! --/wrapper -->
</section><!-- /MAIN CONTENT -->

</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery-3.2.1.min.js"></script>    

<script>

</script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>
<!--external script for all pages-->
<script src="Plugins/gritter/js/jquery.gritter.js" type="text/javascript" ></script>
<script src="Plugins/gritter/gritter-conf.js" type="text/javascript" ></script>
<script src="Plugins/full_calendar/js/moment.min.js" type="text/javascript"></script>
<script src="Plugins/full_calendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="Plugins/full_calendar/js/locale-all.js" type="text/javascript"></script>
<script src="Plugins/SweetAlert2/js/sweetalert2.min.js" type="text/javascript"></script>
<script src="Plugins/DataTables-1.10.15/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="Plugins/DataTables-1.10.15/media/js/dataTables.uikit.min.js" type="text/javascript"></script>
<script src="Plugins/DataTables-1.10.15/inicializar.js" type="text/javascript"></script>
<!--end external script for all pages-->
<script src="funciones/inicio_calendario/calendario.js" type="text/javascript"></script>
<script src="funciones/peticiones/peticiones.js" type="text/javascript"></script>
<script src="funciones/header/header.js" type="text/javascript"></script>
<script src="funciones/personal/personal.js" type="text/javascript"></script>
<script src="Plugins/DataTables-1.10.15/media/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
<script src="Plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
		
$("#opacidad").on('change click',function(){
$("#cantidad").text($("#opacidad").val());
$(".fc-content-skeleton > table > tbody").css('opacity',($("#opacidad").val()/100));

});

$(".fc-header-toolbar").on("click",function(){
setTimeout(function(){

console.log('a');
  $("#cantidad").text($("#opacidad").val());
$(".fc-content-skeleton > table > tbody").css('opacity',($("#opacidad").val()/100));

 }, 100);
});

		
		
		
        var pagina = $("#pagina").val();
        $("." + pagina).addClass("active");

    $('#tblPeticion_filter label input[type=search]').val($('#tipoNotificacionUsuaio').val()).trigger($.Event("keyup", {keyCode: 13}));
        return false;
    });
</script>


</body>
</html>