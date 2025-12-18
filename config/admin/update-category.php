<?php include ('partials/menu.php'); ?>

<div class ="main-content">
    <div class = "wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
        //check weither id set or not
        if(isset($_GET['id']))
        {
            //get id and all detail
           // echo "Getting data";
           $id = $_GET['id'];
           //create sql query to get all detail
           $sql = "SELECT * FROM tbl_category WHERE id=$id";

           //execute
            $res = mysqli_query($conn, $sql);
            //count the rows to check weither it is valid or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else
            {
                $_SESSION['no-category-found'] = "<div class = 'error'>Category not found.</div>";
                //redirect
                header('location:'.SITEURL.'admin/update-category.php');
            }

        }
        else
        {
            //redirect
            header('location:'.SITEURL.'admin/manage-category.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class ="tbl-30">

        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name ="title" value ="<?php echo $title; ?>">
            </td>
        </tr>

        <tr>
            <td>Current Image: </td>
            <td>
                <?php 
                if($current_image != "")
                {
                    //display img
                    ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                    <?php
                }
                else
                {
                    //display msg
                    echo "<div class = 'error'>Image not Added.</div>";
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>New Image: </td>
            <td>
                <input type="file" name ="iamge" >
            </td>
        </tr>

        <tr>
            <td>Featured: </td>
            <td>
                <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name ="featured" value ="Yes"> Yes

                <input <?php if($featured=="No"){echo "checked";}?> type="radio" name ="featured" value ="No"> No
            </td>
        </tr>

        <tr>
            <td>Active: </td>
            <td>
                <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name ="active" value ="Yes"> Yes

                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name ="active" value ="No"> No
            </td>
        </tr>

        <tr>
            <td>
                <input type="hidden" name ="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name ="id" value="<?php echo $id; ?>">
                <input type="submit" name ="submit" value ="Update Category" class="btn-secondary">
            </td>
        </tr>

        </table>
   </form>

   <?php 
   if(isset($_POST['submit']))
   {
   // echo "clicked";
   //get al values from our form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    //updating new img
    //check weither img selected or not

    if(isset($_FILES['image']['name']))
    {
        //get the image details
        $image_name = $_FILES['image']['name'];
        //check weither imag is availale or not
        if($image_name != "")
        {
            //image available
            //upload new img
             //Auto rename
                //get extension of img

                $ext = end(explode('.', $image_name));

                //rename image
                $image_name = "Food_Category_".rand(000, 999).'.'.$ext;


                $src_path = $_FILES['image']['tmp_name'];

                $dest_path = "../images/category/".$image_name;
                
                // uoload image
                $upload = move_uploaded_file($src_path, $dest_path);

                //check image uploaded or not
                //if not then we will stop the process and redirect with error msg
                
                if($upload==false)
                {
                    //set msg
                    $_SESSION['upload'] = "<div class='error'> Failed to upload image.</div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-category.php');
                    //stop the process
                    die();
                }

            //remove current img if available
            if($current_image != "")
            {
                $remove_path = "../images/category/".$current_image;

                $remove = unlink($remove_path);

                //check weither the image is removed or not
                //if failed then display msg and stop the process
                if($remove==false)
                {
                    //failed to remove image
                    $_SESSION['failed-remove'] = "<div class = 'error'>Failed to remove current Image.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                    die();
                }
            }
            
        }
        else
        {
            $image_name = $current_image;
        }
    }
    else
    {
        $image_name = $current_image;
    }

    //update dataabse
    $sql2 = "UPDATE tbl_category SET
    title = '$title',
    image_name = '$image_name',
    featured = '$featured',
    active = '$active'
    WHERE id=$id
    ";

    //execute the query
    $res2 = mysqli_query($conn, $sql2);

    //redirect to manage category with msg
    //check weither executed or not
    if($res==TRUE)
    {
        //category updated]
        $_SESSION['update'] = "<div class ='sucess'>Category Updated Sucessfully.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        $_SESSION['update'] = "<div class ='error'>Failed to update Category.</div>";
        header('location:'.SITEURL.'admin/manage-category.php');
    }


   }
   
   ?>

    </div>
</div>

<?php include ('partials/footer.php'); ?>