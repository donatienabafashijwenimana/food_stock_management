

<?php

include '../connect.php';
$select = $conn->query("select*,sum(qty),sum(tprice)from product,stockin where pid=productid
group by pid");
$selecttot = $conn->query("select*,sum(tprice) from stockin");
if (isset($_POST['generate'])) {
    $select = $conn->query("select*,sum(qty),sum(tprice)from product,stockin where 
    pid=productid and date='{$_POST['date']}' group by pid");
    $selecttot = $conn->query("select*,sum(tprice) from stockin where date='{$_POST['date']}'");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="head">report stockin</div>
    <div class="report">
        <form action="#" method="post">
            <u>daily report</u>
            <label for="">date</label>
            <input type="date" name="date" id="">
            <input type="submit" name="generate" value='generate'>
        </form>
    </div>
    <div class="table" style='margin-left:23%'>
       <table>
            <thead>
                    <th>producid</th>
                    <th>date</th>
                    <th>productname</th>
                    <th>quantity</th>
                    <th>totalprice</th>
                </thead>
                <?php $y=1; foreach($select as $x){?>
                <tr>
                    <td><?=$y++?></td>
                    <td><?=$x['date']?></td>
                    <td><?=$x['productname']?></td>
                    <td><?=$x['sum(qty)']?>kg</td>
                    <td><?=$x['sum(tprice)']?>frw</td>
                </tr>
                <?php }?>
                <tr><th>totalprice:</th>
                <th colspan='4'> <?php 
                   $tot = mysqli_fetch_array($selecttot);
                   echo $tot['sum(tprice)']
                ?>frw</th>
                </tr>

       </table>
    </div>
</body>
</html>