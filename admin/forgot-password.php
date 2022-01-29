<?php include "../PHP/db.php" ?>
<?php
$inputValue = "";
//success
$subtitle_p = "You forgot your password? Enter your email to reset password";
$subtitle_p_color_class = "";

if(isset($_GET['error'])){
    if(isset($_GET['value'])){
        $inputValue = $_GET['value'];
    }
    $inputErrorClass = "is-invalid";
    $subtitle_p_color_class = "text-danger";

    if($_GET['error'] == 'required'){
        $subtitle_p = "Enter email!";
    }elseif($_GET['error'] == 'invalid'){
        $subtitle_p = "Invalid email!";
    }elseif($_GET['error'] == 'notFound'){
        $subtitle_p = "There is no account with this email address!";
    }
}elseif(isset($_GET['reset'])){
    if($_GET['reset'] == success){
        $subtitle_p = "Success! Please check your email.";
        $subtitle_p_color_class = "text-success";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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
      <p class="login-box-msg <?php echo $subtitle_p_color_class ?>"><?php echo $subtitle_p ?></p>
      <form action="includes/forgot-password.php" method="post">
        <div class="input-group mb-3">
          <input name="email" type="email" class="form-control <?php echo $inputErrorClass ?>" placeholder="Email" value="<?php echo $inputValue ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="forgot-password-submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

