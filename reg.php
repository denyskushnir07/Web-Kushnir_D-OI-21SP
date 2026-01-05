<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
  <title>Реєстрація</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #f2f2f2;
      /* колір фону */
    }

    .register-container {
      background-color: rgba(255, 255, 255, 0.8);
      /* колір фону контейнера з прозорістю */
      border: 2px solid #4CAF50;
      /* колір та ширина рамки */
      border-radius: 10px;
      /* радіус закруглення контейнера */
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* тінь контейнера */
      backdrop-filter: blur(5px);
      /* розмиття за контейнером */
    }

    h1 {
      text-align: center;
    }

    form {
      text-align: center;
    }

    input[type="text"],
    input[type="password"],
    input[type="tel"],
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
  </style>
</head>

<body>
<?php
session_start();

if(isset($_SESSION['NameUser'])) {
    $name = 'Привіт, '.$_SESSION['NameUser'].'!'; 
}

if(empty($_SESSION['NameUser']) || empty($_SESSION['IDuser'])) {
    if(isset($_POST['submit'])) {
        include 'connect.php'; // Підключення до бази даних

        $name = $_POST['NameUser'];
        $password = $_POST['PasswordUser'];
        $phone = $_POST['PhoneUser'];

        if(empty($name) || empty($password) || empty($phone)) {
            $message = "Будь ласка, заповніть всі поля форми";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (NameUser, PasswordUser, PhoneUser) VALUES ('$name', '$hashed_password', '$phone')";

            if ($mysqli->query($sql) === TRUE) {
                $message = "Ваш особистий кабінет успішно зареєстровано!";
            } else {
                $message = "Помилка: " . $sql . "<br>" . $mysqli->error;
            }
        }

        $mysqli->close();
    }

    echo "<form id='forma' action='' method='post' onsubmit='return validateForm()'>
        <h1>Реєстрація особистого кабінету</h1>
        <p>ПІБ <input type='text' name='NameUser'></p>
        <p>Пароль <input type='password' name='PasswordUser'></p>
        <p>Номер телефону <input type='tel' name='PhoneUser'></p>
        <p><input type='submit' name='submit' value='Зареєструватися'></p>";

    if(isset($message)) {
        echo "<p style='color: green;'>$message</p>";
    }

    echo "</form>";
}
?>

<a href="login.php" style="position: absolute; top: 10px; left: 10px; text-decoration: none; font-size: 55px;"><i class="icofont-rounded-left"></i></a>

<script>
    function validateForm() {
        var name = document.forms["forma"]["NameUser"].value;
        var password = document.forms["forma"]["PasswordUser"].value;
        var phone = document.forms["forma"]["PhoneUser"].value;
        if (name == "" || password == "" || phone == "") {
            alert("Будь ласка, заповніть всі поля форми");
            return false;
        }
    }
</script>

</body>

</html>