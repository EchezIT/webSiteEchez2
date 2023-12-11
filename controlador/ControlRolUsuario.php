<?php
    class ControlRolUsuario{
        var $objRolUsuario;

        function __construct($objRolUsuario){
            $this->objRolUsuario = $objRolUsuario;
        }

        function guardar(){
            $FkIdUsuario = $this->objRolUsuario->getFkIdUsuario(); 
            $FkIdRol = $this->objRolUsuario->getFkIdRol();
            //hacer un select para que me traiga el id del usuario que tiene el email ingresado
            //ie tengo que tener al menos el correo
            $comando = "insert into rol_usuario(FkIdUsuario,FkIdRol) values('$FkIdUsuario','$FkIdRol')"; 
            $objControlConexion = new ControlConexion(); 
            $objControlConexion->abrirBd($GLOBALS['serv'], $GLOBALS['usua'], $GLOBALS['pass'], $GLOBALS['bdat'], $GLOBALS['port']); //Se invoca el método abrirBd.
            $objControlConexion->ejecutarComandoSql($comando); 
            $objControlConexion->cerrarBd();
        }

        function listarRolesDelUsuario($FkIdUsuario){
            $comandoSql = "SELECT Rol.Id, Rol.Name,Rol.Description
            FROM Rol_Usuario INNER JOIN Rol ON Rol_usuario.FkIdRol = Rol.Id
            WHERE Rol_Usuario.FkIdUsuario = '$FkIdUsuario'";
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

        function borrarRolesDelUsuario($FkIdUsuario){
            $comandoSql = "DELETE FROM rol_usuario WHERE FkIdUsuario= '$FkIdUsuario'";
            $objControlConexion = new ControlConexion();
            $objControlConexion->abrirBd($GLOBALS['serv'],$GLOBALS['usua'],$GLOBALS['pass'],$GLOBALS['bdat'],$GLOBALS['port']);
            $objControlConexion->ejecutarComandoSql($comandoSql);
            $objControlConexion->cerrarBd();
        }
    }
?>