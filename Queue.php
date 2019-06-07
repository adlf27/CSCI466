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

    //Variables
    $freeQueue = false;
    $paidQueue = false;
    $fileID = 0;


    //Get if they used freeQ or paidQ also get the fileID
    foreach ($_POST as $key => $value) {
    	if($key == 'fileID')
    		$fileID = $value;
    	if($key == 'Queue'){
    		if($value == 'FreeQueue')
    			$freeQueue = true;
    		if($value == 'PaidQueue')
    			$paidQueue = true;
    	}
    }


    //Form For User
    if($freeQueue){
    	echo '<form action="Add.php" method="post">';
  		echo 'Name:<br>';
  		echo '<input type="text" name="Name">';
  		echo '<br><br>';
      echo '<input type="hidden" name="fileID" value="' . $fileID . '">';
  		echo '<input type="hidden" name="Queue" value="Free">';
  		echo '<input type="submit" value="Submit">';
		echo '</form>';
    }


    //Form For Free
    if($paidQueue){
    	echo '<form action="Add.php" method="post">';
  		echo 'Name:<br>';
  		echo '<input type="text" name="Name">';
  		echo '<br>';
  		echo 'Credit Card Number:<br>';
  		echo '<input type="text" name="CreditCard">';
  		echo '<br>';
  		echo 'Amount:<br>';
  		echo '<input type="text" name="Amount">';
  		echo '<br><br>';
  		echo '<input type="hidden" name="fileID" value="' . $fileID . '">';
  		echo '<input type="hidden" name="Queue" value="Paid">';
  		echo '<input type="submit" value="Submit">';
		echo '</form>';
    }
?>
</body>
</html>
