<?php include "../includes/db.php" ?>
<?php include "includes/functions.php" ?>

<?php

//Upload Image
if(isset($_POST['post_id']) && $_POST['post_id'] > 0){
  $post_id = escape($_POST['post_id']);
  $target_folder = '../assets/img/projects/'.$post_id.'/';
  $folder_name ='projects/'.$post_id;

  if(!empty($_FILES)){
    $file = $_FILES['file'];
    $image = uploadFile($file, $target_folder);
    addProjectImagesToDB($post_id, $folder_name, $image);
  }
}

//Delete image
if(isset($_POST['id'])){
  $post_id = escape($_GET['post_id']);
  $image_id = escape($_POST['id']);
  $root_folder = '../assets/img/projects/'.$post_id.'/';

  //delete file
  deleteFileFromRow("projects_fotos", "image", $image_id, $root_folder);
  //remove from db
  deleteItem('projects_fotos', $image_id);
}

//Display uploaded images
if(isset($_GET['post_id']) && $_GET['post_id'] > 0){

  $post_id = escape($_GET['post_id']);
  $root_folder = '../assets/img/projects/'.$post_id.'/';
  
  $output = '<div class="uploaded-images-container">';

    $fotos_query = "SELECT * FROM  projects_fotos WHERE project_id = {$post_id} ORDER BY id";
    $fotos_result = mysqli_query($connection, $fotos_query);
    while($row = mysqli_fetch_assoc($fotos_result)){
      $image_id = (!empty($row['id']) ? $row['id'] : ""); 
      $image = (!empty($row['image']) ? $row['image'] : ""); 
      $output .= '<div class="uploaded-image-container">
                    <img src="'.$root_folder.$image.'" class="img-thumbnail"/>
                    <button type="button" class="btn btn-danger btn-sm remove_image" id="'.$image_id.'"> 
                      <i class="fas fa-trash-alt mr-2"></i> Delete
                    </button>
                  </div>';
    }
    
  $output .= '</div>';
  echo $output;
}

?>