<?php
include_once('php/db.php');
$query = $mysql->prepare("SELECT b.id, pt.productname, b.quantity, b.status, l.locationname, l.address, m.email FROM batchorder b INNER JOIN producttype pt ON b.product_id = pt.id INNER JOIN location l ON b.Location_id=l.id INNER JOIN manufacturer m ON b.Manufacturer_id=m.id where m.Email=:email ;");
$query->execute(array(":email" => $_SESSION["manusername"]));
$results = $query->fetchAll();
$count = 0;
foreach ($results as $res) {
    if ($res['status'] == 'Placed') $count++;
}
?>

<ul class="nav nav-pills red">
      <li class="active">
        <a href="manufacturerindex.php">Pending Orders<?php if ($count > 0) echo " ($count)"; ?></a>
      </li>
</ul>
