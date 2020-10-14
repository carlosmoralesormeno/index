<?php
class UsuariosData {
	
	public function UsuariosData(){
	
	}

	public static function getUsuario($run, $type){

		switch ($type){
			case 1: 
				$sql = "SELECT proper(NOMBRE_INSCRIPCION) AS NOMBRE_USUARIO, proper(APAT_INSCRIPCION) AS APELLIDO_USUARIO
				FROM ninscripcion INNER JOIN nlibroregistro ON COD_ALUMNO = COD_INSCRIPCION 
				WHERE RUN_INSCRIPCION = $run";
			
			break;
			case 2: 
				$sql = "SELECT proper(NOMBRES_PERSONA) AS NOMBRE_USUARIO, proper(A_PATERNO_PERSONA) AS APELLIDO_USUARIO
				FROM tb_personas 
				WHERE RUN_PERSONA = $run";
			break;
			case 3: 
				$sql = "SELECT proper(NOMBRES_APODERADO) AS NOMBRE_USUARIO, proper(APATERNO_APODERADO) AS APELLIDO_USUARIO
				FROM napoderado 
				WHERE RUN_APODERADO = $run";
			break;
		}

		$query = Executor::doit($sql);
		return Model::one($query[0],new UsuariosData());
		
	}

}

?>