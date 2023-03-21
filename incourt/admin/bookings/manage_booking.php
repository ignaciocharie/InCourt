<?php
if (isset($_POST["save_booking"]))
{

    
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "incourt";

// Create connection
    $conn = mysqli_connect($servername, $username, $password, $database_name);
    

    if(empty($_POST['id'])){

        $facility_id = $_POST["facility_id"];
        $date_to = $_POST["date_to"];
        $user_id = 33;

        $prefix = date('Ym-');
        $code = sprintf("%'.05d",1);
        while(true){
            $check = $conn->query("SELECT * FROM `booking_list` where ref_code = '{$prefix}{$code}'")->num_rows;
				if($check > 0){
					$code = sprintf("%'.05d",ceil($code) + 1);
				}else{
					break;
				}
        }
        $user_id = 33;
        $ref_code = $prefix.$code;   

    
            $time1 = strtotime($_POST['start_time']);
            $time2 = strtotime($_POST['end_time']);

        $phours = round(abs($time2 - $time1) / 3600,2);    
        
        $hours = $phours;

        $start_time = $_POST["start_time"];
        $end_time = $_POST["end_time"];

        
    }

        $entry = $conn->query("SELECT b.*, f.id as fac_id, cc.id as cat_id FROM `booking_list` b inner join facility_list f on b.facility_id = f.id inner join category_list cc on f.category_id = cc.id WHERE (date_to='{$date_to}' and '{$start_time}' BETWEEN start_time AND end_time AND b.status = 1) or (date_to='{$date_to}'  AND '{$end_time}' BETWEEN start_time AND end_time AND b.status = 1)")->num_rows;
		if($entry > 0){
            echo 'Facility is not available on the selected dates.';
		}

        else {
            $sql = "INSERT INTO `booking_list` (`ref_code`, `client_id`, `facility_id`, `date_to`, `start_time`, `end_time`, `hours`, `status`) 
            VALUES ('$ref_code', $user_id, $facility_id, '$date_to', '$start_time', '$end_time', $hours, 1)";
            $insert = mysqli_query($conn, $sql);

    if($insert) {
        echo 'Booking successfully added!';
    }

}

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<div class="card card-outline card-info rounded-0">
    <div class="card-header">
        <h3 class="card-title">Create Booking</h3>
    </div>
    <div class="card-body">
        
    <div class="container-fluid">

    <form action="" id="booking-form" method="POST">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <input type="hidden" name="facility_id" id="facility_id" value="<?= isset($_GET['fid']) ? $_GET['fid'] : (isset($facility_id) ? $facility_id : "") ?>">
        <div class="form-group">
            <label for="date_to" class="control-label">Schedule Date</label>
            <input name="date_to" id="date_to" type="date" class="form-control form-control-sm rounded-0" required />
        </div>
        <div class="form-group">
            <label for="start_time" class="control-label">Starting Time</label>
            <input name="start_time" id="start_time" type="time" class="form-control form-control-sm rounded-0" required />
        </div>
        <div class="form-group">
            <label for="end_time" class="control-label">Ending Time</label>
            <input name="end_time" id="end_time" type="time" class="form-control form-control-sm rounded-0" required />
        </div>
        
                <center>
                <button type="submit" name="save_booking" class="btn btn-flat btn-primary">Save</button>
                <a class="btn btn-flat btn-default" href="?page=bookings">Cancel</a>
                </center>
        
    </form>
</div>

</body>
</html>

<script>
	
</script>