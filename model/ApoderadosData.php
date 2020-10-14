<?php
class ApoderadosData {
	public static $tablename = "napoderados";

	public function ApoderadosData(){
		
	}

	public static function getDatosApoderado($id){
		$sql = 
		"SELECT 
		RUN_INSCRIPCION,
		DV_INSCRIPCION,
		APAT_INSCRIPCION,
		AMAT_INSCRIPCION,
		NOMBRE_INSCRIPCION,
		NOMBRE_GENERO,
		FNAC_INCRIPCION,
		NOMBRE_NACIONALIDAD,
		nombre_ciudad,
		DIRECCION_INSCRIPCION,
		TELEFONO_INSCRIPCION,
		CELULAR_INSCRIPCION,
		NOMBRE_ESTADO_CIVIL,
		CORREO_INSCRIPCION,
		ALUMNO_MATRICULADO,
		ALUMNO_PREMATRICULA,
		ALUMNO_NUEVO,
		ALUMNO_IMAGEN
		FROM napoderados
		INNER JOIN ngenero ON SEXO_INCRIPCION = COD_GENERO
		INNER JOIN mt_estado_civil ON ESTADOCIVIL_INSCRIPCION = COD_ECIVIL
		INNER JOIN mt_nacionalidad ON NAC_INSCRIPCION = COD_NACIONALIDAD
		INNER JOIN nciudades ON COD_COMUNA = cod_ciudad
		WHERE COD_INSCRIPCION = $id
		"
		;
		$query = Executor::doit($sql);
		return Model::one($query[0],new ApoderadosData());
	}

	public static function getEstudiante($run){
		$sql = 
		"SELECT
		ORDEN_LIBRO_CLASE, RETIRADO, COD_REGISTRO_ESC, proper(CONCAT(APAT_INSCRIPCION,' ', AMAT_INSCRIPCION,' ' , NOMBRE_INSCRIPCION)) AS NOMBRE, ASISTENCIA_ALUMNO_FINAL, ESTUDIANTE_PENDIENTE, RUN_INSCRIPCION, COD_CUR_MINED_AL
		FROM nlibroregistro
		INNER JOIN ninscripcion ON COD_ALUMNO = COD_INSCRIPCION
		INNER JOIN nasig_apoderado ON COD_ALUMNO = COD_ALUMNO_AP
		INNER JOIN napoderado ON COD_APODERADO_ALUM = COD_APODERADO
		WHERE RUN_APODERADO = $run"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ApoderadosData());
	}

}

?>