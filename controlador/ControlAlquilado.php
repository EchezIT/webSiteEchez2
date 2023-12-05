<?php
    class ControlAlquilado{
        
	   var $objAlquilado;

        function __construct($objAlquilado){
            $this->objAlquilado = $objAlquilado;
        }
/*
        function validarIngreso(){
            //$msg = "ok";
            $validar = false;
            $ema = $this->objUsuario->getEmail(); 
            $con = $this->objUsuario->getContrasena();
            $comandoSql = "SELECT * FROM usuario WHERE email='$ema' AND contrasena='$con'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
            try
            {
                if (mysqli_num_rows($recordSet) > 0) 
                {
                    $validar = true;
                }
                $objControlConexion->cerrarBd();
            }
            catch (Exception $objExcetion)
            {
                $msg = $objExcetion->getMessage();
            } 
            return $validar;
        }

        function consultarRolesPorUsuario($nomUsu){
            $msg = "ok";
            $listadoRolesDelUsuario = [];
            $comandoSQL = "SELECT fkIdRol FROM tblrol_usuario WHERE fkNomUsuario='$nomUsu'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSQL);
            try
            {
                if (mysqli_num_rows($recordSet) > 0)
                {
                    $i = 0;
                    while ($row = $recordSet->fetch_array(MYSQLI_BOTH))
                    {
                        $listadoRolesDelUsuario[$i] = $row[0];
                        $i++;
                    }
                    $objControlConexion->cerrarBd();
                }
            }
            catch (Exception $objExcetion)
            {
                $msg = $objExcetion->getMessage();
            }
            return $listadoRolesDelUsuario;
        }
*/
        function guardar(){
            $Id = $this->objAlquilado->getId(); 
            $User_Name = $this->objAlquilado->getUser_Name();
            $Serial = $this->objAlquilado->getSerial();
            $PC_Name = $this->objAlquilado->getPC_Name();
            $Installation_Date = $this->objAlquilado->getInstallation_Date();
            $Plate_PC = $this->objAlquilado->getPlate_PC();
            $Specifications = $this->objAlquilado->getSpecifications();
            $Ram = $this->objAlquilado->getRam();
            $Desktop_Laptop = $this->objAlquilado->getDesktop_Laptop();
            $Domain = $this->objAlquilado->getDomain();
            $Status_PC = $this->objAlquilado->getStatus_PC();
            $dateUpdate_Date = $this->objAlquilado->getdateUpdate_Date();
                
            $comandoSql = "INSERT INTO Alquilado(User_Name,'Serial',PC_Name,Installation_Date,Plate_PC,Specifications,
	        Ram,Desktop_Laptop,Domain,Status_PC,dateUpdate_Date) VALUES ('$User_Name', '$Serial', '$PC_Name', '$Installation_Date', '$Plate_PC', '$Specifications',
	        '$Ram', '$Desktop_Laptop', '$Domain', '$Status_PC', '$dateUpdate_Date')";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $objControlConexion->ejecutarComandoSql($comandoSql);
            $objControlConexion->cerrarBd();
            
        }
        
        function consultar(){
            $Serial= $this->objAlquilado->getSerial(); 
        
            $comandoSql = "SELECT * FROM Alquilado WHERE Serial = '$Serial'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
            if ($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $this->objAlquilado->setUser_Name($row['User_Name']);
                $this->objAlquilado->setPC_Name($row['PC_Name']);
                $this->objAlquilado->setInstallation_Date($row['Installation_Date']);
                $this->objAlquilado->setPlate_PC($row['Plate_PC']);
                $this->objAlquilado->setSpecifications($row['Specifications']);
                $this->objAlquilado->setRam($row['Ram']);
                $this->objAlquilado->setDesktop_Laptop($row['Desktop_Laptop']);
                $this->objAlquilado->setDomain($row['Domain']);
                $this->objAlquilado->setStatus_PC($row['Status_PC']);
                $this->objAlquilado->setdateUpdate_Date($row['dateUpdate_Date']);
            }
            $objControlConexion->cerrarBd();
            return $this->objAlquilado;
        }
        /*
        function modificar(){
            $ema = $this->objUsuario->getEmail(); 
            $con = $this->objUsuario->getContrasena();
            
            $comandoSql = "UPDATE usuario SET contrasena='$con' WHERE email = '$ema'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $objControlConexion->ejecutarComandoSql($comandoSql);
            $objControlConexion->cerrarBd();
        }

        function borrar(){
            $ema= $this->objUsuario->getEmail(); 
            $comandoSql = "DELETE FROM usuario WHERE email = '$ema'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
            $objControlConexion->ejecutarComandoSql($comandoSql);
            $objControlConexion->cerrarBd();
        }
*/
        function listar(){
            $comandoSql = "SELECT * FROM Alquilado";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
            if (mysqli_num_rows($recordSet) > 0) {
                $arregloAlquilados = array();
                $i = 0;
                while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                    $objAlquilado = new Alquilado(0,"","","","",0,"","","","","","",0,"");
                    $objAlquilado->setId($row['Id']);
                    $objAlquilado->setUser_Name($row['User_Name']);
                    $objAlquilado->setSerial($row['Serial']);
                    $objAlquilado->setPC_Name($row['PC_Name']);
                    $objAlquilado->setInstallation_Date($row['Installation_Date']);
                    $objAlquilado->setPlate_PC($row['Plate_PC']);
                    $objAlquilado->setSpecifications($row['Specifications']);
                    $objAlquilado->setRam($row['Ram']);
                    $objAlquilado->setDesktop_Laptop($row['Desktop_Laptop']);
                    $objAlquilado->setDomain($row['Domain']);
                    $objAlquilado->setStatus_PC($row['Status_PC']);
                    $objAlquilado->setdateUpdate_Date($row['dateUpdate_Date']);

                    $arregloAlquilados[$i] = $objAlquilado;
                    $i++;
                }
            }
            $objControlConexion->cerrarBd();
            return $arregloAlquilados;
        }
    }
?>