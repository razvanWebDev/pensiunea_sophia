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
        case 'add_post';
        include "includes/add_post.php";
        break;

        case 'edit_post';
        include "includes/edit_post.php";
        break;

        case 'blog_fotos';
        include "includes/blog_fotos.php";
        break;

        case 'post_comments';
        include "includes/blog_post_comments.php";
        break;

        case 'edit_comment';
        include "includes/edit_comment.php";
        break;

        default:
        include "includes/view_all_posts.php";
      }
    ?>
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<?php include "includes/footer.php"; ?>