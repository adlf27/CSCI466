<!DOCTYPE html>

<!-- There Are two places you need to your password on this file or it will not work !!! -->
<html>

<head>
  <title>Karaoke - DJ</title>
</head>
<body>

<h2>Paid Queue</h2>
<table border="1">
  <thead>
    <tr>
      <th> Play </th>
      <th> FileID </th>
      <th> Title </th>
      <th> Artist </th>
      <th> User </th>
      <th> UserID </th>
      <th> Amount</th>
    </tr>
  </thead>
  <tbody>
    <form method="post" action="djremove.php">
    <input type="submit" name="PaidQueue" value="Remove">

<?php
$username = "z1811673";
$password = "1994Jul27";

try {
	$dsn = "mysql:host=courses;dbname=z1811673";
	$pdo = new PDO($dsn, $username, $password);
}
catch(PDOexception $e) {
	echo "Connection to database failed: " . $e->getMessage();
}
      $SQLStatment = 'SELECT PaidQueue.isPicked, PaidQueue.fileID, PaidQueue.amount, PaidQueue.name AS usrName, PaidQueue.userID,
                      Artist.name AS ArtistName, Title.text
                      FROM PaidQueue, File, Artist, Title
                      WHERE PaidQueue.fileID = File.fileID
                      and File.artistID = Artist.artistID
                      and File.titleID = Title.titleID ORDER BY amount';
      $query = $pdo->query($SQLStatment);


      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        if($row['isPicked'] == 0)
        {
        print '<tr>';
        print '<td align="center"><input type="radio" value="' .$row['fileID'] . '" ' . 'name="fileID"></td>';
        print '<td>' . $row['fileID'] . '</td>';
        print '<td>' . $row['text'] . '</td>';
        print '<td>' . $row['ArtistName'] . '</td>';
        print '<td>' . $row['usrName'] . '</td>';
        print '<td>' . $row['userID'] . '</td>';
        print '<td>' . $row['amount'] . '</td>';
        print '</tr>';
        }
      }
?>
</form>
</tbody>
</table>




<h2>Free Queue</h2>
<table border="1">
  <thead>
    <tr>
      <th> Play </th>
      <th> FileID </th>
      <th> Title </th>
      <th> Artist </th>
      <th> User </th>
      <th> UserID </th>
    </tr>
  </thead>
  <tbody>
    <form method="post" action="djremove.php">
    <input type="submit" name="FreeQueue" value="Remove">

<?php
$username = "z1811673";
$password = "1994Jul27";

try {
  $dsn = "mysql:host=courses;dbname=z1811673";
  $pdo = new PDO($dsn, $username, $password);
}
catch(PDOexception $e) {
  echo "Connection to database failed: " . $e->getMessage();
}
      $SQLStatment = 'SELECT FreeQueue.isPicked, FreeQueue.fileID, User.name AS usrName, FreeQueue.userID,
                      Artist.name AS ArtistName, Title.text
                      FROM FreeQueue, File, Artist, Title, User
                      WHERE FreeQueue.userID = User.userID
                      and FreeQueue.fileID = File.fileID
                      and File.artistID = Artist.artistID
                      and File.titleID = Title.titleID';
      $query = $pdo->query($SQLStatment);


      while($row = $query->fetch(PDO::FETCH_ASSOC)){
        if($row['isPicked'] == 0)
        {
        print '<tr>';
        print '<td align="center"><input type="radio" value="' .$row['fileID'] . '" ' . 'name="fileID"></td>';
        print '<td>' . $row['fileID'] . '</td>';
        print '<td>' . $row['text'] . '</td>';
        print '<td>' . $row['ArtistName'] . '</td>';
        print '<td>' . $row['usrName'] . '</td>';
        print '<td>' . $row['userID'] . '</td>';
        print '</tr>';
        }
      }
?>
</form>
</tbody>
</table>
<a href="user.php">Main</a>


</body>
</html>
