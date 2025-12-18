
<?php
//authorization - access control

//check weither user is logged in or not
if(!isset($_SESSION['user']))
{
    $_SESSION['no-login-message'] = "<div class= 'error text-center'>Please login to access login panel.</div>";
    //redirect
    header('location:'.SITEURL.'admin/login.php');
}
?>
