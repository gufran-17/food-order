<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>

        <form acion="" method="POST">

        <table class="tbl-30">

             <tr>
             <td>Current Password: </td>
             <td>
                <input type="password" name="current_password" placeholder="Old Password">
             </td>
             </tr> 

             <tr>
             <td>New Password: </td>
             <td>
                <input type="password" name="new_password" placeholder="New Password">
             </td>
             </tr>

             <tr>
             <td>Confirm Password:</td>
             <td>
                <input type="password" name="confirm_password" placeholder="Confirm Password">

             </td>
             </tr>

             <tr>
                <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                </td>
                </td>
             </tr>      
        </table>

        </form>


    </div>
</div>

<?php
//check weither submit button is clicked or not
if(isset($_POST['submit']))
{
   // echo "clicked";

   //get data from form
    $id=$_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);
   //check weither user with current id and password exist or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    //execue the query 
    $res = mysqli_query($conn, $sql);

    if($res==TRUE)
    {
        //check weither data is available or not
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //user exists and password can be changed
            //echo "User found";
            //check weither the new and confirm pass match
            if($new_password==$confirm_password)
            {
                //update the password
                $sql2 = "UPDATE tbl_admin SET
                password = '$new_password'
                WHERE id=$id
                ";

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check weither it is executed or not
                if($res2==TRUE)
                {
                    //display sucess msg
                    $_SESSION['change-pwd'] = "<div class='sucess'>Password changed successfully.</div>";
                    //redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                else
                {
                    //display error msg
                    $_SESSION['pwd-not-match'] = "<div class='error'>Failed to change password.</div>";
                    //redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                //redirect to manage admin page with error msg

                $_SESSION['pwd-not-match'] = "<div class='error'>User not found.</div>";
                //redirect the user
            header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {
            //user does no exist set msg and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User not found.</div>";

            //redirect the user
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
   //check weither the password and confirm password match or not

   //change password if all above is true
}


?>


<?php include('partials/footer.php'); ?>