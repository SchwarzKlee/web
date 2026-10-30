<?php
if (empty($_POST)) {
    header('Location: /products/index.php');
    exit();
}
require_once __DIR__ . '/../../config.php';

$id_product = (int)$_POST['id'];
$name = $_POST['name'];
$opisanie = $_POST['opisanie'];
$price = $_POST['price'];
$value = $_POST['value'];

if($id_product > 0) {
    $sql = 'UPDATE `товар` SET `Наименование`=?, `Описание`=?, `Цена`=?, `Размер`=? WHERE `ID_товара`=?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssddd', $name, $opisanie, $price, $value, $id_product);
}
else {
    $sql = 'INSERT INTO `товар` (`Наименование`, `Описание`, `Цена`, `Размер`) VALUES (?, ?, ?, ?)';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdd', $name, $opisanie, $price, $value);
}

if($stmt) {
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    header("Location: /products/index.php");
}
?>