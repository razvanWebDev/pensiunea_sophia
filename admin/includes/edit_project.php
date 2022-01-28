<?php
//get the project data
if(isset($_GET['id'])){
  $project_id = $_GET['id'];
}
$query = "SELECT * FROM projects WHERE id = {$project_id}";
$result = mysqli_query($connection, $query);
$db_id = $db_title = $db_link_to = $db_description = "";
while ($row = mysqli_fetch_assoc($result)) {
  $db_id = $row['id'];
  $db_title = (!empty($row['title']) ? $row['title'] : "");
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
      if($_GET['nameErr'] == "exists"){
        $titleErrorText .= "Numele asta exista deja!";
      }
    }
  }
} 
//get input values in case of error
$titleInputValue = isset($_GET['name']) ? $_GET['name'] : $db_title;
$descriptionInputValue = isset($_GET['description']) ? $_GET['description'] : $db_description;

if(isset($_POST['submit'])) {
  $title = escape($_POST['title']);
  $description = stripslashes($_POST['description']);
  
  $titleError = "";

  //check if project link exists
  $link_to = stripSpecialChars($title);
  $is_name_taken = isNameTaken ("projects", "link_to", $link_to) && ($link_to != $db_link_to);
  if($is_name_taken){
    $titleError .= "&nameErr=exists";
  }

  $error_msg = $titleError;

  if(!empty($error_msg)){
    header("Location: projects.php?source=edit_project&id=$project_id&failed=true$error_msg&name=$title&description=$description");
  }else{
    editProject($title, $description, $db_id);
    header("Location: projects.php");
    exit();
  }
}
?>

<?php $page_title = "Modifica proiect"; ?>
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
              <label for="title">Nume Proiect</label>
              <input type="text" name="title" class="form-control <?php echo $invalidTitleClass ?>"
                value="<?php echo $titleInputValue ?>">
              <span class="error invalid-feedback" style="display: <?php echo $showTitleError ?>">
                <?php echo $titleErrorText ?>
              </span>
            </div>
            <div class="form-group">
              <label for="description">Descriere proiect</label>
              <textarea id="body" name="description">
                    <?php echo $descriptionInputValue ?>
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