<?php
require 'headerConditions.php';
require 'databaseLogin.php';

if(isset($_SESSION['loggedin'])){
    if(isset($_POST['submit'])){
        $stmt=$pdo->prepare('INSERT INTO auction(title, description, categoryId, userName, endDate)
                                                VALUES(:title, :description, :categoryId, :userName, :endDate)
        ');
        $catIdStmt=$pdo->prepare('SELECT id FROM category WHERE name = :name');

        $nameValues = [
            'name'=>$_POST['category']
        ];

        $catIdStmt->execute($nameValues);
        $catId=$catIdStmt->fetch();

        $values = [
            'title'=>$_POST['title'],
            'description'=>$_POST['description'],
            'categoryId'=>$catId['id'],
            'userName'=>$_POST['userName'],
            'endDate'=>$_POST['endDate']
        ];

        $stmt->execute($values);

        echo 'Auction has ben added successfully';
    }else{
        ?>
        <h2>Add an auction</h2>
        <br/>
        <form action="addAuction.php" method="POST">
            <label>Title</label>
            <input type="text" name="title" value=""/>
            <label>Description</label>
            <input type="text" name="description" value=""/>
            <input type="hidden" name="userName" value="<?php echo $_SESSION['loggedin'] ?>"/>
            <?php
            $categoryStmt=$pdo->prepare('SELECT name FROM category');

            $categoryStmt->execute();
            $cat=$categoryStmt->fetchAll();

            ?>
            <label>Category: </label>
            <select name="category">
            <?php
            foreach($cat as $row){
            ?>
            <option><?php echo $row['name'] ?></option>
            <?php
            }
            ?>
            </select>
            <label>Auction availability: </label>
            <input type="date" name="endDate" value=""/>

            <input type="submit" name="submit" value="Add auction"/>
        </form>
        <?php
    }
}

?>


<?php
require 'footer.php'
?>