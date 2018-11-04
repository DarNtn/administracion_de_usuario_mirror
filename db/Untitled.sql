
SELECT  alumno.*,
                    generos.*,
                    datos_medicos.tiene_discapacidad, datos_medicos.porcentaje_discapacidad, tipo_discapacidad,
                    grupo_sanguineo.idgrupo_sanguineo as 'grupo_sanguineo_id'
            FROM    alumno alumno, datos_medicos datos_medicos, grupo_sanguineo grupo_sanguineo
            WHERE   alumno.cedula=datos_medicos.alumnos_cedula and 
                    datos_medicos.idgrupo_sanguineo=grupo_sanguineo.idgrupo_sanguineo and 
                    alumno.cedula = '0930703707' and generos.genero_id=1;