
<!-- ######################## Footer ######################## -->  
      
<footer class="section_dark">

      <div class="row">
           <div style="margin-left:0px;color: white;width: 50%;float:left;" class="twelve columns footer">
              <a target="_blank" style="color: white" href="http://www.ekonnect.net">Ekonnect Knowledge Foundataion<br/>Copyright 2013</a> 
          </div>
          <div style="width: 30%;float:right;" class="twelve columns footer">
              <a target="_blank" href="http://www.linkedin.com/in/ekolearning " class="lsf-icon" style="color: white;font-size:16px; margin-right:15px" title="linkedin">Linkedin</a> 
              <a target="_blank" href="https://www.facebook.com/EkonnectKnowledgeFoundation?ref=hl" class="lsf-icon" style="color: white;font-size:16px; margin-right:15px" title="facebook">Facebook</a> 
          </div>
          
      </div>

</footer>		  
<?php
// api key access
logout_from_system();

if(isset($_SESSION['error_box_msg'])){
  echo "<script>var error_flag = true;var error_msg = '".$_SESSION['error_box_msg']."';</script>";
  unset($_SESSION['error_box_msg']);
}else{
  echo "<script>var error_flag = false;</script>";
}
if(isset($_GET['login'])){
  if($_GET['login']="true"){
    echo '<script>var login = true;</script>'; 
  }
}else{
   echo '<script>var login = false;</script>'; 
}
if(isset($_GET['registration_success']) && !isset($_SESSION['error_box_msg']) ){
  if($_GET['registration_success']="true"){ 
    echo '<script>var registration_success = true;</script>'; 
  }
}else{
   echo '<script>var registration_success = false;</script>'; 
} 

 ?>
<!-- ######################## Scripts ######################## --> 

    <!-- Included JS Files (Compressed) -->
    <script src="javascripts/foundation.min.js" type="text/javascript"></script> 
    <!-- Initialize JS Plugins -->
     <script src="javascripts/app.js" type="text/javascript"></script>
      <script type="text/javascript" src="javascripts/jquery.js"></script>
      <script type="text/javascript" src="javascripts/bootstrap.js"></script>
      <script type="text/javascript" src="javascripts/bootstrap.min.js"></script>
      <script type="text/javascript" src="javascripts/custom_js.js"></script>
    <script type="text/javascript" src="javascripts/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
        $('.nivo-controlNav').html('');
        $('.nivo-controlNav').removeClass();

        $('#login-btn').live({
          click: function (){
            $('.signup-lightbox').fadeIn(400);        
          }
        });
        $("html").click(function() {
          $(".signup-lightbox").hide();
      });
    });    
    
    </script>

 
<!-- Button trigger modal -->
  <a data-toggle="modal" href="#login" class="btn btn-primary btn-login"></a>
  <!-- Modal -->
  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"> 
          <h4 class="modal-title">Login</h4>
        </div><?php
        if(isset($_GET['login']) && isset($_SESSION['course'])){
          echo '<h6 style="text-align: center;color: #cc3333;" class="modal-title">Please Login/Signup to enroll for the Course</h6>';
        }
        ?> 
        <div class="modal-body">                   
          <form  id="login_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
            <input type="text" name="username" placeholder="User Name">
            <input type="password" name="password" placeholder="Password"> 
            <input type="submit" style="float:right" name="submit_login" value="Login" class="button" />  
          </form>
        </div> 
        <div class="modal-footer">
          <a style="float:left" target="_blank" href="http://ekolearning.s3.efrontlearning.com/index.php?ctg=reset_pwd" >Forgot Password</a> <a style="cursor:pointer;" id="register_btn" >New User, Sign Up!</a>
        <div type="button" id="login_close" class="btn btn-default" data-dismiss="modal"></div>
        <div style="display:none;color: red;" id="error_div_1">Please Enter your details Correctly!</div>
          </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- Button trigger modal -->
  <a data-toggle="modal" href="#register" class="btn btn-primary btn-register"></a>
  <!-- Modal -->
  <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"> 
          <h4 class="modal-title">Register</h4>
        </div>
        <div class="modal-body">
          <form id="register_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">  
            <input type="text"  name="username" placeholder="User Name (min 6 alphanumeric characters)">
            <input type="password" name="password" placeholder="Password (min 6 alphanumeric characters)">
            <input type="text"  name="firstname" placeholder="First Name">
            <input type="text"  name="lastname" placeholder="Last Name"> 
            <input type="text" name="email" placeholder="Email ID">    
            <input type="submit" style="float:right" name="submit_register" value="Sign Up" class="button" /> 
          </form>
        </div> 
        <div class="modal-footer">
          <div style="display:none;color: red;" id="error_div_2">Please Enter your details Correctly!</div>
          </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <!-- Button registration_success modal -->
  <a data-toggle="modal" href="#registration_success" class="btn btn-primary btn-registration_success"></a>
  <!-- Modal -->
  <div class="modal fade" id="registration_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div style="width: 360px;" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header"> 
          <h4 class="modal-title">Registration Successful</h4>
        </div>
        <div class="modal-body">
          Thank you for registering for the course.</br> Click
           <a style="pointer:cursor;" target="_blank" href="http://ekolearning.s3.efrontlearning.com/index.php?autologin=<?php  echo $_SESSION['user']['auto_login_key']; ?>">here</a> to access your course.
         
        </div> 
        <div class="modal-footer">
          </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


    <!-- Button registration_success modal -->
  <a data-toggle="modal" href="#error_box" class="btn btn-error_box"></a>
  <!-- Modal -->
  <div class="modal fade" id="error_box" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div style="width: 400px;" class="modal-dialog">
      <div class="modal-content" style="border-radius: 0px;border: 10px solid;border-color: #cc3333;" >
        <div class="modal-header"> 
          <div style="text-align:center;padding:5px"> <img style="width:50px;float: left;margin-top: -12px;" src="images/icon-error.png" /><div style="font-size:20px" id="error_box_message"></div></div>
        </div>  
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

