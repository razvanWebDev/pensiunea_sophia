<?php include "includes/header.php"; ?>
<div class="wrapper">

  <?php include "includes/top_navbar.php"; ?>
  <?php include "includes/sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php 
      if(isset($_GET['source'])) {
          $source = $_GET['source'];
      }else{
          $source = "";
      }

      switch($source) {
        case 'add_project';
        include "includes/add_project.php";
        break;

        case 'edit_project';
        include "includes/edit_project.php";
        break;

        case 'project_fotos';
        include "includes/project_fotos.php";
        break;

        default:
        include "includes/view_all_projects.php";
      }
    ?>
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<?php include "includes/footer.php"; ?>