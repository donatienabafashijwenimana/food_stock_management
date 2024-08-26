<?php
include '../connect.php';
$select= $conn->query("select* from product");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div class="add" onclick="return window.location.href='?product&&add'">add</div><div class="head">product</div>
    <div class="table">
    <table >
        <thead>
            <td>product id</td>
            <td>product name</td>
            <th>quantity</th>
            <th colspan="4">action</th>
        </thead>
        <?php $y=1; foreach($select as $x){
            
            $select = $conn->query("select sum(qty) from stockin where pid='{$x['productid']}}'");
            $xin = mysqli_fetch_array($select);
            $select = $conn->query("select sum(qty) from stockout where pid='{$x['productid']}}'");
            $xout = mysqli_fetch_array($select);
            ?>
        <tr>
            <td><?=$y++?></td>
            <td><?=$x['productname']?></td>
            <td><?=$xin['sum(qty)']-$xout['sum(qty)']?>kg</td>
            <td><a href="?product&&up=<?=$x['productid']?>"><button class="up">update</button></a></td>
            <td><a href="delete.php?idp=<?=$x['productid']?>"><button class="del">delete</button></a></td>
            <td><a href="?product&&in=<?=$x['productid']?>"><button class="in">in</button></a></td>
            <td><a href="?product&&out=<?=$x['productid']?>"><button class="in">out</button></a></td>
        </tr>
        <?php }?>
    </table>
    </div>
    <div class="<?=isset($_GET['add'])?"form":"formh"?>">
        <form action="add.php" method="post">
            <a href="?product"class="close">&times</a>
            <label for="">product name</label>
            <input type="text" name="pname">
            <input type="submit" value="add product" name="addproduct">
        </form>
    </div>
    <div class="<?=isset($_GET['up'])?"form":"formh"?>">
    <?php $select = $conn->query("select*from product where productid='{$_GET['up']}'") ;
    $row = mysqli_fetch_array($select);?>
        <form action="add.php" method="post">
            <input type="hidden" name="id" value="<?=$_GET['up']?>">
            <a href="?product"class="close">&times</a>
            <label for="">product name</label>
            <input type="text" name="pname" value='<?=$row['productname']?>'>
            <input type="submit" value="update product" name="updateproduct">
        </form>
    </div>
    <div class="<?=isset($_GET['in'])?"form":"formh"?>">
        <form action="add.php" method="post">
            <a href="?product"class="close">&times</a>
            <input type="hidden" name="id" value="<?=$_GET['in']?>">

            <label for="">quantity</label>
            <input type="number" name="qty" min='1'>
            <label for="">unit price</label>
            <input type="number" name="uprice" id="" min="1">
            <input type="submit" value="add stockin" name="addin">
        </form>
    </div>
    <div class="<?=isset($_GET['out'])?"form":"formh"?>">
        <form action="add.php" method="post">
            <a href="?product"class="close">&times</a>
            <input type="hidden" name="id" value="<?=$_GET['out']?>">

            <label for="">quantity</label>
            <input type="number" name="qty" min='1'>
            <!-- <label for="">unit price</label> -->
            <input type="hidden" name="uprice" id="" min="1" value='1'>
            <input type="submit" value="add stockout" name="addout">
        </form>
    </div>
</body>
</html>