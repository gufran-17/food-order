<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>

            <br><br>

            <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                 echo    $_SESSION['no-login-message'];
                 unset   ($_SESSION['no-login-message']);
            }
            ?>
            <br><br>

            <form action="" method="POST" class="text-center">
                Username <br><br>
                <input type="text" name="username" placeholder="Enter Username"> <br> <br>

                Password <br><br>
                <input type="password" name="password" placeholder="Enter password"> <br> <br>

                <input type="submit" name="submit" value="Login" class="btn-primary"> <br> <br>
            </form>


            <p class="text-center">Created by - <a href="www.yashpatil.com">Yash Patil</a></p>
        </div>



    </body>
</html>

<?php
 //check weither submit clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //get data from login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //sql for username and password exist
 $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
 //execute query
 $res = mysqli_query($conn, $sql);

 //count rows to check user exist
 $count = mysqli_num_rows($res);
 
 if($count==1)
 {
     //user available and login sucess
     $_SESSION['login'] = "<div class='sucess'>Login Successful.</div>";
     $_SESSION['user'] = $username;
     //redirect to admin page
     header('location:'.SITEURL.'admin/');
 }
 else
 {
     //user not available and login failed
     $_SESSION['login'] = "<div class='error text-center'> username or password did not match.</div>";
     //redirect to admin page
     header('location:'.SITEURL.'admin/login.php');
 }
   
 
}

?>