<?php 
  session_start();
  if($_SESSION['email']==null)header('Location: ../login.php');
  //var_dump($listaRolesDelUsuario);
?>
<style>
.how-section1{
    margin-top:-15%;
    padding: 10%;
}
.how-section1 h4{
    text-align: center; 
    --font-weight: theme; 
    margin-bottom: 15px;
    /*color: #ffa500;
    font-weight: bold;
    font-size: 30px;*/
}
.how-section1 .subheading{
    color: #151515;
    font-size: 20px;
}
.how-section1 .row
{
    margin-top: 10%;
}
.how-img 
{
    text-align: center;
}
.how-img img{
    width: 20%;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Home</title>
<link rel="shortcut icon" href="../vista/img/logo-DBD-01.png">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../vista/css/misCss1.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="js/misFunciones.js"></script>
<script src="js/misFunciones2.js"></script>
<link rel="shortcut icon" href="../vista/img/time-23.png">
<!--for how-section1-->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <!--Se agrega una barra de navegación para acceder a los CRUDs, y agregar la funcionalidad "buscar"-->	
		<div class="navBar">
			<?php require('./navbar.php')?>
		</div>			
        <div class="how-section1">
                    <div class="row">
                        <div class="col-md-12 how-img">
                            <img src="../vista/img/echez-group.png" class="rounded-circle img-fluid" alt=""/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4 style="text-align: center;">De cara al futuro</h4>
                            <p class="subheading" style="text-align: center;">Somos habilitadores de tu transformación digital</p>
                        <p class="text-muted">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 how-img">
                            <img src="../vista/img/fe-100x100.png" class="rounded-circle img-fluid" alt=""/>
                        </div>  
                        <div class="col-md-6 how-img">
                            <img src="../vista/img/teamwork-icon-100x100.png" class="rounded-circle img-fluid" alt=""/>
                        </div>                       
                    </div>  
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Principio</h4>
                            <p class="subheading" style="text-align: center;">Realizamos un ejercicio de fe y reconocemos un Ser superior como parte integral del desarrollo humano que nos lleva a alcanzar plenitud y felicidad. 
                                Creemos en que cada uno de nosotros da lo mejor de sí.  Somos socialmente responsables, propendemos un trabajo ético y nos conectamos con problemáticas sociales.</p>
                        </div>
                        <div class="col-md-6">
                            <h4>Valor</h4>
                            <p class="subheading" style="text-align: center;">Trabajamos de manera colaborativa, como un grupo, entendiendo las necesidades de nuestros clientes para asegurar y exceder los objetivos propuestos.</p>
                        </div>                     
                    </div>                                    
        </div> 
                    
    <!--Se agrega un footer al final de la pagina-->
    <div class="footer">
        <?php require('./footer.php') ?>
    </div>

</body>
</html>