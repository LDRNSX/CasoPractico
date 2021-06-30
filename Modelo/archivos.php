<?php
require_once '../Modelo/CRUD.php';

class archivos extends CRUD{
    protected $IdArchivo;
    protected $Ruta;
    protected $NombreArchivo;
    protected $Tamano;
    protected $Persona;
    protected $FCrea;
    protected $FMod;
    protected $Tipo;
	protected $TipoTexto;
	protected $RutaTexto;
	protected $NombreTexto;
    const BASEDATOS = "archivos";
	const TABLA = "archivos";

	function getIdArchivo(){
		return $this->IdArchivo;
	} 	
	 function setIdArchivo( $query){
		$this->IdArchivo=$query;
	} 
	
	function getRuta(){
		return $this->Ruta;
	} 
	 function setRuta( $query){
		$this->Ruta=$query;
	}
	
	function getNombreArchivo(){
		return $this->NombreArchivo;
	} 
	 function setNombreArchivo( $query){
		$this->NombreArchivo=$query;
	}
	
	function getTamano(){
		return $this->Tamano;
	} 
	 function setTamano( $query){
		$this->Tamano=$query;
	}

    function getPersona(){
		return $this->Persona;
	} 
	 function setPersona( $query){
		$this->Persona=$query;
	}

	function getFCrea(){
		return $this->FCrea;
	} 
	 function setFCrea( $query){
		$this->FCrea=$query;
	}
	
    function getFMod(){
		return $this->FMod;
	} 
	 function setFMod( $query){
		$this->FMod=$query;
	}

    function getTipoTexto(){
		return $this->Tipotexto;
	} 
	 function setTipotexto( $query){
		$this->Tipotexto=$query;
	}

    function getRutaTexto(){
		return $this->RutaTexto;
	} 
	 function setRutaTexto( $query){
		$this->RutaTexto=$query;
	}

	function getTipo(){
		return $this->Tipo;
	} 
	 function setTipo( $query){
		$this->Tipo=$query;
	}

	function getNombreTexto(){
		return $this->NombreTexto;
	} 
	 function setNombreTexto( $query){
		$this->NombreTexto=$query;
	}

	 function __construct($IdArchivo = "",  $Ruta = "",  $NombreArchivo = "",  $Tamano = "", $Persona= "", $FCrea= "", $FMod= "", $Tipo= "", $TipoTexto ="", $RutaTexto="", $NombreTexto="")
	{
		parent::__construct(self::BASEDATOS);
		if($IdArchivo != "") {
			$this->setIdArchivo($IdArchivo);
		} // END IF
		if($Ruta != "") {
			$this->setRuta($Ruta);
		} // END IF
		if($NombreArchivo != "") {
			$this->setNombreArchivo($NombreArchivo);
		} // END IF
		if($Tamano !="") {
			$this->setTamano($Tamano);
		} // END IF
		if($Persona !="") {
			$this->setPersona($Persona);
		} // END IF
        if($FCrea != "") {
			$this->setFCrea($FCrea);
		} // END IF
        if($FMod != "") {
			$this->setFMod($FMod);
		} // END IF
        if($Tipo != "") {
			$this->setTipo($Tipo);
		} // END IF
		if($TipoTexto != "") {
			$this->setTipoTexto($TipoTexto);
		} // END IF
		if($RutaTexto != "") {
			$this->setRutaTexto($RutaTexto);
		} // END IF
		if($NombreTexto != "") {
			$this->setNombreTexto($NombreTexto);
		} // END IF
	} // end of member function __construct
	
	function agregaArchivos()
	{
		$query = "INSERT INTO " . self::TABLA . " (IdRuta, Nombre, Tamano, IdPersona, FechaCreado, FechaModifica, IdTipoContenido) VALUES ('".$this->Ruta."', '".$this->NombreArchivo."', '".$this->Tamano."', '".$this->Persona."', '".$this->FCrea."', '".$this->FMod."', '".$this->Tipo."')";
		return parent::agregaRegistro( $query);
	} // end of member function agregaRegistro

	function buscaArchivos($codigo = "")
	{
		$query = "SELECT A.IdArchivo, A.IdRuta, A.Nombre, A.Tamano, A.IdPersona, A.FechaCreado, A.FechaModifica, A.IdTipoContenido, R.Ruta as RutaTexto, T.Descripción as TipoTexto, P.Nombre as NombreTexto
		FROM archivos A 
		JOIN rutas as R ON R.IdRuta= A.IdRuta 
		JOIN `Tipos de Contenidos` as T ON T.IdTipoContenido = A.IdTIpoContenido
		JOIN personas as P ON A.IdPersona= P.IdPersona ";
		if ($codigo ==""){
			$query .= "WHERE A.IdArchivo =" . $this->IdArchivo . ";";
		}else{
			if ( $codigo != ""){
				$query .= "WHERE A.IdArchivo =" . $codigo . ";";
			}
			
		}
		return parent::buscaRegistro($query);
	} // end of member function buscaRegistro

	 function modificaArchivos()
	{
		$query = "UPDATE " . self::TABLA . " SET IdRuta='".$this->Ruta."', Nombre='".$this->NombreArchivo."',	Tamano='".$this->Tamano."',	IdPersona='".$this->Persona."', FechaCreado='".$this->FCrea."',	FechaModifica='".$this->FMod."', IdTipoContenido='".$this->Tipo."'	WHERE IdArchivo = ".$this->IdArchivo.";";
		return parent::modificaRegistro( $query);
	} // end of member function modificaRegistro

	 function eliminaArchivos()
	{
		$query = "DELETE FROM " . self::TABLA . " WHERE IdArchivo = ".$this->IdArchivo.";";	
		return parent::eliminaRegistro( $query);
	} // end of member function eliminaRegistro

	 function listaArchivos()
	{
		$query = "SELECT * FROM " . self::TABLA . ";";
		return parent::listaRegistros( $query );
	} // end of member function listaRegistros
	
	 function tablaArchivos($Nombre){
		$per_page_record = 10;       
		if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
		  $page_no = $_GET['page_no'];
		} else {
		  $page_no = 1;
		}
		
		$start_from = ($page_no - 1) * $per_page_record;
		$previous_page = $page_no - 1;
		$next_page = $page_no + 1;
		$adjacents = "2";		
		$query = "SELECT IdArchivo, Ruta, Nombre, Tamano, IdPersona, FechaCreado, FechaModifica, Descripción FROM archivos A JOIN rutas as R ON R.IdRuta= A.IdRuta JOIN `Tipos de Contenidos` as T ON T.IdTIpoContenido = A.IdTIpoContenido  ORDER BY A.IdArchivo LIMIT $start_from, $per_page_record;";
		return parent::tablaRegistro($Nombre, $query);
    }

	function contarArchivos(){
		$query = "SELECT COUNT(*) as cuenta FROM " . self::TABLA . ";";
		$resultado = mysqli_query($this->pConnection, $query);
		$retorno = mysqli_fetch_row($resultado);
		return $retorno;
	}
}

?>