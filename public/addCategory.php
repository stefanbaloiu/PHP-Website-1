<?php
session_start();

require 'databaseLogin.php';

if(isset($_SESSION['adminLogged'])){
    require 'headWithAdmin.php';

if(isset($_POST['submit'])){
    $stmt = $pdo->prepare('INSERT INTO category (name)
                                            VALUES (:name)
');

$values = [
    'name'=>$_POST['name']
];

$stmt->execute($values);

echo "The category " . $_POST['name'] . " has been successfully added.";

}
else{
?>

<form action="addCategory.php" method="POST">
    <label>Category name</label>
    <input type="text" name="name" value=""/>

    <input type="submit" name="submit" value="Add category"/>
</form>

<?php

}

}
else{
    require 'head.php';
    echo '<p>Not logged in as admin.</p>';
}
?>

<?php
require 'footer.php';
?>