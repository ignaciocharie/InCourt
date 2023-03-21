<?php

//email_verify.php

$connect = new PDO("mysql:host=localhost;dbname=incourt", "root", "");

$error_user_otp = '';
$verification_code = '';
$message = '';


if (isset($_POST["submit"])) {
	$otp = $_POST["user_otp"];
	if (empty($_POST["user_otp"])) {
		$error_user_otp = 'Enter OTP Number';
	} else {
		$query = "
			SELECT * FROM client_list 
			WHERE verification_code = '" . $otp . "' 
			
			";

		$statement = $connect->prepare($query);

		$statement->execute();

		$total_row = $statement->rowCount();

		if ($total_row > 0) {
			$query = "
				UPDATE client_list 
				SET email_status = 'verified' 
				WHERE verification_code = '" . $otp . "'
				";

			$statement = $connect->prepare($query);
			if ($statement->execute()) {

				sleep(2);
				header('location:login.php?register=success');
			}
		} else {
			$message = '<label class="text-danger">Invalid OTP Number</label>';
		}
	}
}

?>
<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<title>Email Verification using OTP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
	<script src="http://code.jquery.com/jquery.js"></script>
	<script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="<?php echo base_url ?>dist/css/alert.css">
	<link rel="stylesheet" href="./assets/css/email_verify1.css" />
	<script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>
	
	
	

	
</head>

<body class="">
	<div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                        <?php echo $message; ?>
                        <form method="POST">
                            <input type="hidden" name="id">
                            <h2 class="title">Email Verification</h2>
                            <div class="input-field">
                                <i class="fas fa-lock"></i>
                                <input type="text" name="user_otp" placeholder="Enter your OTP Number" autofocus required>
                                <?php echo $error_user_otp; ?>
                            </div>
                                <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm btn-flat btn-block">Submit</button>
                            </div>
                        </form>
        </div>
	</div>
    <div class="panels-container">
    <div class="panel left-panel">
      <img src="./assets/img/verify.svg" class="image" alt="" />
    </div>
  </div>
  </div>
	<br />
	<br />

</body>
</html>