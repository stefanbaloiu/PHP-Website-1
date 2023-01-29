<?php
require 'headerConditions.php';
require 'databaseLogin.php';
?>

<?php
if(isset($_GET['id'])){
    $stmt = $pdo->prepare('SELECT * FROM auction WHERE id = :id');
    $stmtc = $pdo->prepare('SELECT name FROM category WHERE id = :categoryId');

    $values=[
        'id'=>$_GET['id']
    ];

    $valuess=[
        'categoryId'=>$_GET['categoryId']
    ];

    $stmt->execute($values);
    $stmtc->execute($valuess);

    $name = $stmtc->fetch();

    foreach($stmt as $row){
        $catNameStmt=$pdo->prepare('SELECT * FROM category');
            ?>
            <h1>Product Page</h1>
            <img src="product.png" alt="product name">
					<section class="details">
						<h2>Product title: <?php echo $row['title']; ?></h2>
						<h3>Product category: <?php echo $name['name'] ?></h3>
						<p>Auction created by <a href="#"><?php echo $row['userName'] ?></a></p>
						<p class="price">Current bid: £</p>
						<time>Available until: <?php echo $row['endDate'] ?></time>
						
					</section>
					<section class="description">
                    <p>Product description: <?php echo $row['description']; ?></p>
					</section><br/><br/>
                    <?php
                    if(isset($_SESSION['loggedin'])){
                    ?>
                    <form action="#" class="bid">
							<input type="text" name="bid" placeholder="Enter bid amount" />
							<input type="submit" value="Place bid" />
					</form>
                    <?php
                    }
                    if(isset($_SESSION['adminLogged']) || isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === $row['userName']){
                    ?>
                    <br/><p><a href="editAuction.php?id=<?php echo $row['id']; ?>">Edit auction</a></p>
            <?php
            }
        }
    }

?>

<?php
require 'footer.php';
?>