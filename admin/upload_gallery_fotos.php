<?php include "../PHP/db.php" ?>
<?php include "includes/functions.php" ?>

<?php

//Upload Image
  $target_folder = '../images/photo_gallery/';

  if(!empty($_FILES)){
    $file = $_FILES['file'];
    $image = uploadFile($file, $target_folder);
    echo $image;
    addGalleryImagesToDB($image);
  }


//Delete image
if(isset($_POST['id'])){
  $image_id = escape($_POST['id']);
  $root_folder = '../images/photo_gallery/';

  //delete file
  deleteFileFromRow("photo_gallery", "image_name", $image_id, $root_folder);
  //remove from db
  deleteItem('photo_gallery', $image_id);
}

//Display uploaded images
$root_folder = '../images/photo_gallery/';

$output = '<div class="uploaded-images-container">';

  $fotos_query = "SELECT * FROM  photo_gallery ORDER BY id DESC";
  $fotos_result = mysqli_query($connection, $fotos_query);
  while($row = mysqli_fetch_assoc($fotos_result)){
    $image_id = (!empty($row['id']) ? $row['id'] : ""); 
    $image = (!empty($row['image_name']) ? $row['image_name'] : ""); 
    $output .= '<div class="uploaded-image-container">
                  <img src="'.$root_folder.$image.'" class="img-thumbnail"/>
                  <button type="button" class="btn btn-danger btn-sm remove_image" id="'.$image_id.'"> 
                    <i class="fas fa-trash-alt mr-2"></i> Delete
                  </button>
                </div>';
  }
  
$output .= '</div>';
echo $output;

?>