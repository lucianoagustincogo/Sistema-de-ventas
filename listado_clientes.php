<?php

session_start();

if (!isset($_SESSION["nombre"])){
  
  header("Location: login.php");
    exit();
  }

  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); //Activa el reporte de errores
error_reporting(E_ALL);

if(file_exists("clientes.txt")){
    $jsonClientes = file_get_contents("clientes.txt");
    $aClientes = json_decode($jsonClientes, true);
} else{
    $aClientes = array();
}

$pos = isset($_GET["pos"])? $_GET["pos"] : "";


if($_POST){
    $cuit = $_POST["txtCuit"];
    $nombre = $_POST["txtNombre"];
    $telefono = $_POST["txtTelefono"];
    $correo = $_POST["txtCorreo"];
    $fechanac = $_POST["txtFechaNac"];

if(isset($_GET["do"]) && $_GET["do"] == "new"){


    //Creamos el array
    $aClientes[] = array("cuit" => $cuit,
                        "nombre" => $nombre,
                        "telefono" => $telefono,
                        "correo" => $correo,
                        "fechanac" => $fechanac
                    );

    

    //Convertimos a Json
    $jsonClientes = json_encode($aClientes);
    //Guardamos el Json en el archivo
    file_put_contents("clientes.txt", $jsonClientes);

} 
    //Esto modificara la informacion del cliente
    if(isset($_GET["do"]) && $_GET["do"] == "insert"){
        $aClientes[$pos] = array(
        "cuit" => $cuit,
        "nombre" => $nombre,
        "telefono" => $telefono,
        "correo" => $correo,
        "fechanac" => $fechanac);

          //El array modificado convertirlo a json
          $jsonClientes= json_encode($aClientes);                     
          //Guardar el json en el archivo
          file_put_contents("clientes.txt", $jsonClientes);

    }

}
//Con esto borramos al cliente
if(isset($_GET["do"]) && $_GET["do"] == "delete"){
    unset($aClientes[$pos]);
    //Guardar en el archivo, el nuevo array de clientes modificado

    $jsonClientes = json_encode($aClientes);
    file_put_contents("clientes.txt", $jsonClientes);
}


?>
<!DOCTYPE html>
<html lang="es">

<head>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="css/awesomefonts/css/all.min.css" rel="stylesheet">
    <link href="css/awesomefonts/css/fontawesome.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de clientes - ABM Clientes</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

  <?php
include_once "sidebar.php";
?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

      <?php
        include_once "topbar.php"
        ?>

        
        <div class="container-fluid">
        <div class="container">
        <div class="row">
            <!-- Page Heading -->
            <div class = "col-12 text-center py-3">
                <h1>Listado de clientes</h1>
            </div>
        </div>
        <!-- Begin Page Content -->
        <div class = "row">
                    
           <div class="col-12 card-body border ">
                <table class = "table table-hover">
                    <tr>
                        <th>CUIT: </th>
                        <th>Nombre: </th>
                        <th>Correo: </th>
                        <th>Acciones: </th>
                    </tr>
                    <tr>
                        <?php 
                        $pos = 0;
                        foreach ($aClientes as $pos => $cliente){ ?>
                   
                        <td><?php echo $cliente["cuit"] ?></td>
                   
                        <td><?php echo $cliente["nombre"] ?></td>
                    
                        <td><?php echo $cliente["correo"] ?></td>

               

                        <td>
                        <a href="nuevo_cliente.php ?pos=<?php echo $pos;?>&do=insert"><i class="fas fa-edit"></i></a>
                        <a href="?pos=<?php echo $pos;?>&do=delete"><i class="fas fa-trash-alt"></i></a>
                        </td>
                        
                    </tr>
                    <?php   
                    $pos++; 
                    } ?>
                </table>
            </div>
        </div>
    </div>
          

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Listo para irte?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecciona "Salir" si estás listo para cerrar la sesión.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="logout.php">Salir</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
