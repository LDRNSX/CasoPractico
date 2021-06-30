<?php
require_once '../Modelo/ClasesBaseDatos/BaseDatos.php';

class CRUD extends BaseDatos{
    private $pSQL_C;
    private $pSQL_R;
    private $pSQL_U;
    private $pSQL_D;

    protected function setDatos( $BaseDatos){
        $this->pDatos=$BaseDatos;
    } 

    protected function setSQL_C( $query){
        $this->pSQL_C=$query;
    } 

    protected function setSQL_R( $query){
        $this->pSQL_R=$query;
    } 

    protected function setSQL_U( $query){
        $this->pSQL_U=$query;
    }

    protected function setSQL_D( $query){
        $this->pSQL_D=$query;
    } 
    function __construct($BaseDatos,  $SQL_C = "",  $SQL_R = "",  $SQL_U = "",  $SQL_D = "")
	{
		parent::__construct($BaseDatos);
		if ($SQL_C != "") {
			$this->setSQL_C($SQL_C);
		} // END IF
		if ($SQL_R != "") {
			$this->setSQL_R($SQL_R);
		} // END IF
		if ($SQL_U != "") {
			$this->setSQL_U($SQL_U);
		} // END IF
		if ($SQL_D != "") {
			$this->setSQL_D($SQL_D);
		} // END IF
	} // end of member function __construct

	function agregaRegistro($query = "")
	{
		if ($query != "") {
			$this->setSQL_C($query);
		} // END IF
		$retorno = $this->execute($this->pSQL_C);
		return $retorno;
	} // end of member function agregaRegistro

	function buscaRegistro($query = "")
	{
		if ($query != "") {
			$this->setSQL_R($query);
		} // END IF
		$retorno = $this->getData($this->pSQL_R);
		return $retorno;
	} // end of member function buscaRegistro

	function modificaRegistro($query = "")
	{
		if ($query != "") {
			$this->setSQL_U($query);
		} // END IF
		$retorno = $this->execute($this->pSQL_U);
		return $retorno;
	} // end of member function modificaRegistro

	function eliminaRegistro($query = "")
	{
		if ($query != "") {
			$this->setSQL_D($query);
		} // END IF
		$retorno = $this->execute($this->pSQL_D);
		return $retorno;
	} // end of member function eliminaRegistro

	function listaRegistros($query = "")
	{
		if ($query != "") {
			$this->setSQL_R($query);
		} // END IF
		$retorno = $this->getData($this->pSQL_R);
		return $retorno;
	} // end of member function listaRegistros

	function tablaRegistro($Nombre, $query = "")
	{
		if ($query != "") {
			$this->setSQL_R($query);
		} // END IF
		$retorno = $this->getData($this->pSQL_R);
		$array = array();
		$array[] = ' <table width="100%">' . PHP_EOL;

		foreach ($retorno as $key => $value) {
			// echo '<pre>';
			// var_dump($value);
			// echo '</pre>';
			// die();
			/*
            [0]=>
            array(5) {
                ["IdPersona"]=>
                string(1) "1"
                ["NIFNIE"]=>
                string(9) "11216428H"
                ["Nombre"]=>
                string(6) "Marisa"
                ["Apellidos"]=>
                string(5) "Alvez"
                ["Usuario"]=>
                string(6) "AlvMar"
            }
            */
			if ($key == 0) {
				$array[] = ' <tr>' . PHP_EOL;
				foreach ($value as $cod => $columna) {
					$array[] = ' <th>' . $cod . '</th>' . PHP_EOL;
				}
				$array[] = '<th>Modificar</th>' . PHP_EOL;
				$array[] =  '<th>Eliminar</th>' . PHP_EOL;
				$array[] = ' </tr>' . PHP_EOL;
				$array[] = ' <tr>' . PHP_EOL;
			}

			$identificador = "";
			foreach ($value as $cod => $columna) {
				$array[] = '                    <td>' . $columna . '</td>' . PHP_EOL;
				if ($identificador == "") {
					$identificador = $columna;
				}
			}
			$array[]= '<td><a href="'.$Nombre.'U.php?IdArchivo='.$identificador.'" class="active">Modificar</a></td>' . PHP_EOL;
			$array[]= '<td><a href="'.$Nombre.'D.php?IdArchivo='.$identificador.'" class="active">Eliminar</a></td>' . PHP_EOL;
			$array[] = ' </tr>' . PHP_EOL;
		} // END FOREACH
		$array[] = '</table>' . PHP_EOL;
		return $array;
	}
} // end of CRUD
?>