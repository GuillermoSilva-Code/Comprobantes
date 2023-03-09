<?php 
 
require_once 'config/init.php';

// chequear si el usuario NO está logueado
if(empty($_SESSION['user_id'])) {
    header('location:login.php');
    exit();
}
$user_id = $_SESSION['user_id'];
 
$sql = "SELECT * FROM usuarios WHERE ID = $user_id";
$query = $connect->query($sql);
$result = $query->fetch_array();
 
// Querys para Controlar y Autorizar en Side Menubar
$cont1 = "SELECT COUNT(*) as 'cont_controlar' FROM comprobante where Controlado LIKE '' AND Rechazado LIKE ''";
$cont2 = "SELECT COUNT(*) as 'cont_autorizar' FROM comprobante where Controlado NOT LIKE '' AND Rechazado LIKE '' AND Aprobado LIKE ''";
$query2 = $connect->query($cont1);
$result2 = $query2->fetch_array();
$query3 = $connect->query($cont2);
$result3 = $query3->fetch_array();
// --------------
?>
<?php
if (isset($_POST['boton_autorizar'])) { 
  $nrocomprobante = $_POST['nrocomprobante'];
  $autorizo = $_POST['autorizo'];
  $detalles = $_POST['detalles'];

  $sql1 = "UPDATE comprobante SET Aprobado = '$autorizo', detalles = '$detalles' WHERE Nro_comprobante = '$nrocomprobante'";
  if($query = $connect->query($sql1)){
    echo "exito";
    echo "<meta http-equiv='refresh' content='0'>";
  }else{
    echo "error";
  }

} else if (isset($_POST['boton_rechazar'])) {
  //echo "llegue";
  $nrocomprobante = $_POST['nrocomprobante'];
  $rechazo = $_POST['autorizo'];
  $detalles = $_POST['detalles'];

  $sql2 = "UPDATE comprobante SET Rechazado = '$rechazo', detalles = '$detalles' WHERE Nro_comprobante = '$nrocomprobante'";
  if($query = $connect->query($sql2)){
    echo "exito";
    echo "<meta http-equiv='refresh' content='0'>";
  }else{
    echo "error";
  }
}
$connect->close();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Daxa Comprobantes</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" /> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Roboto", sans-serif}
    table tr:not(:first-child){
      cursor: pointer;transition: all .25s ease-in-out;
    }
    table tr:not(:first-child):hover{background-color: #ddd;}
  </style>
</head>
<body class="w3-light-grey">

  <!-- Top container -->
  <div class="w3-bar w3-top w3-blue w3-large" style="z-index:4">
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
    <span class="w3-bar-item w3-right"><img src="images/login.png" style="width: 80px"></span>
  </div>

  <!-- Sidebar/menu -->
  <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
    <div class="w3-container w3-row">
      <div class="w3-col s4">
        <img src="https://img2.freepng.es/20180714/ro/kisspng-computer-icons-user-membership-vector-5b498fc76f2a07.4607730515315475914553.jpg" class="w3-circle w3-margin-right" style="width:46px">
      </div>
      <div class="w3-col s8 w3-bar">
        <span><strong><?php echo $result['Nombre'] . " " . $result['Apellido'] ?></strong></span><br>
        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
        <a href="editar.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
        <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
      </div>
    </div>
    <hr>
    <div class="w3-container">
      <h5>Panel</h5>
    </div>
    <div class="w3-bar-block">
      <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Cerrar Menú</a>
      <a href="index.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-home fa-fw"></i>  Inicio</a>
      <a href="caja_chica.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-briefcase fa-fw"></i>  Caja chica</a>
      <a href="cierre_caja_chica.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-briefcase fa-fw"></i>  Cierre de caja chica</a>
      <a href="liquidacion.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-dollar fa-fw"></i>  Liquidación de gastos</a>
      <a href="controlar.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  Controlar<span class="w3-tag w3-red w3-round w3-right"><?php echo $result2['cont_controlar'] ?></span></a>
      <a href="autorizar.php" class="w3-bar-item w3-button w3-padding w3-dark-grey"><i class="fa fa-lock fa-fw"></i>  Autorizar<span class="w3-tag w3-red w3-round w3-right"><?php echo $result3['cont_autorizar'] ?></span></a>
      <a href="historial.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  Historial</a>
      <button class="w3-button w3-block w3-left-align" onclick="myAccFunc()"><i class="fa fa-cog fa-fw"></i> 
        Configuración <i class="fa fa-caret-down"></i>
      </button>
      <div id="demoAcc" class="w3-hide w3-white w3-card">
        <a href="editar.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-wrench fa-fw"></i> Editar Perfil</a>
        <a href="usuarios.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Administrar Usuarios</a>
      </div><br><br>
      <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-close fa-fw"></i>  Cerrar sesión</a><br><br>
    </div>
  </nav>


  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
      <h5><b><i class="fa fa-lock"></i> AUTORIZAR - DAXA ARGENTINA</b></h5><br>
    </header>
    <div class="w3-container">
      <h4><b>Pendientes</b></h4>
      <div class="w3-responsive">
        <table id="table" class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-color">
          <tr class="w3-green">
            <th>Comprobante</th>
            <th>Presentada por</th>
            <th>Destino</th>
            <th>Motivo</th>
            <th>Fecha</th>
            <th>Comprobante N°</th>
            <th>Total</th>
            <th>Controlado por</th>
          </tr>
          <?php
          $conn = new mysqli("localhost", "root", "", "comprobantes");
          if ($conn->connect_error) {
            die('Could not connect to the database.');
          }

          $Select = "SELECT Comprobante, Presentado, Destino, Motivo, Fecha, Nro_comprobante, Total, Controlado FROM comprobante where Controlado NOT LIKE '' AND Rechazado LIKE '' AND Aprobado LIKE ''";
          $sql = $conn->query($Select);
          if($sql-> num_rows > 0){
            while($row = $sql-> fetch_assoc()){
              echo "<tr><td>".$row["Comprobante"]."</td><td>".$row["Presentado"]."</td><td>".$row["Destino"]."</td><td>".$row["Motivo"]."</td><td>".$row["Fecha"]."</td><td>".$row["Nro_comprobante"]."</td><td>".$row["Total"]."</td><td>".$row["Controlado"]."</td></tr>";
            }
          }else{
            echo "No hay comprobantes pendientes";
          }

          ?>
        </table><br>
      </div><hr>

      <!-- Datos comprobante -->
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="inputcomp"><b>Comprobante</b></label>
            <input type="text" style="font-style:italic;" class="form-control" id="comprobante">
          </div>
          <div class="form-group col-md-3">
            <label for="inputprep"><b>Preparó</b></label>
            <input type="text" style="font-style:italic;" class="form-control" id="preparo">
          </div>
          <div class="form-group col-md-6">
            <label for="inputdes"><b>Destino</b></label>
            <input type="text" style="font-style:italic;" class="form-control" id="destino">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputnro"><b>N° Comprobante</b></label>
            <input type="text" class="form-control" id="nrocomprobante" name="nrocomprobante">
          </div>
          <div class="form-group col-md-6">
            <label for="inputmot"><b>Motivo</b></label>
            <input type="text" style="font-style:italic;" class="form-control" id="motivo" name="motivo">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputcon"><b>Controló</b></label>
            <input type="text" class="form-control" id="controlo" name="controlo">
          </div>
          <div class="form-group col-md-3">
            <label for="inputfec"><b>Fecha</b></label>
            <input type="text" class="form-control" id="fecha" name="fecha">
          </div>
          <div class="form-group col-md-3">
            <label for="inputtot"><b>Total</b></label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">$</span>
              </div>
              <input type="text" class="form-control" id="total" name="total">
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <label><b>Autorizó</b></label>
            <input type="text" class="form-control" style="font-weight:bold;" id="autorizo" value="<?php echo $result['Nombre'] . " " . $result['Apellido'] ?>" name="autorizo">
          </div>
          <div class="form-group col-md-9">
            <label><b>Detalles</b></label>
            <input type="text" class="form-control" id="detalles" placeholder="Detalles de la operación / Motivo del rechazo" name="detalles">
          </div>
        </div>

      <!-- Botones -->
      <button type="submit" class="btn btn-primary" name="boton_autorizar" style="margin-left:10px;">Autorizar</button>
      <button type="submit" class="btn btn-danger" name="boton_rechazar" style="margin-left:10px;">Rechazar</button>
      <a class="btn btn-warning" href="index.php" role="button" style="margin-left:10px;">Salir</a>
      <br>
      </form>
    </div><hr>

    <!-- Footer -->
    <footer class="w3-container w3-padding-16 w3-light-grey">
      <div class="w3-bar ">
          <div class="w3-bar-item"> <p>2022 © <a href="http://daxa.com.ar/" target="_blank">Daxa Argentina</a></p></div>
          <div class="w3-bar-item w3-right">Versión 0.1</div>
      </div>
    </footer>

    <!-- Fin de página -->
  </div>

  <script>
// Get sidebar
var mySidebar = document.getElementById("mySidebar");

// Get Div con efecto overlay
var overlayBg = document.getElementById("myOverlay");

// Intercambiar entre mostrar y desactivar barra lateral, con efecto de overlay
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Cerrar sidebar con botón close
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
// Función de Configuración Sidebar
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-dark-grey";
  } else { 
    x.className = x.className.replace(" w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-dark-grey", "");
  }
}
// Click en la tabla
var table = document.getElementById('table');
for(var i = 1; i < table.rows.length; i++)
{
 table.rows[i].onclick = function()
 {
    //rIndex = this.rowIndex;
    document.getElementById("comprobante").value = this.cells[0].innerHTML;
    document.getElementById("preparo").value = this.cells[1].innerHTML;
    document.getElementById("destino").value = this.cells[2].innerHTML;
    document.getElementById("motivo").value = this.cells[3].innerHTML;
    document.getElementById("fecha").value = this.cells[4].innerHTML;
    document.getElementById("nrocomprobante").value = this.cells[5].innerHTML;
    document.getElementById("total").value = this.cells[6].innerHTML;
    document.getElementById("controlo").value = this.cells[7].innerHTML;
  };
}
</script>
</body>
</html>
