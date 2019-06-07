<html>
<body>

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

    $userName = '';
    $userID = 0;
    $fileID = 0;
    $CreditCardNum = 0;

    $freeQueue = false;
    $paidQueue = false;

    foreach ($_POST as $key => $value) {
      if($key == 'Queue'){
        if($value == 'Free')
          $freeQueue = true;
        if($value == 'Paid')
          $paidQueue = true;
      }
    }

    foreach ($_POST as $key => $value) {
      if($key == "fileID")
         $fileID = $value;
    }

    foreach ($_POST as $key => $value) {

      if($key == 'Name'){
        $userName  = $value;
        //Create New User This wont do anything if the exist they just arent added to the table
         $SQLStatment = 'INSERT INTO User(name) VALUES("' . $value . '")';
         $query = $pdo->query($SQLStatment);

         //If they are new or old users there ID is fetched here
         $SQLStatment = 'SELECT * FROM User WHERE name = "' . $value . '"';
         $query = $pdo->query($SQLStatment);
         $row = $query->fetch(PDO::FETCH_ASSOC);
         $userID = $row['userID'];
      }
    }

    if($paidQueue){
    foreach ($_POST as $key => $value) {
      if($key == 'CreditCard'){
        $CreditCardNum = $value;
        $Amount = '';
        foreach ($_POST as $key => $value) {
          if($key == 'Amount')
            $Amount = $value;
        }
        $SQLStatment = 'INSERT INTO PaidQueue(fileID, amount, creditNumber, name, userID, pDateTime, isPicked) VALUES('. $fileID . ',' . $Amount . ',' . $CreditCardNum . ', "' . $userName . '",' . $userID . ',' . 'CURTIME()'. ',' . 'FALSE'  .')';
        $query = $pdo->query($SQLStatment);
        if($query == false){
          echo "SONG IS TAKEN: You know could always convince the DJ with something that rhymes with ivory ;) ";
          echo "<br /><a href='user.php'>Go Back </a>";
        }
        if($query == true){
          echo "Thank You for your slection and your Green $$$ it's safer with us anyways ;)";
          echo '<br /><a href="user.php">Go Back</a>';
        }
      }
    }
  }

      if($freeQueue){
        $SQLStatment = "INSERT INTO FreeQueue(fileID, userID, pDateTime, isPicked) VALUES('$fileID ', '$userID','CURTIME()','FALSES')";
        $n = $pdo->exec($SQLStatment);
        if($n == 0){
          echo "SONG IS TAKEN: The DJ has enough songs to play and favoritism ain't one of them ;)";
          echo "<br /><a href='user.php'>Go Back</a>";
        }
        if($n > 0){
          echo "We Can't Wait to hear you sing your little heart out!";
          echo '<br /><a href="user.php">Go Back</a>';
      }
    }
?>
</body>
</html>
