<?php

include('../config/constants.php');
 //echo "Delete Food Page";
 if(isset($_GET['id']) && isset($_GET['image_name']))
 {
    //process to delete
    //echo "process to delete";

    //get id
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //remove img if available

    //check weither img available ,delete only if available
    if($image_name != "")
    {
        //it has image and remove from folder

        //get the img path
        $path = "../images/food/".$image_name; 

        //remove img file from folder
        $remove = unlink($path);

        if($remove==FALSE)
            {
                //set session msg
                $_SESSION['upload'] = "<div class ='error'> Failed to remove Food Image.</div>";

                //redirect
                header('location:'.SITEURL.'admin/manage-food.php');
                //stop the process
                die();
            } 
    }

    //delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //execute
    $res = mysqli_query($conn, $sql);
    //check weither query executed or not
     //redirect
    if($res==TRUE)
        {
            $_SESSION['delete'] = "<div class = 'sucess'>Food deleted sucessfully.</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-food.php');

        }
        else
        {
            $_SESSION['delete'] = "<div class = 'error'>Failed to Delete Food.</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-food.php');

        }
   
 }
 else
 {
    //redirect 
    //echo "Redirect";
    $_SESSION['delete'] = "<div class = 'error'>Unauthorized Acess.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
 }
?>