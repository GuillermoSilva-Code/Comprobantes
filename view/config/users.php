<?php  
require_once 'config/db_connect.php';
function userdata($username) {
    global $connect;
    $sql = "SELECT * FROM usuarios WHERE username = '$username'";
    $query = $connect->query($sql);
    $result = $query->fetch_assoc();
    if($query->num_rows == 1) {
        return $result;
    } else {
        return false;
    }
     
    $connect->close();
 
}
function logged_in() {
    if(isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
}
function not_logged_in() {
    if(isset($_SESSION['id']) === FALSE) {
        return true;
    } else {
        return false;
    }
}
 
function getUserDataByUserId($id) {
    global $connect;
 
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $query = $connect->query($sql);
    $result = $query->fetch_assoc();
    return $result;
 
    $connect->close();
}
function users_exists_by_id($id, $username) {
    global $connect;
 
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND id != $id";
    $query = $connect->query($sql);
    if($query->num_rows >= 1) {
        return true;
    } else {
        return false;
    }
 
    $connect->close();
}
 
function updateInfo($id) {
    global $connect;
 
    $username = $_POST['username'];
    $apellido = $_POST['apellido'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
 
    $sql = "UPDATE usuarios SET username = '$username', nombre = '$nombre', apellido = '$apellido', email = '$email' WHERE id = $id";
    $query = $connect->query($sql);
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
}

function passwordMatch($id, $password) {
    global $connect;
 
    $userdata = getUserDataByUserId($id);
 
    $makePassword = makePassword($password, $userdata['salt']);
 
    if($makePassword == $userdata['password']) {
        return true;
    } else {
        return false;
    }
 
    // close connection
    $connect->close();
}
 
function changePassword($id, $password) {
    global $connect;
 
    //$salt = salt(32);
    //$makePassword = makePassword($password, $salt);
 
    //$sql = "UPDATE usuarios SET password = '$makePassword', salt = '$salt' WHERE id = $id";
    $sql = "UPDATE usuarios SET Contraseña = '$password' WHERE ID = $id";
    $query = $connect->query($sql);
 
    if($query === TRUE) {
        return true;
    } else {
        return false;
    }
}
function salt($length) {
    return mcrypt_create_iv($length);
}
 
function makePassword($password, $salt) {
    return hash('sha256', $password.$salt);
}

?>