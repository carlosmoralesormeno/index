<?php
class RegistroData {
	public static $tablename = "nlibroregistro";

	public function RegistroData(){
		//Declarar en caso de guardar algo
	}

	public static function getCurso($curso, $letra){
		$anoEstablecimiento = "2020-01-01";

		$sql = 
		"SELECT COD_INSCRIPCION, COD_REGISTRO_ESC, ORDEN_LIBRO_CLASE, NUM_MATR, RUN_INSCRIPCION, DV_INSCRIPCION, ABREV_GENERO, FNAC_INCRIPCION, (YEAR(('$anoEstablecimiento'))-YEAR(FNAC_INCRIPCION))- (RIGHT(('$anoEstablecimiento'),5)<RIGHT(FNAC_INCRIPCION,5)) as EDAD, 
		NOMBR_ENSENANZA, lower(CONCAT(NOMBRE_CURSO,' ', NOMBRE_LETRA)) AS CURSOEST, FECHA_INGRESO, FECHA_RETIRO, PREMATR, RETIRADO, 
		ALUMNO_NUEVO, proper(APAT_INSCRIPCION) as APAT_INSCRIPCION , proper(AMAT_INSCRIPCION) as AMAT_INSCRIPCION, proper(NOMBRE_INSCRIPCION) as NOMBRE_INSCRIPCION, proper(DIRECCION_INSCRIPCION) as DIRECCION_INSCRIPCION, TELEFONO_INSCRIPCION, CELULAR_INSCRIPCION 
		From ninscripcion, ".self::$tablename.", ngenero, tipos_ensenanza, tipos_cursos, letras_cursos
		Where COD_INSCRIPCION = ".self::$tablename.".Cod_Alumno 
		AND SEXO_INCRIPCION = COD_GENERO 
		AND COD_ENS_ALUM = COD_ID
		AND COD_CUR_MINED_AL = ID_CURSO
		AND LETRA_CUR_ALUM = COD_LETRA
		and COD_CUR_MINED_AL = $curso
		and LETRA_CUR_ALUM = $letra
		order by ORDEN_LIBRO_CLASE"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new RegistroData());
	}

	public static function getCursoActives($curso, $letra, $idTest){
		$anoEstablecimiento = "2020-01-01";

		$sql = 
		"SELECT COD_INSCRIPCION, COD_REGISTRO_ESC, ORDEN_LIBRO_CLASE, NUM_MATR, RUN_INSCRIPCION, DV_INSCRIPCION, ABREV_GENERO, FNAC_INCRIPCION, (YEAR(('$anoEstablecimiento'))-YEAR(FNAC_INCRIPCION))- (RIGHT(('$anoEstablecimiento'),5)<RIGHT(FNAC_INCRIPCION,5)) as EDAD, 
		NOMBR_ENSENANZA, lower(CONCAT(NOMBRE_CURSO,' ', NOMBRE_LETRA)) AS CURSOEST, FECHA_INGRESO, FECHA_RETIRO, PREMATR, RETIRADO, 
		ALUMNO_NUEVO, proper(APAT_INSCRIPCION) as APAT_INSCRIPCION , proper(AMAT_INSCRIPCION) as AMAT_INSCRIPCION, proper(NOMBRE_INSCRIPCION) as NOMBRE_INSCRIPCION, proper(DIRECCION_INSCRIPCION) as DIRECCION_INSCRIPCION, TELEFONO_INSCRIPCION, CELULAR_INSCRIPCION,
		(SELECT ID FROM tb_test_cursos_estudiante WHERE ID_ESTUDIANTE = COD_REGISTRO_ESC AND ID_TEST_CURSO = $idTest) AS ID_TEST 
		From ninscripcion, ".self::$tablename.", ngenero, tipos_ensenanza, tipos_cursos, letras_cursos
		Where COD_INSCRIPCION = ".self::$tablename.".Cod_Alumno 
		AND SEXO_INCRIPCION = COD_GENERO 
		AND COD_ENS_ALUM = COD_ID
		AND COD_CUR_MINED_AL = ID_CURSO
		AND LETRA_CUR_ALUM = COD_LETRA
		and COD_CUR_MINED_AL = $curso
		and LETRA_CUR_ALUM = $letra
		and RETIRADO = 0
		order by ORDEN_LIBRO_CLASE"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new RegistroData());
	}

