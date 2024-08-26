<?php

include '../connect.php';
if (isset($_GET['idp'])) {
    $delete = $conn->query("delete from product where productid='{$_GET['idp']}'");
    if ($delete) {
        ?>
        <script>
            alert('product deleted')
            window.location.href='home.php';
        </script>
        <?php
    }
}

include '../connect.php';
if (isset($_GET['idsi'])) {
    $delete = $conn->query("delete from stockin where stid='{$_GET['idsi']}'");
    if ($delete) {
        ?>
        <script>
            alert('record deleted')
            window.location.href='home.php?sin';
        </script>
        <?php
    }
}


include '../connect.php';
if (isset($_GET['idso'])) {
    $delete = $conn->query("delete from stockout where stid='{$_GET['idso']}'");
    if ($delete) {
        ?>
        <script>
            alert('product deleted')
            window.location.href='home.php?sout';
        </script>
        <?php
    }
}
?>