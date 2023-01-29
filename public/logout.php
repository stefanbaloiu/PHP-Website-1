<?php
session_start();

require 'head.php';
require 'databaseLogin.php';

$indexMessage = "<p><a href=\"index.php\">Click here to go back to the main page.</a></p>";

if(isset($_SESSION['loggedin']) || isset($_SESSION['adminLogged'])){
    unset($_SESSION['loggedin']);
    unset($_SESSION['adminLogged']);
    echo "Logged out successfully." . $indexMessage;
}

?>

<?php
require 'footer.php';
?>