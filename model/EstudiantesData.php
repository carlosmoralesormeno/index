<?php
class EstudiantesData {
	public static $tablename = "ninscripcion";

	public function EstudiantesData(){
		
	}

	public static function getEstudianteById($id){
		$sql = 
		"SELECT COD_REGISTRO_ESC, proper(CONCAT(APAT_INSCRIPCION,' ',AMAT_INSCRIPCION,' ' ,NOMBRE_INSCRIPCION)) AS NOMBRE FROM nlibroregistro INNER JOIN ninscripcion ON COD_ALUMNO = COD_INSCRIPCION WHERE COD_REGISTRO_ESC = $id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ApoderadosData());
	}

	public static function getDatosEstudiante($id){
		$sql = 
		"SELECT 
		RUN_INSCRIPCION,
		DV_INSCRIPCION,
		proper(APAT_INSCRIPCION) AS APAT_INSCRIPCION,
		proper(AMAT_INSCRIPCION) AS AMAT_INSCRIPCION,
		proper(NOMBRE_INSCRIPCION) AS NOMBRE_INSCRIPCION ,
		proper(NOMBRE_GENERO) AS NOMBRE_GENERO,
		FNAC_INCRIPCION,
		proper(NOMBRE_NACIONALIDAD) AS NOMBRE_NACIONALIDAD,
		nombre_ciudad,
		proper(DIRECCION_INSCRIPCION) AS DIRECCION_INSCRIPCION,
		TELEFONO_INSCRIPCION,
		CELULAR_INSCRIPCION,
		proper(NOMBRE_ESTADO_CIVIL) AS NOMBRE_ESTADO_CIVIL,
		lower(CORREO_INSCRIPCION) AS CORREO_INSCRIPCION,
		ALUMNO_MATRICULADO,
		ALUMNO_PREMATRICULA,
		ALUMNO_NUEVO,
		ALUMNO_IMAGEN
		FROM ".self::$tablename."
		INNER JOIN ngenero ON SEXO_INCRIPCION = COD_GENERO
		INNER JOIN mt_estado_civil ON ESTADOCIVIL_INSCRIPCION = COD_ECIVIL
		INNER JOIN mt_estado_nacionalidad ON NAC_INSCRIPCION = COD_NACIONALIDAD
		INNER JOIN nciudades ON COD_COMUNA = cod_ciudad
		WHERE COD_INSCRIPCION = $id
		"
		;
		$query = Executor::doit($sql);
		return Model::one($query[0],new EstudiantesData());
	}

	public static function getDatosAdicionalesEstudiante($id){
		$sql = 
		"SELECT
		(SELECT AFIRMACION FROM mt_estado_afirmacion WHERE JUNAEB = ID) AS JUNAEB,
		(SELECT AFIRMACION FROM mt_estado_afirmacion WHERE CHILE_SOLIDARIO = ID) AS CHILE_SOLIDARIO,
		(SELECT ESTADO_SEP FROM mt_estado_sep WHERE SEP = ID) AS SEP,
		(SELECT AFIRMACION FROM mt_estado_afirmacion WHERE INTEGRACION = ID) AS INTEGRACION,
		(SELECT AFIRMACION FROM mt_estado_afirmacion WHERE EMBARAZO = ID) AS EMBARAZO,
		(SELECT AFIRMACION FROM mt_estado_afirmacion WHERE REPITIENTE = ID) AS REPITIENTE,
		(SELECT NOMBRE_ORIG_INDIGENA FROM mt_estado_origen_indigena WHERE INDIGENA = ID) AS INDIGENA,
		ENFERMEDADES_ALUMNO,
		(SELECT PROBLEMA_SALUD FROM mt_estado_salud WHERE PROBLEMAS_ALUMNO = ID) AS PROBLEMAS_ALUMNO,
		(SELECT SECTOR_RESIDENCIA FROM mt_estado_residencia WHERE ARURAL = ID) AS ARURAL,
		DISTANCIA,
		HINGRESO_AL,
		HSALIDA_AL,
		DUNICO_AL,
		NDUNICO_AL,
		RELIGION_AL,
		COLACION3,
		(SELECT proper(NOMBRE_ALUMNO_VIVE) as NOMBRE_ALUMNO_VIVE FROM mt_estado_estudiante_vive WHERE VIVE_ALUMNO = ID) AS VIVE_ALUMNO,
		RELIGION_OP
		FROM nbeneficios
		WHERE COD_ALUMNO = $id
		"
		;
		$query = Executor::doit($sql);
		return Model::one($query[0],new EstudiantesData());
	}

	public static function getEstudiante($idCurso, $idLetra){
		$sql = 
		"SELECT ORDEN_LIBRO_CLASE, RETIRADO, COD_REGISTRO_ESC, proper(CONCAT(APAT_INSCRIPCION,' ', AMAT_INSCRIPCION,' ' , NOMBRE_INSCRIPCION)) AS NOMBRE, ASISTENCIA_ALUMNO_FINAL, ESTUDIANTE_PENDIENTE, RUN_INSCRIPCION
		FROM ninscripcion 
		INNER JOIN nlibroregistro ON COD_INSCRIPCION = COD_ALUMNO
		AND COD_CUR_MINED_AL = $idCurso
		AND LETRA_CUR_ALUM = $idLetra
		ORDER BY ORDEN_LIBRO_CLASE
		"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new EstudiantesData());
	}

	public static function getCurso($idEstudiante){
		$sql = 
		"SELECT COD_CUR_MINED_AL, LETRA_CUR_ALUM
		FROM nlibroregistro 
		WHERE COD_REGISTRO_ESC = $idEstudiante
		"
		;
		$query = Executor::doit($sql);
		return Model::one($query[0],new EstudiantesData());
	}
	


}


?>