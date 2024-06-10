<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WAD2 - Midterm Project</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <style>
    .profile{
      max-width: 800px;
      margin: 40px auto;
      padding: 15px;
      font-size: 1.7em;
    }
    h1{
      margin-bottom: 12px;
    }
    hr{
      width: 475px;
      margin: auto;
    }
    #profile_info{
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    #profile_info h3{
      padding: 12px 30px;
      color: #efefef;
      background: linear-gradient(60deg, #622E8C, #AD6BA3);
      text-transform: capitalize;
      border-radius: 8px;
      width: 60vw;
      text-align: center;
      margin: 30px 0;
    }
    #profile_info p{
      padding: 12px 0;
      background-color: #b8aab6;
      text-transform: inherit;
      width: 80vw;
      padding: 15px 30px;
      border-radius: 8px;
      text-align: justify;
    }
    #profile_info p:first-letter {
      text-transform: capitalize
    }
  </style>

</head>

<body>
  <div class="profile" >
    <h1 style="text-align: center;">Profile Page</h1>
    <hr>
    <br>
    <div id="profile_info">
      <?php

        require 'config.php';

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        try {
            $pdo = new PDO($dsn, $user, $password, $options);

            if ($pdo) {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $query = "SELECT * FROM `posts` WHERE id = :id";
                    $statement = $pdo->prepare($query);
                    $statement->execute([':id' => $id]);

                    $post = $statement->fetch(PDO::FETCH_ASSOC);

                    if ($post) {
                        echo '<h3>Title: ' . $post['title'] . '</h3>';
                        echo '<p>Body: ' . $post['body'] . '</p>';
                    } else {
                        echo "No post found with ID $id!";
                    }
                } else {
                    echo "No post ID provided!";
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
      ?>
    </div>
  </div>
</body>

</html>
