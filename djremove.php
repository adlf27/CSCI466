<!DOCTYPE html>
<html>
<body>
<?php

$username = "z1811673";
$password = "1994Jul27";

try {
	$dsn = "mysql:host=courses; dbname=z1811673";
	$pdo = new PDO($dsn, $username, $password);
}
catch(PDOexception $e) {
	echo "Connection to database failed: " . $e->getMessage();
}


$PaidQueue = FALSE;
$FreeQueue = FALSE;
$fileID = 0;

    foreach ($_POST as $key => $value) {
      if($key == "PaidQueue" && $value == 'Remove')
      	$PaidQueue = TRUE;
      if($key == 'FreeQueue' && $value == 'Remove')
      	$FreeQueue = TRUE;
      if($key == 'fileID')
      	$fileID = $value;
    }

    if($PaidQueue){
    	$SQLStatment = 'UPDATE PaidQueue SET isPicked = TRUE WHERE fileID =' . $fileID;
    	$query = $pdo->query($SQLStatment);
    }

    if($FreeQueue){
    	$SQLStatment = 'UPDATE FreeQueue SET isPicked = TRUE WHERE fileID =' . $fileID;
    	$query = $pdo->query($SQLStatment);
    }

?>
<a href="dj.php">Go Back</a>
</body>
</html>
