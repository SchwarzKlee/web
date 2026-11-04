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
                    <li class="in">Заказы</li>
                    <li>|</li>
                    <li><a href="/consumers/index.php">Заказчики</a></li>
                    <li>|</li>
                    <li><a href="/shipment/index.php">Отгрузка</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="addButton">
            <h1>Заказы</h1>
            <a href="createAndEdit.php"><button>Добавить заказ</button></a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Заказчик</th>
                    <th>Номер договора</th>
                    <th>Товар</th>
                    <th>Количество</th>
                    <th>Дата заказа</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once __DIR__ . '/../config.php';
                $sql = '
                    SELECT 
                        z.ID_заказа, 
                        c.Наименование AS Заказчик, 
                        z.`Номер договора`, 
                        t.Наименование AS Товар, 
                        z.Количество, 
                        z.`Дата заказа`
                    FROM `заказ` z
                    JOIN `заказчик` c ON z.ID_заказчика = c.ID_заказчика
                    JOIN `товар` t ON z.ID_товара = t.ID_товара
                    ORDER BY z.ID_заказа ASC
                ';
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($result) {
                        $counter = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $counter++;    
                            $id = $row['ID_заказа'];
                            echo "<tr>
                                <td>$counter</td>
                                <td>".$row['Заказчик']."</td>
                                <td>".$row['Номер договора']."</td>
                                <td>".$row['Товар']."</td>
                                <td>".$row['Количество']."</td>
                                <td>".$row['Дата заказа']."</td>
                                <td><a href='createAndEdit.php?id=".$id."'>Редактировать</a></td>
                                <td><a href='php/delete.php?id=".$id."'>Удалить</a></td>
                            </tr>";
                        }
                    } else {
                        $errorMessage = mysqli_error($conn);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    $errorMessage = mysqli_error($conn);
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
