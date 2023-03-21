<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//forget_password.php
$connect = new PDO("mysql:host=localhost; dbname=incourt", "root", "");


$message = '';
$user_code = "";


session_start();


if (isset($_POST["submit"])) {
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
				if ($row["email_status"] == 'not verified') {
					$message = '<div class="alert alert-info">Your Email Address is not verified, so first verify your email address by click on this <a href="resend_email_otp.php">link</a></div>';
				} else {
					$user_otp =  substr(number_format(time() * rand(), 0, '', ''), 0, 6);

					$sub_query = "
					UPDATE client_list 
					SET verification_code = '" . $user_otp . "' 
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
						$mailer->Subject = 'Password reset request for your account';
						$mailer->Body = '
						<p>To reset your password, you have to enter this verification code when prompted: <b>' . $user_otp . '</b>.</p>
						<p>Sincerely,</p>
						';

						// $mailer->send();
						if ($mailer->send()) {
							echo '<script>alert("Please Check Your Email for password reset code")</script>';

							echo '<script>window.location.replace("forget_password.php?step2")</script>';
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
			$message = '<div class="alert alert-info">Email Address not found in our record</div>';
		}
	}
}

if (isset($_POST["check_otp"])) {
	$user_otp = $_POST["user_otp"];
	if (empty($_POST["user_otp"])) {
		$message = '<div class="alert alert-danger">Enter OTP Number</div>';
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
				echo '<script>window.location.replace("forget_password.php?step3=1&code=' . $_POST["user_otp"] . '")</script>';
			} else {
				$message = '<div class="alert alert-dangers">Wrong OTP Number</div>';
			}
		} catch (PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}

if (isset($_POST["change_password"])) {
	$new_password = $_POST["user_password"];
	$confirm_password = $_POST["confirm_password"];


	if ($new_password == $confirm_password) {
		$query = "
		UPDATE client_list 
		SET password = '" . password_hash($new_password, PASSWORD_DEFAULT) . "' 
		WHERE verification_code = '" . $_GET['code'] . "'
		";

		$connect->query($query);
		if ($connect->query($query)) {
			// Query was successful
			echo '<script>window.location.replace("login.php?reset_password=success")</script>';
		} else {
			// Query failed
			$message = '<div class="alert alert-danger">Failed to reset password</div>';
		}


		echo '<script>window.location.replace("login.php?reset_password=success")</script>';
	} else {
		$message = '<div class="alert alert-danger">Confirm Password is not match</div>';
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Forgot Password</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="http://code.jquery.com/jquery.js"></script>
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"></script>
	  <link rel="stylesheet" href="<?php echo base_url ?>dist/css/alert.css">
	<link rel="stylesheet" href="./assets/css/forgot-pass.css" />
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
				<?php

				echo $message;

				if (isset($_GET["step1"])) {
				?>
					<form method="post">
                    <h2 class="title">Enter Your Registered Email</h2>
						<div class="input-field">
                        <i class="fas fa-lock"></i>
							<input type="text" name="email" placeholder="Enter your Email" autofocus required>
						</div>
							<button type="submit" name="submit" class="btn btn-primary btn-sm btn-flat btn-block" value="Send">Send</button>
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
							<button type="submit" name="check_otp" class="btn btn-primary btn-sm btn-flat btn-block" value="Send">Send</button>
					</form>
				<?php
				}

				if (isset($_GET["step3"])) {
				?>
					<form method="post">
					<h2 class="title">New Password</h2>
						<div class="input-field">
                        <i class="fas fa-lock"></i>
							<input type="password" name="user_password" placeholder="Enter New Password" autofocus required>
						</div>
						<div class="input-field">
						<i class="fas fa-lock"></i>
							<input type="password" name="confirm_password" placeholder="Confirm Password" autofocus required>
						</div>
							<button type="submit" name="change_password" class="btn btn-primary btn-sm btn-flat btn-block" value="Change">Submit</button>
					</form>
				<?php
				}
				?>
			</div>
		</div>
        <div class="panels-container">
			<div class="panel left-panel">
			<img src="./assets/img/forgot-pass.svg" class="image" alt="" />
			</div>
		</div>
	</div>
	<br />
	<br />
</body>
</html>