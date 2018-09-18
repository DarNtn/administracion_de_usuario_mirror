
function validar_clave(cla1,cla2) {
var caract_invalido = " ";
var caract_longitud = 6;
if (cla1 == '' || cla2 == '') {
swal('Mensaje','Debes introducir tu clave en los dos campos.','error');
return false;
}else
if (cla1.length < caract_longitud) {
swal('Mensaje','Tu clave debe constar de ' + caract_longitud + ' caracteres.','error');
return false;
}else
if (cla1.indexOf(caract_invalido) > -1) {
swal('Mensaje','Las claves no pueden contener espacios','error');
return false;
}
else {
if (cla1 != cla2) {
swal('Mensaje','Las claves introducidas no son iguales','error');
return false;
}
else {
return true;
      }
   }
}
