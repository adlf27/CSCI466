<!DOCTYPE html>
<html>
  <head><title>Assignment 11</title></head>
  <body>
    <h2 style="text-align:center;">Page 2: Boat Services </h2>
    <div style="position:relative;">
    <table style="position:fixed; bottom:0; width:100%; text-align:center;">
      <tr>
        <th><a href="assign11.php">Page: 1</a></th>
        <th><a href="assign11C.php">Page: 3</a></th>
      </tr>
      <tr>
        <th>Luis Aguinaga</th>
        <th>Section: 4</th>
        <th>CSCI466</th>
        <th>04/27/2018</th>
      </tr>
      <?php
        $username = 'z1811673';
        $password = '1994Jul27';
        try{
          $dsn = "mysql:host=courses; dbname=z1811673";
          $pdo = new PDO($dsn, $username, $password);
        }
        catch(PDOexception $e){
          echo "Connection to datbase failed: " . $e->getMessage();
        }

        $sql = "SELECT BoatName FROM MarinaSlip;";
        $result = $pdo->query($sql);

        echo "<h3>Select Boat Name and Service to be done:</h3>";
        echo "<form action=' ' method='post'>";
        echo "<table style='text-align:center; width:100%;'>";
	echo "<tr><th>Boat Name</th><th>Service</th></tr>";
        echo "<tr><td><select name='boatName'>";
        while($row = $result->fetch(PDO::FETCH_BOTH))
          echo "<option value='" . $row["BoatName"] . "'>" . $row["BoatName"] ."</option>";
        echo "</select></td>";

        $sql = "SELECT CategoryDescription FROM ServiceCategory;";
        $result = $pdo->query($sql);

        echo "<td><select name='service'";
        while($row = $result->fetch(PDO::FETCH_BOTH))
          echo "<option value='" . $row["CategoryDescription"] ."'>" . $row["CategoryDescription"] . "</option>";
        echo "<input type='submit' value='Submit' />";
        echo "<input type='reset' value='Clear' />";
        echo "</select></td></tr>";
        echo "</form>";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
	  $name = $_POST["boatName"];
          $service = $_POST["service"];

          $sql = "SELECT SlipID FROM MarinaSlip WHERE BoatName = '$name';";
          $result = $pdo->query($sql);
          $row = $result->fetch(PDO::FETCH_BOTH);
          $slip = $row["SlipID"];

          $sql = "SELECT CategoryNum FROM ServiceCategory WHERE CategoryDescription = '$service';";
          $result = $pdo->query($sql);
          $row = $result->fetch(PDO::FETCH_BOTH);
          $catNum = $row["CategoryNum"];

          $sql = "INSERT INTO ServiceRequest(SlipID, CategoryNum) VALUES ('$slip', '$catNum');";
	  $n = $pdo->exec($sql);
          if($n > 0)
            echo "New Service Request Created Succesfully!!";
          else
            echo "Error Entering New Request!!";
        }
        ?>
   </body>
</html>
