<?php 
function escape($string) {
  global $connection;
  return mysqli_real_escape_string($connection, trim($string));
}

function ifExists($item){
  global $connection;
  return $item != "" && $item != " " && $item != "  " && $item != "undefined" && $item != null ;
}

//strip special characters & replace space with "-"
function stripSpecialChars($string){
  global $connection;
  return strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $string));
}

//check if item exists in DB
function isNameTaken ($tblName, $db_name, $name){
  global $connection;

  $query = "SELECT * FROM {$tblName} WHERE {$db_name} = '{$name}'";
  $result = mysqli_query($connection, $query);
  $count = mysqli_num_rows($result);
  $isNameTaken = $count > 0;
  return $isNameTaken;
}

function userExists($username, $email) {
  global $connection;

  $query = "SELECT * FROM users WHERE username = ? OR email = ?";
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt, $query)){
    header("Location: users.php?source=add_user");
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
      return $row;
    }else{
      $result = false;
      return $result;
    }
    mysqli_stmt_close($stmt);
  }
}

function createUser($firstname, $lastname, $username, $email, $phone, $user_image, $user_password) {
  global $connection;

  $query = "INSERT INTO users (firstname, lastname, username, email, phone, user_image, user_password) VALUES (?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt, $query)){
    header("Location: users.php?source=add_user");
    exit();
  }else{
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $username, $email, $phone, $user_image, $hashed_password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);  
  }
}

function loginUser($username, $password){
  global $connection;

  $userExists = userExists($username, $username);

  if($userExists === false) {
    echo "Error";
    header("Location: ../index.php");
    exit();
  }

  $hashed_password = $userExists["user_password"];
  $check_passwords = password_verify($password, $hashed_password);

  if($check_passwords === false) {
    echo "Error";
    header("Location: ../index.php");
    exit();
  }else if($check_passwords === true){
    header("Location: ../admin.php");
    echo "Logged in";
    
    $_SESSION["userId"] = $userExists["id"];
    $_SESSION["username"] = $userExists["username"];
    $_SESSION["user_image"] = $userExists["user_image"];

  
    exit();
  }
}

function getYTVideoId($videoLink){
  global $connection;

  $ytarray=explode("/", $videoLink);
  $ytendstring=end($ytarray);
  $ytendarray=explode("?v=", $ytendstring);
  $ytendstring=end($ytendarray);
  $ytendarray=explode("&", $ytendstring);
  $ytcode=$ytendarray[0];

  return $ytcode;
}

function getCaptcha($secret_key, $g_response){
  $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$g_response");
  $return = json_decode($response);
  return $return;
}

function resize_image($file, $w, $h, $crop=FALSE) {
  //resize_image(‘/path/to/some/image.jpg’, 200, 200);
  global $connection;

  list($width, $height) = getimagesize($file);
  $r = $width / $height;
  if ($crop) {
      if ($width > $height) {
          $width = ceil($width-($width*abs($r-$w/$h)));
      } else {
          $height = ceil($height-($height*abs($r-$w/$h)));
      }
      $newwidth = $w;
      $newheight = $h;
  } else {
      if ($w/$h > $r) {
          $newwidth = $h*$r;
          $newheight = $h;
      } else {
          $newheight = $w/$r;
          $newwidth = $w;
      }
  }
  $src = imagecreatefromjpeg($file);
  $dst = imagecreatetruecolor($newwidth, $newheight);
  imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

  return $dst;
}

