<?php

require_once 'database.php';
$database = new Store();
$database->createTables();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordRepeat = $_POST['password_repeat'];

    if ($password !== $passwordRepeat) {
        echo "Passwords do not match.";
    } else {
        if ($database->getUserByEmail($email)) {
            echo "User with this email already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $database->registerUser($name, $email, $hashedPassword);

            echo "Registration successful. You can now log in.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form method="post" action="register.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="password_repeat">Repeat Password:</label><br>
        <input type="password" id="password_repeat" name="password_repeat" required><br>
        <input type="submit" value="Register">
    </form>


    <form method='post' action='index.php' class='btn'>
        <button type='submit'>Home</button>
    </form><br>;

</html>
