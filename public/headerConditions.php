<?php
session_start();

//Got from: https://stackoverflow.com/questions/48561298/how-to-suppress-php-warnings-with-pdo
ini_set('display_errors', 1);

if(isset($_SESSION['loggedin']) && !isset($_SESSION['adminLogged'])){
    require 'headWithLogout.php';
}
else if(isset($_SESSION['adminLogged'])){
    require 'headWithAdmin.php';
}
else{
    require 'head.php';
}

?>