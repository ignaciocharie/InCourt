<?php
$time1 = strtotime('08:00:00');
$time2 = strtotime('09:30:00');
$difference = round(abs($time2 - $time1) / 3600,2);
echo $difference;

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<input type="number" id="num1" name="num1" value="541">
	<input type="number" id="num2" name="num2" value="567">

	<?php 
		$total = $num1 + $num2;
		echo "$total";


			$fac_id = $_POST['facility_id']

            $qry = $conn->query("SELECT * from `facility_list` where id = $fac_id ");
            $fetch = $qry->fetch_array();
            $price = $fetch['price'];
      
           	$pfee = round(abs($phours * $price),2);

     		$_POST['fee'] = $pfee;




	 ?>

</body>
</html>

 $qry = $conn->query("SELECT * from `facility_list` where id = $_POST['facility_id'] ");
            	$fetch = $qry->fetch_array();
            	$price = $fetch['price'];


 $_POST['fee'] = $price * $phours;