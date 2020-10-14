<?php
class RespuestasData {
	
	public function RespuestasData(){
		$this->idRespuesta = "";
		$this->idPuntaje = "";
	}

	public function updateByIdRespuesta(){
		$sql = "UPDATE tb_test_respuesta SET IN_PUNTAJE = $this->idPuntaje WHERE ID = $this->idRespuesta";
		Executor::doit($sql);
	}

}

?>