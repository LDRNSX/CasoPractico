<?php
require_once '../Modelo/CRUD.php';

class rutas extends CRUD {
    protected $IdRuta;
    protected $Ruta; 
    const BASEDATOS = "archivos";
	const TABLA = "rutas";

    function getIdRuta(){
		return $this->IdRuta;
	} 	
	function setIdRuta( $query){
		$this->IdRuta=$query;
	} 
	
	function getRuta(){
		return $this->Ruta;
	} 
	function setRuta( $query){
		$this->Ruta=$query;
    }

    function __construct($IdRuta = "",  $Ruta = "")
	{
		parent::__construct(self::BASEDATOS);
		if($IdRuta != "") {
			$this->setIdRuta($IdRuta);
		} // END IF
		if($Ruta != "") {
			$this->setRuta($Ruta);
		} // END IF
    }

    function agregaRuta()
	{
		$query = "INSERT INTO " . self::TABLA . " (Ruta) VALUES ('".$this->Ruta."')";
		return parent::agregaRegistro( $query);
	} // end of member function agregaRegistro

	function buscaRuta($codigo = "")
	{
		$query = "SELECT * FROM " . self::TABLA . ";";
		if ($codigo ==""){
			$query .= "WHERE IdRuta =" . $this->IdRuta . ";";
		}else{
			if ( $codigo != ""){
				$query .= "WHERE IdRuta =" . $codigo . ";";
			}
			
		}
		return parent::buscaRegistro($query);
	} // end of member function buscaRegistro

	 function modificaRuta()
	{
		$query = "UPDATE " . self::TABLA . " SET Ruta='".$this->Ruta."'	WHERE IDRuta = ".$this->IdRuta.";";
		return parent::modificaRegistro( $query);
	} // end of member function modificaRegistro

	 function eliminaRuta()
	{
		$query = "DELETE FROM " . self::TABLA . " WHERE IdRuta = ".$this->IdRuta.";";
		return parent::eliminaRegistro( $query);
	} // end of member function eliminaRegistro

	 function listaRuta()
	{	
		$query = "SELECT * FROM " . self::TABLA . ";";
		return parent::listaRegistros( $query );
	} // end of member function listaRegistros
	
	 function tablaRuta($Nombre){
		$query = "SELECT * FROM " . self::TABLA . ";";
		return parent::tablaRegistro($Nombre, $query);
	
    }
}
?>