<?php 
// DELETE PHOTO
 if(isset($_GET['delete'])) {
    if(isset($_SESSION['username'])){
        $delete_id = mysqli_real_escape_string($connection, $_GET['delete']);
        deleteFileFromRow('users', 'user_image', $delete_id, "dist/img/users/");
    }
 }

$userNameInputValue = "";
$invalidUsernameClass = "";
$showUsernameError = "none";

$emailInputValue = "";
$invalidEmailClass = "";
$showEmailError = "none";

if(isset($_GET['u_id'])) {
    $the_user_id = $_GET['u_id'];
}

$query = "SELECT * FROM users WHERE id = $the_user_id";
$select_users_by_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_users_by_id)) {
  $id = $row['id'];
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $db_username = $row['username'];
  $db_email = $row['email'];
  $phone = $row['phone'];
  $user_password = $row['user_password'];
  $user_image = $row['user_image'];  
  $displayUserImage = ifExists($user_image) ? $user_image : "user.png";

  //get values for username and email inputs
  $userNameInputValue = $db_username; 
  $emailInputValue = $db_email;
}

if(isset($_POST['edit_user'])) {
    
  $firstname = escape($_POST['firstname']);
  $lastname = escape($_POST['lastname']);
  $username = escape($_POST['username']);
  $email = escape($_POST['email']);
  $phone = escape($_POST['phone']);
  $user_password = escape($_POST['user_password']);
  $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

  if(($db_username !== $username && userExists($username, $username))){
    $invalidUsernameClass = "is-invalid";
    $showUsernameError = "block";
    $userNameInputValue = $username;
      // echo "<p class='alert alert-danger'>Username already taken</p>";
  }elseif(($db_email !== $email && userExists($email, $email))){
    $invalidEmailClass = "is-invalid";
    $showEmailError = "block";
    $emailInputValue = $email;
      // echo "<p class='alert alert-danger'>Email already taken</p>";
  }else{
      if(ifExists(escape($_FILES['user_image']['name']))){
          $user_image = escape($_FILES['user_image']['name']);
          $user_image_temp = $_FILES['user_image']['tmp_name'];
          move_uploaded_file($user_image_temp, "dist/img/users/$user_image");
      }

      $query = "UPDATE users SET ";
      $query .= "firstname = '{$firstname}', ";
      $query .= "lastname = '{$lastname}', ";
      $query .= "username = '{$username}', ";
      $query .= "email = '{$email}', ";
      $query .= "phone = '{$phone}', ";
      $query .= "user_image = '{$user_image}', ";
      $query .= "user_password = '{$hashed_password}' ";
      $query .= "WHERE id = {$the_user_id}";

      $update_user = mysqli_query($connection, $query);

      if(!$update_user) {
          die("QUERY FAILED" . mysqli_error($connection));
      }

      header("Location: users.php");
      exit();
    }
}
?>

<?php $page_title = "Modifica utilizator $db_username"; ?>
<?php include "page_title.php"; ?>

<!-- Main content -->
<section class="content">
  <form id="user-form" action="" method="post" enctype="multipart/form-data">
    <div class="row">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Poza</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class='image-container'>
                <img src='dist/img/users/<?php echo $displayUserImage; ?>'>
                <div class='image-actions'>
                  <a class='btn btn-primary'
                    href='users.php?source=edit_user_photo&id=<?php echo $the_user_id ?>'>Schimba</a>
                  <a class='btn btn-danger' href='users.php?source=edit_user&u_id=<?php echo $the_user_id; ?>&delete=<?php echo $the_user_id; ?>'
                    onClick="javascript:return confirm('Delete photo?');">Sterge</a>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Informatii</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
            <div class="form-group">
                <label for="firstname">Nume *</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?>">
              </div>
              <div class="form-group">
                <label for="lastname">Prenume *</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>">
              </div>
              <div class="form-group">
                <label for="username">Username *</label>
                <input type="text" name="username" class="form-control <?php echo $invalidUsernameClass ?>" value="<?php echo $userNameInputValue ?>">
                <span class="error invalid-feedback" style="display: <?php $showUsernameError ?>">Username already taken.</span>
              </div>
              <div class="form-group">
                <label for="email">Email*</label>
                <input type="email" name="email" class="form-control <?php echo $invalidEmailClass ?>" value="<?php echo $emailInputValue ?>">
                <span class="error invalid-feedback" style="display: <?php $showEmailError ?>">Email already taken.</span>
              </div>
              <div class="form-group">
                <label for="phone">Telefon *</label>
                <input type="tel" name="phone" class="form-control" value="<?php echo $phone ?>">
              </div>

              <div class="form-group">
                <label for="user_password">Parola (camp gol daca nu se modifica parola) </label>
                <input type="password" id="user_password" name="user_password" class="form-control">
              </div>
              <div class="form-group">
                <label for="repeat_user_password">Repeta Parola (camp gol daca nu se modifica parola)</label>
                <input type="password" name="repeat_user_password" class="form-control">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="javascript:history.back(1)" class="btn btn-secondary">Inapoi</a>
        <input onclick="return confirm('Modifici utilizator?')" type="submit" value="Modifica utilizator" name="edit_user"
          class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
<!-- /.content -->