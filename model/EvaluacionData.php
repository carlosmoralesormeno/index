<?php
class EvaluacionData {
	
	public function EvaluacionData(){
		$this->id = "";
		$this->nombre = "";
		$this->objetivo = "";
		$this->habilidades = "";
		$this->asignatura = "";
		$this->maxTest = 1;
		$this->idRUT = "";
		$this->idTest = "";
		$this->fechaCreacion = "NOW()";
	}

	public function addEvaluacion(){
		$sql = "INSERT INTO tb_test (NOMBRE_TEST, OBJETIVO_APRENDIZAJE_TEST, HABILIDADES_TEST, ASIGNATURA_TEST, MAX_TEST, CREACION) ";
		$sql .= "VALUES ('$this->nombre', '$this->objetivo', '$this->habilidades', $this->asignatura, $this->maxTest, $this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public function addAutor(){
		$sql = "INSERT INTO tb_test_autor (ID_TEST, ID_RUT, CREADO) ";
		$sql .= "VALUES ($this->idTest, $this->idRUT, $this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public static function getEvaluaciones($idRut){
		$sql = "SELECT tb_test_autor.ID, ID_TEST, NOMBRE_TEST, OBJETIVO_APRENDIZAJE_TEST, HABILIDADES_TEST, proper(NOMBRE_ASIGNATURA) as NOMBRE_ASIGNATURA
		FROM tb_test_autor
		INNER JOIN tb_test ON ID_TEST = tb_test.ID
		INNER JOIN tb_asignaturas ON COD_ASIGNATURA = ASIGNATURA_TEST
		WHERE ID_RUT = $idRut
		ORDER BY ID_TEST DESC";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EvaluacionData());
	}

	public static function getEvaluacion($idTest){
		$sql = "SELECT ID, NOMBRE_TEST, OBJETIVO_APRENDIZAJE_TEST, HABILIDADES_TEST, ASIGNATURA_TEST
		FROM tb_test
		WHERE ID = $idTest";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionData());
	}

	public function updateEvaluacion(){
		$sql = "UPDATE tb_test SET NOMBRE_TEST = '$this->nombre',  ASIGNATURA_TEST = $this->asignatura, OBJETIVO_APRENDIZAJE_TEST = '$this->objetivo', HABILIDADES_TEST = '$this->habilidades' ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
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

	public static function getNombreEstudiante($idRegistro){
		$sql = "SELECT proper(CONCAT(NOMBRE_INSCRIPCION,' ', APAT_INSCRIPCION,' ', AMAT_INSCRIPCION)) AS NOMBRE_USUARIO
		FROM ninscripcion INNER JOIN nlibroregistro ON COD_ALUMNO = COD_INSCRIPCION 
		WHERE COD_REGISTRO_ESC = $idRegistro";
		$query = Executor::doit($sql);
		return Model::one($query[0],new EvaluacionData());
	}

	public static function getEvaluacionDocente(){
		$sql = "SELECT ID_RUT,
		CONCAT(proper(A_PATERNO_PERSONA),' ',proper(A_MATERNO_PERSONA),' ',proper(NOMBRES_PERSONA)) as NOMBRE
		FROM tb_test_autor
		INNER JOIN tb_personas ON RUN_PERSONA = ID_RUT
		GROUP BY ID_RUT";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EvaluacionData());
	}

}

?>