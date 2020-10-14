<?php
class PersonasData {

	public function PersonasData(){
	}
	public static function getAllPersonas(){
		$sql = 
		"SELECT RUN_PERSONA, proper(CONCAT(A_PATERNO_PERSONA,' ', A_MATERNO_PERSONA,' ',NOMBRES_PERSONA)) AS NOMBRE_PERSONA
		FROM tb_personas
		ORDER BY A_PATERNO_PERSONA, A_PATERNO_PERSONA, NOMBRES_PERSONA"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new PersonasData());
	}

}


?>