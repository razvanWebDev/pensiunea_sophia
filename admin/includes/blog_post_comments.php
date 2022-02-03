<?php

//get the post ID
if(isset($_GET['post_id'])){
  $post_id = $_GET['post_id'];
}

// DELETE COMMENT
 if(isset($_GET['delete'])) {
  if(isset($_SESSION['username'])){
    $delete_id = mysqli_real_escape_string($connection, $_GET['delete']);
    //remove project
    deleteItem('blog_comments', $delete_id);
    header("Location: blog.php?source=post_comments&post_id=$post_id");
    exit();  
  }else{
    header("Location: index.php");
    exit();
  }
 }

?>

<?php $page_title = "Comentarii articol blog"; ?>
<?php include "includes/page_title.php"; ?>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body">
      <!-- Get article title -->
      <?php
        $query = "SELECT * FROM blog WHERE id='{$post_id}' ORDER BY id DESC LIMIT 1";
        $select_posts = mysqli_query($connection, $query);
    
        while ($row = mysqli_fetch_assoc($select_posts)) {
          $title = (!empty($row['title']) ? $row['title'] : "");
      ?>
      <h4 class="mt-2 mb-4">
        <?php echo $title ?>
      </h4>
      <?php } ?>


      <table class="table table-bordered table-hover text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Nume</th>
            <th>Email</th>
            <th>Data si ora</th>
            <th>Comentariu</th>
            <th>Modifica</th>
            <th>Sterge</th>
          </tr>
        </thead>
        <tbody>
          <?php
        $query = "SELECT * FROM blog_comments WHERE post_id = {$post_id} ORDER BY id";
        $select_users = mysqli_query($connection, $query);
        
        $rowCounter = 0;
        while ($row = mysqli_fetch_assoc($select_users)) {  
          $comment_id = (!empty($row['id']) ? $row['id'] : "");          
          $name = (!empty($row['name']) ? $row['name'] : "");
          $email = (!empty($row['email']) ? $row['email'] : "");
          $comment = (!empty($row['comment']) ? $row['comment'] : "");
          $timestamp = (!empty($row['timestamp']) ? $row['timestamp'] : "");
          $rowCounter++;
     ?>

          <tr>
            <td>
              <?php echo $rowCounter ?>
            </td>
            <td>
              <?php echo $name ?>
            </td>
            <td>
              <?php echo $email ?>
            </td>
            <td>
              <?php echo $timestamp ?>
            </td>
            <td>
              <?php echo $comment ?>
            </td>

            <td class="text-center">
              <a href="blog.php?source=edit_comment&id=<?php echo $comment_id ?>"
                class="btn btn-sm btn-primary edit-delete-btn">
                <i class="far fa-edit mr-2"></i>Modifica
              </a>
            </td>
            <td class="text-center">
              <a href="blog.php?source=post_comments&post_id=<?php echo $post_id ?>&delete=<?php echo $comment_id ?>"
                onClick="javascript:return confirm('Esti sigur ca stergi comentariul ?')" ;
                class="btn btn-sm bg-danger edit-delete-btn">
                <i class="fas fa-trash-alt mr-2"></i>
                Sterge
              </a>
            </td>
          </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->