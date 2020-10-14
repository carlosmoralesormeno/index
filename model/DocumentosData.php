<?php
class DocumentosData {
	
	public function DocumentosData(){
		$this->id = "";
		$this->textoNombre = "";
		$this->idCurso = "";
		$this->idAsignatura = "";
		$this->atributo = "";
		$this->fecha = "";
		$this->textoObjetivo = "";
		$this->idRUN = "";
		$this->fileExtension = "";
		$this->fechaCreacion = "NOW()";
	}

	public function add(){
		$sql = "INSERT INTO tb_document (NOMBRE, OBJETIVO, IDRUN, FILEEXTENSION, CREACION) ";
		$sql .= "VALUES ('$this->textoNombre', '$this->textoObjetivo', $this->idRUN, '$this->fileExtension', $this->fechaCreacion)";
		$idInsert =  Executor::doit($sql);
		return $idInsert;
	}

	public function update(){
		$sql = "UPDATE tb_test_pregunta SET TEXTO_PREGUNTA = '$this->textoPregunta' ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public function delete(){
		$sql = "DELETE from tb_test_pregunta ";
		$sql .= "WHERE ID = $this->id";
		Executor::doit($sql);
	}

	public static function getTestByUser($idRun){
		$sql = "SELECT ID, NOMBRE, OBJETIVO, FILEEXTENSION
		FROM tb_document WHERE IDRUN = $idRun";
		$query = Executor::doit($sql);
		return Model::many($query[0],new DocumentosData());
	}

}

?>