<?php
require 'headerConditions.php';
require 'databaseLogin.php';

if(isset($_SESSION['loggedin'])){
    if(isset($_POST['delete'])){
        $deleteStmt = $pdo->prepare('DELETE FROM auction WHERE title = :title');

        $delValues = [
            'title'=>$_POST['title']
        ];

        $deleteStmt->execute($delValues);

        echo 'The auction has been successfully deleted.';
    }else{
    if(isset($_POST['submit'])){
        $submitStmt = $pdo->prepare('UPDATE auction SET title = :title, description = :description, endDate = :endDate WHERE id = :id');

        $values = [
            'title'=>$_POST['title'],
            'description'=>$_POST['description'],
            'id'=>$_POST['id'],
            'endDate'=>$_POST['endDate']
        ];

        $submitStmt->execute($values);
        echo 'Auction ' . $_POST['title'] . ' has been edited.';
    }
    else if(isset($_GET['id'])){
        $stmt = $pdo->prepare('SELECT * FROM auction WHERE id = :id');
        $bidStmt = $pdo->prepare('SELECT * FROM bids WHERE auctionId = :id');

        $values = [
            'id'=>$_GET['id']
        ];

        $stmt->execute($values);
        $bidStmt->execute($values);

        foreach($stmt as $row){
            //foreach($bidStmt as $rrow){
                ?>
                <form action="editAuction.php?id=<?php echo $row['id']; ?>" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>"/>
                    <label>Auction title: </label>
                    <input type="text" name="title" value="<?php echo $row['title']; ?>"/>
                    <label>Auction description: </label>
                    <input type="textarea" name="description" value="<?php echo $row['description']; ?>"/>
                    <label>Auction availability: </label>
                    <input type="date" name="endDate" value="<?php echo $row['endDate']; ?>"/>
                    <input type="submit" name="submit" value="Modify auction"/>
                    <input type="submit" name="delete" value="Delete auction"/>
                </form>
                <?php
           }
        }
    }
}

?>

<?php
require 'footer.php';
?>