<?php
require_once '../Modelo/CRUD.php';

class tipo extends CRUD{
    protected $IdTipoContenido;
    protected $Descripcion; 
    const BASEDATOS = "archivos";
	const TABLA = "`tipos de contenidos`";

    function getIdTipoContenido(){
		return $this->IdTipoContenido;
	} 	
	function setIdTipoContenido( $query){
		$this->IdTipoContenido=$query;
	} 
	
	function getDescripcion(){
		return $this->Descripcion;
	} 
	function setDescripcion( $query){
		$this->Descripcion=$query;
    }

    function __construct($IdTipoContenido = "",  $Descripcion = "")
	{
		parent::__construct(self::BASEDATOS);
		if($IdTipoContenido != "") {
			$this->setIdTipoContenido($IdTipoContenido);
		} // END IF
		if($Descripcion != "") {
			$this->setDescripcion($Descripcion);
		} // END IF
    }

    function agregaTipoContenido()
	{
		$query = "INSERT INTO " . self::TABLA . " (Descripcion) VALUES ('".$this->Descripcion."')";
		return parent::agregaRegistro( $query);
	} // end of member function agregaRegistro

	function buscaTipoContenido($codigo = "")
	{
		$query = "SELECT * FROM " . self::TABLA . ";";
		if ($codigo ==""){
			$query .= "WHERE IdTipoContenido =" . $this->IdTipoContenido . ";";
		}else{
			if ( $codigo != ""){
				$query .= "WHERE IdTipoContenido =" . $codigo . ";";
			}		
		}
		return parent::buscaRegistro($query);
	} // end of member function buscaRegistro

	 function modificaTipoContenido()
	{
		$query = "UPDATE " . self::TABLA . " SET Descripcion='".$this->Descripcion."'	WHERE IdTipoContenido = ".$this->IdTipoContenido.";";
		return parent::modificaRegistro( $query);
	} // end of member function modificaRegistro

	 function eliminaTipoContenido()
	{
		$query = "DELETE FROM " . self::TABLA . " WHERE IdTipoContenido = ".$this->IdTipoContenido.";";
		return parent::eliminaRegistro( $query);
	} // end of member function eliminaRegistro

	 function listaTipoContenido()
	{
		$query = "SELECT * FROM " . self::TABLA . ";";
		return parent::listaRegistros( $query );
	} // end of member function listaRegistros
	
	 function tablaTipoContenido($Nombre){
		$query = "SELECT * FROM " . self::TABLA . ";";
		return parent::tablaRegistro($Nombre, $query);
	
    }
}
?>