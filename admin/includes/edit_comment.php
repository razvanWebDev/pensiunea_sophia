<?php
//get the project data
if(isset($_GET['id'])){
  $id = $_GET['id'];
}
$query = "SELECT * FROM blog_comments WHERE id = {$id} ORDER BY id DESC LIMIT 1";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
  $post_id = (!empty($row['post_id']) ? $row['post_id'] : "");
  $name = (!empty($row['name']) ? $row['name'] : "");
  $email = (!empty($row['email']) ? $row['email'] : "");
  $comment = (!empty($row['comment']) ? $row['comment'] : "");
}


if(isset($_POST['submit'])) {
  $name = escape($_POST['name']);
  $email = escape($_POST['email']);
  $comment = escape($_POST['comment']);

  editComment($name, $email, $comment, $id);
  header("Location: blog.php?source=post_comments&post_id=$post_id");
  exit();
}
?>

<?php $page_title = "Editeaza comentariul"; ?>
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
              <label for="name">Nume</label>
              <input type="text" name="name" class="form-control"
                value="<?php echo $name ?>">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control"
                value="<?php echo $email ?>">
            </div>
            <div class="form-group">
              <label for="comment">Comentariu</label>
              <textarea  name="comment" class="form-control">
                <?php echo $comment; ?>
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
        <input type="submit" value="Salveaza comantariu" name="submit" id="submit"
          class="btn btn-success float-right">
      </div>
    </div>
  </form>
</section>
<!-- /.content -->