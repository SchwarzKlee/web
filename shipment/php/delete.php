<?php
if (empty($_GET)) {
    header('Location: /shipment/index.php');
    exit();
}
$id_ship = (int)$_GET['id'];

require_once __DIR__ . '/../../config.php';
$stmt = mysqli_prepare($conn, 'DELETE FROM `отгрузка` WHERE `ID_отгрузки` = ?');
mysqli_stmt_bind_param($stmt, 'i', $id_ship);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: /shipment/index.php");
?>