<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/form.css">
</head>
<body>
    <div class="header">lavina tss information system</div>
    <div class="form">
        <form action="#" method="post">
            <label for="">username</label>
            <input type="text" name="username" pattern='[a-zA-Z]{3,6}' title='incorect username'>
            </select>
            <label for="">password</label>
            <input type="password" name="password" pattern='.{3,}' title='incorect password'>
            <input type="date" name="" id="" max="<?=date('Y-m-d')?>">
            <input type="submit" value="login" name="login">
            <a href="register.php">register</a>
        </form>
    </div>
</body>
</html>

<?php
session_start();
include 'connect.php';
if(isset($_POST['login'])){
    $select=$conn->query("select*from user where username='{$_POST['username']}' and password='{$_POST['password']}'");
    if (mysqli_num_rows($select)>0) {
        $row= mysqli_fetch_array($select);
        $_SESSION['username'] = $_POST['username'];
        header("location:php/home.php");

    }else{
        ?><script>
   alert('login failed')
        </script>
        <?php
    }
}
?>