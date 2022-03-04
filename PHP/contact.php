<?php 
ob_start();
include "db.php";
include "../admin/includes/functions.php";

if(isset($_POST['submit'])) {
  //check captcha
  $captcha = getCaptcha($secret_key, $_POST['g-recaptcha-response']);

  //Captcha passed
  if($captcha->success == true && $captcha->score > 0.5){
	//if(true){
    //$email_to = "razvan.crisan@ctotech.io, crsn_razvan@yahoo.com, sophiapensiune@gmail.com, szilarddombi@yahoo.com";
    $email_to = "razvan.crisan@ctotech.io, crsn_razvan@yahoo.com";
    $email_subject = "Mesaj nou pe site!";

    //form data 
    $name = escape($_POST['template-contactform-name']); 
	$email = escape($_POST['template-contactform-email']); 
    $phone = escape($_POST['template-contactform-phone']);
    $checkin = escape($_POST['template-contactform-checkin']);
    $persons = escape($_POST['template-contactform-persons']);
    $nights = escape($_POST['template-contactform-nights']);
    $message = escape($_POST['template-contactform-message']);  

    //Own Email==========================================  
    $email_message = "<p><b>Detaliile mesajului: </b></p>";
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "<p><b>Nume:</b> ".clean_string($name)."</p>";
    $email_message .= "<p><b>Email:</b> ".clean_string($email)."</p>";
    $email_message .= "<p><b>Telefon:</b> ".clean_string($phone)."</p>";
    $email_message .= "<p><b>Data checkin:</b> ".clean_string($checkin)."</p>";
    $email_message .= "<p><b>Nr. persoane:</b> ".clean_string($persons)."</p>";
    $email_message .= "<p><b>Nr. nopti:</b> ".clean_string($nights)."</p>";
    $email_message .= "<p><b>Mesaj:</b> ".clean_string($message)."</p>";
         
    // create email headers
    $headers = "From: ".$email."\r\n";
    $headers .= "Reply-To: ".$email."\r\n";
    $headers .= "Content-type: text/html\r\n";
    $headers .= 'X-Mailer: PHP/' . phpversion();  

    mail($email_to, $email_subject, $email_message, $headers);  

    //DB contact=======================================================

    $query = "INSERT INTO contact (name, email, phone, checkin, nights, persons, message) ";
    $query .= "VALUES ('{$name}', '{$email}', '{$phone}', '{$checkin}', '{$nights}', '{$persons}', '{$message}')";

    $result =  mysqli_query($connection, $query);

    if(!$result) {
    die("DB query failed" . mysqli_error());
    }
    header("Location: ../contact.php?send=success");
    exit();

    mysqli_close($connection);
  }else{
    //Captcha failed
    header("Location: ../contact.php?error=captcha_failed");
    exit();
  }
  mysqli_close($connection);  
}
ob_end_clean();
?>