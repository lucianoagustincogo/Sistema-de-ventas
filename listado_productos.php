<?php

session_start();

if (!isset($_SESSION["nombre"])){
  
  header("Location: login.php");
    exit();
  }

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1); //Activa el reporte de errores
error_reporting(E_ALL);

if(file_exists("productos.txt")){
    $jsonProductos = file_get_contents("productos.txt");
    $aProductos = json_decode($jsonProductos, true);
} else{
    $aProductos = array();
}

$pos = isset($_GET["pos"])? $_GET["pos"] : "";


if($_POST){
    $cod = $_POST["txtCod"];
    $nombre = $_POST["txtNombre"];
    $descripcion = $_POST["txtDescripcion"];
    $stock = $_POST["nStock"];
    $precio = $_POST["nPrecio"];

if(isset($_GET["do"]) && $_GET["do"] == "new"){


    //Creamos el array
    $aProductos[] = array("cod" => $cod,
                        "nombre" => $nombre,
                        "descripcion" => $descripcion,
                        "stock" => $stock,
                        "precio" => $precio
                                          );

    

    //Convertimos a Json
    $jsonProductos = json_encode($aProductos);
    //Guardamos el Json en el archivo
    file_put_contents("productos.txt", $jsonProductos);

} 
    //Esto modificara la informacion del cliente
    if(isset($_GET["do"]) && $_GET["do"] == "insert"){
        $aProductos[$pos] = array(
        "cod" => $cod,
        "nombre" => $nombre,
        "descripcion" => $descripcion,
        "stock" => $stock,
        "precio" => $precio);

          //El array modificado convertirlo a json
          $jsonProductos= json_encode($aProductos);                     
          //Guardar el json en el archivo
          file_put_contents("productos.txt", $jsonProductos);

    }

}
//Con esto borramos al cliente
if(isset($_GET["do"]) && $_GET["do"] == "delete"){
    unset($aProductos[$pos]);
    //Guardar en el archivo, el nuevo array de clientes modificado

    $jsonProductos = json_encode($aProductos);
    file_put_contents("productos.txt", $jsonProductos);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Listado de productos - ABM Clientes</title>

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
          <h1>Listado de productos</h1>
      </div>
  </div>
  <!-- Begin Page Content -->
  <div class = "row">
              
     <div class="col-12 card-body border ">
          <table class = "table table-hover">
              <tr>
                  <th>Código: </th>
                  <th>Nombre: </th>
                  <th>Descripción: </th>
                  <th>Stock: </th>
                  <th>Precio: </th>
                  <th>Acciones: </th>
              </tr>
              <tr>
                  <?php 
                  $pos = 0;
                  foreach ($aProductos as $pos => $producto){ ?>
             
                  <td><?php echo $producto["cod"] ?></td>
             
                  <td><?php echo $producto["nombre"] ?></td>
              
                  <td><?php echo $producto["descripcion"] ?></td>

                  <td><?php echo $producto["stock"] ?></td>

                  <td><?php echo "$" . $producto["precio"] ?></td>

         

                  <td>
                  <a href="nuevo_producto.php ?pos=<?php echo $pos;?>&do=insert"><i class="fas fa-edit"></i></a>
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