	public static function getRegistro(){
		$anoEstablecimiento = "2020-01-01";

		$sql = 
		"SELECT COD_INSCRIPCION, COD_REGISTRO_ESC, ORDEN_LIBRO_CLASE, NUM_MATR, RUN_INSCRIPCION, DV_INSCRIPCION, ABREV_GENERO, FNAC_INCRIPCION, (YEAR(('$anoEstablecimiento'))-YEAR(FNAC_INCRIPCION))- (RIGHT(('$anoEstablecimiento'),5)<RIGHT(FNAC_INCRIPCION,5)) as EDAD, 
		NOMBR_ENSENANZA, CONCAT(proper(NOMBRE_CURSO),' ', NOMBRE_LETRA) AS CURSOEST, FECHA_INGRESO, FECHA_RETIRO, PREMATR, RETIRADO, 
		ALUMNO_NUEVO, proper(APAT_INSCRIPCION) as APAT_INSCRIPCION , proper(AMAT_INSCRIPCION) as AMAT_INSCRIPCION, proper(NOMBRE_INSCRIPCION) as NOMBRE_INSCRIPCION, proper(DIRECCION_INSCRIPCION) as DIRECCION_INSCRIPCION, TELEFONO_INSCRIPCION, CELULAR_INSCRIPCION 
		From ninscripcion, ".self::$tablename.", ngenero, tipos_ensenanza, tipos_cursos, letras_cursos
		Where COD_INSCRIPCION = ".self::$tablename.".Cod_Alumno 
		AND SEXO_INCRIPCION = COD_GENERO 
		AND COD_ENS_ALUM = COD_ID
		AND COD_CUR_MINED_AL = ID_CURSO
		AND LETRA_CUR_ALUM = COD_LETRA
		order by COD_ENS_ALUM, NUM_MATR, APAT_INSCRIPCION, AMAT_INSCRIPCION, NOMBRE_INSCRIPCION"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new RegistroData());
	}

	public static function getCumpleanos(){
	
		$sql = "SELECT CONCAT(proper(NOMBRE_INSCRIPCION),' ',proper(APAT_INSCRIPCION),' ',proper(AMAT_INSCRIPCION)) AS NOMBRE, 
		CONCAT(proper(NOMBRE_CURSO),'  ', NOMBRE_LETRA) AS CURSO
		FROM ninscripcion
		INNER JOIN nlibroregistro ON COD_ALUMNO = COD_INSCRIPCION
		INNER JOIN tipos_cursos ON ID_CURSO = COD_CUR_MINED_AL
		INNER JOIN letras_cursos ON COD_LETRA = LETRA_CUR_ALUM
		WHERE day(FNAC_INCRIPCION)= DAY(NOW())
		AND month(FNAC_INCRIPCION)= MONTH(NOW())
		AND RETIRADO = 0";
		$query = Executor::doit($sql);
		return Model::many($query[0],new RegistroData());
	}

	public static function getEstudianteRUT($run){
	
		$sql = "SELECT COD_INSCRIPCION, RUN_INSCRIPCION from ninscripcion where RUN_INSCRIPCION = $run";
		$query = Executor::doit($sql);
		return Model::one($query[0],new RegistroData());
	}

