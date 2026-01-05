<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .home-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: transparent;
            color: #333;
            border: 2px solid #333;
            border-radius: 20px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s;
        }
        .home-link:hover {
            background-color: #333;
            color: #fff;
            border-color: #333;
        }
        .analysis {
            margin-top: 20px;
        }
        .analysis h2 {
            margin-bottom: 10px;
            color: #0c0c0c;
        }
        .analysis-table {
    white-space: nowrap; /* Заборона переносу */
}

.analysis-table th,
.analysis-table td {
    padding: 8px; /* Задаємо відступи для кращого вигляду */
}

.analysis-table {
    width: 100%;
    border-collapse: collapse;
}

.analysis-table th,
.analysis-table td {
    padding: 8px;
    border: 1px solid #ddd; /* додайте рамки для кращого розмежування */
}

.analysis-table th {
    background-color: #f2f2f2; /* фон для заголовків */
}

.analysis-table td:nth-child(3) {
    white-space: normal; /* Заборона переносу для результатів */
}

        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
            color: #333;
        }
        table tr:hover {
            background-color: #f9f9f9;
        }
        .table-zapys th,
        .table-zapys td {
        padding: 8px;
        border: 1px solid #ddd; 
        }
        /* Стилі для повідомлень про статус */
.message {
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}

.message.success {
    background-color: #dff0d8;
    color: #3c763d;
}

.message.error {
    background-color: #f2dede;
    color: #a94442;
}

</style>
</head>

<body>
<?php

session_start();
include 'connect.php'; // Підключення до бази даних

if(isset($_POST['NameUser']) && isset($_POST['PasswordUser'])){
    $NameUser = $_POST['NameUser'];
    $PasswordUser = $_POST['PasswordUser'];

    if(empty($NameUser) || empty($PasswordUser)){
        exit("<div class='message error'>Не введена уся інформація, заповніть усі поля!</div>");
    }

    $NameUser = mysqli_real_escape_string($mysqli, $NameUser);
    $PasswordUser = mysqli_real_escape_string($mysqli, $PasswordUser);

    // Витягуємо дані користувача з бази даних за іменем користувача
    $result = mysqli_query($mysqli, "SELECT * FROM `users` WHERE NameUser='$NameUser'");
    $row = mysqli_fetch_assoc($result);

    if(empty($row)){
        exit("<div class='message error'>Такого акаунту не існує!</div>");
    } else {
        // Порівнюємо хеш введеного пароля з хешем, збереженим у базі даних
        $hashed_password = $row['PasswordUser'];
        if(password_verify($PasswordUser, $hashed_password)){
            $_SESSION['NameUser'] = $row['NameUser'];
            echo "<div class='message success'>Ви успішно увійшли!</div>";
            // Тут ви можете виконати будь-які додаткові дії після успішного входу
        } else {
            exit("<div class='message error'>Введені ім'я або пароль не вірні!</div>");
        }
    }
}

echo "<div class='center'>
        <a href='index.php' class='home-link'>Повернутися на головну сторінку</a>
    </div>";

// Отримання ім'я пацієнта з сесії
$NameUser = $_SESSION['NameUser'];


// Запит до бази даних для отримання записів на прийом для пацієнта
$appointmentQuery = mysqli_query($mysqli, "SELECT * FROM `appointments` WHERE name='$NameUser'");

echo "<div class='appointments'>
        <h2>Записи на прийом</h2>
        <table class='table-zapys'>
            <tr>
                <th>Напрямок</th>
                <th>Лікар</th>
                <th>Дата</th>
                <th>Час</th>
                <th>Ім'я</th>
                <th>Телефон</th>
            </tr>";

while($row = mysqli_fetch_assoc($appointmentQuery)) {
    echo "<tr>
            <td>".$row['direction']."</td>
            <td>".$row['doctor']."</td>
            <td>".$row['date']."</td>
            <td>".$row['time']."</td>
            <td>".$row['name']."</td>
            <td>".$row['phone']."</td>
          </tr>";
}

echo "</table>
      </div>";


// Запит до бази даних для отримання результатів аналізів
$analysisQuery = mysqli_query($mysqli, "SELECT * FROM `analysis_result` WHERE NameUser='$NameUser'");

echo "<div class='analysis'>
        <h2>Результати аналізів</h2>
        <table class='analysis-table'>
            <tr>
                <th>Дата</th>
                <th>Назва аналізу</th>
                <th>Результат</th>
            </tr>";

while($row = mysqli_fetch_assoc($analysisQuery)) {
    echo "<tr>
            <td>".$row['analysisDate']."</td>
            <td>".$row['analysisName']."</td>
            <td>".$row['result']."</td>
          </tr>";
}

echo "</table>
      </div>";


mysqli_close($mysqli);
?>


</body>
</html>
