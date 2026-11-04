<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказчики</title>
    
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
                $stmt = mysqli_prepare($conn, 'SELECT * FROM `заказчик` WHERE `ID_заказчика` = ?');
                mysqli_stmt_bind_param($stmt, 'i', $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                
                while($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <h2>Редактировать заказчика</h2>
                    <input type='hidden' name='id' value='".$_GET['id']."'>
                    <label for='name'>Наименование</label>
                    <input type='text' name='name' id='name' placeholder='Наименование' required value='".$row['Наименование']."'>
                    <label for='inn'>ИНН</label>
                    <input type='text' name='inn' id='inn' placeholder='ИНН' required value='".$row['ИНН']."'>
                    <label for='address'>Юридический адрес</label>
                    <input type='text' name='address' id='address' placeholder='Юридический адрес' required value='".$row['Юридический адрес']."'>
                    <label for='contact'>Контактное лицо</label>
                    <input type='text' name='contact' id='contact' placeholder='Контактное лицо' required value='".$row['Контактное лицо']."'>
                    <label for='number'>Номер телефона</label>
                    <input type='text' name='number' id='number' placeholder='Телефон' required value='".$row['Телефон']."'>
                    <label for='email'>Email</label>
                    <input type='email' name='email' id='email' placeholder='Email' required value='".$row['Email']."'>
                    <input type='submit' value='Сохранить'>
                    ";
                }
            }
            else {
                echo "
                <h2>Заказчик</h2>
                    <input type='hidden' name='id' value='-1'>
                    <label for='name'>Наименование</label>
                    <input type='text' name='name' id='name' placeholder='Наименование' required>
                    <label for='inn'>ИНН</label>
                    <input type='text' name='inn' id='inn' placeholder='ИНН' required>
                    <label for='address'>Юридический адрес</label>
                    <input type='text' name='address' id='address' placeholder='Юридический адрес' required>
                    <label for='contact'>Контактное лицо</label>
                    <input type='text' name='contact' id='contact' placeholder='Контактное лицо' required>
                    <label for='number'>Контактное лицо</label>
                    <input type='text' name='number' id='number' placeholder='Телефон' required>
                    <label for='email'>Email</label>
                    <input type='email' name='email' id='email' placeholder='Email' required>
                <input type='submit' value='Сохранить'>
                ";
            }
            ?>
            </form>
        </div>
    </main>
</body>
</html>