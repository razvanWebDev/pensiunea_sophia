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
      if($_GET['nameErr'] == "required"){
        $titleErrorText .= "Titlul este obligatoriu!";
      }
      if($_GET['nameErr'] == "exists"){
        $titleErrorText .= "Numele exista deja!";
      }
    }
  }
} 
//get input values in case the username or email already exist
$titleInputValue = isset($_GET['title']) ? $_GET['title'] : "";
$dateInputValue = isset($_GET['date']) ? $_GET['date'] : "";
$descriptionInputValue = isset($_GET['description']) ? $_GET['description'] : "";

if(isset($_POST['submit'])) {
  $title = escape($_POST['title']);
  $date = escape($_POST['date']);
  $posted_by = "Admin";
  $description = stripslashes($_POST['description']);
  $status = escape($_POST['status']);
  
  $titleError = "";
  $link_to = stripSpecialChars($title);
  $is_name_taken = isNameTaken ("blog", "link_to", $link_to);

  // check if title exists
  if(empty($title)){
    $titleError .= "&nameErr=required";
  }
  //check if project link exists
  else if($is_name_taken){
    $titleError .= "&nameErr=exists";
  }

  $error_msg = $titleError;

  if(!empty($error_msg)){
    header('Location: blog.php?source=add_post&failed=true'.$error_msg.'&title='.$title.'&date='.$date.'&description='.$description.'');
  }else{
    //add new project db
    $lastId = createPost($title, $date, $posted_by, $description, $status);

    // create images folder
    $new_folder = "../images/blog/{$lastId}";
    if (!is_dir($new_folder)) {
      mkdir($new_folder, 0777, true);
    }else{
        die("There was an error creating the photos folder");
    }

    header("Location: blog.php?source=blog_fotos&post_id=$lastId");
    exit();
  }
}
?>

<?php $page_title = "Adauga un articol blog"; ?>
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
              <label for="title">Data</label>
              <input type="date" name="date" class="form-control" value=<?php echo date("Y-m-d") ?>>
            </div>
            <div class="form-group">
              <label for="description">Continut articol</label>
              <textarea id="body" name="description">
                    <?php echo $descriptionInputValue ?>
                </textarea>
            </div>
            <div class="form-group">
              <label for="description">Status</label>
              <select name="status" class="form-control">
                <option value="lucru">In lucru</option>
                <option value="public">Public</option>
              </select>
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