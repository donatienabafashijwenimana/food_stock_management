<?php

include '../connect.php';
$select = $conn->query("select*,sum(qty)from product,stockout where pid=productid
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
    <div class="head">stockout</div>
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
                    <td><a href="?sout&&up=<?=$x['stid']?>"><button class="up">update</button></a></td>
                    <td><a href="delete.php?idso=<?=$x['stid']?>"><button class="del">delete</button></a></td>
                </tr>
                <?php }?>
       </table>
    </div>
    <div class="<?=isset($_GET['up'])?"form":"formh"?>">
    <?php $selecto = $conn->query("select*from stockout where stid='{$_GET['up']}'");
      $row = mysqli_fetch_array($selecto);?>
        <form action="add.php" method="post">
            <a href="?product"class="close">&times</a>
            <input type="hidden" name="id" value="<?=$_GET['up']?>">
            <input type="hidden" name="pid" value='<?=$row['pid']?>'>

            <label for="">quantity</label>
            <input type="number" name="qty" min='1' value='<?=$row['qty']?>'>
            
            <input type="submit" value="update stockout" name="updateout">
        </form>
    </div>
</body>
</html>