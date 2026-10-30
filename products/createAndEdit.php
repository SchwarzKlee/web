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
            <?php
            require_once __DIR__ . '/../config.php';
            if (!empty($_GET)) {
                $id = (int)$_GET['id'];
                $stmt = mysqli_prepare($conn, 'SELECT * FROM `товар` WHERE `ID_товара` = ?');
                mysqli_stmt_bind_param($stmt, 'i', $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                while($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <h2>Редактировать товар</h2>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <label for='name'>Наименование</label>
                    <input type='text' name='name' id='name' placeholder='Наименование' required value='".$row['Наименование']."'>
                    <label for='opisanie'>Описание</label>
                    <textarea name='opisanie' id='opisanie' cols='30' rows='5' placeholder='Описание' required>".$row['Описание']."</textarea>
                    <label for='price'>Цена</label>
                    <input type='number' name='price' id='price' placeholder='Цена' required value='".$row['Цена']."'>
                    <label for='value'>Размер</label>
                    <input type='number' name='value' id='value' placeholder='Размер' required value='".$row['Размер']."'>
                    <input type='submit' value='Сохранить'>
                    ";
                }
            }
            else {
                echo "
                <h2>Товар</h2>
                <input type='hidden' name='id' value='-1'>
                <input type='text' name='name' id='name' placeholder='Наименование' required>
                <textarea name='opisanie' id='opisanie' cols='30' rows='5' placeholder='Описание' required></textarea>
                <input type='number' name='price' id='price' placeholder='Цена' required>
                <input type='number' name='value' id='value' placeholder='Размер' required>
                <input type='submit' value='Сохранить'>
                ";
            }
            ?>
            </form>
        </div>
    </main>
</body>
</html>