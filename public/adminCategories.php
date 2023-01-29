<?php
session_start();

require 'databaseLogin.php';

if(isset($_SESSION['adminLogged'])){
    require 'headWithAdmin.php';

    ?>
<h2>Select a category to edit</h2><br/>
<ul>
    <?php

    $stmt = $pdo->prepare('SELECT * FROM category');

    $stmt->execute();

    foreach($stmt as $row){
        echo '<li><a href="editCategory.php?id=' . $row['id'] . '">' . $row['name'] . '</a></li>';
    }

?>
    <br/>
    <p><a href="addCategory.php">Add a new category</a></p>
    <p><a href="deleteCategory.php">Delete a category</a></p>
</ul>

<?php
}
else{
    require 'head.php';
    echo '<p>Not logged in as admin.</p>';
}

require 'footer.php';
?>