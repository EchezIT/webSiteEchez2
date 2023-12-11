<?php
    class ControlUsuario{
        
	   var $objUsuario;

        function __construct($objUsuario){
            $this->objUsuario = $objUsuario;
        }

        function validarIngreso(){
            //$msg = "ok";
            $validar = false;
            $ema = $this->objUsuario->getEmail(); 
            $con = $this->objUsuario->getPassword();
            $comandoSql = "SELECT * FROM usuario WHERE email='$ema'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSql);           
            try
            {
                if (mysqli_num_rows($recordSet) > 0) // && 
                {            
                    $fila = $recordSet->fetch_assoc();
                    $verificar_hash = password_verify($con, $fila['Password']);     
                    if ($verificar_hash) {
                        $validar = true;
                    }
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

        function guardar(){
            $Id = $this->objUsuario->getId(); 
            $Name = $this->objUsuario->getName();
            $Email = $this->objUsuario->getEmail(); 
            $Password = $this->objUsuario->getPassword();

            // Hashea la contraseña con Bcrypt
            $hash = password_hash($Password, PASSWORD_BCRYPT);

            $comandoSql = "INSERT INTO Usuario(Id,Name,Email,Password) VALUES ('$Id','$Name','$Email', '$hash')";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $objControlConexion->ejecutarComandoSql($comandoSql);
            $objControlConexion->cerrarBd();
            
        }
        
        function consultar(){
            $Email= $this->objUsuario->getEmail(); 
        
            $comandoSql = "SELECT * FROM Usuario WHERE Email = '$Email'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
            if ($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $this->objUsuario->setId($row['Id']);
                $this->objUsuario->setName($row['Name']);
                $this->objUsuario->setPassword($row['Password']);
            }
            $objControlConexion->cerrarBd();
            return $this->objUsuario;
        }

        function modificar(){
            $Name = $this->objUsuario->getName();
            $Email = $this->objUsuario->getEmail(); 
            $Password = $this->objUsuario->getPassword();
            // Hashea la contraseña con Bcrypt
            $hash = password_hash($Password, PASSWORD_BCRYPT);

            $comandoSql = "UPDATE usuario SET Password='$hash',Name='$Name' WHERE email = '$Email'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $objControlConexion->ejecutarComandoSql($comandoSql);
            $objControlConexion->cerrarBd();
        }

        function borrar(){
            $Email= $this->objUsuario->getEmail(); 
            $comandoSql = "DELETE FROM usuario WHERE email = '$Email'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
            $objControlConexion->ejecutarComandoSql($comandoSql);
            $objControlConexion->cerrarBd();
        }

        function listar(){
            $comandoSql = "SELECT * FROM usuario";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']);
            $recordSet = $objControlConexion->ejecutarSelect($comandoSql);
            $arregloUsuarios = array();
            if (mysqli_num_rows($recordSet) > 0) {               
                $i = 0;
                while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                    $objUsuario = new Usuario(0,"","","");
                    $objUsuario->setName($row['Name']);
                    $objUsuario->setEmail($row['Email']);
                    $objUsuario->setPassword($row['Password']);
                    $arregloUsuarios[$i] = $objUsuario;
                    $i++;
                }
            }
            $objControlConexion->cerrarBd();
            return $arregloUsuarios;
        }
    }
?>