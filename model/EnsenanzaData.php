<?php
class EnsenanzaData {
	public static $tablename = "tipos_ensenanza";
	
	public function EnsenanzaData(){
		
	}

	public static function getAll(){
		$sql = 
		"SELECT COD_ID, lower(NOMBR_ENSENANZA) as NOMBR_ENSENANZA FROM ".self::$tablename."";
		$query = Executor::doit($sql);
		return Model::many($query[0],new EnsenanzaData());
	}


}

?>