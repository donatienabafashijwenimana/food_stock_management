<?php
include '../connect.php';
if (isset($_POST['addproduct'])){
    $pname = $_POST['pname'];
    $select= $conn->query("select*from product where productname='$pname'");
    if(mysqli_num_rows($select)>0){
        ?><script>
            alert('produdt exist')
            window.history.back();
        </script>
        <?php
    }else{
        $insert = $conn->query("insert into product values(null,'$pname')");
        if ($insert) {
            ?><script>
            alert('produdt added')
            window.location.href='home.php';
        </script>
        <?php 
        }
    }
}
include '../connect.php';
if (isset($_POST['updateproduct'])){
    $pname = $_POST['pname'];
    $id= $_POST['id'];
    $select= $conn->query("select*from product where productname='$pname' and productid<>'$id'");
    if(mysqli_num_rows($select)>0){
        ?><script>
            alert('produdt exist')
            window.location.href='home.php';
        </script>
        <?php
    }else{
        $insert = $conn->query("update product set productname='$pname' where productid='$id'");
        if ($insert) {
            ?><script>
            alert('product upadeted')
            window.location.href='home.php';
        </script>
        <?php 
        }
    }
}



if(isset($_POST['addin'])){
    $pname=$_POST['id'];
    $qty = $_POST['qty'];
    $uprice = $_POST['uprice'];
    $tprice = $uprice*$qty;
    $select = $conn->query("select*from stockin where pid='$pname' and date=current_date()");
    if (mysqli_num_rows($select)>0) {
        $insert =$conn->query("update stockin set qty=qty+'$qty',uprice=uprice+'$uprice',
        tprice=tprice+'$tprice' where pid='$pname' and date=current_date()");
        if ($insert) {
            $insert =$conn->query("update stockin set uprice=tprice/qty where pid='$pname' and date=current_date()");
            ?><script>
                alert('stockin added')
                window.location.href='home.php';
            </script>
            <?php 
        }
    }else {
    $insert =$conn->query("insert into stockin values(null,'$pname',current_date(),'$qty','$uprice','$tprice')");
    if ($insert) {
        ?><script>
            alert('stockin added')
            window.location.href='home.php';
        </script>
        <?php 
    }
}
}

if(isset($_POST['updatein'])){
    $pname=$_POST['id'];
    $qty = $_POST['qty'];
    $uprice = $_POST['uprice'];
    $tprice = $uprice*$qty;
        $insert =$conn->query("update stockin set qty='$qty',uprice='$uprice',
        tprice='$tprice' where stid='$pname'");
        if ($insert) {
            ?><script>
                alert('stockin updated')
                window.location.href='home.php?sin';
            </script>
            <?php 
        }
    

}


if(isset($_POST['addout'])){
    $pname=$_POST['id'];
    $qty = $_POST['qty'];
    $uprice = $_POST['uprice'];
    $tprice = $uprice*$qty;

    $select = $conn->query("select sum(qty) from stockin where pid='$pname'");
    $xin = mysqli_fetch_array($select);
    $select = $conn->query("select sum(qty) from stockout where pid='$pname'");
    $xout = mysqli_fetch_array($select);
    if ($xin['sum(qty)']-$xout['sum(qty)']<$qty) {
        ?><script>
            alert('not enough quantiyt')
            window.location.href='home.php';
        </script>
        <?php
    }else{
    $select = $conn->query("select*from stockout where pid='$pname' and date=current_date()");
    if (mysqli_num_rows($select)>0) {
        $insert =$conn->query("update stockout set qty=qty+'$qty' where pid='$pname' and date=current_date()");
        if ($insert) {
            ?><script>
                alert('stockout added')
                window.location.href='home.php';
            </script>
            <?php 
        }
    }else {
    $insert =$conn->query("insert into stockout values(null,'$pname',current_date(),'$qty')");
    if ($insert) {
        ?><script>
            alert('stockin added')
            window.location.href='home.php'
        </script>
        <?php 
    }
}
}
}

if(isset($_POST['updateout'])){
    $pname=$_POST['id'];
    $pid = $_POST['pid'];
    $qty = $_POST['qty'];

    $select = $conn->query("select sum(qty) from stockin where pid='$pid'");
    $xin = mysqli_fetch_array($select);
    $select = $conn->query("select sum(qty) from stockout where pid='$pid'");
    $xout = mysqli_fetch_array($select);
    if (($xin['sum(qty)']-$xout['sum(qty)'])<$qty) {
        ?><script>
            alert('not enough quantity')
            window.history.back()
        </script>
        <?php
    }else{
        $insert =$conn->query("update stockout set qty='$qty' where stid='$pname'");
        ?><script>
            alert('updated')
            window.location.href='home.php?sout'
        </script>
        <?php

}
}