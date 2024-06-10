<?php
require 'config.php';


$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $password, $options);

    if ($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = "SELECT * FROM `users` WHERE username = :username";
            $statement = $pdo->prepare($query);
            $statement->execute([':username' => $username]);

            $user = $statement->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if ('$hishDuck001' === $password) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    header("Location: profiles.php");
                    exit;
                } else {
                    echo "Invalid password!";
                }
              } else {
                echo "User not found!";
            }
        }
    }
} 
catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WAD2 - Midterm Project</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div class="log_in">
    <form id="login_form" method="POST" action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
      <h1 style="text-align:center;"> Here you can Login</h1>
      <h3 style="text-align:center;"e> Let's join hands C:!</h3>
      <br>
      <p> &nbsp; &nbsp; &nbsp;Enter your username:</p>
      <input type="text" id="Username" name="username" required >
      <br>
      <p>  &nbsp; &nbsp;&nbsp;Enter your password:</p>
      <input type="password" id="Password" name="password" required>
      <br>
      <br>
      <br>
      <button id="submit"><b>LOGIN</b></button>
    </form>
  </div>
  
</body>

</html>
