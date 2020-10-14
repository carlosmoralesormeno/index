<?php
class CursosData {
	
	public function CursosData(){
		
	}

	public function getUnit(){ return UnitData::getById($this->unit_id);}

	public static function getAll(){
		$sql = 
		"SELECT 
		tb_cursos.ID_CURSO,
		ID_ENSENANZA_REG,
		ID_CURSO_REG,
		proper(NOMBRE_CURSO) as NOMBRE_CURSO,
		NOMBRE_LETRA,
        ID_LETRA_REG,
		(SELECT COUNT(COD_ALUMNO) FROM nlibroregistro WHERE RETIRADO = 0 AND COD_CUR_MINED_AL = ID_CURSO_REG AND LETRA_CUR_ALUM = ID_LETRA_REG) AS TOTAL_MATRICULA
		FROM
		tb_cursos
		INNER JOIN tipos_cursos 
		ON tipos_cursos.ID_CURSO = ID_CURSO_REG
        INNER JOIN letras_cursos
        on ID_LETRA_REG = COD_LETRA
		ORDER BY ID_ENSENANZA_REG, ID_CURSO_REG, ID_LETRA_REG
		";
		$query = Executor::doit($sql);
		return Model::many($query[0],new CursosData());
	}

	public static function getByIdCurso($idCurso){
		$sql = 
		"SELECT ID_CURSO_REG, ID_LETRA_REG FROM tb_cursos WHERE ID_CURSO = $idCurso";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CursosData());
	}

	public static function getNombreById($idCurso){
		$sql = 
		"SELECT proper(NOMBRE_CURSO) as NOMBRE_CURSO FROM tipos_cursos WHERE ID_CURSO = $idCurso";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CursosData());
	}

	public static function getLetraById($idLetra){
		$sql = 
		"SELECT NOMBRE_LETRA FROM letras_cursos WHERE COD_LETRA = $idLetra";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CursosData());
	}

	public static function getCursoById($id){
		$sql = 
		"SELECT CONCAT(proper(NOMBRE_CURSO),' ',NOMBRE_LETRA) AS NOMBRE_CURSO
		FROM tb_cursos
		INNER JOIN tipos_cursos ON tipos_cursos.ID_CURSO = tb_cursos.ID_CURSO_REG
		INNER JOIN letras_cursos ON COD_LETRA = ID_LETRA_REG
		WHERE tb_cursos.ID_CURSO = $id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CursosData());
	}

}

?>