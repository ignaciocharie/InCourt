<?php

//resend_email_otp.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$connect = new PDO("mysql:host=localhost; dbname=incourt", "root", "");


$message = '';
$verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

session_start();


if (isset($_POST["resend"])) {
	if (empty($_POST["email"])) {
		$message = '<div class="alert alert-danger">Email Address is required</div>';
	} else {
		$data = array(
			':email'	=>	trim($_POST["email"])
		);

		$query = "
		SELECT * FROM client_list 
		WHERE email = :email
		";

		$statement = $connect->prepare($query);

		$statement->execute($data);

		if ($statement->rowCount() > 0) {
			$result = $statement->fetchAll();
			foreach ($result as $row) {
				if ($row["email_status"] == 'verified') {
					$message = '<div class="alert alert-info">Email Address already verified.</div>';
				} else {
					$sub_query = "
					UPDATE client_list 
					SET verification_code = '" . $verification_code . "' 
					WHERE id = '" . $row["id"] . "'
					";

					$connect->query($sub_query);



					$mailer = new PHPMailer(true);
					try {
						$mailer->isSMTP();

						if (true) {
							$mailer->SMTPOptions = [
								'ssl' => [
									'verify_peer' => false,
									'verify_peer_name' => false,
									'allow_self_signed' => true
								]
							];
						}
						$mailer->Host = 'smtp.gmail.com';
						$mailer->SMTPAuth = true;
						$mailer->Username = 'pererdan7@gmail.com';
						$mailer->Password = 'ksldbgnrzvjvzwqj';
						$mailer->SMTPSecure = 'tls';
						$mailer->Port = 587;

						$mailer->setFrom('pererdan7@gmail.com', 'InCourt');
						$mailer->addAddress($_POST["email"]);

						$mailer->isHTML(true);
						$mailer->Subject = 'Verification code to Verify Your Email Address';
						$mailer->Body = '
						<p>To verify your email address, enter this verification code when prompted: <b>' . $verification_code . '</b>.</p>
						<p>Sincerely,</p>
						';

						// $mailer->send();
						if ($mailer->send()) {
							echo '<script>alert("Please Check Your Email for Verification Code")</script>';
							echo '<script>window.location.replace("resend_email_otp.php?step2")</script>';
						} else {
							$message = $mail->ErrorInfo;
						}
						$mailer->ClearAllRecipients();
					} catch (Exception $e) {
						echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
					}
				}
			}
		} else {
			$message = '<div class="alert alert-danger">Email Address not found in our record</div>';
		}
	}
}

if (isset($_POST["check_otp"])) {
	$user_otp = $_POST["user_otp"];
	if (empty($_POST["user_otp"])) {
		$message = '<div class="alert alert-dangers">Enter OTP Number</div>';
	} else {
		try {
			$data = array(
				':user_otp' => $_POST["user_otp"]
			);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = "SELECT * FROM client_list WHERE verification_code = :user_otp";

			$statement = $connect->prepare($query);
			$statement->execute($data);
			if ($statement->rowCount() > 0) {
				// Update user status to "verified"
				$update_query = "UPDATE client_list SET email_status = 'verified' WHERE verification_code = :user_otp";
				$update_statement = $connect->prepare($update_query);
				$update_statement->execute($data);

				// Redirect user to login page
				echo '<script>window.location.replace("login.php")</script>';
			} else {
				$message = '<div class="alert alert-dangers">Wrong OTP Number</div>';
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Resend Email Verification OTP</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="http://code.jquery.com/jquery.js"></script>
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="<?php echo base_url ?>dist/css/alert.css">
	<link rel="stylesheet" href="./assets/css/resend-otp.css" />
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

<body>
	<div class="container">
        <div class="forms-container">
            <div class="signin-signup">
			<div class="panel-body">
				<?php echo $message; ?>
				<?php

				echo $message;

				if (isset($_GET["step1"])) {
				?>
					<form method="post">
                    <h2 class="title">Resend OTP Email Verification</h2>
						<div class="input-field">
                            <i class="fas fa-lock"></i>
							<input type="text" name="email" placeholder="Enter your Email" autofocus required>
						</div>
                            <button type="submit" name="resend" value="Send" class="btn btn-primary btn-sm btn-flat btn-block">Send</button>
                </div>
					</form>
              
				<?php
				}


				if (isset($_GET["step2"])) {
				?>
					<form method="POST">
					<h2 class="title">Enter OTP Number</h2>
						<div class="input-field">
							<i class="fas fa-lock"></i>
							<input type="text" name="user_otp" placeholder="Enter your OTP" autofocus required>
						</div>
							<button type="submit" name="check_otp" class="btn btn-primary btn-sm btn-flat btn-block" value="Send">Send </button>
					</form>
				<?php
				}
				?>


			</div>
		</div>
			<div class="panels-container">
			<div class="panel left-panel">
			<img src="./assets/img/resend-otp.svg" class="image" alt="" />
			</div>
		</div>
	</div>
	<br />
	<br />
</body>

</html>