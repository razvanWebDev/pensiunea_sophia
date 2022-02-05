<?php include "includes/header.php"; ?>
<div class="wrapper">

  <?php include "includes/top_navbar.php"; ?>
  <?php include "includes/sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<?php    
  $page_title = "Galerie foto"; 
  include "includes/page_title.php";
?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">

          <form action="upload_gallery_fotos.php" class="dropzone" id="dropzoneFrom" method="POST">
            <div class="dz-message">
              Drop files here or click to upload gallery photos
            </div>
          </form>

          <div id="preview" class="dropzone-previews"></div>
          <!-- card body -->
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<?php include "includes/footer.php"; ?>