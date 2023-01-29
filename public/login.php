<?php
require 'headerConditions.php';

require 'databaseLogin.php';

$loginMessage = '<p><a href="login.php">Click here to attempt login again.</a></p>';

if(isset($_POST['submit'])){
    $stmt = $pdo->prepare('SELECT * FROM userAccounts WHERE email = :email');

    if($_POST['email'] === '' || $_POST['password'] === ''){
        echo "Enter all the required information!" . $loginMessage;
    }
    else{
        $values = [
                'email'=>$_POST['email']
            ];
            $stmt->execute($values);

            $user = $stmt->fetch();

            if(password_verify($_POST['password'], $user['pass'])){
                                echo "Logged in successfully.";
                                $_SESSION['loggedin'] = $user['displayName'];
                                if($user['adminStatus'] === 'y'){
                                    $_SESSION['adminLogged'] = true;
                                }
                            }
                            else{
                                if($_POST['password'] === $user['pass'] && $_POST['email'] === $user['email']){
                                    echo "Successfully logged in.";
                                    $_SESSION['loggedin'] = $user['displayName'];
                                    if($user['adminStatus'] === 'y'){
                                        $_SESSION['adminLogged'] = true;
                                    }
                                }
                                else{
                                    echo "Invalid email or password.";
                                }
                            }
        }
}
else {

?>

<h2>Login</h2>

<br/>

<form action="login.php" method="POST">
    <label>Email</label>
    <input type="text" name="email" value="" />

    <label>Password</label>
    <input type="password" name="password" value="" />
    
    <input type="submit" name="submit" value="Submit" />
</form>

<?php
}
?>

<?php
require 'footer.php';
?>