
<!DOCTYPE html>
<html>
  <head><title>Assignment 11</title></head>
  <body>
    <h2 style="text-align:center;">Page 3: Updating Service Request </h2>
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
        echo "<h4>Select the following: </h4>";
        $sql =" SELECT ServiceID FROM ServiceRequest;";
        $result = $pdo->query($sql);

        echo "<form action=' ' method='post'>";
        echo "<table>";
	echo "<tr><th>ServiceID</th><th>Service</th><th>Text</th></tr>";
	echo "<tr><td><select name='slip'>";
        while($row = $result->fetch(PDO::FETCH_BOTH))
          echo "<option value='" . $row["ServiceID"] . "'>" . $row["ServiceID"] . "</option>";
        echo "</select></td>";

        echo "<td><select name='service'>";
        echo "<option value='Description'>Description </option>";
        echo "<option value='Status'> Status </option>";
        echo "<option value='EstHours'> EstHours </option>";
        echo "<option value='SpentHours'> SpentHours </option>";
        echo "<option value='NextServiceDate'> NextServiceDate </option>";
        echo "</select></td>";
        echo "<td><input type='text' name='text'/>";
        echo "<input type='submit' value='Submit'/></td></tr>";
	echo "</table>";
	echo "</form>";

        if($_SERVER["REQUEST_METHOD"] == "POST")
 	{
          $id = $_POST["slip"];
          $serv = $_POST["service"];
          $what = $_POST["text"];

          $sql = "UPDATE ServiceRequest SET $serv = '$what' WHERE ServiceID = '$id';";

  	  if($pdo->query($sql) == TRUE)
            echo "Record Updated Successfully!!";
          else
       	    echo "Error Updating Record!!";
	}
       ?>
   </body>
</html>
