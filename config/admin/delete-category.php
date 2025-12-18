<?php

    //include config file
    include('../config/constants.php');
    //echo "Delete Page";
    //check weither the id and miage value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //delete
        //echo "Get value and delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove physical image file if available
        if($image_name != "")
        {
            $path = "../images/category/".$image_name;

            //remove image
            $remove = unlink($path);

            //remove
            if($remove==FALSE)
            {
                //set session msg
                $_SESSION['remove'] = "<div class ='error'> Failed to remove Category Image.</div>";

                //redirect
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            } 
        }

        //delete data from database
        
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //sql query to delete database
        $res = mysqli_query($conn, $sql);

        //check weither data is deleted or not
        if($res==TRUE)
        {
            $_SESSION['delete'] = "<div class = 'sucess'>Category deleted sucessfully.</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else
        {
            $_SESSION['delete'] = "<div class = 'error'>Failed to Delete category.</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        //redirect to manage category page with msg
    }
    else
    {
        //redirect
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>