	public static function getCantidadCurso($curso, $letra){
		
		$sql = 
		"SELECT 
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename.", ninscripcion WHERE COD_ALUMNO = COD_INSCRIPCION AND SEXO_INCRIPCION = 0 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS HOMBRES,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename.", ninscripcion WHERE COD_ALUMNO = COD_INSCRIPCION AND SEXO_INCRIPCION = 1 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS MUJERES,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS TOTAL_MATRICULA,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE PREMATR = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS INGRESO,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE PREMATR = 1 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS INICIAL,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE RETIRADO = 1 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS RETIRO,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS MAT_REAL,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE PREMATR = 2 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS VALIDACION,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND JUNAEB = 1 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS JUNAEB,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND CHILE_SOLIDARIO = 1 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS CH_SOL,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND RELIGION_AL = 1 AND RELIGION_OP = 0 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS CATOLICA,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND RELIGION_AL = 1 AND RELIGION_OP = 1 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS EVANGELICA,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND RELIGION_AL = 1 AND RELIGION_OP = 2 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS OTRA_RELIGION,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND RELIGION_AL = 0 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS NO_OPTA,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename.", ninscripcion WHERE COD_ALUMNO = COD_INSCRIPCION AND ALUMNO_NUEVO = 1 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS NUEVO,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND SEP = 2 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS AL_SPR,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND SEP = 1 AND RETIRADO = 0 AND COD_CUR_MINED_AL = $curso AND LETRA_CUR_ALUM = $letra) AS AL_SEP
		";
		$query = Executor::doit($sql);
		return Model::one($query[0],new RegistroData());
	}

	public static function getCantidadRegistro(){
		
		$sql = 
		"SELECT 
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename.", ninscripcion WHERE COD_ALUMNO = COD_INSCRIPCION AND SEXO_INCRIPCION = 0 AND RETIRADO = 0 ) AS HOMBRES,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename.", ninscripcion WHERE COD_ALUMNO = COD_INSCRIPCION AND SEXO_INCRIPCION = 1 AND RETIRADO = 0 ) AS MUJERES,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE RETIRADO = 0 ) AS TOTAL_MATRICULA,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE PREMATR = 0 ) AS INGRESO,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE PREMATR = 1 ) AS INICIAL,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE RETIRADO = 1 ) AS RETIRO,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." ) AS MAT_REAL,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename." WHERE PREMATR = 2 ) AS VALIDACION,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND JUNAEB = 1 AND RETIRADO = 0 ) AS JUNAEB,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND CHILE_SOLIDARIO = 1 AND RETIRADO = 0 ) AS CH_SOL,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND RELIGION_AL = 1 AND RELIGION_OP = 0 AND RETIRADO = 0 ) AS CATOLICA,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND RELIGION_AL = 1 AND RELIGION_OP = 1 AND RETIRADO = 0 ) AS EVANGELICA,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND RELIGION_AL = 1 AND RELIGION_OP = 2 AND RETIRADO = 0 ) AS OTRA_RELIGION,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND RELIGION_AL = 0 AND RETIRADO = 0 ) AS NO_OPTA,
		(SELECT COUNT(COD_ALUMNO) FROM ".self::$tablename.", ninscripcion WHERE COD_ALUMNO = COD_INSCRIPCION AND ALUMNO_NUEVO = 1 AND RETIRADO = 0 ) AS NUEVO,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND SEP = 2 AND RETIRADO = 0 ) AS AL_SPR,
		(SELECT COUNT(".self::$tablename.".COD_ALUMNO) FROM ".self::$tablename.", nbeneficios WHERE ".self::$tablename.".COD_ALUMNO = nbeneficios.COD_ALUMNO AND SEP = 1 AND RETIRADO = 0 ) AS AL_SEP
		";
		$query = Executor::doit($sql);
		return Model::one($query[0],new RegistroData());
	}

	public static function getRegistroEstudiante($idRegistro){

		$sql = 
		"SELECT
		COD_REGISTRO_ESC,
		COD_ALUMNO,
		NUM_MATR,
		COD_ENS_ALUM ,
		COD_CUR_MINED_AL,
		LETRA_CUR_ALUM,
		FECHA_INGRESO,
		RETIRADO,
		FECHA_RETIRO,
		PREMATR,
		ORDEN_LIBRO_CLASE,
		SITUACION_FINAL_NOTA,
		ASISTENCIA_ALUMNO_FINAL,
		PROMEDIO_FINAL_ALUMNO,
		ESTUDIANTE_PENDIENTE
		FROM ".self::$tablename."
		WHERE COD_REGISTRO_ESC = $idRegistro		
		 ";
		$query = Executor::doit($sql);
		return Model::one($query[0],new RegistroData());
	}


}

?>