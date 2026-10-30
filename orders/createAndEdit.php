
<?php
require_once __DIR__ . '/../config.php';

$customers = [];
$products = [];
$orderRow = null;

$stmt = mysqli_prepare($conn, 'SELECT `ID_заказчика`, `Наименование` FROM `заказчик` ORDER BY `Наименование` ASC');
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

$stmt = mysqli_prepare($conn, 'SELECT `ID_товара`, `Наименование` FROM `товар` ORDER BY `Наименование` ASC');
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

if (!empty($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = mysqli_prepare($conn, 'SELECT * FROM `заказ` WHERE `ID_заказа` = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $orderRow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказы</title>
    
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="/assets/img/factory.png" alt="">
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
        <div class="form">
            <form action='php/edit.php' method='post'>
            <?php if ($orderRow): ?>
                <h2>Редактировать заказ</h2>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div>
                    <label for="customer_id">Заказчик</label>
                    <select name="customer_id" id="customer_id" required>
                        <option value="" disabled selected>Выберите заказчика</option>
                        <?php foreach ($customers as $c): ?>
                            <option value="<?php echo (int)$c['ID_заказчика']; ?>"
                                <?php if ((int)$orderRow['ID_заказчика'] === (int)$c['ID_заказчика']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($c['Наименование']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="number">Номер договора</label>
                    <input type="text" name="number" id="number" placeholder="Номер договора" required value="<?php echo htmlspecialchars($orderRow['Номер договора']); ?>">
                </div>
                <div>
                    <label for="product_id">Товар</label>
                    <select name="product_id" id="product_id" required>
                        <option value="" disabled selected>Выберите товар</option>
                        <?php foreach ($products as $p): ?>
                        <option value="<?php echo (int)$p['ID_товара']; ?>"
                        <?php if ((int)$orderRow['ID_товара'] === (int)$p['ID_товара']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($p['Наименование']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="count">Количество</label>
                    <input type="number" name="count" id="count" placeholder="Количество" required value="<?php echo (int)$orderRow['Количество']; ?>">
                </div>
                <div>
                    <label for="date">Дата заказа</label>
                    <?php
                    $dateValue = $orderRow['Дата заказа'];
                    if (strlen($dateValue) > 10) $dateValue = substr($dateValue, 0, 10);
                    ?>
                    <input type="date" name="date" id="date" required value="<?php echo htmlspecialchars($dateValue); ?>">
                </div>
                <?php else: ?>
                <h2>Добавить заказ</h2>
                    <input type="hidden" name="id" value="-1">
                    <div>
                        <label for="customer_id">Заказчик</label>
                        <select name="customer_id" id="customer_id" required>
                            <option value="" disabled selected>Выберите заказчика</option>
                            <?php foreach ($customers as $c): ?>
                                <option value="<?php echo (int)$c['ID_заказчика']; ?>">
                                    <?php echo htmlspecialchars($c['Наименование']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="number">Номер договора</label>
                        <input type="text" name="number" id="number" placeholder="Номер договора" required>
                    </div>
                    <div>
                        <label for="product_id">Товар</label>
                        <select name="product_id" id="product_id" required>
                            <option value="" disabled selected>Выберите товар</option>
                            <?php foreach ($products as $p): ?>
                                <option value="<?php echo (int)$p['ID_товара']; ?>">
                                    <?php echo htmlspecialchars($p['Наименование']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="count">Количество</label>
                        <input type="number" name="count" id="count" placeholder="Количество" required>
                    </div>
                    <div>
                        <label for="date">Дата заказа</label>
                        <input type="date" name="date" id="date" required>
                    </div>
                <?php endif; ?>

                <button type="submit" value="Сохранить">Сохранить</button>
            </form>
        </div>
    </main>
</body>
</html>