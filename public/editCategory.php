<?php
session_start();

require 'databaseLogin.php';

if(isset($_SESSION['adminLogged'])){
    require 'headWithAdmin.php';

    if(isset($_POST['submit'])){
        $stmt = $pdo->prepare('UPDATE category SET name = :name WHERE id = :id');

        $values = [
            'name' => $_POST['name'],
            'id' => $_POST['id']
        ];

        $stmt->execute($values);
        echo "Category " . $_POST['name'] . " has been edited.";
    }
    else if(isset($_GET['id'])){
        $nameStmt = $pdo->prepare('SELECT * FROM category WHERE id = :id');

        $values = [
            'id' => $_GET['id']
        ];

        $nameStmt->execute($values);

        $catname = $nameStmt->fetchAll();

        foreach($catname as $row){
        ?>
        <form action="editCategory.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $catname[0]['id']; ?>"/>
            <label>Category name: </label>
            <input type="text" name="name" value="<?php echo $catname[0]['name']; ?>"/>
            <input type="submit" name="submit" value="Modify category"/>
        </form>
        <?php
        }
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