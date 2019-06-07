<!DOCTYPE html>
<html>
<head><title>Karaoke</title></head>
<body>
  <h1 style="text-align:center">Karaoke</h1>
  <?php
    $username = 'z1811673';
    $password = '1994Jul27';

    try{  //if something goes wrong, an exception is thrown.
      $dsn = "mysql:host=courses; dbname=z1811673";
      $pdo = new PDO($dsn, $username, $password);
    }
    catch(PDOexception $e){  //handle that expression
      echo"Connection to database Failed: " . $e->getMessage();
    }
    echo "<h4 style='text-align:center;'>Search By:</h4>";
    echo "<br/>";
    echo "<table style='text-align:center; width:100%;'>";
    echo "<tr><th>Artist Name</th><th>Song Title</th><th>Contributor</th></tr>";
    echo "<form action='Results.php' method='post'>";

  //slide down bar selects song names
    $sql = "SELECT name FROM Artist;";
    $result = $pdo->query($sql);

    echo "<tr><td><select name='artist'>";
    while($row = $result->fetch(PDO::FETCH_BOTH))
      echo"<option value='" . $row["name"] . "'>" . $row["name"] ."</option>";

    echo"<input type='submit' value='Submit' />";
    echo "</select></td>";
    echo "</form>";

  //slide down bar- list title songs
    echo "<form action='Results.php' method='post'>";
    $sql = "SELECT text FROM Title";
    $result = $pdo->query($sql);

    echo "<td><select name='title'>";
    while($row = $result->fetch(PDO::FETCH_BOTH))
      echo "<option value='" . $row["text"] . "'>" . $row["text"] . "</option>";
    echo "<input type='submit' value='Submit' />";
    echo "</select></td>";

    echo "</form>";
  //slide down bar for contributor name

    echo "<form action='Results.php' method='post'>";
    $sql = "SELECT name FROM Contributor;";
    $result = $pdo->query($sql);

    echo "<td><select name='cont'>";
    while($row = $result->fetch(PDO::FETCH_BOTH))
      echo "<option value='" . $row["name"] . "'>" .$row["name"] . "</option>";
    echo "<input type='submit' value='Submit' />";
    echo "</select></td>";
    echo "</form>";

    echo "</table>";
  ?>
  <a href="dj.php">DJ View </a>
  </body>
</html>
