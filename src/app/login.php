<?php
session_start();

require_once '../config/config.php';

try {

    if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        $sql = "SELECT username FROM users WHERE id_user=:id_user";

        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = [":id_user" => $id];

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($key === hash('sha256', $user['username'])) {
            $_SESSION['key'] = true;
        }
    }

    if (isset($_SESSION['key'])) {
        header("Location: beranda.php");
        exit;
    }

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username=:username";

        $stmt = $db->prepare($sql);

        // bind parameter ke query
        $params = [":username" => $username];

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // jika user terdaftar
        if ($user) {
            // verifikasi password
            if ($password === $user["password"]) {
                $_SESSION["key"] = true;

                if (isset($_POST['remember'])) {
                    setcookie('id', $user['id_user'], time() + 60);
                    setcookie('key', hash('sha256', $user['username']), time() + 60);
                }

                // login sukses, alihkan ke halaman timeline
                header("Location: beranda.php");
                exit;
            }
        }
    }
} catch (PDOException $e) {
    die($e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/login_style.css">
</head>

<body>
    <h2>Login Form</h2>

    <form action="" method="post">
        <div class="imgcontainer">
            <img src="../img/login.jpg" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit" name="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

        <div class="container" style="background-color:#f1f1f1">
            <button type="button" class="cancelbtn">Cancel</button>
            <span class="psw">Forgot <a href="#">password?</a></span>
        </div>
    </form>
</body>

</html>