<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/css/admin-login.css" />
    <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/alert.css">
    <title>Admin Login</title>
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
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
<div class="container">
    <div class="forms-container">
        <div class="signin-signup">

        <form id="login-frm" class="sign-in-form" action="" method="post">
        <h2 class="title">Admin Login</h2>
        <div class="input-field"> 
          <i class="fas fa-user"></i>
          <input type="text" class="form-control" name="username" autofocus placeholder="Username">
        </div>
        <div class="input-field mb-3">
          <i class="fas fa-lock"></i>
          <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary btn-sm btn-flat btn-block">Login</button>
        </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <img src="../assets/img/registerr.svg" class="image" alt="" />
        </div>
      </div>
    </div>

<script src="./assets/js/app.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>