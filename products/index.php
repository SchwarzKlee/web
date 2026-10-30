<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товары</title>
    
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
                    <li class="in">Товары</li>
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
    <main>
        <div class="addButton">
            <h1>Товары</h1>
            <a href="createAndEdit.php"><button>Добавить товар</button></a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Наименование</th>
                    <th>Описание</th>
                    <th>Цена, ₽</th>
                    <th>Размер, см</th>
                    <th>Редактировать</th>
                    <th>Удалить</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once __DIR__ . '/../config.php';

                $stmt = mysqli_prepare($conn, 'SELECT * FROM `товар`');
                if ($stmt) {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['ID_товара'];
                            echo "
                            <tr>
                                <td>".$row['ID_товара']."</td>
                                <td>".$row['Наименование']."</td>
                                <td>".$row['Описание']."</td>
                                <td>".$row['Цена']."</td>
                                <td>".$row['Размер']."</td>
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