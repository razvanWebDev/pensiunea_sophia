<?php  
  if(isset($_GET['post_id'])){
    $post_id = escape($_GET['post_id']);
  }
  
  $page_title = "Poze articol blog"; 
  include "includes/page_title.php";
?>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body">

      <form action="upload_post_fotos.php" class="dropzone" id="dropzoneBlog" method="POST">
        <div class="dz-message">
          Drop files here or click to upload
        </div>
        <input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id ?>">
      </form>

      <div id="preview" class="dropzone-previews"></div>

      <div class="col-12 mt-4">
      <button class="btn btn-success btn-block" id="btnDone">GATA</button>
      </div>
<!-- card body -->
    </div>
  </div>
</section>