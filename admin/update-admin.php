<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        //get id of selected admin
        $id=$_GET['id'];

        //create sql query to get details
        $sql="SELECT * FROM tbl_admin WHERE id=$id";

        //execute the query
        $res=mysqli_query($conn, $sql);

        //check weither query is executed or not
        if($res==TRUE)
        {
            //check weither data is available or not
            $count = mysqli_num_rows($res);
            //check weither we have admin data or not
            if($count==1)
            {
                //get the details
                //echo"Admin Available"
                $row = mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];

                $username = $row['username'];
            }
            else
            {
                //redirect to manage
                header('location'.SITEURL.'admin/manage-admin.php');
            }
        }
        ?>

        <form acion="" method="POST">

        <table class="tbl-30">
             <tr>
             <td>Full name: </td>
             <td>
                <input type="text" name="full_name" value="<?php echo $full_name; ?>">
             </td>
             </tr> 

             <tr>
             <td>Username: </td>
             <td>
                <input type="text" name="username" value="<?php echo $username; ?>">
             </tr>

            <tr>
                <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Admin" class="btn-secondary ">
                </td>
            </tr>

        </table>

        </form>

    </div>
</div>

<?php
    //check weither submit is clicked or not
    if(isset($_POST['submit']))
    {
           // echo"button clicked";
           //get all the values from form to update
           $id = $_POST['id'];
           $full_name = $_POST['full_name'];
           $username = $_POST['username'];

           // create sql query
           $sql = "UPDATE tbl_admin SET
           full_name = '$full_name',
           username = '$username'
           WHERE id='$id'
           ";
           //execute the query
           $res = mysqli_query($conn, $sql);
           //check weither query executed successfully
           if($res==TRUE)
           {
            //query executed and admin updated
            $_SESSION['update'] = "<div class='sucess'>Admin updated successfully.</div>";
            //redirect to manage admin
            header('location:'.SITEURL.'admin/manage-admin.php');
           }
           else
           {
            $_SESSION['update'] = "<div class='error'>Failed to update Admin.</div>";
            //redirect to manage admin
            header('location:'.SITEURL.'admin/manage-admin.php');
           }
    }




?>


<?php include('partials/footer.php'); ?>