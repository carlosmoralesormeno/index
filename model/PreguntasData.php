<?php
class PreguntasData {
	
	public function PreguntasData(){
		$this->id = "";
		$this->prueba = "";
		$this->textoPregunta = "";
		$this->tipoPregunta = "";
		$this->fechaCreacion = "NOW()";
	}

	public function add(){
		$sql = "INSERT INTO tb_test_pregunta (ID_TEST_PREGUNTA, TEXTO_PREGUNTA, TIPO_PREGUNTA, CREACION) ";
		$sql .= "VALUES ($this->prueba,'$this->textoPregunta',$this->tipoPregunta, $this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public function update(){
		$sql = "UPDATE tb_test_pregunta SET TEXTO_PREGUNTA = '$this->textoPregunta', TIPO_PREGUNTA = $this->tipoPregunta ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public function delete(){
		$sql = "DELETE from tb_test_pregunta ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public function deleteAllAlternativas(){
		$sql = "DELETE from tb_test_alternativa WHERE ID_PREGUNTA = $this->id";
		Executor::doit($sql);
	}

	public static function getPreguntasRandom($idTest){
		$sql = "SELECT ID, ID_TEST_PREGUNTA, TEXTO_PREGUNTA, TIPO_PREGUNTA
		FROM tb_test_pregunta WHERE ID_TEST_PREGUNTA = $idTest ORDER BY RAND()";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PreguntasData());
	}

	public static function getPreguntas($idTest){
		$sql = "SELECT ID, ID_TEST_PREGUNTA, TEXTO_PREGUNTA, TIPO_PREGUNTA
		FROM tb_test_pregunta WHERE ID_TEST_PREGUNTA = $idTest";
		$query = Executor::doit($sql);
		return Model::many($query[0],new PreguntasData());
	}

	public static function getPreguntasView($idPregunta){
		$sql = "SELECT ID, ID_TEST_PREGUNTA, TEXTO_PREGUNTA, TIPO_PREGUNTA FROM tb_test_pregunta WHERE ID = $idPregunta";
		$query = Executor::doit($sql);
		return Model::one($query[0],new PreguntasData());
	}

}

?>