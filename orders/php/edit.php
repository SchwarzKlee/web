<?php
if (empty($_POST)) {
    header('Location: /orders/index.php');
    exit();
}
require_once __DIR__ . '/../../config.php';

$id_order = (int)$_POST['id'];
$customer_id = $_POST['customer_id'];
$number = $_POST['number'];
$product_id = $_POST['product_id'];
$count = $_POST['count'];
$date = $_POST['date'];

if (preg_match('/^\d{4}-\d{2}-\d{2}$/', trim($date))) {
    $final = trim($date);
} else {
    $final = date('Y-m-d');
}

$stmt = null;
if ($id_order > 0) {
    $query = "UPDATE `заказ` SET `ID_заказчика`='$customer_id', `Номер договора`='$number', `ID_товара`='$product_id', `Количество`='$count', `Дата заказа`='$final' WHERE `ID_заказа`='$id_order'";
    $stmt = mysqli_prepare($conn, $query);
} else {
    $query = "INSERT INTO `заказ` (`ID_заказчика`, `Номер договора`, `ID_товара`, `Количество`, `Дата заказа`) VALUES ('$customer_id', '$number', '$product_id', '$count', '$final')";
    $stmt = mysqli_prepare($conn, $query);
}

if($stmt) {
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    header("Location: /orders/index.php");
}
?>