
<?php
session_start();

include ('config/database.php');




if(isset($_POST['submit'])){
  $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $avatar = $_FILES['avatar'];
if(!$username){
    $_SESSION['signup'] = "Please enter your username!";
}
elseif(!$email){
    $_SESSION['signup'] = "Please enter a valid email!";
}
elseif(strlen($password) < 8 || strlen($cpassword) < 8){
    $_SESSION['signup'] = "Password should be 8+ characters!";
}
elseif(!$avatar['name']){
    $_SESSION['signup'] = "Please add avatar!";
}
else{
   if($password !== $cpassword){
    $_SESSION['signup'] = "Passwords do not match!";
   }
   else{
     $user_check_query = "SELECT * FROM userpage where username = '$username' OR email = '$email' ";
     $user_check_result = mysqli_query($connect, $user_check_query);
     if(mysqli_num_rows($user_check_result)){
        $_SESSION['signup'] = "Username already exists!";
     }
     else{
        $time = time();
        $avatar_name = $time. $avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $destination_path = 'images/'. $avatar_name;

        $allowed_files = ['png', 'jpg', 'jpeg'];

        $extension = explode('.', $avatar_name);

        $extension = end($extension);
        if(in_array($extension, $allowed_files)){
            // make sure image not too large
            if($avatar['size'] < 1000000){
               move_uploaded_file($avatar_tmp_name, $destination_path);
            }
            else{
                $_SESSION['signup'] = 'File size too big , should be less than 1mb';
            }
        }
            else{
                $_SESSION['signup'] = 'File should be png, jpg or jpeg';
        }
     }
   }
}

//'. ROOT_URL.'

// redirect to sign up if probem
if($_SESSION['signup']){
    $_SESSION['signup-data'] = $_POST;
    header('location: signup.php'); 
    die();
}
else{
    // insert new users into table

   $inset_new_user = "INSERT INTO userpage( username , email, password, file, forum_notify) VALUES('$username', '$email', '$password', '$avatar_name', 0 )" ;
   $query_new_user = mysqli_query($connect, $inset_new_user);

   if(!mysqli_errno($connect)){
    $_SESSION['signup-success'] = 'Registration sucessful . Please login in';
    header('location:  signin.php'); 
    die();
   }
}
}
else{
    header('location:  signup.php'); 
}
?>