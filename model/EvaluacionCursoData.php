<?php
class EvaluacionCursoData {
	
	public function EvaluacionCursoData(){
		$this->id = "";
		$this->idTest = "";
		$this->idCurso = "";
		$this->maxTest = "";
		$this->idEvaluacion = "";
		$this->fechaCreacion = "NOW()";
	}

	public function addEvaluacion(){
		$sql = "INSERT INTO tb_test_evaluaciones (ID_ESTUDIANTE, ID_TEST, NUMBER_TEST, CREACION) ";
		$sql .= "VALUES ($this->idEstudiante, $this->idTest, $this->numberTest, $this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public function addRespuestas(){
		$sql = "INSERT INTO tb_test_respuesta (ID_EVALUACION, ID_ALTERNATIVA, TXT_RESPUESTA, IN_PUNTAJE, CREACION) ";
		$sql .= "VALUES ($this->idEvaluacion, $this->idAlternativa, '$this->txtRepuesta', $this->inPuntaje, $this->fechaCreacion)";
		Executor::doit($sql);
	}
	
	public function deleteRespuestas(){
		$sql = "DELETE FROM tb_test_respuesta ";
		$sql .= "WHERE ID_EVALUACION = $this->idEvaluacion";
		Executor::doit($sql);
	}

	public function deleteEvaluacion(){
		$sql = "DELETE FROM tb_test_evaluaciones ";
		$sql .= "WHERE ID = $this->idEvaluacion";
		Executor::doit($sql);
	}

	public static function getIdEvaluacion($idEstudiante, $numberTest, $idTest){
		$sql = "SELECT ID FROM tb_test_evaluaciones WHERE ID_ESTUDIANTE = $idEstudiante AND NUMBER_TEST = $numberTest AND ID_TEST = $";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionCursoData());
	}

	public static function getRespuesta($idEvaluacion, $idAlternativa){
		$sql = "SELECT ID, TXT_RESPUESTA, IN_PUNTAJE FROM tb_test_respuesta WHERE ID_EVALUACION = $idEvaluacion AND ID_ALTERNATIVA = $idAlternativa";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionCursoData());
	}

	public static function getAllTest(){
		$sql = "SELECT ID, proper(NOMBRE_TEST) as NOMBRE_TEST FROM tb_test ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EvaluacionCursoData());
	}

	public static function getMaxTest($idTest){
		$sql = "SELECT MAX_TEST FROM tb_test WHERE ID = $idTest";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionCursoData());
	}

	//Cantidad de Test que realiza el estudiante
	public static function getQuestTest($idEstudiante, $idTest){
		$sql = "SELECT COUNT(ID_ESTUDIANTE) AS QUEST_TEST FROM tb_test_evaluaciones WHERE ID_ESTUDIANTE = $idEstudiante AND ID_TEST = $idTest";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionCursoData());
	}

	public static function getQuestPts($idTest){
		$sql = "SELECT SUM(PUNTAJE_ALTERNATIVA) as PUNTAJE_TEST FROM tb_test_alternativa INNER JOIN tb_test_pregunta ON ID_PREGUNTA = tb_test_pregunta.ID WHERE ID_TEST_PREGUNTA = $idTest";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionCursoData());
	}

}

?>