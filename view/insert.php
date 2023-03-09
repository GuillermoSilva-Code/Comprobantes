<?php
require_once ("PHPMailer/clsMail.php");

$mailSend = new clsMail();

if (isset($_POST['submit'])) {
    if (isset($_POST['nrocomprobante']) && isset($_POST['lugar']) &&
        isset($_POST['fecha']) && isset($_POST['destino']) &&
        isset($_POST['total']) && isset($_POST['motivo'])) {
        
        $nrocomprobante = $_POST['nrocomprobante'];
        $lugar = $_POST['lugar'];
        $fecha = $_POST['fecha'];
        $presentado = $_POST['presentado'];
        $destino = $_POST['destino'];
        $total = $_POST['total'];
        $motivo = $_POST['motivo'];
        $correo = $_POST['correo'];
        $comprobante = "Caja chica";

         $nombrecontrol =  'Guillermo Panetta';
         $subject    = 'Comprobante de Caja';
            
         $message.= '<html><head>
         <meta charset="utf-8">
         <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
         <style> table, th, td { border: 1px solid; }</style>
         </head><body>
         <table style="max-width: 600px; padding: 10px; margin:0 auto; border-collapse: collapse;">
                <tr><td style="background-color: #ecf0f1; text-align: left; padding: 0">
                    <a href="https://daxa.com.ar">
                      <img width="20%" style="display:block; margin: 1.5% 3%" src="http://daxa.com.ar/images/logo.png">
                    </a>
                  </td>
                </tr>';
        $message.=' <tr>
                  <td style="background-color: #ecf0f1">
                    <div style="color: #34495e; margin: 4% 10% 2%; text-align: justify;font-family: sans-serif">
                      <h2 style="color: #e67e22; margin: 0 0 7px">Estimado '.$nombrecontrol.'</h2>
                      <p style="margin: 2px; font-size: 15px">
                        Una nueva solicitud de '.$subject.' ha sido ingresada por <b>'.$presentado.'</b>. <br>Favor de ingresar a la página para controlar la solicitud.<br><br>
                        <i><b>Resumen del Comprobante:</b></i></p>
                        <table style="color: #34495e; font-size: 13px;  margin: 10px; border: 1px solid">
                        <tr>
                          <td style="padding:0 30px 0 1px;">Comprobante.N°:</td>
                          <td>'.$nrocomprobante.'</td>
                        </tr>
                        <tr>
                          <td style="padding:0 30px 0 1px;">Preparó:</td>
                          <td>'.$presentado.'</td>
                        </tr>
                        <tr>
                          <td style="padding:0 30px 0 1px;">Controló:</td>
                          <td>n/a</td>
                        </tr>
                        <tr>
                          <td style="padding:0 30px 0 1px;">Autorizó:</td>
                          <td>n/a</td>
                        </tr>
                        <tr>
                          <td style="padding:0 30px 0 1px;">Destino:</td>
                          <td>'.$destino.'</td>
                        </tr>
                        <tr>
                          <td style="padding:0 30px 0 1px;">Motivo:</td>
                          <td>'.$motivo.'</td>
                        </tr>
                        <tr>
                          <td style="padding:0 30px 0 1px;">Total:</td>
                          <td>'.$total.'</td>
                        </tr>
                        <tr>
                          <td style="padding:0 30px 0 1px;">Lugar: '.$lugar.'</td>
                          <td>Fecha: '.$fecha.'</td>
                        </tr>
                        <tr>
                          <td style="padding:0 30px 0 1px;">Correo:</td>
                          <td>'.$correo.'</td>
                        </tr>
                        </table>
                      <br>
                      <br>
                      <div style="width: 100%; text-align: center">
                        <a style="text-decoration: none; border-radius: 5px; padding: 11px 23px; color: white; background-color: #3498db"
                          href="https://daxa.com.ar/">Ir a la página</a>
                      </div>
                      <p style="color: #b3b3b3; font-size: 12px; text-align: center;margin: 30px 0 0">Daxa Argentina 2022
                      </p>
                    </div>
                  </td>
                </tr>';
              $message.='</table>';


        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "comprobantes";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Error. No se puede conectar con la base de datos.');
        }
        else {
            $Select = "SELECT Nro_comprobante FROM comprobante WHERE Nro_comprobante = ? LIMIT 1";
            $Insert = "INSERT INTO comprobante(Comprobante, Presentado, Destino, Motivo, Lugar, Fecha, Nro_comprobante, Total) values(?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $nrocomprobante);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssssss",$comprobante, $presentado, $destino, $motivo, $lugar, $fecha, $nrocomprobante, $total);
                if ($stmt->execute()) {
                    //echo "Nuevo registro insertado correctamente.";
                    $enviado = $mailSend-> Enviar("Comprobantes |DAXA|",$presentado,"guillermo.silva@daxa.com.ar","Nueva solicitud de comprobante de caja", $message);
                    if($enviado){
                        header("Location: caja_chica.php?e=success");
                    }else {
                        echo ("Error al enviar el correo");
                    }
                    
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Nrocomprobante ya existe.";
                header("Location: caja_chica.php?e=error");
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "Todos los campos son requeridos.";
        die();
    }
}
else {
    echo "Botón submit no está colocado";
}
?>