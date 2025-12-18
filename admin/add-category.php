<?php include ('partials/menu.php'); ?>

<div class="main-content">
<div class="wrapper">
    <h1>Add Category</h1>

    <br><br>

    <?php
     if(isset($_SESSION['add'])) // checking syst session set or not
     {
         echo $_SESSION['add']; //display session msg
         unset ($_SESSION['add']); // remove session msg
     }

     if(isset($_SESSION['upload'])) // checking syst session set or not
     {
         echo $_SESSION['upload']; //display session msg
         unset ($_SESSION['upload']); // remove session msg
     }
    ?>
        <br><br>
    <!--Add category form starts-->
    <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" placeholder="Category Title">
            </td>
         </tr>

         <tr>
            <td>Select image: </td>
            <td>
            <input type="file" name="image">
            </td>
        </tr>

         <tr>
            <td>Featured: </td>
            <td>
                <input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
            </td>
        </tr>

        <tr>
            <td>Active: </td>
            <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </td>
        </tr>
        
        <tr>
            <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </td>
        </tr>

        </table>
    </form>
    <!--Add category form ends-->
    
    <?php
    //check weither submit button clicked or not
    if(isset($_POST['submit']))
    {
      //  echo "clicked";

      //get the value from form
      $title = $_POST['title'];

      //check weither button is selected or not
      if(isset($_POST['featured']))
      {
        // get the value from the form
        $featured = $_POST['featured'];
      }
      else
      {
       $featured = "No";
      }

      if(isset($_POST['active']))
      {
        // get the value from th e form
        $active = $_POST['active'];
      }
      else
      {
       $active = "No";
      }
      //check weither img is selected or not
     // print_r($_FILES['image']);
      
     // die(); //  code breaked here

        if(isset($_FILES['image']['name']))
        {
            //upload image
            //to upload img we need image name source and destination path
            $image_name = $_FILES['image']['name'];

            //upload image only if img is selected
            if($image_name != "")
            {

                //Auto rename
                //get extension of img

                $ext = end(explode('.', $image_name));

                //rename image
                $image_name = "Food_Category_".rand(000, 999).'.'.$ext;


                $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;
                
                // uoload image
                $upload = move_uploaded_file($source_path, $destination_path);

                //check image uploaded or not
                //if not then we will stop the process and redirect with error msg
                
                if($upload==FALSE)
                {
                    //set msg
                    $_SESSION['upload'] = "<div class='error'> Failed to upload image.</div>";
                    //redirect
                    header('location:'.SITEURL.'admin/add-category.php');
                    //stop the process
                    die();
                }
            }
        }
        else
        {
            //dont upload image and set image value as blank
            $image_name="";
        }

      
     // create sql query to insert
      $sql = "INSERT INTO tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";
        //execute the query and save in database
        $res = mysqli_query($conn, $sql);
        //check weither query executed
        if($res==TRUE)
        {
            //query executed and category added
            $_SESSION['add'] = "<div class= 'sucess'>Category Added Sucessfully.</div>";
            //redirect
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //failed to add category
            $_SESSION['add'] = "<div class = 'error'> Failed to Add Category.</div>";
            //redirect
            header('location:'.SITEURL.'admin/add-category.php');
        }
    }
    ?>
</div>
</div>


<?php include ('partials/footer.php'); ?>