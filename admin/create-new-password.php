<?php include "../PHP/db.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <h1><b>Admin</b></h1>
      </div>
      <div class="card-body">
        <?php
          $selector = isset($_GET['selector']) ? $_GET['selector'] : "";
          $validator = isset($_GET['validator']) ? $_GET['validator'] : "";

          if(empty($selector) || empty($validator)){
            echo "<p class='text-danger'>Could not validate your request!</p>";
          }else{
            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
        ?>

        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
        <form action="includes/reset-password.php" method="post" id="reset-password-form">
        <input type="hidden" name="selector" value="<?php echo $selector ?>">
        <input type="hidden" name="validator" value="<?php echo $validator ?>">
          <div class="input-group form-group mb-3">
            <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group form-group mb-3">
            <input type="password" name="pwd_repeat" class="form-control" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" name="reset-password-submit" class="btn btn-primary btn-block">Reset password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <?php
          }
        }
      ?>

        <p class="mt-3 mb-1">
          <a href="index.php">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Custom JS -->
<script src="dist/js/admin.js"></script>
</body>

</html>