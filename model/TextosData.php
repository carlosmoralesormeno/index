<?php
class TextosData {
	
	public function TextosData(){
		$this->id = "";
		$this->idPregunta = "";
		$this->txtTexto = "";
		$this->fechaCreacion = "NOW()";
	}

	public function add(){
		$sql = "INSERT INTO tb_test_textos (ID_PREGUNTA, TXT_TEXTO, CREADO) ";
		$sql .= "VALUES ($this->idPregunta,'$this->txtTexto',$this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public function update(){
		$sql = "UPDATE tb_test_textos SET TXT_TEXTO = '$this->txtTexto' ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public function delete(){
		$sql = "DELETE from tb_test_textos ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public static function getTexto($idPregunta){
		$sql = "SELECT ID, TXT_TEXTO FROM tb_test_textos WHERE ID_PREGUNTA = $idPregunta";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TextosData());
	}

	public static function getTextoById($idTexto){
		$sql = "SELECT TXT_TEXTO FROM tb_test_textos WHERE ID = $idTexto";
		$query = Executor::doit($sql);
		return Model::one($query[0],new TextosData());
	}

}

?>