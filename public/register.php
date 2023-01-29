<?php
require 'headerConditions.php';

require 'databaseLogin.php';

$loginMessage = "<p><a href=\"login.php\">Click here to login.</a></p>";
$registerMessage = "<p><a href=\"register.php\">Click here to register again.</a></p>";

if(isset($_POST['submit'])){
    $stmt = $pdo->prepare('INSERT INTO userAccounts (email, pass, displayName)
                                                    VALUES(:email, :pass, :displayName)
');

if($_POST['email'] === '' || $_POST['password'] === '' || $_POST['displayname'] === ''){
    echo "Enter all the required information!" . $registerMessage;
}
else{
    
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $values = [
            'email'=>$_POST['email'],
            'pass'=>$hash,
            'displayName'=>$_POST['displayname']
        ];
        $stmt->execute($values);


        echo "Your account has been successfully created." . $loginMessage;
    }

}
else{
?>

<h2>Register</h2>

<br/>

<form action="register.php" method="POST">
    <label>Email</label>
    <input type="text" name="email" value="" />

    <label>Password</label>
    <input type="password" name="password" value="" />

    <label>Display name</label>
    <input type="text" name="displayname" value="" />
    
    <input type="submit" name="submit" value="Submit" />
</form>
<a href="login.php">Already have an account? Click here to Login</a>

<?php
}

?>

<?php
require 'footer.php';
?>