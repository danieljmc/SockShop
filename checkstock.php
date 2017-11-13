<?php
	include "db.php";
	
	//Below are the tables and the columns taken from them
	//	product - Size, Colour
	//	producttype - Name, id
	//	productquantity - Quantity
	//	manufacturer - Company name
	//	location - location name
	
	try{
		$query = "SELECT producttype.id, producttype.ProductName, manufacturer.Company, product.Size, product.Colour, productquantity.Quantity, location.LocationName FROM ((((product 
			INNER JOIN producttype ON product.ProductType_id = producttype.id)
			INNER JOIN productquantity ON product.id = productquantity.ProductID)
            INNER JOIN location ON productquantity.locationID = location.id)
            INNER JOIN manufacturer ON producttype.Manufacturer_id = manufacturer.id);"
	
		$result = mysql_query($query);

		while($row = mysql_fetch_array($result)) {
			echo $row['producttype.id'];
		}
		
	}
	catch (PODException $e)
	{
		echo $e->getMessage(); 
	}

?>