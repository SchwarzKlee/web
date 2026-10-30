<?php
require_once __DIR__ . '/config.php';
$dbStatus = mysqli_ping($conn) ? 'Соединение с БД успешно.' : 'Проблема с подключением к БД.';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Завод "Прогресс"</title>
    
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="assets//img/factory.png" alt="">
                <h1><a href="/index.php">Завод Прогресс</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="/products/index.php">Товары</a></li>
                    <li>|</li>
                    <li><a href="/orders/index.php">Заказы</a></li>
                    <li>|</li>
                    <li><a href="/consumers/index.php">Заказчики</a></li>
                    <li>|</li>
                    <li><a href="/shipment/index.php">Отгрузка</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main class="main">
    <div class="center-panel">
      <h2>Завод "Прогресс"</h2>
      <div class="panel">
        <p>Соединение с БД успешно.</p>
      </div>
      <div class="panel-table">
        <div class="panel">
            <img src="assets/img/Товары.png">
            <a href="/products/index.php">Товары</a>
        </div>
        <div class="panel">
            <img src="assets/img/Заказы.png">
            <a href="/orders/index.php">Заказы</a>
        </div>
        <div class="panel">
            <img src="assets/img/Заказчики.png">
            <a href="/consumers/index.php">Заказчики</a>
        </div>
        <div class="panel">
            <img src="assets/img/Отгрузка.png">
            <a href="/shipment/index.php">Отгрузка</a>
      </div>
    </div>
  </main>
</body>
</html>