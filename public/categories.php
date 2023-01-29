<?php
require 'headerConditions.php';
require 'databaseLogin.php';

if(isset($_SESSION['loggedin']) || isset($_SESSION['adminLogged'])){
    ?>
    <h2><a href="addAuction.php">Add a new auction</a></h2>
    <?php
}
?>

<h1>Active listings</h1>
<ul class="productList">

<?php

if(isset($_GET['id'])){
    $stmt = $pdo->prepare('SELECT * FROM auction WHERE categoryId = :id');
    $stmtn = $pdo->prepare('SELECT name FROM category WHERE id = :id');

    $values = [
        'id'=>$_GET['id']
    ];
    
    $stmt->execute($values);
    $stmtn->execute($values);

    $auction= $stmt->fetchAll();
    $cat= $stmtn->fetch();

    foreach($auction as $row){
        ?>
        <li>
            <img src="product.png" alt="<?php echo $row['title'] ?>">
            <article>
                <h2>Title: <?php echo $row['title'] ?></h2>
                <h3>Category name: <?php echo $cat['name'] ?></h3>
                <p>Description: <?php echo $row['description'] ?></p>

                <p class="price">Current bid: ...</p>
                <a href="auctionInfo.php?id=<?php echo $row['id'] ?>&categoryId=<?php echo $row['categoryId'] ?>" class="more auctionLink">More &gt;&gt; </a>
            </article>
        </li>
        <?php
    }
}


?>

</ul>

<?php
require 'footer.php'
?>