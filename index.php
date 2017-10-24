<html>
<head>
</head>
<body>
<?php

//include database connection
include "db.php"; 

$query = "SELECT * FROM customer";
$stmt = $mysql->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
$boi = "come and get me, big boi";
foreach( $result as $row ) {
echo $row['Name'] . $row['Address'] ."<br>";

echo $boi;

}
?>
</body>
</html>