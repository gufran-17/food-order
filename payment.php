<?php include('partials-front/menu.php'); ?>

      

  <?php
             if(isset($_GET['food_id']))
             {
                 $food_id = $_GET['food_id'];
                 //category title
                 $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
         
                 $res = mysqli_query($conn, $sql);
         
                 $count = mysqli_num_rows($res);
         
                 if($count==1)
                 {                
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                 }
                 else
                 {
                    header('location:'.SITEURL);
                 }
             }
             else
             {
                 //rediect
                 header('location:'.SITEURL);
             }
         ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form method="POST">
            <h4>Account</h4>
            <div class="input-group">
                <div class="input-box">
                    <input type="text" placeholder="Full Name" required class="name">
                    <i class="fa fa-user icon"></i>
                </div>
                <div class="input-box">
                    <input type="text" placeholder="Nick Name" required class="name">
                    <i class="fa fa-user icon"></i>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <input type="email" placeholder="Email Adress" required class="name">
                    <i class="fa fa-envelope icon"></i>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <h4> Date of Birth</h4>
                    <input type="text" placeholder="DD" class="dob">
                    <input type="text" placeholder="MM" class="dob">
                    <input type="text" placeholder="YYYY" class="dob">
                </div>
                <div class="input-box">
                    <h4> Gender</h4>
                    <input type="radio" id="b1" name="gendar" checked class="radio">
                    <label for="b1">Male</label>
                    <input type="radio" id="b2" name="gendar" class="radio">
                    <label for="b2">Female</label>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <h4>Payment Details</h4>
                    <input type="radio" name="pay" id="bc1" checked class="radio">
                    <label for="bc1"><span><i class="fa fa-cc-visa"></i> Credit Card</span></label>
                    <input type="radio" name="pay" id="bc2" class="radio">
                    <label for="bc2"><span><i class="fa fa-cc-paypal"></i> Paypal</span></label>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <input type="tel" placeholder="Card Number" required class="name">
                    <i class="fa fa-credit-card icon"></i>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <input type="tel" placeholder="Card CVC" required class="name">
                    <i class="fa fa-user icon"></i>
                </div>
                <div class="input-box">
                    <select>
                        <option>01 jun</option>
                        <option>02 jun</option>
                        <option>03 jun</option>
                    </select>
                    <select>
                        <option>2020</option>
                        <option>2021</option>
                        <option>2022</option>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <div class="input-box">
                    <button type="submit">PAY NOW</button>
                </div>
            </div>
        </form>

            <?php

                if(isset($_POST['submit']))
                {
                    //get all details from the form
                        $food = $_POST['food'];
                        $price = $_POST['price'];
                        $qty = $_POST['qty'];

                        $total = $price * $qty;

                        $order_date = date("Y-m-d H:i:sa");

                        $status = "Ordered";
                        $customer_name = $_POST['full-name'];
                        $customer_contact = $_POST['contact'];
                        $customer_email = $_POST['email'];
                        $customer_address = $_POST['address'];

                        //save order

                        //create sql
                        $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                         ";

                        // echo $sql2; die();

                         //execute
                         $res2 = mysqli_query($conn, $sql2);

                         if($res2==TRUE)
                         {
                             $_SESSION['order'] = "<div class = 'sucess text-center'> </div>";
                             //redirect
                             header('location:'.SITEURL.'payment.php');
                 
                         }
                         else
                         {
                             $_SESSION['order'] = "<div class = 'error text-center'>Failed to Order Food.</div>";
                             //redirect
                             header('location:'.SITEURL);
                 
                         }

                       
        
                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->




    <?php include('partials-front/footer.php'); ?>