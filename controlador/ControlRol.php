<?php
    class ControlRol{
        var $objRol;

        function __construct($objRol){
            $this->objRol = $objRol;
        }

        function guardar(){
            $Name = $this->objRol->getName(); //Asigna a la variable nom el nombre que está dentro del objeto.
            $Description = $this->objRol->getDescription();
            $comando = "insert into Rol(Name,Description) values('$Name','$Description')"; //Cadena de caracteres donde se construye el comando Sql.
            $objControlConexion = new ControlConexion(); //Se instancia la clase controlConexion.
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']); //Se invoca el método abrirBd.
            $objControlConexion->ejecutarComandoSql($comando); //Se invoca el método ejecutarComandoSql.
            $objControlConexion->cerrarBd();
        }

        function consultar(){
            $Name= $this->objRol->getName(); 
        
            $comandoSql = "SELECT * FROM Rol WHERE Name = '$Name'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
            if ($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $this->objRol->setDescription($row['Description']);
            }
            $objControlConexion->cerrarBd();
            return $this->objRol;
        }

        function modificar(){
            $Name = $this->objRol->getName(); 
            $Description = $this->objRol->getDescription();
            
            $comandoSql = "UPDATE Rol SET Description='$Description' WHERE Name = '$Name'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $objControlConexion->ejecutarComandoSql($comandoSql);
            $objControlConexion->cerrarBd();
        }

        function borrar(){
            $Name= $this->objRol->getName(); 
            $comandoSql = "DELETE FROM Rol WHERE Name = '$Name'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
            $objControlConexion->ejecutarComandoSql($comandoSql);
            $objControlConexion->cerrarBd();
        }

        function listar(){
            $comandoSql = "SELECT * FROM Rol";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
            $arregloRoles = array();
            if (mysqli_num_rows($recordSet) > 0) {               
                $i = 0;
                while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                    $objRol = new Rol(0,"","");
                    $objRol->setId($row['Id']);
                    $objRol->setName($row['Name']);
                    $objRol->setDescription($row['Description']);
                    $arregloRoles[$i] = $objRol;
                    $i++;
                }
            }
            $objControlConexion->cerrarBd();
            return $arregloRoles;
        }
    }
?>