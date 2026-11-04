
<?php
require_once __DIR__ . '/../config.php';

$products = [];
$shipmentRow = null;

$stmt = mysqli_prepare($conn, 'SELECT `ID_товара`, `Наименование` FROM `товар` ORDER BY `Наименование` ASC');
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_stmt_close($stmt);

if (!empty($_GET['id'])) {
    $id = (int)$_GET['id'];

    $stmt = mysqli_prepare($conn, 'SELECT * FROM `отгрузка` WHERE `ID_отгрузки` = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $shipmentRow = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>отгрузка</title>
    
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
            <?php if ($shipmentRow): ?>
                <h2>Редактировать отгрузку</h2>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div>
                    <label for="product_id">Товар</label>
                    <select name="product_id" id="product_id" required>
                        <option value="" disabled selected>Выберите товар</option>
                        <?php foreach ($products as $p): ?>
                        <option value="<?php echo (int)$p['ID_товара']; ?>"
                        <?php if ((int)$shipmentRow['ID_товара'] === (int)$p['ID_товара']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($p['Наименование']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="date">Дата отгрузки</label>
                    <input type="date" name="date" id="date" placeholder="Дата отгрузки" required value="<?php echo $shipmentRow['Дата отгрузки']; ?>">
                </div>
                <div>
                    <label for="count">Количество</label>
                    <input type="number" name="count" id="count" placeholder="Количество" required value="<?php echo (int)$shipmentRow['Количество']; ?>">
                </div>
                <div>
                    <label for="status">Статус</label>
                    <select name="status" id="status" required>
                        <option value="Не отгружено" <?php if ($shipmentRow['Статус'] === 'Не отгружено') echo 'selected'; ?>>Не отгружено</option>
                        <option value="Отгружено" <?php if ($shipmentRow['Статус'] === 'Отгружено') echo 'selected'; ?>>Отгружено</option>
                    </select>
                </div>
                <?php else: ?>
                <h2>Добавить отгрузку</h2>
                    <input type="hidden" name="id" value="-1">
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
                        <label for="date">Дата отгрузки</label>
                        <input type="date" name="date" id="date" required>
                    </div>
                    <div>
                        <label for="count">Количество</label>
                        <input type="number" name="count" id="count" placeholder="Количество" required>
                    </div>
                    <div>
                        <label for="status">Статус</label>
                        <select name="status" id="status" required>
                            <option value="Не отгружено" selected>Не отгружено</option>
                            <option value="Отгружено">Отгружено</option>
                        </select>
                    </div>
                <?php endif; ?>
                <button type="submit" value="Сохранить">Сохранить</button>
            </form>
        </div>
    </main>
</body>
</html>