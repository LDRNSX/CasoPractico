<?php
require_once '../Modelo/CRUD.php';

class personas extends CRUD{
	public $IdPersona;
	public $NIFNIE;
	public $Nombre;
	public $Apellidos;
	public $Usuario;
	const BASEDATOS = "archivos";
	const TABLA = "personas";
	
	function getIdPersona(){
		return $this->IdPersona;
	} 
	
	 function setIdPersona( $query){
		$this->IdPersona=$query;
	} 
	
	function getNIFNIE(){
		return $this->NIFNIE;
	} 
	
	 function setNIFNIE( $query){
		$this->NIFNIE=$query;
	}
	
	function getNombre(){
		return $this->Nombre;
	} 

	 function setNombre( $query){
		$this->Nombre=$query;
	}
	
	function getApellidos(){
		return $this->Apellidos;
	} 

	 function setApellidos( $query){
		$this->Apellidos=$query;
	}
	
	function getUsuario(){
		return $this->Usuario;
	} 

	 function setUsuario( $query){
		$this->Usuario=$query;
	}
	
	 function __construct($IdPersona = "",  $NIFNIE = "",  $Nombre = "",  $Apellidos = "", $Usuario= "")
	{
		parent::__construct(self::BASEDATOS);
		if($IdPersona != "") {
			$this->setIdPersona($IdPersona);
		} // END IF
		if($NIFNIE != "") {
			$this->setNIFNIE($NIFNIE);
		} // END IF
		if($Nombre != "") {
			$this->setNombre($Nombre);
		} // END IF
		if($Apellidos !="") {
			$this->setApellidos($Apellidos);
		} // END IF
		if($Usuario !="") {
			$this->setUsuario($Usuario);
		} // END IF
	} // end of member function __construct
	
	function agregaDatos()
	{
		$query = "INSERT INTO " . self::TABLA . " (NIFNIE, Nombre, Apellidos, Usuario) VALUES ('".$this->NIFNIE."', '".$this->Nombre."', '".$this->Apellidos."', '".$this->Usuario."')";
		return parent::agregaRegistro( $query);
	} // end of member function agregaRegistro

	function buscaDatos($codigo = "", $NIF = "")
	{
		$query = "SELECT * FROM personas ";
		if ($codigo =="" && $NIF == ""){
			$query .= "WHERE IdPersona =" . $this->IdPersona . ";";
		}else{
			if ( $codigo != ""){
				$query .= "WHERE IdPersona =" . $codigo . ";";
			}else{
				if ($NIF != ""){
				$query .= "WHERE NIFNIE ='".$NIF."';";
				}else{
					$query .= "WHERE NIFNIE ='".$this->NIFNIE."';";
				}
			}
		}
		return parent::buscaRegistro($query);
	} // end of member function buscaRegistro

	 function modificaDatos()
	{
		$query = "UPDATE " . self::TABLA . " SET Nombre='".$this->Nombre."', Apellidos='".$this->Apellidos."',	NIFNIE='".$this->NIFNIE."',	Usuario='".$this->Usuario."'	WHERE IdPersona = ".$this->IdPersona.";";
		return parent::modificaRegistro( $query);
	} // end of member function modificaRegistro

	 function eliminaDatos()
	{
		$query = "DELETE FROM " . self::TABLA . " WHERE IdPersona = ".$this->IdPersona.";";
		return parent::eliminaRegistro( $query);
	} // end of member function eliminaRegistro

	 function listaDatos()
	{
		$query = "SELECT * FROM " . self::TABLA . ";";
		return parent::listaRegistros( $query );
	} // end of member function listaRegistros
	
	 function tablaDatos($Nombre){
		$query = "SELECT * FROM " . self::TABLA . ";";
		return parent::tablaRegistro($Nombre, $query);
	
    }
}

?>