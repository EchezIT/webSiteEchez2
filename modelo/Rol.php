<?php
    class Rol{
        var $Id;
        var $Name;
        var $Description;

        function __construct($Id, $Name,$Description){
            $this->Id = $Id;
            $this->Name = $Name;
            $this->Description = $Description;
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

        function setDescription($Description){
            $this->Description = $Description;
        }

        function getDescription(){
        return $this->Description;
        }

    }
?>