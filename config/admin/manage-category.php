<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Category</h1>

        <br><br><br><br>

        <?php 
         if(isset($_SESSION['add'])) // checking syst session set or not
         {
             echo $_SESSION['add']; //display session msg
             unset ($_SESSION['add']); // remove session msg
         }

         if(isset($_SESSION['remove'])) // checking syst session set or not
         {
             echo $_SESSION['remove']; //display session msg
             unset ($_SESSION['remove']); // remove session msg
         }

         if(isset($_SESSION['delete'])) // checking syst session set or not
         {
             echo $_SESSION['delete']; //display session msg
             unset ($_SESSION['delete']); // remove session msg
         }

         if(isset($_SESSION['no-category-found'])) // checking syst session set or not
         {
             echo $_SESSION['no-category-found']; //display session msg
             unset ($_SESSION['no-category-found']); // remove session msg
         }

         if(isset($_SESSION['update'])) // checking syst session set or not
         {
             echo $_SESSION['update']; //display session msg
             unset ($_SESSION['update']); // remove session msg
         }

         if(isset($_SESSION['upload'])) // checking syst session set or not
         {
             echo $_SESSION['upload']; //display session msg
             unset ($_SESSION['upload']); // remove session msg
         }

         if(isset($_SESSION['failed-remove'])) // checking syst session set or not
         {
             echo $_SESSION['failed-remove']; //display session msg
             unset ($_SESSION['failed-remove']); // remove session msg
         }
        ?>

        <br>
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

        <br /><br /><br />

        <table class="tbl-full text-center">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                $sql = "SELECT * FROM tbl_category";
                
                //execute the query
                $res = mysqli_query($conn, $sql); 
             // count rows
                $count = mysqli_num_rows($res);
                //check weither we have data in database

                $sn=1;
                if($count>0)
                {
                    //we have data in database 
                    //get data and display data
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                         <tr>
                <td><?php echo $sn++ ; ?>.</td>
                <td><?php echo $title; ?></td>
                        <td>    
                                <?php 
                                    //check weither img naem is available or not
                                    if($image_name!="")
                                    {
                                        //display the img
                                        ?>

                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >

                                        <?php
                                    }
                                    else
                                    {
                                        //display the msg
                                        echo "<div class = 'error'>Image not added.</div>";
                                    }
                
                                ?>
                        </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td></td>
                <td></td>
                <td>
                      <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                      <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                </td>
            </tr>

                        <?php
                    }
                }
                else
                {
                    //we dont have data in database
                    //display msg inside table
                    ?>
                    <tr>
                        <td colspan= "6"><div class = 'error'>No Category Added.</div></td>
                    </tr>
                    <?php
                }
            ?>

           
        </table>

</div>
</div>
<!--Main content section ends-->

<?php include('partials/footer.php'); ?>
