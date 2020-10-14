<?php
class EvaluacionConfigData {
	
	public function EvaluacionConfigData(){
		$this->id = "";
		$this->idTest = "";
		$this->idCurso = "";
		$this->testMax = "";
		$this->idDocente = "";
		$this->idTestConfig = "";
		$this->idEstudiante = "";
		$this->fechaCreacion = "NOW()";
	}

	public function addConfiguracionEva(){
		$sql = "INSERT INTO tb_test_cursos (ID_TEST, ID_CURSO, MAX_TEST, CREACION) ";
		$sql .= "VALUES ($this->idTest, $this->idCurso, $this->testMax, $this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public function addConfiguracionEstudiante(){
		$sql = "INSERT INTO tb_test_cursos_estudiante (ID_TEST_CURSO, ID_ESTUDIANTE, CREACION) ";
		$sql .= "VALUES ($this->idTestConfig, $this->idEstudiante, $this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public function deleteAllConfiguracionEstudiante(){
		$sql = "DELETE FROM tb_test_cursos_estudiante ";
		$sql .= "WHERE ID_TEST_CURSO = $this->idTestConfig";
		Executor::doit($sql);
	}

	public function addConfiguracionPerm(){
		$sql = "INSERT INTO tb_test_permisos (ID_TEST, ID_CURSO, ID_DOCENTE, CREACION) ";
		$sql .= "VALUES ($this->idTest, $this->idCurso, $this->idDocente, $this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public static function getEvaluacionesConfig($idTest){
		$sql = "SELECT ID, tb_cursos.ID_CURSO as IDCURSO, ID_TEST, ID_CURSO_REG, ID_LETRA_REG, CONCAT(proper(NOMBRE_CURSO),' ',NOMBRE_LETRA) AS NOMBRE_CURSO, MAX_TEST
		FROM tb_test_cursos
		INNER JOIN tb_cursos ON tb_cursos.ID_CURSO = tb_test_cursos.ID_CURSO
		INNER JOIN tipos_cursos ON tipos_cursos.ID_CURSO = tb_cursos.ID_CURSO_REG
		INNER JOIN letras_cursos ON COD_LETRA = ID_LETRA_REG
		WHERE ID_TEST = $idTest
		ORDER BY ID DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EvaluacionConfigData());
	}

	public static function getEvaluacionesPerm($idTest, $idCurso){
		$sql = "SELECT ID, tb_cursos.ID_CURSO as IDCURSO, ID_TEST, ID_CURSO_REG, ID_LETRA_REG, CONCAT(proper(NOMBRE_CURSO),' ',NOMBRE_LETRA) AS NOMBRE_CURSO, CONCAT(proper(A_PATERNO_PERSONA),' ',proper(A_MATERNO_PERSONA),' ',proper(NOMBRES_PERSONA)) as NOMBRE_DOCENTE
		FROM tb_test_permisos
		INNER JOIN tb_cursos ON tb_cursos.ID_CURSO = tb_test_permisos.ID_CURSO
		INNER JOIN tipos_cursos ON tipos_cursos.ID_CURSO = tb_cursos.ID_CURSO_REG
		INNER JOIN letras_cursos ON COD_LETRA = ID_LETRA_REG
		INNER JOIN tb_personas on RUN_PERSONA = ID_DOCENTE
		WHERE ID_TEST = $idTest
		AND tb_cursos.ID_CURSO = $idCurso
		ORDER BY ID DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EvaluacionConfigData());
	}
	

	public function updateEvaluacionConfig(){
		$sql = "UPDATE tb_test_cursos SET MAX_TEST = $this->testMax ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public function deleteEvaluacionConfig(){
		$sql = "DELETE FROM tb_test_cursos ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public function deleteEvaluacionPerm(){
		$sql = "DELETE FROM tb_test_permisos ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public static function getEvaluacion($idTest){
		$sql = "SELECT ID, NOMBRE_TEST, OBJETIVO_APRENDIZAJE_TEST, HABILIDADES_TEST
		FROM tb_test
		WHERE ID = $idTest";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionConfigData());
	}

	public function deleteEvaluacion(){
		$sql = "DELETE FROM tb_test ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public function deletePreguntas(){
		$sql = "DELETE FROM tb_test_pregunta ";
		$sql .= "WHERE ID_TEST_PREGUNTA = $this->id";
		Executor::doit($sql);
	}

}

?>