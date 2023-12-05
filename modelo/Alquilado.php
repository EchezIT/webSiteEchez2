<?php
  class Alquilado{
  	var $Id, $User_Name, $Serial, $PC_Name, $Installation_Date, $Plate_PC, $Specifications,
	  $Ram, $Desktop_Laptop, $Domain, $Status_PC, $dateUpdate_Date;

  	function __construct($Id, $User_Name, $Serial, $PC_Name, $Installation_Date, $Plate_PC, $Specifications,
	  $Ram, $Desktop_Laptop, $Domain, $Status_PC, $dateUpdate_Date){
  		$this->Id = $Id;
  		$this->User_Name = $User_Name;
		$this->Serial = $Serial;
		$this->PC_Name = $PC_Name;
		$this->Installation_Date = $Installation_Date;
		$this->Plate_PC = $Plate_PC;
		$this->Specifications = $Specifications;
		$this->Ram = $Ram;
		$this->Desktop_Laptop = $Desktop_Laptop;
		$this->Domain = $Domain;
		$this->Status_PC = $Status_PC;
		$this->dateUpdate_Date = $dateUpdate_Date;
  	}

  	function setId($Id){
  		$this->Id = $Id;
  	}

  	function getId(){
  		return $this->Id;
  	} 

  	function setUser_Name($User_Name){
  		$this->User_Name = $User_Name;
  	}

  	function getUser_Name(){
  		return $this->User_Name;
  	}
	
	  function setSerial($Serial){
		$this->Serial = $Serial;
	}

	function getSerial(){
		return $this->Serial;
	} 

	function setPC_Name($PC_Name){
		$this->PC_Name = $PC_Name;
	}

	function getPC_Name(){
		return $this->PC_Name;
	} 

	function setInstallation_Date($Installation_Date){
		$this->Installation_Date = $Installation_Date;
	}

	function getInstallation_Date(){
		return $this->Installation_Date;
	} 
	function setPlate_PC($Plate_PC){
		$this->Plate_PC = $Plate_PC;
	}

	function getPlate_PC(){
		return $this->Plate_PC;
	} 
	function setSpecifications($Specifications){
		$this->Specifications = $Specifications;
	}

	function getSpecifications(){
		return $this->Specifications;
	} 
	function setRam($Ram){
		$this->Ram = $Ram;
	}

	function getRam(){
		return $this->Ram;
	} 
	function setDesktop_Laptop($Desktop_Laptop){
		$this->Desktop_Laptop = $Desktop_Laptop;
	}

	function getDesktop_Laptop(){
		return $this->Desktop_Laptop;
	} 
	function setDomain($Domain){
		$this->Domain = $Domain;
	}

	function getDomain(){
		return $this->Domain;
	} 
	function setStatus_PC($Status_PC){
		$this->Status_PC = $Status_PC;
	}

	function getStatus_PC(){
		return $this->Status_PC;
	} 
	function setdateUpdate_Date($dateUpdate_Date){
		$this->dateUpdate_Date = $dateUpdate_Date;
	}

	function getdateUpdate_Date(){
		return $this->dateUpdate_Date;
	} 
  }
?>