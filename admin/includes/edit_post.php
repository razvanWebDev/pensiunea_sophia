<?php
//get the project data
if(isset($_GET['id'])){
  $post_id = $_GET['id'];
}
$query = "SELECT * FROM blog WHERE id = {$post_id}";
$result = mysqli_query($connection, $query);
$db_id = $db_title = $db_link_to = $db_description = "";
while ($row = mysqli_fetch_assoc($result)) {
  $db_id = $row['id'];
  $db_title = (!empty($row['title']) ? $row['title'] : "");
  $db_date = (!empty($row['date']) ? $row['date'] : "");
  $db_link_to = (!empty($row['link_to']) ? $row['link_to'] : "");
  $db_description = (!empty($row['description']) ? $row['description'] : ""); 
}

$invalidTitleClass = "";
$showTitleError = "none";
$titleErrorText = "";

//check for errors
if(isset($_GET['failed'])){
  if($_GET['failed'] == "true"){
    if(isset($_GET['nameErr'])){
      $showTitleError = "block";
      $invalidTitleClass = "is-invalid";
      if($_GET['nameErr'] == "required"){
        $titleErrorText .= "Titlul este obligatoriu!";
      }
      if($_GET['nameErr'] == "exists"){
        $titleErrorText .= "Numele exista deja!";
      }
    }
  }
} 
//get input values in case of error
$titleInputValue = isset($_GET['title']) ? $_GET['title'] : $db_title;
$dateInputValue = isset($_GET['date']) ? $_GET['date'] : $db_date;
$descriptionInputValue = isset($_GET["post_description"]) ? $_GET["post_description"] : $db_description;

if(isset($_POST['submit'])) {
  $title = escape($_POST['title']);
  $date = escape($_POST['date']);
  $posted_by = "Admin";
  $description = $_POST['description'];

;
  
  $titleError = "";

  //check if project link exists
  $link_to = stripSpecialChars($title);
  $is_name_taken = isNameTaken ("blog", "link_to", $link_to) && ($link_to != $db_link_to);
  // check if title exists
  if(empty($title)){
    $titleError .= "&nameErr=required";
  }
  else if($is_name_taken){
    $titleError .= "&nameErr=exists";
  }

  $error_msg = $titleError;

  if(!empty($error_msg)){
    header('Location: blog.php?source=edit_post&id='.$post_id.'&failed=true'.$error_msg.'&title='.$title.'&date='.$date.'&description='.$description.'');
  }else{
    editPost($title, $date, $description, $db_id);
    header("Location: blog.php");
    exit();
  }
}
?>

<?php $page_title = "Modifica articol"; ?>
<?php include "page_title.php"; ?>

<!-- Main content -->
<section class="content">
  <form id="user-form" action="" method="POST" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">General</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="title">Titlu articol</label>
              <input type="text" name="title" class="form-control <?php echo $invalidTitleClass ?>"
                value="<?php echo $titleInputValue ?>">
              <span class="error invalid-feedback" style="display: <?php echo $showTitleError ?>">
                <?php echo $titleErrorText ?>
              </span>
            </div>
            <div class="form-group">
              <label for="date">Data</label>
              <input type="date" name="date" class="form-control" value=<?php echo $dateInputValue; ?>>
            </div>
            <div class="form-group">
              <label for="description">Continut articol</label>
              <textarea id="body" name="description">
                    <?php echo $descriptionInputValue; ?>
                </textarea>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <a href="javascript:history.back(1)" class="btn btn-secondary">Inapoi</a>
        <input type="submit" value="Salveaza proiect" name="submit" id="submit"
          class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
<!-- /.content -->