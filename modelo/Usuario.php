<?php
  class Usuario{
  	var $Id,$Name,$Email, $Password;

  	function __construct($Id,$Name,$Email,$Password){
  		$this->Id = $Id;
		$this->Name = $Name;
		$this->Email = $Email;
  		$this->Password = $Password;
  	}
	function setId($Id){
		$this->Id = $Id;
	}
	function getId(){
		return $this->Id;
	}
	function setName($Name){
		$this->Name = $Name;
	}
	function getName(){
		return $this->Name;
	}
  	function setEmail($Email){
  		$this->Email = $Email;
  	}

  	function getEmail(){
  		return $this->Email;
  	} 

  	function setPassword($Password){
  		$this->Password = $Password;
  	}

  	function getPassword(){
  		return $this->Password;
  	}    		
  }
?>