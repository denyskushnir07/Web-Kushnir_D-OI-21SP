<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #ddd;
}

a {
    text-decoration: none;
    color: #0000EE;
}

a:hover {
    color: #FF0000;
}

input[type='submit'] {
    background-color: #491283;
    border: none;
    color: white;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 14px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}

input[type='submit']:hover {
    background-color: #491283;
}

.center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 10vh; 
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

.search-container {
    text-align: center;
    margin-bottom: 20px;
}

.search-container input[type="text"] {
    padding: 10px;
    width: 250px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.search-container button[type="submit"] {
    padding: 10px 20px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.search-container button[type="submit"]:hover {
    background-color: #555;
}

.refresh-btn {
    background-color: transparent;
    border: none;
    cursor: pointer;
    font-size: 24px;
}

.refresh-btn:hover {
    color: #555;
}

/* Стилі для контейнера форми */
.form-container {
    max-width: 500px;
    margin: 0 auto;
}

/* Стилі для полів введення */
.form-container input[type="text"],
.form-container input[type="date"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Стилі для поля введення результату */
.form-container input[type="text"]#result {
    width: 100%;
    padding: 30px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

/* Стилі для кнопки відправки */
.form-container input[type="submit"] {
    width: 100%;
    background-color: #491283;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Стилі для міток */
.form-container label {
    font-weight: bold;
}

/* Стилі для міток та введених даних */
.form-container label,
.form-container input {
    display: block;
    margin-bottom: 10px;
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
.text{
    text-align:center;
}
</style>
</head>
<body>

<?php
include("connect.php");
session_start();
include 'connect.php';

// Check if admin credentials are provided
if(isset($_POST['NameAdmin']) && isset($_POST['PasswordAdmin'])){
    $NameAdmin = $_POST['NameAdmin'];
    $PasswordAdmin = $_POST['PasswordAdmin'];

    if(empty($NameAdmin) || empty($PasswordAdmin)){
        exit("<div class='message error'>Не введена уся інформація, заповніть усі поля!</div>");
    }

    $NameAdmin = mysqli_real_escape_string($mysqli, $NameAdmin);
    $PasswordAdmin = mysqli_real_escape_string($mysqli, $PasswordAdmin);

    $result = mysqli_query($mysqli, "SELECT * FROM `admin` WHERE NameAdmin='$NameAdmin'");
    $row = mysqli_fetch_assoc($result);

    if(empty($row)){
        exit("<div class='message error'>Такого акаунту не існує!</div>");
    } else {
        if($row['PasswordAdmin'] == $PasswordAdmin){
            $_SESSION['NameAdmin'] = $row['NameAdmin'];
            echo "<div class='message success'>Ви успішно увійшли!</div>";
        } else {
            exit("<div class='message error'>Введені ім'я або пароль не вірні!</div>");
        }
    }
}

// Deleting appointments by name
if(isset($_GET['delete_name'])) {
    $delete_name = $_GET['delete_name'];
    mysqli_query($mysqli, "DELETE FROM appointments WHERE name='$delete_name'");
}

// Searching appointments by name
if(isset($_GET['search_name']) && !empty($_GET['search_name'])) {
    $search_name = $_GET['search_name'];
    $result = mysqli_query($mysqli, "SELECT * FROM appointments WHERE name LIKE '%$search_name%'");
} else {
    // Selecting all appointments if search parameter is not specified
    $result = mysqli_query($mysqli, "SELECT * FROM appointments");
}

echo "<div class='center'>
        <a href='index.php' class='home-link'>Повернутися на головну сторінку</a>
    </div>";

// Search form for appointments
echo "<div class='search-container'>
        <form method='GET'>
            <input type='text' placeholder='Пошук за іменем' name='search_name' value='" . (isset($_GET['search_name']) ? $_GET['search_name'] : '') . "'>
            <button type='submit'>Пошук</button>
        </form>
    </div>";

// Refresh button
echo "<button onclick='window.location.reload();' class='refresh-btn'><i class='fas fa-sync-alt'></i></button>";

// Update appointment by name
if(isset($_POST['update_name'])) {
    $update_name = $_POST['update_name'];
    $new_direction = $_POST['new_direction'];
    $new_doctor = $_POST['new_doctor'];
    $new_date = $_POST['new_date'];
    $new_time = $_POST['new_time'];
    $new_phone = $_POST['new_phone'];

    mysqli_query($mysqli, "UPDATE appointments SET direction='$new_direction', doctor='$new_doctor', date='$new_date', time='$new_time', phone='$new_phone' WHERE name='$update_name'");
}

// Display appointments table
echo "<h2>Дані про пацієнтів записаних на прийом</h2>";
echo "<table border='1'>
<tr>
<th>Напрямок</th>
<th>Лікар</th>
<th>Дата</th>
<th>Час</th>
<th>Ім'я</th>
<th>Телефон</th>
<th>Дії</th>
</tr>";

while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['direction'] . "</td>";
    echo "<td>" . $row['doctor'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['time'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['phone'] . "</td>";
    echo "<td>
            <form method='post'>
                <input type='hidden' name='update_name' value='" . $row['name'] . "'>
                <input type='text' name='new_direction' value='" . $row['direction'] . "'>
                <input type='text' name='new_doctor' value='" . $row['doctor'] . "'>
                <input type='date' name='new_date' value='" . $row['date'] . "'>
                <input type='time' name='new_time' value='" . $row['time'] . "'>
                <input type='text' name='new_phone' value='" . $row['phone'] . "'>
                <input type='submit' value='Оновити'>
            </form>
        </td>";
    echo "<td><a href='appo.php?delete_name=" . $row['name'] . "'>Видалити</a></td>";
    echo "</tr>";
}
echo "</table>";

// Deleting analysis result by patient's name
if(isset($_GET['delete_analysis'])) {
    $delete_name = $_GET['delete_analysis'];
    mysqli_query($mysqli, "DELETE FROM analysis_result WHERE NameUser='$delete_name'");
}

// Displaying analysis results with delete option
echo "<h2>Результати аналізів пацієнтів</h2>";
echo "<table border='1'>
<tr>
<th>Ім'я пацієнта</th>
<th>Дата аналізу</th>
<th>Назва аналізу</th>
<th>Результат</th>
<th>Дії</th>
</tr>";

$analysis_results = mysqli_query($mysqli, "SELECT * FROM analysis_result");
while ($row = mysqli_fetch_array($analysis_results)) {
    echo "<tr>";
    echo "<td>" . $row['NameUser'] . "</td>";
    echo "<td>" . $row['analysisDate'] . "</td>";
    echo "<td>" . $row['analysisName'] . "</td>";
    echo "<td>" . $row['result'] . "</td>";
    echo "<td><a href='appo.php?delete_analysis=" . $row['NameUser'] . "'>Видалити</a></td>";
    echo "</tr>";
}
echo "</table>";

// Adding analysis results
if(isset($_POST['analysisDate']) && isset($_POST['analysisName']) && isset($_POST['result']) && isset($_POST['NameUser'])) {
    $analysisDate = $_POST['analysisDate'];
    $analysisName = $_POST['analysisName'];
    $result = $_POST['result'];
    $NameUser = $_POST['NameUser'];
    
    addAnalysisResults($mysqli, $NameUser, $analysisDate, $analysisName, $result);
}

// Function to add analysis results to the database
function addAnalysisResults($mysqli, $NameUser, $analysisDate, $analysisName, $result) {
    $NameUser = mysqli_real_escape_string($mysqli, $NameUser);
    $analysisDate = mysqli_real_escape_string($mysqli, $analysisDate);
    $analysisName = mysqli_real_escape_string($mysqli, $analysisName);
    $result = mysqli_real_escape_string($mysqli, $result);

    $query = "INSERT INTO analysis_result (NameUser, analysisDate, analysisName, result) VALUES ('$NameUser', '$analysisDate', '$analysisName', '$result')";
    if(mysqli_query($mysqli, $query)) {
        echo "<div class='message success'>Результати аналізів успішно додані!</div>";
    } else {
        echo "<div class='message error'>Помилка при додаванні результатів аналізів: " . mysqli_error($mysqli) . "</div>";
    }
}
?>


<!-- HTML form to add analysis results -->
<div class="form-container">
    <h2 class="text">Додати результати аналізів</h2>
    <form method="post" action="">
        <label for="NameUser">Ім'я пацієнта:</label>
        <input type="text" id="NameUser" name="NameUser" required><br>
        
        <label for="analysisDate">Дата аналізу:</label>
        <input type="date" id="analysisDate" name="analysisDate" required><br>
        
        <label for="analysisName">Назва аналізу:</label>
        <input type="text" id="analysisName" name="analysisName" required><br>
        
        <label for="result">Результат:</label>
        <input type="text" id="result" name="result" required><br>
        
        <input type="submit" value="Додати результат аналізу">
    </form>
</div>


</body>
</html>
