<?php

//include constrants.php file here

include ('../config/constants.php');

//get the id of admin to be deleted

$id = $_GET['id'];

//create sql query to delete admin

$sql = "DELETE FROM tbl_admin WHERE id=$id";

//execute the query

$res = mysqli_query($conn, $sql);

//check weither the query executed successfully or not
if($res==true)
{
    //query executed sucessfully and admin deleted
    //echo"admin deleted"
    //create session variable to display message
    $_SESSION['delete'] = "<div class='sucess'>Admin deleted successfully.</div>";
    //redirect to manage admin
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    //failed to delete admin
    //echo "failed to delete Admin";

    $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try again later.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
}

//redirect to manage admin page with message(sucess/errpr)