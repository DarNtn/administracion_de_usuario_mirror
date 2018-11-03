use administracion_colegio;

describe alumno;
describe estados;
describe documento;

select * from actividad;
select * from adjunto;
select * from administrador;
select * from alumno;
select * from autorizacion;
select * from autorizado;
select * from citacion;
select * from citacion_curso;
select * from citacion_padre;
select * from cursos;
select * from datos_medicos;
select * from detalle_materia;
select * from documento;
select * from estado_civil;
select * from estados;
select * from factura;
select * from generos;
select * from grupo_sanguineo;
select * from horario;
select * from instituciones;
select * from lugares;
select * from materia;
select * from mensaje;
select * from nivel_educacion;
select * from parentesco;
select * from periodo_electivo;
select * from personal;
select * from usuario;

# Insert
INSERT INTO datos_medicos VALUES(1,22,'$tipoD','$cedula', 5);
INSERT INTO alumno VALUES('$cedula', '$nombres', '$apellidos', 0, '', '2018-02-22', 0, '', '2018-02-22', '', 0, 0, '', 0, 0);
insert into documento values('link', 'name', '0930703707');

# Get 
select 
alumno.cedula, alumno.nombres, alumno.apellidos, alumno.direccion, alumno.fecha_nacimiento, alumno.foto_direccion, alumno.observacion, alumno.pension, 
generos.sexo,
lugares.provincia, lugares.ciudad,
estados.nombre as 'estado', 
instituciones.nombre as 'institucion',
cursos.nombre as 'curso', 
datos_medicos.tiene_discapacidad, datos_medicos.porcentaje_discapacidad, tipo_discapacidad,
grupo_sanguineo.nombre as 'grupo_sanguineo'
from alumno alumno, generos generos, lugares lugares, estados estados, instituciones instituciones, cursos cursos, datos_medicos datos_medicos, grupo_sanguineo grupo_sanguineo
where alumno.genero_id=generos.genero_id and alumno.cedula=datos_medicos.alumnos_cedula and alumno.instituciones_id=instituciones.institucion_id and alumno.lugar_id=lugares.lugar_id and datos_medicos.idgrupo_sanguineo=grupo_sanguineo.idgrupo_sanguineo and estados.estado_id=alumno.estado_id;

###########
select estado_id from estados where nombre='Activo';

###########
select 
alumno.*,
datos_medicos.tiene_discapacidad, datos_medicos.porcentaje_discapacidad, tipo_discapacidad,
grupo_sanguineo.idgrupo_sanguineo as 'grupo_sanguineo_id'
from alumno alumno, datos_medicos datos_medicos, grupo_sanguineo grupo_sanguineo
where alumno.cedula=datos_medicos.alumnos_cedula and datos_medicos.idgrupo_sanguineo=grupo_sanguineo.idgrupo_sanguineo and alumno.cedula = '0930703707';

###########
update alumno set cedula='0930703707',nombres='Boscoo',apellidos='Andrade',
genero_id=1,direccion='asdadsa', fecha_nacimiento='2018-01-02',
lugar_id=4, instituciones_id=4, observacion='$observacion'
where cedula='0930703707';

###########
update datos_medicos set alumnos_cedula='0930703707', porcentaje_discapacidad=33,
tipo_discapacidad='fisica', idgrupo_sanguineo=3, tiene_discapacidad=1
where alumnos_cedula='0930703707';

###########
UPDATE alumno SET foto_direccion='$direccion' where cedula='0930703707';