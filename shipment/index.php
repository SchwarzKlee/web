<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отгрузка</title>
    
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="/assets/img/factory.png" alt="">
                <h1><a href="/assets/index.php">Завод Прогресс</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="/products/index.php">Товары</a></li>
                    <li>|</li>
                    <li><a href="/orders/index.php">Заказы</a></li>
                    <li>|</li>
                    <li><a href="/consumers/index.php">Заказчики</a></li>
                    <li>|</li>
                    <li class="in">Отгрузка</li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <div class="addButton">
            <h1>Отгрузка</h1>
            <a href="php/addProduct.php"><button>Добавить отгрузку</button></a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Товар</th>
                    <th>Дата отгрузки</th>
                    <th>Количество</th>
                    <th>Статус</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once __DIR__ . '/../config.php';
                $sql = '
                    SELECT 
                        z.ID_отгрузки,  
                        t.Наименование AS Товар, 
                        z.`Дата отгрузки`, 
                        z.Количество,
                        z.Статус
                    FROM `отгрузка` z
                    JOIN `товар` t ON z.ID_товара = t.ID_товара
                    ORDER BY z.ID_отгрузки ASC
                ';
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['ID_отгрузки'];
                            echo "
                            <tr>
                                <td>".$row['ID_отгрузки']."</td>
                                <td>".$row['Товар']."</td>
                                <td>".$row['Дата отгрузки']."</td>
                                <td>".$row['Количество']."</td>
                                <td>".$row['Статус']."</td>
                                <td><a href='createAndEdit.php?id=".$id."'>Редактировать</a></td>
                                <td><a href='php/delete.php?id=".$id."'>Удалить</a></td>
                            </tr>
                            ";
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