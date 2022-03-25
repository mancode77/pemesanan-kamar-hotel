<?php

require_once '../config/config.php';

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "SELECT * FROM users WHERE username=:username";

    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = [":username" => $username];

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if ($user) {
        echo "
        <script>
            alert('Akun sudah terdaftar!');
            document.location.href = 'login.php';
        </script>
		";
    }

    // menyiapkan query
    $sql = "INSERT INTO users (username, password, role) 
            VALUES (:username, :password, :role)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":password" => $password,
        ":role" => $role
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if ($saved) {
        echo "
        <script>
            alert('Berhasil mendaftar!');
            document.location.href = 'login.php';
        </script>
		";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../styles/register_style.css">
    <link rel="shortcut icon" href="../img/title_hotel.jpg">
</head>

<body>
    <form action="" method="post">
        <div class="container">
            <h1>Register</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>

            <label for="email"><b>Username</b></label>
            <input type="text" name="username" placeholder="Enter Username" name="email" id="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" name="password" placeholder="Enter Password" name="psw" id="psw" required>

            <label for="role"><b>Role</b></label>
            <select id="role" name="role">
                <option value="admin" name="role">Admin</option>
                <option value="guest" name="role">Guest</option>
                <option value="resepsionis" name="role">Resepsionis</option>
            </select>

            <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>
            <button type="submit" class="registerbtn" name="submit">Register</button>
        </div>

        <div class="container signin">
            <p>Already have an account? <a href="login.php">Sign in</a>.</p>
        </div>
    </form>
</body>

</html>