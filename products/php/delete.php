<?php
if (empty($_GET)) {
    header('Location: /products/index.php');
    exit();
}
$id_product = (int)$_GET['id'];

require_once __DIR__ . '/../../config.php';
$stmt = mysqli_prepare($conn, 'DELETE FROM `товар` WHERE `ID_товара` = ?');
mysqli_stmt_bind_param($stmt, 'i', $id_product);

mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header("Location: /products/index.php");
?>