function uploadImage($inputName, $path, $dbClmnName, $inputIndex="no_index"){
  // Call example: uploadImage('image', '../img/', 'post_image');
  //$inputIndex is required for multiple image upload (array)
  global $connection;

  $inputIndexExists = ($inputIndex != "no_index" || $inputIndex === 0);

  $fileError = $inputIndexExists ? $_FILES[$inputName]['error'][$inputIndex] : $_FILES[$inputName]['error'];

  //check if input is empty
  if($fileError != 0) {
    $GLOBALS[$dbClmnName] = "";
    return;
  } 

  $fileName = $inputIndexExists ? $_FILES[$inputName]['name'][$inputIndex] : $_FILES[$inputName]['name'];
  $fileTmpName = $inputIndexExists ? $_FILES[$inputName]['tmp_name'][$inputIndex] : $_FILES[$inputName]['tmp_name'];
  $fileSize = $inputIndexExists ? $_FILES[$inputName]['size'][$inputIndex] : $_FILES[$inputName]['size'];
  $fileType = $inputIndexExists ? $_FILES[$inputName]['type'][$inputIndex] : $_FILES[$inputName]['type'];
  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  $allowed = array('jpeg', 'jpg', 'png');

  if($fileName){
      if(in_array($fileActualExt, $allowed)){
          if($fileError == 0){
              if($fileSize < 5000000){
                  $fileNameNew = uniqid().rand().".".$fileActualExt;
                  $fileDestination = $path.$fileNameNew;
                  move_uploaded_file($fileTmpName, $fileDestination);
                  $GLOBALS[$dbClmnName] = $fileNameNew;
              }else{
                  echo "Your file is too big! ".$fileSize;
              }

          }else{
              echo "There was an error uploading your file";
          }
      }else{
          echo "You cannot upload files of this type";
      }

  }
}


function deleteBulk($tableName){
  // Delete selected rows from the db (mostly useful for rows without files)
  global $connection;
  if(isset($_POST['checkBoxArray'])){
    if(isset($_SESSION['username'])){
        foreach($_POST['checkBoxArray'] as $delete_id){
            $query = "DELETE FROM {$tableName} WHERE id = {$delete_id}";
            $delete_query = mysqli_query($connection, $query);
        }
    }
  }
}

function uploadFile($input, $path){
  $fileName = $input['name'];
  $fileTmpName = $input['tmp_name'];
  $fileSize = $input['size'];
  $fileType = $input['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));
  $allowed = array('jpeg', 'jpg', 'png');

  if($fileName){
    if(in_array($fileActualExt, $allowed)){
      if($fileSize < 5000000){
        $fileNameNew = uniqid().rand().".".$fileActualExt;
        $fileDestination = $path.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        return $fileNameNew;
      }else{
        die ("Your file is too big! ".$fileSize);
      }
    }else{
      die ("You cannot upload files of this type");
    }
  }
  //return name if no image is selected
  return "";
}

function deleteFile($btnName, $tblName, $clmnName, $idName, $selectedId){
  // Delete a file where you need to provide an id
  global $connection;
  if(isset($_POST[$btnName])){    
    if (array_key_exists($btnName, $_POST)) {
         //delete from db
        $query = "UPDATE {$tblName} SET ";
        $query .= "{$clmnName} = '' ";
        $query .= "WHERE {$idName} = {$selectedId}";
        $update_post = mysqli_query($connection, $query);

        if(!$update_post) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
        //delete actual file
        $filename = $_POST[$btnName];
        if (file_exists($filename)) {
            unlink($filename);
        } else {
            echo 'Could not delete '.$filename.', file does not exist';
        }
    }
  }
}

function deleteItem($tableName, $delete_id){
  //Delete an already selected row frm the db
  global $connection;
  $query = "DELETE FROM {$tableName} WHERE id = {$delete_id}";
  $delete_query = mysqli_query($connection, $query);
}

function deleteItemDiffID($tableName, $id, $delete_id){
  //Use this when the id name is different ex: package_id
  //Delete an already selected row from the db
  global $connection;
  if(isset($_SESSION['username'])){
    $query = "DELETE FROM {$tableName} WHERE {$id} = {$delete_id}";
    $delete_query = mysqli_query($connection, $query);
  }
}

function deleteFileFromRow($tblName, $clmnName, $selectedId, $path){
  //When you delete an entire row from the db, CALL THIS TO ALSO REMOVE THE FILE
   // Call example: deleteFileFromRow("news", "post_image", $the_post_id, "../img/");
  global $connection;
  //delete actual file
  $query = "SELECT * FROM {$tblName} WHERE id = '{$selectedId}'";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
      $fileName = $row[$clmnName]; 
      if(ifExists($fileName)){
        if (file_exists($path.$fileName)) {
              unlink($path.$fileName);
        }else {
          echo 'Could not delete '.$filename.', file does not exist';
        }
      }    
  }

  //delete from db
  $query = "UPDATE {$tblName} SET ";
  $query .= "{$clmnName} = '' ";
  $query .= "WHERE id = {$selectedId}";
  $update_post = mysqli_query($connection, $query);

  if(!$update_post) {
      die("QUERY FAILED" . mysqli_error($connection));
  }
}

