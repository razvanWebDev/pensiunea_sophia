<?php
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
//get input values in case the username or email already exist
$titleInputValue = isset($_GET['name']) ? $_GET['name'] : "";
$descriptionInputValue = isset($_GET['description']) ? $_GET['description'] : "";

if(isset($_POST['submit'])) {
  $title = escape($_POST['title']);
  $description = stripslashes($_POST['description']);
  
  $titleError = "";

  //check if project link exists
  $link_to = stripSpecialChars($title);
  $is_name_taken = isNameTaken ("projects", "link_to", $link_to);
  if($is_name_taken){
    $titleError .= "&nameErr=exists";
  }

  $error_msg = $titleError;

  if(!empty($error_msg)){
    header("Location: projects.php?source=add_project&failed=true$error_msg&name=$title&description=$description");
  }else{
    //add new project db
    $lastId = createProject($title, $description);
    echo $lastId;

    // create images folder
    $new_folder = "../assets/img/projects/{$lastId}";
    if (!is_dir($new_folder)) {
      mkdir($new_folder, 0777, true);
    }else{
        die("There was an error creating the photos folder");
    }

    header("Location: projects.php?source=project_fotos&project_id=$lastId");
    exit();
  }
}
?>

<?php $page_title = "Adauga un proiect"; ?>
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
              <label for="title">Nume proiect</label>
              <input type="text" name="title" class="form-control <?php echo $invalidTitleClass ?>"
                value="<?php echo $titleInputValue ?>">
              <span class="error invalid-feedback" style="display: <?php echo $showTitleError ?>">
                <?php echo $titleErrorText ?>
              </span>
            </div>
            <div class="form-group">
              <label for="description">Descriere Proiect</label>
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
        <input type="submit" value="Salveaza si adauga poze" name="submit" id="submit"
          class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
<!-- /.content -->