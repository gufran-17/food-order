<?php include('partials/menu.php'); ?>

        <!-- Main conten section starts-->
<div class="main-content">
<div  class="wrapper">
   <h1>Dashboard</h1>
<br><br>
         <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
            <br><br>
   <div class="col-4 text-center">

        <?php
        $sql = "SELECT * FROM tbl_category";
            //execute
            $res = mysqli_query($conn, $sql);
            //count rows
            $count = mysqli_num_rows($res);


        ?>
    <h1><?php echo $count; ?></h1>
    <br>
    Categories
   </div>
   <div class="col-4 text-center">

   <?php
        $sql2 = "SELECT * FROM tbl_category";
            //execute
            $res2 = mysqli_query($conn, $sql2);
            //count rows
            $count2 = mysqli_num_rows($res2);


        ?>
        
    <h1><?php echo $count2; ?></h1>
    <br>
    foods
   </div>
   <div class="col-4 text-center">

        <?php
                $sql3 = "SELECT * FROM tbl_category";
                //execute
                $res3 = mysqli_query($conn, $sql3);
                //count rows
                $count3 = mysqli_num_rows($res3);


                ?>

    <h1><?php echo $count3; ?></h1>
    <br>
    Total orders
   </div>
   <div class="col-4 text-center">

   <?php
                $sql4 = "SELECT SUM(total) As Total FROM tbl_order WHERE status ='Delivered'";
                //execute
                $res4 = mysqli_query($conn, $sql4);
                //count rows
                $row4 = mysqli_fetch_assoc($res4);

                $total_revenue =$row4['Total'];


                ?>

    <h1>₹.<?php echo $total_revenue; ?></h1>
    <br>
    Revenue generated
   </div>
<div class="clearfix"></div>
</div>
</div>

        <!-- Main content section ends-->

<?php include("partials/footer.php"); ?>