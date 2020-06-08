<?php
session_start();

if (!isset($_SESSION["nombre"])){
  
  header("Location: login.php");
    exit();
  }

include_once "config.php";
include_once "entidades/cliente.php";


$cliente = new Cliente();
$cliente->cargarFormulario($_REQUEST);


if($_POST){
    if(isset($_POST["btnGuardar"])){
        if(isset($_GET["id"]) && $_GET["id"] > 0){
            $cliente->actualizar();
        } else{
            $cliente->insertar();
        }
    } else if (isset($_POST["btnBorrar"])){
        $cliente->eliminar();
    }

}
if(isset($_GET["id"]) && $_GET["id"] > 0){
    $cliente->obtenerPorId();
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

  <title>Nuevo cliente - ABM Clientes</title>

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

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
        <div class="container">
        <div class="row">
            <div class = "col-12 text-center py-3">
                <div>
                    <h1 class="">Registro de clientes</h1>
                </div>
            </div>
        </div>
        <div class = "row">
                    <div class="col-12">
                            <div> 
                                <a href="nuevo_cliente.php" class="btnGuardar btn btn-primary text-light mb-3">         
                                <i class="fas fa-user-plus"> Ingrese un nuevo cliente</i>
                                </a>
                            </div>
                    </div>
            <div class=" col-12 card-body border">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6 col-12">
                        <label for="txtCuit">CUIT:</label>
                        <input type="text" id="txtCuit" name="txtCuit" class="form-control" required value="<?php echo $cliente->cuit ?>"><br>
                    </div>
                    <div class="col-sm-6 col-12"> 
                        <label for="txtNombre">Nombre y apellido:</label>    
                        <input type="text" id="txtNombre" name="txtNombre" class="form-control" required value="<?php echo $cliente->nombre ?>"><br>
                    </div>
                    <div class="col-sm-6 col-12">                        
                        <label for="txtTelefono">Teléfono:</label>
                        <input type="text" id="txtTelefono" name="txtTelefono" class="form-control" required value="<?php echo $cliente->telefono ?>"><br>
                    </div>
                    <div class="col-sm-6 col-12">                        
                        <label for="txtCorreo">Correo:</label>
                        <input type="text" id="txtCorreo" name="txtCorreo" class="form-control" required value="<?php echo $cliente->correo ?>"><br>
                    </div>
                    <div class="col-sm-6 col-12">                        
                        <label for="txtFechaNac">Fecha de nacimiento:</label>
                        <input type="date" id="txtFechaNac" class="form-control" name="txtFechaNac" required value="<?php echo $cliente->fecha_nac ?>"><br>
                    </div>
                    <div class="col-12 form-group">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                            <button type="reset" id="btnLimpiar" name="btnLimpiar" class="btn btn-secondary mr-2">Limpiar</button>
                            <button type="submit" id="btnBorrar" name="btnBorrar" class="btn btn-danger">Borrar</button>

                        </div>
                    </div>
                </div>
            </form>
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
