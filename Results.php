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

    if(!empty($_POST)){
      foreach ($_POST as $key => $value) {

        #If You Serach By Contributor
        if($key == 'cont'){
          $SQLStatment = 'SELECT File.fileID AS FILEID, Artist.name AS ArtistName, Title.text AS Text, Contributor.name AS ContributorName FROM Title, Artist, File, Contributes, Contributor Where Artist.artistID = File.artistID and Title.titleID = File.titleID and File.fileID = Contributes.fileID and Contributes.contrID = Contributor.contrID and Contributor.name ="' . $value . '"';
        }

        #If You Serch By Title
        if($key == 'title'){
          $SQLStatment = 'SELECT File.fileID AS FILEID, Artist.name AS ArtistName, Title.text AS Text, Contributor.name AS ContributorName FROM Title, Artist, File, Contributes, Contributor
            WHERE Artist.artistID = File.artistID and File.titleID = Title.titleID and File.fileID = Contributes.fileID and
            Contributes.contrID = Contributor.contrID and Title.text = "' . $value . '"';
        }

        #If You Serach By Artist
        if($key == 'artist'){
          $SQLStatment = 'SELECT DISTINCT File.fileID AS FILEID, Artist.name AS ArtistName, Title.text AS Text, Contributor.name AS ContributorName FROM Title, Artist, File, Contributes, Contributor
            WHERE Artist.artistID = File.artistID and File.titleID = Title.titleID and File.fileID = Contributes.fileID and
            Contributes.contrID = Contributor.contrID and Artist.name = "' . $value . '" GROUP BY text';
        }
      }

      //Query depends on the upper block of code
      $query = $pdo->query($SQLStatment);

      //Table Format
      echo '<div align="center">';
      echo '<table border="1">';
      echo '<thead>';
      echo '<tr>';
      echo '<th>Select</th>';
      echo '<th>Artist</th>';
      echo '<th>Title</th>';
      echo '<th>Contributor</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      echo '<form method="post" action="Queue.php">';
      echo '<div align="center">';
      echo '<input type="submit" name="Queue" value="FreeQueue">';
      echo '<input type="submit" name= "Queue" value="PaidQueue">';
      echo '<br><br>';
      echo '</div>';



      //Table row Generation
      while($row = $query->fetch(PDO::FETCH_ASSOC)){
          echo '<tr>';
          echo '<td align="center"><input type="radio" name="fileID" value="' .$row['FILEID'] . '"></td>';
          echo '<td>' . $row['ArtistName'] . '</td>';
          echo '<td>' . $row['Text'] . '</td>';
          echo '<td>' . $row['ContributorName'] . '</td>';
          echo '</tr>';
      }

      //End Table Format
      echo '</form>';
      echo '</tbody>';
      echo '</table>';
      echo '</div>';
    }
?>
</body>
</html>
