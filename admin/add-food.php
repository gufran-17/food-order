<?php include('partials/menu.php'); ?>
<div class ="main-content">
    <div class = "wrapper">
        <h1>Add Food</h1>
        
        <br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
           echo $_SESSION['upload']; //displaying session msg
           unset($_SESSION['upload']); //removing session msg
        }
        ?>

        <form action="" method="POST"  enctype="multipart/form-data">
            <table class = "tbl-30">

            <tr>
                <td>Title: </td>
                <td>
                <input type="text" name ="title" placeholder="Title of the Food">
                </td>
            </tr>

            <tr>
            <td>Description: </td>
            <td>
                <textarea name="description" cols = "30" rows = "5" placeholder = "Description of the Food."></textarea>
            </td>
        </tr>

            <tr>
                <td>price: </td>
                <td>
                <input type="number" name ="price">
                </td>
            </tr>

            <tr>
                <td>Select Image: </td>
                <td>
                <input type="file" name ="image">
                </td>
            </tr>

            
            <tr>
                <td>Category: </td>
                <td>
                    <select name="category">

                        <?php 
                            //create a code to display categories from database
                            //create sql query to get data from database
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                            $res = mysqli_query($conn, $sql);

                            //count rows to check weither we have categories or not
                            $count = mysqli_num_rows($res);

                            //if count is greater than zero we have categories else we dont have categories
                            if($count>0)
                            {
                                //we have categories
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                    
                                    <?php
                                }
                            }
                            else
                            {
                                //we do not have category
                                ?>
                                <option value="0">No Categories Found</option>
                                <?php
                            }
                            //display on dropdown
                        ?>

                        <option value="1">Food</option>
                        <option value="2">Snacks</option>
                    </select>
                </td>
            </tr>

            <tr>
            <td>Featured: </td>
            <td>
                <input type="radio" name ="featured" value ="Yes"> Yes

                <input type="radio" name ="featured" value ="No"> No
            </td>
           </tr>

        <tr>
            <td>Active: </td>
            <td>
                <input  type="radio" name ="active" value ="Yes"> Yes

                <input  type="radio" name ="active" value ="No"> No
            </td>
        </tr>

        <tr>
            <td colspan = 2> 
                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
            </td>
        </tr>


            </table>
        </form>

        <?php 
        //check weither the button is clicked or not
        if(isset($_POST['submit']))
        {
            //Add the food in database
           // echo"clicked";

           //get data from form
           $title = $_POST['title'];
           $description = $_POST['description'];
           $price = $_POST['price'];
           $category = $_POST['category'];

           //check weither radio button active checked or not
           if(isset($_POST['featured']))
           {
            $featured = $_POST['featured'];
           }
           else
           {
            $featured = "No";
           }

           if(isset($_POST['active']))
           {
            $active = $_POST['active'];
           }
           else
           {
            $active = "No";
           }

           //upload image if selected

           //check weither select image is clicked or not and upload image
           if(isset($_FILES['image']['name']))
           {
            //get the details
            $image_name = $_FILES['image']['name'];

            //check weither the image is selected or not and upload image only if selected
            if($image_name != "")
            {
                //image is selected
                //rename the img
                $ext = end(explode('.', $image_name));

                //create new name for each image
                $image_name = "Food-Name-".rand(000, 999).".".$ext;

                //upload the img

                //get source path and destination path

                //source path is current location of the image
                $src = $_FILES['image']['tmp_name'];

                //destination save folder
                $dst = "../images/food/".$image_name;

                //upload food image
                $upload = move_uploaded_file($src, $dst);

                //check weither img uploaded or not
                if($upload == false)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                    //redirect to previous
                    header('location:'.SITEURL.'admin/add-food.php');
                    die();
                }
            }

           }
           else
           {
            $image_name = "";
           }

           //insert into database

           //create sql query to save or add food
           $sql2 = "INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                 //redirect with msg to manage food page

                if($res2 == TRUE)
                {
                    //query executed and category added
                    $_SESSION['add'] = "<div class= 'sucess'>Food Added Sucessfully.</div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //failed to add category
                    $_SESSION['add'] = "<div class = 'error'> Failed to Add Food.</div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

        }
        ?>

    </div>
</div>
<?php include('partials/footer.php'); ?>