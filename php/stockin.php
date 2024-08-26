<?php

include '../connect.php';
$select = $conn->query("select*,sum(qty),sum(tprice)from product,stockin where pid=productid
group by pid");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="head">stockin</div>
    <div class="table">
       <table>
            <thead>
                    <th>producid</th>
                    <th>productname</th>
                    <th>quantity</th>
                    <th>totalprice</th>
                    <th colspan='2'>action</th>
                </thead>
                <?php $y=1; foreach($select as $x){?>
                <tr>
                    <td><?=$y++?></td>
                    <td><?=$x['productname']?></td>
                    <td><?=$x['sum(qty)']?>kg</td>
                    <td><?=$x['sum(tprice)']?>frw</td>
                    <td><a href="?sin&&up=<?=$x['stid']?>"><button class="up">update</button></a></td>
                    <td><a href="delete.php?idsi=<?=$x['stid']?>"><button class="del">delete</button></a></td>
                </tr>
                <?php }?>
       </table>
    </div>
    <div class="<?=isset($_GET['up'])?"form":"formh"?>">
    <?php $select = $conn->query("select*from stockin where stid='{$_GET['up']}'");
      $row = mysqli_fetch_array($select);?>
        <form action="add.php" method="post">
            <a href="?product"class="close">&times</a>
            <input type="hidden" name="id" value="<?=$_GET['up']?>">

            <label for="">quantity</label>
            <input type="number" name="qty" min='1' value='<?=$row['qty']?>'>
            <label for="">unit price</label>
            <input type="tel" name="uprice" id="" min="1"value='<?=$row['uprice']?>'>
            <input type="submit" value="update stockin" name="updatein">
        </form>
    </div>
</body>
</html>