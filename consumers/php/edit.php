<?php
if (empty($_POST)) {
    header('Location: /consumers/index.php');
    exit();
}
require_once __DIR__ . '/../../config.php';

$id_consumer = (int)$_POST['id'];
$name = $_POST['name'];
$inn = $_POST['inn'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$number = $_POST['number'];
$email = $_POST['email'];

if($id_consumer > 0) {
    $sql = 'UPDATE `заказчик` SET `Наименование`=?, `ИНН`=?, `Юридический адрес`=?, `Контактное лицо`=?, `Телефон`=?, `Email`=? WHERE `ID_заказчика`=?';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssi', $name, $inn, $address, $contact, $number, $email, $id_consumer);
}
else {
    $sql = 'INSERT INTO `заказчик`(`Наименование`, `ИНН`, `Юридический адрес`, `Контактное лицо`, `Телефон`, `Email`) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssss', $name, $inn, $address, $contact, $number, $email);
}

if($stmt) {
    mysqli_stmt_execute($stmt);
    $affected = mysqli_stmt_affected_rows($stmt);
    mysqli_stmt_close($stmt);
    header("Location: /consumers/index.php");
}
?>