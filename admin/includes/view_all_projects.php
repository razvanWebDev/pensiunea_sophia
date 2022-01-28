<!-- DELETE PROJECT -->
<?php 
 if(isset($_GET['delete'])) {
  if(isset($_SESSION['username'])){
    $delete_id = mysqli_real_escape_string($connection, $_GET['delete']);

    //remove project
    deleteItem('projects', $delete_id);
    //remove photos from db
    deleteItemDiffID("projects_fotos", "project_id", $delete_id);
    // remove folder
    if(!empty($delete_id && $delete_id > 0)){
      deleteFolder("../assets/img/projects/$delete_id/");
    }
    header("Location: projects.php");
    exit();  
  }else{
    header("Location: index.php");
    exit();
  }
 }
?>

<?php $page_title = "Proiecte"; ?>
<?php include "includes/page_title.php"; ?>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="card card-solid">
    <div class="card-body">

      <a href="projects.php?source=add_project" class="btn bg-primary mb-4">
        <i class="fas fa-plus mr-2"></i>Adauga un proiect
      </a>

      <table class="table table-bordered table-hover text-center">
        <thead>
          <tr>
            <th>#</th>
            <th>Nume proiect</th>
            <th>Descriere proiect</th>
            <th>Poze proiect</th>
            <th>Modifica</th>
            <th>Sterge</th>
          </tr>
        </thead>
        <tbody>
          <?php
        //pagination
        $rowCounter_per_page = 0;
        //the number of posts per page
        $articles_per_page = 15;
    
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = 1;
        }

        if($page == "" || $page == 1){
            $page_1 = 0;
        }else{
            $page_1 = ($page * $articles_per_page) - $articles_per_page;
        }

        $post_query_count = "SELECT * FROM projects";
        $select_post_query_count = mysqli_query($connection, $post_query_count);
        $count = mysqli_num_rows($select_post_query_count);
        $count = ceil($count / $articles_per_page); 

        $query = "SELECT * FROM projects ORDER BY id DESC LIMIT $page_1, $articles_per_page";
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
          $rowCounter_per_page++;
          $totalRowCounter = $rowCounter_per_page + (($page-1) * $articles_per_page);
          
          $id = $row['id'];
          $title = (!empty($row['title']) ? $row['title'] : "");
          $description = (!empty($row['description']) ? $row['description'] : ""); 
          //get short text for expandable table
          // $short_text = strip_tags($description);
          $short_text = $description;
          if (strlen($short_text) > 175) {

            // truncate string
            $stringCut = substr($short_text, 0, 170);
            $endPoint = strrpos($stringCut, ' ');
        
            //if the string doesn't contain any space then it will cut without word basis.
            $short_text = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $short_text .= '...';
          }

          $folder_name = $image = "";

          //display only first image
            $image_query = "SELECT * FROM projects_fotos WHERE project_id = {$id} ORDER BY id DESC LIMIT 1";
            $image_result = mysqli_query($connection, $image_query);
            while($row = mysqli_fetch_assoc($image_result)){
              $folder_name = (!empty($row['folder_name']) ? $row['folder_name'] : ""); 
              $image = (!empty($row['image']) ? $row['image'] : ""); 
            }
      ?>

          <tr data-widget="expandable-table" aria-expanded="false">
            <td>
              <?php echo $totalRowCounter ?>
            </td>
            <td>
              <?php echo $title ?>
            </td>
            <td class="text-justify">
              <?php echo $short_text ?>
            </td>
            <td class="text-center">
              <?php
                if(!empty($image)){
              ?>
              <img class="table-image mb-2" src="../assets/img/<?php echo $folder_name ?>/<?php echo $image ?>" alt=" ">
              <?php } ?>
              <a class='btn btn-sm btn-primary edit-delete-btn'
                href='projects.php?source=project_fotos&project_id=<?php echo $id ?>'>Modifica poze</a>
            </td>
            <td class="text-center">
              <a href="projects.php?source=edit_project&id=<?php echo $id ?>"
                class="btn btn-sm btn-primary edit-delete-btn">
                <i class="far fa-edit mr-2"></i>Modifica text
              </a>
            </td>
            <td class="text-center">
              <a href="projects.php?delete=<?php echo $id; ?>&fldr=<?php echo $foldername ?>"
                onClick="javascript:return confirm('Esti sigur ca stergi proiectul <?php echo $title; ?>?')"
                ; class="btn btn-sm bg-danger edit-delete-btn">
                <i class="fas fa-trash-alt mr-2"></i>
                Sterge proiect
              </a>
            </td>
          </tr>
          <tr class="expandable-body">
            <td colspan="8" class="text-justify">
              <p>
                <?php echo $description ?>
              </p>
            </td>
          </tr>
          <?php } ?>

        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <nav aria-label="Contacts Page Navigation">
      <ul class="pagination justify-content-center m-0">
        <?php
        if($count > 1){
          for($i = 1; $i <= $count; $i++){
            if($i == $page){
                echo "<li class='page-item active'><a class='page-link' href='projects.php?page={$i}'>$i</a></li>";
            }else{
                echo "<li class='page-item'><a class='page-link' href='projects.php?page={$i}'>$i</a></li>";
            }
          }
        }
        ?>
      </ul>
    </nav>
  </div>
  <!-- /.card-footer -->
  </div>
  <!-- /.card -->

</section>
<!-- /.content -->