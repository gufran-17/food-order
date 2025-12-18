<?php include('partials-front/menu.php'); ?>

     
<!-- Contacts Section Starts Here -->

<div class="container">
        <div class="contact-parent">
           <div class="contact-child child1">
		   <h5>
              <p   style="font-size:20px;">
                 <i class="fas fa-map-marker-alt"></i> Address <br />
                 <span class="text-pink"> Mg road,Sai Building 1st floor,Begumpet.</span>
                 <br />
                
                 <span class="text-pink">Begumpet,Hyderabad.</span>
              </p>
              <p  style="font-size:20px;">
                 <i class="fas fa-phone-alt"></i> Let's Talk <br />
                 <span class="text-pink"> 968574365</span>
              </p>
              <p  style="font-size:20px;">
                 <i class=" far fa-envelope"></i> General Support <br />
                 <span class="text-pink">mealsonwheels@gamil.com</span>
              </p>
			  </h5>
           </div>
           <div class="contact-child child2">
              <div class="inside-contact">
                <h2>CONTACT US</h2>
				<br>
	<h4>
    <form action="contact.php" method="POST">
        <div class="form-group">
            <label>Name:</label>
            <input style="font-size:20px;"type="text" name="name" class="form-control" required>
        </div>
						<br>

		<div class="form-group">
            <label>Phone:</label>
            <input style="font-size:20px; type="text" name="phone" class="form-control" required>
        </div>
						<br>

        <div class="form-group">
            <label>Email:</label>
            <input  style="font-size:20px;type="email" name="mail" class="form-control" required>
        </div>
						<br>

        <div class="form-group">
            <label>Message:</label>
            <textarea class="form-control" name="message" required></textarea>
        </div>
						<br>

        <div class="form-group">
            <button class="btn btn-success" type="submit">Submit</button>
        </div>
		
						<br>
				<br>

    </form>
	</h4>
		</div>
		</div>
		</div>
        <div class="clearfix"></div>
		
<?php


        if($_POST)
      { 
        $name=$_POST['name'];
        $email_address=$_POST['mail'];
        $phone=$_POST['phone'];
        $message=$_POST['message'];    
    
    
        $sq1="INSERT INTO `contact` (`id`, `name`, `email_address`, `phone`, `message`, `date`) VALUES (NULL,'$name', '$email_address', '$phone', '$message', current_timestamp());";

          if (($conn->query($sq1) == TRUE))
          {
           echo "<div style='background-color:lightgreen;'>"."Received message successfuly". "</div>";
         } else {
           echo "<div style='background-color:red;'>"."Failed to send the message". "</div>";
         } 
        }
    
            
        
        
    

    
?>

     
   

    <?php include('partials-front/footer.php'); ?>