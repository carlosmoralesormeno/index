<?php
class EvaluacionesData {
	
	public function EvaluacionesData(){
		$this->idEstudiante = "";
		$this->idTest = "";
		$this->numberTest = "";
		$this->idEvaluacion = "";
		$this->idAlternativa = "";
		$this->txtRepuesta = "";
		$this->inPuntaje = 0;
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

	public static function getIdEvaluacion($idEstudiante, $numberTest, $idTest){
		$sql = "SELECT ID FROM tb_test_evaluaciones WHERE ID_ESTUDIANTE = $idEstudiante AND NUMBER_TEST = $numberTest AND ID_TEST = $idTest";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionesData());
	}

	public static function getRespuesta($idEvaluacion, $idAlternativa){
		$sql = "SELECT ID, TXT_RESPUESTA, IN_PUNTAJE FROM tb_test_respuesta WHERE ID_EVALUACION = $idEvaluacion AND ID_ALTERNATIVA = $idAlternativa";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionesData());
	}

	public static function getAllTest(){
		$sql = "SELECT ID, proper(NOMBRE_TEST) as NOMBRE_TEST FROM tb_test ";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EvaluacionesData());
	}

	public static function getMaxTest($idTest){
		$sql = "SELECT MAX_TEST FROM tb_test WHERE ID = $idTest";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionesData());
	}

	//Cantidad de Test que realiza el estudiante
	public static function getQuestTest($idEstudiante, $idTest){
		$sql = "SELECT COUNT(ID_ESTUDIANTE) AS QUEST_TEST FROM tb_test_evaluaciones WHERE ID_ESTUDIANTE = $idEstudiante AND ID_TEST = $idTest";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionesData());
	}

	public static function getQuestPts($idTest){
		$sql = "SELECT SUM(PUNTAJE_ALTERNATIVA) as PUNTAJE_TEST FROM tb_test_alternativa INNER JOIN tb_test_pregunta ON ID_PREGUNTA = tb_test_pregunta.ID WHERE ID_TEST_PREGUNTA = $idTest";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionesData());
	}

	public static function getResultTest($idTest, $idNumberTest, $idCurso, $idLetra){
		$sql = "
			SELECT COD_REGISTRO_ESC, PROPER(CONCAT(APAT_INSCRIPCION,' ', AMAT_INSCRIPCION,' ',NOMBRE_INSCRIPCION)) AS NOMBRE, 
			(
			SELECT COUNT(tb_test_respuesta.ID) FROM tb_test_respuesta
			INNER JOIN tb_test_alternativa ON ID_ALTERNATIVA = tb_test_alternativa.ID
			INNER JOIN tb_test_pregunta ON ID_PREGUNTA = tb_test_pregunta.ID
			INNER JOIN tb_test_evaluaciones ON ID_EVALUACION = tb_test_evaluaciones.ID
			WHERE ID_TEST_PREGUNTA = $idTest
			AND NUMBER_TEST = $idNumberTest
			AND ID_ESTUDIANTE = COD_REGISTRO_ESC
			) AS RESPUESTAS,
			(
			SELECT COUNT(tb_test_respuesta.ID) FROM tb_test_respuesta
			INNER JOIN tb_test_alternativa ON ID_ALTERNATIVA = tb_test_alternativa.ID
			INNER JOIN tb_test_pregunta ON ID_PREGUNTA = tb_test_pregunta.ID
			INNER JOIN tb_test_evaluaciones ON ID_EVALUACION = tb_test_evaluaciones.ID
			WHERE ID_TEST_PREGUNTA = $idTest
			AND NUMBER_TEST = $idNumberTest
			AND ID_ESTUDIANTE = COD_REGISTRO_ESC
			AND TIPO_PREGUNTA = 0
			AND CORRECTA_ALTERNATIVA = 1
			)AS QC,
			(
			SELECT COUNT(tb_test_respuesta.ID) FROM tb_test_respuesta
			INNER JOIN tb_test_alternativa ON ID_ALTERNATIVA = tb_test_alternativa.ID
			INNER JOIN tb_test_pregunta ON ID_PREGUNTA = tb_test_pregunta.ID
			INNER JOIN tb_test_evaluaciones ON ID_EVALUACION = tb_test_evaluaciones.ID
			WHERE ID_TEST_PREGUNTA = $idTest
			AND NUMBER_TEST = $idNumberTest
			AND ID_ESTUDIANTE = COD_REGISTRO_ESC
			AND TIPO_PREGUNTA = 1
			AND IN_PUNTAJE > 0
			)AS QO,
			(
			SELECT SUM(PUNTAJE_ALTERNATIVA) FROM tb_test_respuesta
			INNER JOIN tb_test_alternativa ON ID_ALTERNATIVA = tb_test_alternativa.ID
			INNER JOIN tb_test_pregunta ON ID_PREGUNTA = tb_test_pregunta.ID
			INNER JOIN tb_test_evaluaciones ON ID_EVALUACION = tb_test_evaluaciones.ID
			WHERE ID_TEST_PREGUNTA = $idTest
			AND NUMBER_TEST = $idNumberTest
			AND ID_ESTUDIANTE = COD_REGISTRO_ESC
			AND CORRECTA_ALTERNATIVA = 1
			AND TIPO_PREGUNTA = 0
			) AS PC,
			(
			SELECT SUM(IN_PUNTAJE) FROM tb_test_respuesta
			INNER JOIN tb_test_alternativa ON ID_ALTERNATIVA = tb_test_alternativa.ID
			INNER JOIN tb_test_pregunta ON ID_PREGUNTA = tb_test_pregunta.ID
			INNER JOIN tb_test_evaluaciones ON ID_EVALUACION = tb_test_evaluaciones.ID
			WHERE ID_TEST_PREGUNTA = $idTest
			AND NUMBER_TEST = $idNumberTest
			AND ID_ESTUDIANTE = COD_REGISTRO_ESC
			AND TIPO_PREGUNTA = 1
			) AS PO,
			(SELECT SUM(QC+QO)) AS CORRECTAS,
			(SELECT IFNULL(PC,0)) AS PCNULL,
			(SELECT IFNULL(PO,0)) AS PONULL,
			(SELECT SUM(PCNULL+PONULL)) AS PUNTAJE
			FROM ninscripcion
			INNER JOIN nlibroregistro ON COD_ALUMNO = COD_INSCRIPCION
			WHERE COD_CUR_MINED_AL = $idCurso
			AND LETRA_CUR_ALUM = $idLetra
			HAVING RESPUESTAS > 0

			ORDER BY APAT_INSCRIPCION, AMAT_INSCRIPCION, NOMBRE_INSCRIPCION
		"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new EvaluacionesData());
	}

	public static function getTestEstudiante($idEstudiante, $idCurso, $idLetra){
		$sql = "SELECT tb_test_cursos.ID_TEST AS IDTEST, NOMBRE_TEST, ID_CURSO_REG, ID_LETRA_REG, tb_test_cursos.MAX_TEST AS MAX_TEST_C, 
		(SELECT COUNT(ID_ESTUDIANTE) FROM tb_test_evaluaciones WHERE ID_ESTUDIANTE = $idEstudiante AND ID_TEST = IDTEST) AS TEST_EST,
		(SELECT ID_TEST_CURSO FROM tb_test_cursos_estudiante INNER JOIN tb_test_cursos ON tb_test_cursos.ID = ID_TEST_CURSO WHERE ID_ESTUDIANTE = $idEstudiante AND ID_TEST = IDTEST) AS HABILITADO
		FROM tb_test_cursos
		INNER JOIN tb_test ON tb_test.ID = ID_TEST
		INNER JOIN tb_cursos ON tb_cursos.ID_CURSO = tb_test_cursos.ID_CURSO
		WHERE ID_CURSO_REG = $idCurso
		AND ID_LETRA_REG = $idLetra
		ORDER BY IDTEST"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new EvaluacionesData());
	}

	public static function getTestDocente($idDocente){
		$sql = "SELECT tb_test_permisos.ID_TEST AS IDTEST, NOMBRE_TEST, ID_CURSO_REG, ID_LETRA_REG, tb_test_permisos.ID_CURSO AS IDCURSOP, 
		CONCAT(proper(NOMBRE_CURSO),' ', NOMBRE_LETRA) as NOMBRE_CURSO, tb_test_cursos.MAX_TEST AS MAXTEST
		FROM tb_test_permisos
		INNER JOIN tb_test ON tb_test.ID = ID_TEST
		INNER JOIN tb_cursos ON tb_cursos.ID_CURSO = tb_test_permisos.ID_CURSO
		INNER JOIN tipos_cursos ON ID_CURSO_REG = tipos_cursos.ID_CURSO
		INNER JOIN letras_cursos ON ID_LETRA_REG = COD_LETRA
		INNER JOIN tb_test_cursos ON tb_test_permisos.ID_TEST = tb_test_cursos.ID_TEST
		WHERE tb_test_permisos.ID_CURSO = tb_test_cursos.ID_CURSO
		AND ID_DOCENTE = $idDocente
		ORDER BY IDTEST"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new EvaluacionesData());
	}

}

?>