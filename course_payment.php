<?php
session_start(); 

if(!empty($_POST)){
  $course = $_POST;
  $_SESSION['course'] = $_POST;
}else if(!empty($_SESSION['course'])) {
  $course = $_SESSION['course'];
}else{
  header('Location: courses.php');
}

if(!isset($_SESSION['user'])){
  header('Location: courses.php?login=true');
  die();
}

include ('include/header.php');
include ('API/efront_api.php');

//dump($_SESSION);
$user_id = $_SESSION['user']['id'];

// check if the current course is a free course
if( intval($course['price'])==0 ){
  //it is a free course so assign it to user
  assign_free_course_to_user($_SESSION['user']['username'] , $course['course_id'] , $_SESSION['user']['email']);
  //dump($_SESSION);  
}


?>

   <!-- ######################## Section ######################## -->
   
     
      <section class="section_light">
 

<div class="row">
      
      <div class="box_fluid col_fluid masonry-brick" style="float:right">
         <div style="text-align:center;" class="box_fluid_inner">
                  <h4 style="margin: 10px 0;">Rs. <?php  echo $course['price']; ?></h4>
                </div>
        <a href="#"><img src="images/course.jpg" alt="desc"></a>
                <div class="box_fluid_inner">
                  <h4><?php  echo $course['name']; ?></h4>
                   <p style="font-style: italic; font-family: Georgia">By <?php  echo $course['author']; ?></p> 
                   <p><?php  echo $course['description']; ?>
            </p> 
            
                </div> 
      </div>
          
            <div class="row" style='width:40%;float:left'>
              <div  class="box_fluid_inner">
          <div id="error_div" style="display:none;color: red;" >Please Fill Required Details</div>
                  <h4 style="margin: 20px 0;">Fill up your Details to proceed to Payment</h4>
                </div>
          <form id="course_payment" name="course_payment" method="post" action="sendpayment.php" >  
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
            <input type="hidden" name="course_id" value="<?php echo $course['course_id']; ?>" />
            <input type="text" name="full_name" class="twelve" placeholder="Full Name" />
            <input type="text" name="email_id" class="twelve" placeholder="Email ID" />
            <input type="text" name="address" class="twelve" placeholder="Address" />
            <input type="text" name="city" class="six column" placeholder="City" />
            <input type="text" name="state" class="three column" placeholder="State" />
            <input type="text" name="country" class="three column" value="India" placeholder="Country" />
            <input type="text" name="pincode" class="twelve" placeholder="Pincode" />
            <input type="text" name="contact_no" class="twelve" placeholder="Contact No." /> 
            <input style="float:right;" type="submit" name="payment_submit" value="Submit" class="button success" />
          </form>
        </div>




      </div>

        </section>

        
		<!-- end section -->
        
<?php 
include ('include/footer.php');

?>
  
</body>
</html>
