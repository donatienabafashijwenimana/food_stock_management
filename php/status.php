<?php
include '../connect.php';
$select= $conn->query("select* from product");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <div class="head">stock</div>
    <div class="table">
    <table >
        <thead>
            <td>product id</td>
            <td>product name</td>
            <th>quantity in</th>
            <th>quantity out</th>
            <th>quantity remain</th>
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
            <td><?=$xin['sum(qty)']-0?>kg</td>
            <td><?=$xout['sum(qty)']-0?>kg</td>
            <td><?=$xin['sum(qty)']-$xout['sum(qty)']?>kg</td>
            
        </tr>
        <?php }?>
    </table>
    </div>
    
</body>
</html>