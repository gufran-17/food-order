<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add'])) // checking syst session set or not
            {
                echo $_SESSION['add']; //display session msg
                unset ($_SESSION['add']); // remove session msg
            }
        ?>

         <form action="" method="POST">

            <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name">
                </td>
             </tr>

             <tr>
                <td>Username:</td>
                 <td>
                    <input type="text" name="username" placeholder="Your Username">
                 </td>
             </tr>

             <tr>
                 <td>Password: </td>
                 <td>
                     <input type="password" name="password" placeholder="Your Password">
                </td>
            </tr>
            
            <tr>
            
                <td colspan="2">
                    <input type="Submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
            </table>
                <br />
        </form>

    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php
    //process value from the form and save it in Database
    //check weither the submit button is clicked or not
     if(isset($_POST['submit']))
     {
         // Button clicked
         //echo"Button clicked";

         //Get data from the form 
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];
         $password = md5($_POST['password']); // password encryption with md5

         //SQL Query to save the database

         $sql = "INSERT INTO tbl_admin SET
         full_name='$full_name',
         username='$username',
         password='$password'
         ";
            //executing query and saving into database
            $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //check weither the data is inserted or not
        if($res==TRUE)
        {
            //data inserted
           // "Data inserted";
           //create a session variable to display message
           $_SESSION['add']="<div class='sucess'>Admin Added successfully.</div>";
           //redirect page Manage Admin
           header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //failed to insert data
           // "Failed to insert data";
           //create a session variable to display message
           $_SESSION['add']="<div class='error'>Failed to add admin.</div>";
           //redirect page Add Admin
           header("location:".SITEURL.'admin/manage-admin.php');
        }
     }
?>