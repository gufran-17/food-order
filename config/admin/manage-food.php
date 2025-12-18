<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br /><br><br>


            <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>

        <br /><br /><br />

        <?php

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add']; //displaying session msg
            unset($_SESSION['add']); //removing session msg
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete']; //displaying session msg
            unset($_SESSION['delete']); //removing session msg
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload']; //displaying session msg
            unset($_SESSION['upload']); //removing session msg
        }

        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize']; //displaying session msg
            unset($_SESSION['unauthorize']); //removing session msg
        }

        
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update']; //displaying session msg
            unset($_SESSION['update']); //removing session msg
        }

        


        ?>

        <table class="tbl-full text-center">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                //create sql query
                $sql = "SELECT * FROM tbl_food";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                $sn=1;

                if($count>0)
                {
                    //we have data in database 

                    //get food and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                       ?>
                             <tr>
                                <td><?php echo $sn++; ?>.</td>
                                <td><?php echo $title; ?></td>
                                <td><?php echo $price; ?></td>
                                <td>
                                    <?php 
                                    // check weither we have image or not
                                    if($image_name == "")
                                    {
                                        //we do not have the image ,display error msg
                                        echo "<div class = 'error'>Image not Added.</div>";
                                    } 
                                    else
                                    {
                                        //display image
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px" >
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                   <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                   <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                </td>
                            </tr>
                     <?php 

                    }
                }
                else
                {
                    //get data and display data
                    echo "<tr><td colspan = '7' class = 'error'> Food not Added yet. </td></tr>";
                }
            ?>
           
        </table>
</div>
</div>

<?php include('partials/footer.php'); ?>