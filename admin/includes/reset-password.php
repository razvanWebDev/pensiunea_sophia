<?php 
ob_start();
include "../../PHP/db.php";
include "functions.php";


if(isset($_POST['reset-password-submit'])) {
    $selector = escape($_POST['selector']);
    $validator = escape($_POST['validator']);
    $password = escape($_POST['pwd']);
    $passwordRepeat = escape($_POST['pwd_repeat']);

    $currentDate = date("U");

    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = mysqli_stmt_init($connection);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error1";
        exit();
    }else{
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if(!$row = mysqli_fetch_assoc($result)){
            echo "You need to resubmit your reset request";
            exit();
        }else{
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row['pwdResetToken']);

            if($tokenCheck === false){
                echo "You need to resubmit your reset request";
                exit();
            }elseif($tokenCheck === true) {
                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users WHERE email=?";
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "There was an error2";
                    exit();
                }else{
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if(!$row = mysqli_fetch_assoc($result)){
                        echo "There was an error3";
                        exit();
                    }else{
                        $sql = "UPDATE users SET user_password=? WHERE email=?";

                        $stmt = mysqli_stmt_init($connection);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            echo "There was an error4";
                            exit();
                        }else{
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash,  $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            //delete tokens
                            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
                            $stmt = mysqli_stmt_init($connection);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                echo "There was an error5";
                                exit();
                            }else{
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../index.php?newpwd=passwordupdated");
                                exit();
                            }
                        }
                    }
                }
            }
        }
    }
}else{
    header("Location: ../index.php");
    exit();
}
ob_end_clean();
?>
