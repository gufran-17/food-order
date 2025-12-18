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

    <!-- order Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method ="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                        <?php
                        if($image_name == "")
                        {
                         echo "<div class = 'error'>Image not Available.</div>";
                        }
                        else
                        {
                            ?>
                             <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Dal rice" class="img-responsive img-curve">
                             <?php
                        } 
                        ?>

                    </div>
    
                    <div class="food-menu-desc text-white">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name = "food" value="<?php echo $title; ?>">

                        <p class="food-price">Rs. <?php echo $price; ?></p>
                        <input type="hidden" name = "price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Sarika Shaikh" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

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
                        price = '$price',
                        qty = '$qty',
                        total = '$total',
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
                             $_SESSION['order'] = "<div class = 'sucess text-center'>Food Ordered successfully </div>";
                             //redirect
                             header('location:'.SITEURL);
                 
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
    <!-- order Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>