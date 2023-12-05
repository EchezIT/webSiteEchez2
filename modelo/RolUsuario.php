<?php
    class RolUsuario{
        var $FkIdUsuario;
        var $FkIdRol;

        function __construct($FkIdUsuario, $FkIdRol){
            $this->FkIdUsuario = $FkIdUsuario;
            $this->FkIdRol = $FkIdRol;
        }

        function setFkIdUsuario($FkIdUsuario){
            $this->FkIdUsuario = $FkIdUsuario;
        }

        function getFkIdUsuario(){
            return $this->FkIdUsuario;
        }

        function setFkIdRol($FkIdRol){
            $this->FkIdRol = $FkIdRol;
        }

        function getFkIdRol(){
            return $this->FkIdRol;
        }
    }
?>