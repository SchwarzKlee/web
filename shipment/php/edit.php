<?php
if (empty($_POST)) {
    header('Location: /shipment/index.php');
    exit();
}
require_once __DIR__ . '/../../config.php';

$id_ship = (int)$_POST['id'];
$product_id = $_POST['product_id'];
$date = $_POST['date'];
$count = $_POST['count'];
$status = $_POST['status'];

if (preg_match('/^\d{4}-\d{2}-\d{2}$/', trim($date))) $final = trim($date);
else $final = date('Y-m-d');

$stmt = null;
if ($id_ship > 0) {
    $query = "UPDATE `отгрузка` SET `ID_товара`='$product_id', `Дата отгрузки`='$final', `Количество`='$count', `Статус`='$status' WHERE `ID_отгрузки`='$id_ship'";
    $stmt = mysqli_prepare($conn, $query);
} else {
    $query = "INSERT INTO `отгрузка`(`ID_товара`, `Дата отгрузки`, `Количество`, `Статус`) VALUES ('$product_id', '$final', '$count', '$status')";
    $stmt = mysqli_prepare($conn, $query);
}

if($stmt) {
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    header("Location: /shipment/index.php");
}
?>