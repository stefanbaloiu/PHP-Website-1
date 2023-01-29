<?php
session_start();

require 'databaseLogin.php';

if(isset($_SESSION['adminLogged'])){
    require 'headWithAdmin.php';

    if(isset($_POST['submit'])){
        $stmt = $pdo->prepare('DELETE FROM category WHERE name = :name');

        $values = [
            'name'=>$_POST['category']
        ];
        
        $stmt->execute($values);
        echo "Category deleted.";
    }else{
        $stmtSelect = $pdo->prepare('SELECT * FROM category');

        $stmtSelect->execute();
        $data=$stmtSelect->fetchAll();

        ?>
        <form action="deleteCategory.php" method="POST">
            <label>Category name </label>
            <select name="category">
        <?php
        foreach($data as $row){
        ?>
            <option><?php echo $row['name'] ?></option>
        <?php
        }
        ?>
            </select>
            <input type="submit" name="submit" value="Delete category"/>
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
