<?php
if (empty($_GET)) {
    header('Location: /orders/index.php');
    exit();
}
$id_order = (int)$_GET['id'];

require_once __DIR__ . '/../../config.php';
$stmt = mysqli_prepare($conn, 'DELETE FROM `заказ` WHERE `ID_заказа` = ?');
mysqli_stmt_bind_param($stmt, 'i', $id_order);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: /orders/index.php");
?>