function deleteFileFromRowDiffID($tblName, $id, $clmnName, $selectedId, $path){
  //Use this when the id name is different ex: package_id
  //When you delete an entire row from the db, CALL THIS TO ALSO REMOVE THE FILE
   // Call example: deleteFileFromRow("news", "post_image", $the_post_id, "../img/");
  global $connection;

  //delete actual file
  $query = "SELECT * FROM {$tblName} WHERE {$id} = {$selectedId}";
  $result = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($result)) {
      $fileName = $row[$clmnName]; 
      if(ifExists($fileName)){
        if (file_exists($path.$fileName)) {
              unlink($path.$fileName);
        }
      }    
  }

  //delete from db
  $query = "UPDATE {$tblName} SET ";
  $query .= "{$clmnName} = '' ";
  $query .= "WHERE {$id} = {$selectedId}";
  $update_post = mysqli_query($connection, $query);

  if(!$update_post) {
      die("QUERY FAILED" . mysqli_error($connection));
  }
}

function updateDbImage($tblName, $clmnName, $imageName, $id) {
  global $connection;

  $query = "UPDATE {$tblName} SET {$clmnName} = ? WHERE id = {$id}";
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt, $query)){
    header("Location: admin.php");
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "s", $imageName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);  
  }
}

// delete folder and files in it
function deleteFolder($dir) {
  global $connection;
  if(!empty($dir)){
    $files = array_diff(scandir($dir), array('.','..'));
    foreach ($files as $file) {
      (is_dir("$dir/$file")) ? deleteFolder("$dir/$file") : unlink("$dir/$file");
    }
    return rmdir($dir);
  }else{
    echo "Selected folder does not exist!";
  }
}

function addBlogImagesToDB($post_id, $folder_name, $imageName){
  global $connection;

  $query = "INSERT INTO blog_fotos (post_id, folder_name, image) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt, $query)){
    header("Location: blog.php?source=blog_fotos");
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "sss", $post_id, $folder_name, $imageName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);  
  }
}

function  createPost($title, $date, $posted_by, $description, $status) {
  global $connection;

  $query = "INSERT INTO blog (title, date, posted_by, link_to, description, status) VALUES (?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt, $query)){
    header("Location: blog.php?source=add_post");
    exit();
  }else{
    $link_to = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $title));
    mysqli_stmt_bind_param($stmt, "ssssss", $title, $date, $posted_by, $link_to, $description, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt); 
    //get the post id 
    $last_id =  mysqli_insert_id($connection);
    return $last_id;
  }
}

function editPost($title, $date, $description, $id) {
  global $connection;

  $query = "UPDATE blog SET title = ?, date = ?, link_to = ?, description = ? WHERE id = '{$id}'";
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt, $query)){
    header("Location: blog.php?source=edit_post&id={$id}");
    exit();
  }else{
    $link_to = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $title));
    mysqli_stmt_bind_param($stmt, "ssss", $title, $date, $link_to, $description);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);  
  }
}

function addGalleryImagesToDB($imageName){
  global $connection;

  $query = "INSERT INTO photo_gallery (image_name) VALUES (?);";
  $stmt = mysqli_stmt_init($connection);

  if(!mysqli_stmt_prepare($stmt, $query)){
    header("Location: gallery.php?error=unknown");
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "s", $imageName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);  
  }
}

?>
