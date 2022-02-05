<?php include "../PHP/db.php" ?>
<?php include "includes/functions.php" ?>

<?php

//Upload Image
if(isset($_POST['post_id']) && $_POST['post_id'] > 0){
  $post_id = escape($_POST['post_id']);
  $target_folder = '../images/blog/'.$post_id.'/';
  $folder_name ='blog/'.$post_id;

  if(!empty($_FILES)){
    $file = $_FILES['file'];
    $image = uploadFile($file, $target_folder);
    addBlogImagesToDB($post_id, $folder_name, $image);
  }
}

//Delete image
if(isset($_POST['id'])){
  $post_id = escape($_GET['post_id']);
  $image_id = escape($_POST['id']);
  $root_folder = '../images/blog/'.$post_id.'/';

  //delete file
  deleteFileFromRow("blog_fotos", "image", $image_id, $root_folder);
  //remove from db
  deleteItem('blog_fotos', $image_id);
}

//Display uploaded images
if(isset($_GET['post_id']) && $_GET['post_id'] > 0){

  $post_id = escape($_GET['post_id']);
  $root_folder = '../images/blog/'.$post_id.'/';
  
  $output = '<div class="uploaded-images-container">';

    $fotos_query = "SELECT * FROM  blog_fotos WHERE post_id = {$post_id} ORDER BY id DESC";
    $fotos_result = mysqli_query($connection, $fotos_query);
    while($row = mysqli_fetch_assoc($fotos_result)){
      $image_id = (!empty($row['id']) ? $row['id'] : ""); 
      $image = (!empty($row['image']) ? $row['image'] : ""); 
      $output .= '<div class="uploaded-image-container">
                    <img src="'.$root_folder.$image.'" class="img-thumbnail"/>
                    <button type="button" class="btn btn-danger btn-sm remove_blog_image" id="'.$image_id.'"> 
                      <i class="fas fa-trash-alt mr-2"></i> Delete
                    </button>
                  </div>';
    }
    
  $output .= '</div>';
  echo $output;
}

?>