<?php
class ResolucionData {
	
	public function ResolucionData(){
		$this->id = "";
		$this->idPregunta = "";
		$this->txtResolucion = "";
		$this->fechaCreacion = "NOW()";
	}

	public function add(){
		$sql = "INSERT INTO tb_test_resolucion (ID_PREGUNTA, TXT_RESOLUCION, CREADO) ";
		$sql .= "VALUES ($this->idPregunta,'$this->txtResolucion',$this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public function update(){
		$sql = "UPDATE tb_test_resolucion SET TXT_RESOLUCION = '$this->txtResolucion' ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public function delete(){
		$sql = "DELETE from tb_test_resolucion ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public static function getResolucion($idPregunta){
		$sql = "SELECT ID, TXT_RESOLUCION FROM tb_test_resolucion WHERE ID_PREGUNTA = $idPregunta";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ResolucionData());
	}

	public static function getResolucionById($idResolucion){
		$sql = "SELECT TXT_RESOLUCION FROM tb_test_resolucion WHERE ID = $idResolucion";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ResolucionData());
	}

}

?>