<?php 
ob_start();
session_start(); 

include "db.php";
include "../admin/includes/functions.php";

if(isset($_POST['submit'])) {
  //check captcha
  $captcha = getCaptcha($secret_key, $_POST['g-recaptcha-response']);

  //Captcha passed
  if($captcha->success == true && $captcha->score > 0.5){
    //if(true){
    //$email_to = "razvan.crisan@ctotech.io, crsn_razvan@yahoo.com, sophiapensiune@gmail.com";
    $email_to = "razvan.crisan@ctotech.io, crsn_razvan@yahoo.com";
    $email_subject = "Comentariu nou pe blog!";
     

    //form data 
    $post_id = escape($_POST['post_id']);
    $name = escape($_POST['name']); 
	$email = escape($_POST['email']); 
    $comment = escape($_POST['comment']);

    if(isset($_SESSION["username"]) && $_SESSION["username"] != ""){
        $name = "Admin";
    }
  
    //Own Email==========================================  
    $email_message = "<p><b>Detaliile comantariului: </b></p>";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $query = "SELECT * FROM blog WHERE id='{$post_id}' ORDER BY id DESC LIMIT 1";
    $select_posts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_posts)) {
      $title = (!empty($row['title']) ? $row['title'] : "");
      $link_to = (!empty($row['link_to']) ? $row['link_to'] : "");
    }  

    $email_message .= "<p><b>Comentariu nou pentru articolul:</b> <i>".clean_string($name)."</i></p>";
    $email_message .= "<p><b>Nume:</b> ".clean_string($name)."</p>";
    $email_message .= "<p><b>Email:</b> ".clean_string($email)."</p>";
    $email_message .= "<p><b>Comentariu:</b> ".clean_string($message)."</p>";
         
    // create email headers
    $headers = "From: ".$email."\r\n";
    $headers .= "Reply-To: ".$email."\r\n";
    $headers .= "Content-type: text/html\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();  

    mail($email_to, $email_subject, $email_message, $headers);  

    //DB contact=======================================================

    $query = "INSERT INTO  blog_comments (post_id, name, email, comment) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($connection);
  
    if(!mysqli_stmt_prepare($stmt, $query)){
      header("Location: ../post.php?article=$link_to&error=unknown");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt, "ssss", $post_id, $name, $email, $comment);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      header("Location: ../post.php?article=$link_to");
    exit();
    }
  }else{
    //Captcha failed
    header("Location: ../post.php?article=$link_to&error=captcha_failed");
    exit();
  }
  mysqli_close($connection);  
}
ob_end_clean();
?>