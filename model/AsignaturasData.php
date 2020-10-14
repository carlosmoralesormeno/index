<?php
class AsignaturasData {
	public static $tablename = "tb_asignaturas";

	public function AsignaturasData(){
		
	}

	public static function getAll($curso){
		$sql = 
		"SELECT COD_ASIGNATURA_NOTA_ASIGNATURA_CURSO, proper(NOMBRE_ASIGNATURA) as NOMBRE_ASIGNATURA, ORDEN_NOTA_ORDEN_ASIGNATURA_CURSO, TIPO_ASIGNATURA, CONCEPTO_ASIGNATURA
		FROM ".self::$tablename."
		INNER JOIN tb_notas_asignaturas_cursos ON COD_ASIGNATURA_NOTA_ASIGNATURA_CURSO = COD_ASIGNATURA
		WHERE COD_CURSO_NOTA_ASIGNATURA_CURSO = $curso
		ORDER BY ORDEN_NOTA_ORDEN_ASIGNATURA_CURSO"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new AsignaturasData());
	}

	public static function getAllEvaluacion(){
		$sql = 
		"SELECT COD_ASIGNATURA, proper(NOMBRE_ASIGNATURA) as NOMBRE_ASIGNATURA
		FROM tb_asignaturas
		ORDER BY NOMBRE_ASIGNATURA"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new AsignaturasData());
	}


}

?>