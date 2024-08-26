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
        <form action="#" method='post'>
            <label for="">username</label>
            <input type="text" name="username">
            </select>
            <label for="">password</label>
            <input type="password" name="password">
            <input type="submit" value="register" name='register'>
            <a href="login.php">login</a>
        </form>
    </div>
</body>
</html>
<?php
session_start();
include 'connect.php';
if(isset($_POST['register'])){
    if (!preg_match('/^[a-zA-Z]*$/',$_POST['username'])) {
        ?><script>
            alert('incorect username')
            </script>
            <?php
    }elseif (strlen($_POST['password'])!==6) {
        ?><script>
            alert('incorect password')
            </script>
            <?php
    }else{
    $select=$conn->query("select*from user where username='{$_POST['username']}'");
    if (mysqli_num_rows($select)<=0) {
        $row= mysqli_fetch_array($select);
        $insert = $conn->query("insert into user values(null,'{$_POST['username']}','{$_POST['password']}')");
        if ($insert) {
            ?><script>
            alert('registered')
            window.location.href='login.php'
            </script>
            <?php
        }
       

    }else{
        ?><script>
   alert('username exist')
        </script>
        <?php
    }
}
}
?>