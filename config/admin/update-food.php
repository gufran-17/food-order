<?php include ('partials/menu.php'); ?>

<?php
  if(isset($_GET['id']))
  {
    $id = $_GET['id'];

    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

    $res2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_assoc($res2);

    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
  }
  else
  {
     //redirect
     header('location:'.SITEURL.'admin/manage-food.php');
  }
?>

<div class="main-content">
<div class="wrapper">
    <h1>Update Food</h1>
    <br><br>

    <form action="" method="POST" enctype="multipart/form-data">
    <table class = "tbl-30"> 

    <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" value = "<?php echo $title; ?>">
            </td>
         </tr>

         <tr>
            <td>Description: </td>
            <td>
                <textarea name="description" cols = "30" rows = "5"><?php echo $description; ?></textarea>
            </td>
        </tr>

        <tr>
                <td>price: </td>
                <td>
                <input type="number" name ="price" value="<?php echo $price; ?>">
                </td>
        </tr>

        <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                    if($current_image == "")
                    {
                       echo "<div class='error'>Image not Available.</div>";
                    }
                    else
                    {
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                        <?php
                    }
                    ?>
                </td>
        </tr>

        <tr>
                <td>Select New Image: </td>
                <td>
                <input type="file" name ="image">
                </td>
            </tr>

        <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                    <?php
                
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                if($count>0)
                      {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the details of categories
                            $category_title = $row['title'];
                            $category_id = $row['id'];       
                            
                           // echo "<option value='$category_id'>$category_title</option>";
                             ?>   

                             <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                     
                             <?php                    
                          }
                        }
                     else
                        {
                          //we do not have category
                        
                        echo  "<option value='0'>No Categories Found.</option>";
                       
                        }  
                      
                ?>

                    </select>
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
                <input  <?php if($active=="Yes"){echo "checked";}?> type="radio" name ="active" value ="Yes"> Yes

                <input  <?php if($active=="No"){echo "checked";}?> type="radio" name ="active" value ="No"> No
            </td>
        </tr>

        <tr>
            <td> 
                <input type="hidden" name ="id" value="<?php echo $id; ?>">
                <input type="hidden" name ="current_image" value="<?php echo $current_image; ?>">
                
                <input type="submit" name="submit" value="Update Food" class="btn-secondary">
            </td>
        </tr>


    </table>
        </form>

        <?php
           if(isset($_POST['submit']))
           {
           // echo "button clicked";
           
           //get all details from the form
           
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $current_category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];
  

           //upload img if selected

           //check weither upload button clicked or not
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
                        $image_name = "Food-Name-".rand(0000, 9999).'.'.$ext;
        
        
                        $src_path = $_FILES['image']['tmp_name'];
        
                        $dest_path = "../images/food/".$image_name;
                        
                        // uoload image
                        $upload = move_uploaded_file($src_path, $dest_path);
        
                        //check image uploaded or not
                        //if not then we will stop the process and redirect with error msg
                        
                        if($upload==false)
                        {
                            //set msg
                            $_SESSION['upload'] = "<div class='error'> Failed to upload new Image.</div>";
                            //redirect
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //stop the process
                            die();
                        }

                             //remove image if currrent img already exist

                        if($current_image != "")
                        {
                            $remove_path = "../images/food/".$current_image;
            
                            $remove = unlink($remove_path);
            
                            //check weither the image is removed or not
                            //if failed then display msg and stop the process
                            if($remove==false)
                            {
                                //failed to remove image
                                $_SESSION['remove-failed'] = "<div class = 'error'>Failed to remove current Image.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
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
                $sql3 = "UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id=$id
                ";

                //execute the query
                $res3 = mysqli_query($conn, $sql3);

                //redirect to manage category with msg
                //check weither executed or not
                if($res3==TRUE)
                {
                    //category updated]
                    $_SESSION['update'] = "<div class ='sucess'>Food Updated Sucessfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class ='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

           //update

           //redirect
           }
        ?>

    </div>
</div>

<?php include ('partials/footer.php'); ?>