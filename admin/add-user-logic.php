
<?php
session_start();

define('ROOT_URL', 'http://localhost/forum_web/');
$connect = mysqli_connect('localhost', 'root', 'secret', 'signin');




if(isset($_POST['submit'])){
  $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $is_admin = filter_var($_POST['select'], FILTER_SANITIZE_NUMBER_INT) ;
  $avatar = $_FILES['avatar'];
if(!$username){
    $_SESSION['add_user'] = "Please enter your username!";
}
elseif(!$email){
    $_SESSION['add_user'] = "Please enter a valid email!";
}
elseif(strlen($password) < 8 || strlen($cpassword) < 8){
    $_SESSION['add_user'] = "Password should be 8+ characters!";
}
elseif(!$avatar['name']){
    $_SESSION['add_user'] = "Please add avatar!";
}
else{
   if($password !== $cpassword){
    $_SESSION['add_user'] = "Passwords do not match!";
   }
   else{
     $user_check_query = "SELECT * FROM userpage where username = '$username' OR email = '$email' ";
     $user_check_result = mysqli_query($connect, $user_check_query);
     if(mysqli_num_rows($user_check_result) > 0){
        $_SESSION['add_user'] = "Username already exists!";
     }
     else{
        $time = time();
        $avatar_name = $time. $avatar['name'];
        $avatar_tmp_name = $avatar['tmp_name'];
        $destination_path = '../images/'. $avatar_name;

        $allowed_files = ['png', 'jpg', 'jpeg'];

        $extension = explode('.', $avatar_name);

        $extension = end($extension);
        if(in_array($extension, $allowed_files)){
            // make sure image not too large
            if($avatar['size'] < 1000000){
               move_uploaded_file($avatar_tmp_name, $destination_path);
            }
            else{
                $_SESSION['add_user'] = 'File size too big , should be less than 1mb';
            }
        }
            else{
                $_SESSION['add_user'] = 'File should be png, jpg or jpeg';
        }
     }
   }
}

//'. ROOT_URL.'

// redirect to sign up if probem
if($_SESSION['add_user']){
    $_SESSION['add_user-data'] = $_POST;
    header('location: add_user.php'); 
    die();
}
else{
    // insert new users into table

   $inset_new_user = "INSERT INTO userpage( username , email, password, file, forum_notify) VALUES('$username', '$email', '$password', '$avatar_name', '$is_admin' )" ;
   $query_new_user = mysqli_query($connect, $inset_new_user);

   if(!mysqli_errno($connect)){
    $_SESSION['add_user-success'] = 'Registration sucessful . Please login in';
    header('location:  '. ROOT_URL. 'manage_users.php'); 
    die();
   }
}
}
else{
    header('location:  add_user.php'); 
}
?>