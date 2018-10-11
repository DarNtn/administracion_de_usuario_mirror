use administracion_colegio;
describe alumno;
select * from alumno;
select * from datos_medicos;
select * from generos;
select * from lugares;

INSERT INTO datos_medicos VALUES(1,22,'$tipoD','$cedula', 5);
INSERT INTO alumno VALUES('$cedula', '$nombres', '$apellidos', 0, '', '2018-02-22', 0, '', '2018-02-22', '', 0, 0, '', '', 0, 0);

# Get alumnos
                                
select 

alumno.cedula, alumno.nombres, alumno.apellidos, alumno.direccion, alumno.fecha_nacimiento, alumno.foto_direccion, alumno.observacion, alumno.certificado_direccion, alumno.pension, 
generos.sexo,
lugares.provincia, lugares.ciudad,
estados.nombre, 
instituciones.nombre,
cursos.nombre, 
datos_medicos.tiene_discapacidad, datos_medicos.porcentaje_discapacidad, tipo_discapacidad,
grupo_sanguineo.nombre

from alumno alumno, generos generos, lugares lugares, estados estados, instituciones instituciones, cursos cursos, datos_medicos datos_medicos, grupo_sanguineo grupo_sanguineo
where alumno.genero_id=generos.genero_id and alumno.cedula=datos_medicos.alumnos_cedula and alumno.instituciones_id=instituciones.institucion_id and alumno.lugar_id=lugares.lugar_id and datos_medicos.idgrupo_sanguineo=grupo_sanguineo.idgrupo_sanguineo;
