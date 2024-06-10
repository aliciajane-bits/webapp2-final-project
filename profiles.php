<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WAD2 - Midterm Project</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <style>
    body{
      color: #100e16;
      background-size: cover;
      background-position: center;
      background-repeat: repeat-y;
    }
    .profiles {
      max-width: 600px;
      margin: 40px auto;
      padding: 15px;
    }
    ul {
      list-style-type: none;
      padding: 0;
    }
    li {
      margin-bottom: 10px;
      border: 1px solid #422559;
      padding: 12px;
      border-radius: 7px;
      background-color: #b8aab6;
      cursor: pointer;
      grid-template-rows: 1fr 1fr;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      text-transform: capitalize;
    }
    li:hover {
      color: #efefef;
      background: linear-gradient(60deg, #622E8C, #AD6BA3);
      border: 1px solid #efefef;
    }
    li a{
      text-decoration: none;
      color: #000000;
    }
    li a:hover{
      color: #efefef;
    }
    h1 {
      text-align: center;
      margin-bottom: 12px;
    }
    hr{
      width: 40vw;
      margin: auto;
    }
    #profile_lists{
      display: grid;
      grid-template-columns: repeat(3,30vw);
      grid-template-rows: auto;
      justify-content: center;
      gap: 12px;
    }
  </style>
</head>

<body>
    <div class="profiles">
      <h1>List of Profiles</h1>
      <hr>
      <br>
      <br>
      <ul id="profile_lists">
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
              $user_id = $_SESSION['user_id'];

              $query = "SELECT * FROM `posts` WHERE userId = :id";
              $statement = $pdo->prepare($query);
              $statement->execute([':id' => $user_id]);

              $rows = $statement->fetchAll(PDO::FETCH_ASSOC);

              foreach ($rows as $row) {
                  echo '<li><a href="profile.php?id=' . $row['id'] . '">' . $row['title'] . '</li>';
              }
          }
      } catch (PDOException $e) {
          echo $e->getMessage();
      }
      ?>
      </ul>
    </div>
</body>

</html>