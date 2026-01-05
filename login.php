<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
    <title>Вхід</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2; /* колір фону */
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.8); /* колір фону контейнера з прозорістю */
            border: 2px solid #4CAF50; /* колір та ширина рамки */
            border-radius: 10px; /* радіус закруглення контейнера */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* тінь контейнера */
            backdrop-filter: blur(5px); /* розмиття за контейнером */
        }

        h1 {
            text-align: center;
        }

        form {
            text-align: center;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            box-sizing: border-box; 
        }

        input[type="submit"] {
            background-color: #491283; 
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #491283;
        }

        /* Зміни у посиланні на сторінку реєстрації */
        a.registration-link {
            color: black; /* Чорний колір тексту */
            text-decoration: none; /* Видалення підкреслення */
            font-size: 15px;
        }
        
    </style>
</head>
<body>
<?php 
    session_start();
    if(isset($_SESSION['NameUser'])){
        $name = 'Привіт, '.$_SESSION['NameUser'].'!'; 
    }
    if(empty($_SESSION['NameUser']) or empty($_SESSION['IDadmin']))
    {
        echo "<form id='forma' action='user-account.php' method='post'>
        <h1>Вхід у особистий кабінет</h1>
        <p>ПІБ <input type='text' name='NameUser'></p>
        <p>Пароль <input type='password' name='PasswordUser'></p>
        <p><input type='submit' name='submit' value='Вхід'></p>
        <a href='reg.php' class='registration-link'>Реєстрація</a>"; // Додано клас для стилізації посилання
    }
    else{
        echo "Ви ввійшли на сайт, як ".$_SESSION['NameUser']."
        тут інформація для крутих користувачів";
        echo "<form action='close.php' method='post'>
        <input type='submit' name='submit' value='Вихід'>
        </form>";
    }
?>

<a href="index.php" style="position: absolute; top: 10px; left: 10px; text-decoration: none; font-size: 55px;"><i class="icofont-rounded-left"></i></a>

<!-- Кнопка для перекидання на форму логіну для адмінів -->
<a href="admin_login.php" style="position: fixed; top: 20px; right: 20px; font-size: 22px; color: black; text-decoration: none;">
    <span>Для персоналу</span>
    <i class="icofont-people"></i> <!-- Замініть "icon-font-class" і "icon-code" на відповідний клас і код вашої іконки з IconFont -->
</a>

</body>
</html>
