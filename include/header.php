<?php 
session_start();
error_reporting(1);
include('include/config.php');
if(isset($_GET['W1XD4SXP'])){
  $_SESSION['error_box_msg'] = $_GET['W1XD4SXP'];
} 
//dump($_SESSION);

 ?>
<!DOCTYPE html> 
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->


<head>

  <meta charset="utf-8" /> 

  <title>Ekolearning</title>
  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="stylesheets/foundation.css">
  <link rel="stylesheet" href="stylesheets/main.css">
  <link rel="stylesheet" href="stylesheets/app.css">
  <link rel="stylesheet" href="stylesheets/custom.css">
  <link rel="stylesheet" href="stylesheets/bootstrap.css">
  <link rel="stylesheet" href="stylesheets/default.css" type="text/css" media="screen" /> 
    <link rel="stylesheet" href="stylesheets/nivo-slider.css" type="text/css" media="screen" /> 

  <script src="javascripts/modernizr.foundation.js"></script>
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44084281-1', 'ekonnect.net');
  ga('send', 'pageview');

</script>
  <link rel="stylesheet" href="ligature.css">
  
  <!-- Google fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
<style type="text/css">
.red_border {
border: 1px solid red !important;
}
</style>

</head>

<body> 
<!-- ######################## Main Menu ######################## -->
 
<nav>

     <div style= "background: #222;padding:0px" class="twelve columns header_nav">
     <div class="row"> 
       <ul style="line-height: 25px;height: 20px;" id="menu-header" class="nav-bar horizontal"> 
        <?php 
          if(!isset($_SESSION['user'])){
            echo  '<li id="login_btn" class="active" style="line-height: 25px;margin:5px;float:right"><a style="padding: 0 15px;background: #cc3333;" href="#">Login</a></li>';
          }else{
            //dump($_SESSION['user']);
            $name = $_SESSION['user']['firstname'].' '.$_SESSION['user']['lastname'];
            echo '<li class="active" style="line-height: 25px;margin:5px;float:right"><a style="padding: 0 15px;background: #cc3333;" href="include/logout.php">Logout</a></li>';
            echo '<li class="active" style="line-height: 25px;margin:5px;float:right"><a style="padding: 0 15px;background: #cc3333;" href="#">Hi,'.$name.'</a></li>';
          }

        ?>
          
        </ul>
      </div>  
      </div>
      <div ><img style="margin-left: 13%;width:300px;" id="main_image" src="images/map-bg.png"  /> 
        <a target="_blank" style="cursor:pointer" href="http://www.ekonnect.net"><img style="margin-top: 5px;margin-left: -23%;width:200px;position:absolute;" src="images/ekonnect.png"  /> </a>
     <a style="cursor:pointer" href="http://www.ekolearning.ekonnect.net">
      <img style="margin-left: 6%; width: 300px;z-index: 1000;float: right;margin-right: 12%;padding: 15px;" src="images/logo.png"  /></a></div>
     <!-- menu bar-->
     <div style= "background: #CC3333;padding:0px" class="twelve columns header_nav">
     <div class="row">
      
        <ul style="line-height: 25px;height: 20px;" id="menu-header" class="nav-bar horizontal">
          <!--<li class="<?php if($_SERVER['PHP_SELF'] == "/index.php")echo "active"; ?>"><a href="index.php">Home</a></li>  -->    
          <li class="<?php if($_SERVER['PHP_SELF'] == "/courses.php")echo "active"; ?>"><a href="courses.php">Course Catalog</a></li> 
          <!--<li class="<?php if($_SERVER['PHP_SELF'] == "/mentors.php")echo "active"; ?>"><a href="mentors.php">Mentors</a></li>  -->
          <!--<li class="<?php if($_SERVER['PHP_SELF'] == "/faculty.php")echo "active"; ?>"><a href="faculty.php">Faculty</a></li> -->
          <!--<li class="<?php if($_SERVER['PHP_SELF'] == "/contact.php")echo "active"; ?>"><a href="contact.php">Write to Us</a></li> -->
          <!--<li class="<?php if($_SERVER['PHP_SELF'] == "/about.php")echo "active"; ?>"><a href="about.php">About Us</a></li>   -->      
        </ul>
        
      
        
      </div>  
      </div>
</nav>
