<?php
session_start();
if (!isset($_SESSION['username'])) {
   header('location:../login.php');
}

$p="";
if (isset($_GET['product'])) 
    $p="product";
    elseif(isset($_GET['sin']))
    $p='sin';
    elseif (isset($_GET['sout'])) 
    $p= 'sout';
    elseif (isset($_GET['reportin'])) 
    $p= 'reportin';
    elseif (isset($_GET['reportout'])) 
    $p= 'reportout';
    elseif (isset($_GET['status'])) 
    $p= 'status';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lavinia food mangement</title>
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/form-table.css">
</head>
<body>
    <div class="header"> LAVINA TSS INFORMATION SYSTEM</div>
    <div class="body">
        <div class="left">
            <a href="?product" class="<?php if($p=='product')echo 'active'?>">product</a>
            <a href="?sin" class="<?php if($p=='sin')echo 'active'?>">stock in</a>
            <a href="?sout"class="<?php if($p=='sout')echo 'active'?>">stockout</a>
            <a href="?reportin"class="<?php if($p=='reportin')echo 'active'?>">report stockin</a>
            <a href="?reportout"class="<?php if($p=='reportout')echo 'active'?>">report stockout</a>
            <a href="?status"class="<?php if($p=='status')echo 'active'?>">stock</a>
            <a href="logout.php">logout(<?=$_SESSION['username'];?>)</a>
        </div>
        <div class="right">
            <?php if(isset($_GET['product'])){ include 'product.php';}
                   elseif(isset($_GET['sin'])){ include 'stockin.php';}
                   elseif(isset($_GET['sout'])){ include 'stockout.php';}
                   elseif(isset($_GET['reportin'])){ include 'reportin.php';}
                   elseif(isset($_GET['reportout'])) {include 'reportout.php';}
                   elseif(isset($_GET['status'])) {include 'status.php';}
                   else {include 'product.php';}?>

        </div>
    </div>
    <div class="footer">
    LAVINA TSS INFORMATION SYSTEM&copycopyright
    </div>
</body>
</html>