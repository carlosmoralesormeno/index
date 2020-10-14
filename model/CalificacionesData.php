<?php
class CalificacionesData {
	public static $tablename = "tb_notas_alumno";
	
	public function CalificacionesData(){
		$this->id = "";
		$this->idEstudiante = "";
		$this->idSemestre = "";
		$this->idColumna = "";
		$this->idAsignatura = "";
		$this->nota = "";
		$this->idCurso = "";
		$this->idLetra = "";
		$this->idInsUp = "";

	}

	public static function getAll($idEstudiante, $semestre){
		$sql = 
		"SELECT
		COD_ASIGNATURA_ALUMNO_NOTA,
		COLUMNA_ALUMNO_NOTA,
		SEMESTRE_ALUMNO_NOTA,
		NOTA_ALUMNO_NOTA
		FROM
		".self::$tablename."
		WHERE COD_REG_ALUMNO_NOTA = $idEstudiante
		AND SEMESTRE_ALUMNO_NOTA = $semestre;"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CalificacionesData());
	}

	public static function getByAsignatura($idCurso, $idLetra, $idAsignatura, $idSemestre){
		$sql = 
		"SELECT
		ORDEN_LIBRO_CLASE,
		COD_REGISTRO_ESC,
		COLUMNA_ALUMNO_NOTA,
		ID_NOTA_ALUMNO,
		NOTA_ALUMNO_NOTA
		FROM tb_notas_alumno
		INNER JOIN nlibroregistro ON COD_REG_ALUMNO_NOTA = COD_REGISTRO_ESC
		WHERE COD_CUR_MINED_AL = $idCurso
		AND LETRA_CUR_ALUM = $idLetra
		AND COD_ASIGNATURA_ALUMNO_NOTA = $idAsignatura
		AND SEMESTRE_ALUMNO_NOTA = $idSemestre"
		;
		$query = Executor::doit($sql);
		return Model::many($query[0],new CalificacionesData());
	}

	public function add(){
		$sql = "INSERT INTO ".self::$tablename." (COD_REG_ALUMNO_NOTA, SEMESTRE_ALUMNO_NOTA, COLUMNA_ALUMNO_NOTA, COD_ASIGNATURA_ALUMNO_NOTA, NOTA_ALUMNO_NOTA, TOKEN_NOTA) ";
		$sql .= "VALUES ($this->idEstudiante,$this->idSemestre,$this->idColumna,$this->idAsignatura,$this->nota,0)";
		$idInsert =  Executor::doit($sql);
	}

	public function update(){
		$sql = "UPDATE ".self::$tablename." SET NOTA_ALUMNO_NOTA = $this->nota ";
		$sql .= "WHERE ID_NOTA_ALUMNO = $this->id";
		Executor::doit($sql);
	}

	public function delete(){
		$sql = "DELETE FROM ".self::$tablename." ";
		$sql .= "WHERE ID_NOTA_ALUMNO = $this->id";
		Executor::doit($sql);
	}

	//Reparar esta función para que ingrese un RBD
	public static function getNota($idEstudianteA, $idColumnaA, $idAsignaturaA, $idSemestreA){
		$sql = "SELECT ID_NOTA_ALUMNO, NOTA_ALUMNO_NOTA FROM tb_notas_alumno ";
		$sql .= "WHERE COD_REG_ALUMNO_NOTA = $idEstudianteA AND COLUMNA_ALUMNO_NOTA = $idColumnaA AND COD_ASIGNATURA_ALUMNO_NOTA = $idAsignaturaA AND SEMESTRE_ALUMNO_NOTA = $idSemestreA";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CalificacionesData());
	}

}

?>