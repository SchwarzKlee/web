<?php
if (empty($_GET)) {
    header('Location: /consumers/index.php');
    exit();
}
$id_consumer = (int)$_GET['id'];

require_once __DIR__ . '/../../config.php';
$stmt = mysqli_prepare($conn, 'DELETE FROM `заказчик` WHERE `ID_заказчика` = ?');
mysqli_stmt_bind_param($stmt, 'i', $id_consumer);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: /consumers/index.php");
?>