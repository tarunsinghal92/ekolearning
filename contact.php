<?php  
include ('include/header.php'); 

if(isset($_POST['submit_contact'])){
  //dump($_POST);
  contact_us_mail($_POST);
}

?>
 
   <!-- ######################## Section ######################## -->
      
      <section class="section_light">
            

      <div class="row">  
        <div class="six columns">     
          <div id="error_div" style="display:none;">Please fill all information correctly</div>
          <h3>Contact Form</h3>

          <!-- Row Layout for forms -->
          <form name="contact_form" id="contact_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >  
            <input type="text" class="twelve" name="name" placeholder="Name" />
            <input type="text" class="twelve" name="email" placeholder="Email ID" />
            <textarea style="height:100px" name="message" placeholder="Message"></textarea>
            <input style="float:right" type="submit" name="submit_contact" value="Submit" class="button success" />
          </form>
          <h3>Address</h3>
            <p>Ekonnect Knowledge Foundation</br> 
              A60,Royal Industrial Estate,</br>
              2nd Floor, Naigaon Cross Road,</br>
              Wadala(W) Mumbai - 400031</br>
              <strong>Ph: (0)- 24108255/24147481</strong></p>
              <!-- Contact Form -->
        </div>

        <div class="six columns">
          <h3>Where to find us</h3>
          <img src="images/map.jpg" >
        </div>
      </div>

        </section>
        
		<!-- end section -->
        
<?php 
include ('include/footer.php');

?>
</body>
</html>