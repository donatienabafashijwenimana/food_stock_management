<?php

include '../connect.php';
$select = $conn->query("select*,sum(qty)from product,stockout where pid=productid
group by pid");
if (isset($_POST['generate'])) {
    $select = $conn->query("select*,sum(qty)from product,stockout where pid=productid and date='{$_POST['date']}'
    group by pid"); 
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
    <div class="head">stockout</div>
    <div class="report">
        <form action="#" method='post'>
            <u>daily report</u>
            <label for=""> date</label>
            <input type="date" name="date" id="">
            <input type="submit" value="generate" name='generate'>
        </form>
    </div>
    <div class="table" style='margin-left:20%'>
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
                    <td><a href="?sin&&up=<?=$x['stid']?>"><button class="up">update</button></a></td>
                    <td><a href="?sin&&idd=<?=$x['stid']?>"><button class="del">delete</button></a></td>
                </tr>
                <?php }?>
                
       </table>
    </div>
</body>
</html>