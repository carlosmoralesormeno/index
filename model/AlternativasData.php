<?php
class AlternativasData {
	
	public function AlternativasData(){
		$this->idPregunta = "";
		$this->idAlternativa = "";
		$this->textoAlternativa = "";
		$this->puntajeAlternativa ="";
		$this->fechaCreacion = "NOW()";
	}

	public function add(){
		$sql = "INSERT INTO tb_test_alternativa (ID_PREGUNTA, TEXTO_ALTERNATIVA, CORRECTA_ALTERNATIVA, CREACION) ";
		$sql .= "VALUES ($this->idPregunta,'$this->textoAlternativa', 0, $this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
	}

	public function updateByIdPregunta(){
		$sql = "UPDATE tb_test_alternativa SET CORRECTA_ALTERNATIVA = 0, PUNTAJE_ALTERNATIVA = 0 WHERE ID_PREGUNTA = $this->idPregunta";
		Executor::doit($sql);
	}

	public function updateAlternativa(){
		$sql = "UPDATE tb_test_alternativa SET CORRECTA_ALTERNATIVA = 1, PUNTAJE_ALTERNATIVA = $this->puntajeAlternativa WHERE ID = $this->idAlternativa";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "UPDATE tb_test_alternativa SET TEXTO_ALTERNATIVA = '$this->textoAlternativa' WHERE ID = $this->idAlternativa";
		Executor::doit($sql);
	}

	public function delete(){
		$sql = "DELETE from tb_test_alternativa WHERE ID = $this->idAlternativa";
		Executor::doit($sql);
	}

	public static function getAlternativaView($idPregunta){
		$sql = "SELECT ID, TEXTO_ALTERNATIVA, CORRECTA_ALTERNATIVA, PUNTAJE_ALTERNATIVA FROM tb_test_alternativa WHERE ID_PREGUNTA = $idPregunta";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlternativasData());
	}

	public static function getAlternativaViewRandom($idPregunta){
		$sql = "SELECT ID, TEXTO_ALTERNATIVA, CORRECTA_ALTERNATIVA, PUNTAJE_ALTERNATIVA FROM tb_test_alternativa WHERE ID_PREGUNTA = $idPregunta ORDER BY RAND()";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlternativasData());
	}

	public static function getAlternativaEdit($idAlternativa){
		$sql = "SELECT ID, TEXTO_ALTERNATIVA FROM tb_test_alternativa WHERE ID = $idAlternativa";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AlternativasData());
	}

}

?>