<?php session_start();?>
<?php if(!isset($_SESSION['id']) ): ?>
<form method="POST">
    <input  name="username"/>
    <input  name="password"/>
    <input type="submit" name="submit"/>

</form>
<?php  endif; ?>

<?php
mysql_connect("localhost", "root", "");
mysql_select_db("shoppingCart");

if(isset($_POST['username'], $_POST['password']) ){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT id FROM users WHERE password = '$password' AND  username = '$username'";


    $result = mysql_query($query);
    $user = mysql_fetch_assoc($result);

    if(empty($user) ){
        echo "Invalid details";
    }
    else{
        $_SESSION['id'] = $user['id'];
    }

}

if(isset($_SESSION['id']) ){
    $id = $_SESSION['id'];
    $query = "SELECT id, username, password FROM users WHERE id = $id ";
    $result = mysql_query($query);
    $user = mysql_fetch_assoc($result);

    echo "<h1>". $user['username'] . " you are logged on <h1> ";

    $logout = "<a href='?logout=true'>logout</a> ";
    echo $logout;
}
    if($_GET['logout']){
    session_destroy();
    header("Location: /shoppingCart/");
    exit;
}