<!DOCTYPE html>
<html>
  <head><title>Assignment 11</title></head>
  <body>
    <h3 style="text-align:center;">Page 1: Add New Owners</h3>
    <div style="position:relative;">
    <table style="position:fixed; bottom:0; width:100%; text-align:center;">
      <tr>
        <th><a href="assign11B.php">Page: 2</a></th>
        <th><a href="assign11C.php">Page: 3</a></th>
      </tr>
      <tr>
        <th>Luis Aguinaga</th>
        <th>Section: 4</th>
        <th>CSCI466</th>
        <th>04/27/2018</th>
      </tr>
    </table>
  </div>
  <form action=" " method="post">
    <fieldset>
      <legend>New Owner Info.</legend>
      <label>First Name:<br />
      <input type="text" name="firstName"/><br />
      <label>Last Name: <br />
      <input type="text" name="lastName"/><br />
      <label>Address: <br />
      <input type="text" name="Address"/><br />
      <label>City <br />
      <input type="text" name="City"/><br />
      <label>State: <br />
      <input type="text" name="state"/><br />
      <label>Zip Code: <br />
      <input type="text" name="zip"/><br />
    </fieldset>
    <input type="submit" value="Submit" />
    <input type="reset" value="Clear" />

  </form>
    <?php
        $username = 'z1811673';
        $password = '1994Jul27';
        try{
          $dsn = "mysql:host=courses;dbname=z1811673";
          $pdo = new PDO($dsn, $username, $password);
        }
        catch(PDOexception $e){
          echo "Connection to database Failed: " . $e->getMessage();
        }
        $first = $_POST["firstName"];
        $last = $_POST["lastName"];
        $address = $_POST["Address"];
        $city = $_POST["City"];
        $state =$_POST["state"];
        $zip = $_POST["zip"];

        $sql = "INSERT INTO OwnerTbl (LastName, FirstName, Address, City, State, Zip) VALUES ('$last', '$first','$address', '$city', '$state', '$zip');";
        $n = $pdo->exec($sql);
        if( $n > 0)
          echo "New Record Created Successfully!!";
        else {
          echo "Error";
        }

    ?>
  </body>
</html>
