<?php 
include ('include/header.php');

?>

<body>

<!-- ######################## Main Menu ######################## -->
 
<nav>

     <div style= "background: #222;padding:0px" class="twelve columns header_nav">
     <div class="row"> 
       <ul style="line-height: 25px;height: 20px;" id="menu-header" class="nav-bar horizontal"> 
          <li class="active" style="line-height: 25px;margin:5px;float:right"><a style="padding: 0 15px;background: #cc3333;" href="#">Login</a></li>
        </ul>
      </div>  
      </div>
      <div ><img style="margin-left: 13%;width:300px;" src="images/map-bg.png"  /> 
        <img style="margin-top: 5px;margin-left: -23%;width:200px;position:absolute;" src="images/ekonnect.png"  /> 
      <img style="margin-left: 6%; width: 300px;z-index: 1000;float: right;margin-right: 12%;padding: 15px;" src="images/logo.png"  /></div>
     <!-- menu bar-->
     <div style= "background: #CC3333;padding:0px" class="twelve columns header_nav">
     <div class="row">
      
          <ul style="line-height: 25px;height: 20px;" id="menu-header" class="nav-bar horizontal">
        
         <li class=""><a href="index.php">Home</a></li>      
          <li class="active"><a href="blog.php">Courses Catelog</a></li> 
          <li class=""><a href="product-single.php">Course Info</a></li> 
          <li class=""><a href="contact.php">Contact Us</a></li>
          <li class=""><a href="about.php">About Us</a></li>       
        </ul>
        
      
        
      </div>  
      </div>
</nav>
 
      
<!-- ######################## Section ######################## -->

<section>

  <div class="section_main">
   
      <div class="row">
      
          <section class="eight columns">
          
          <div style="margin:20px 0px"></div>
          
          <article class="blog_post">
          
             <div class="three columns">
             <a href="#" class="th"><img src="images/thumb1.jpg" alt="desc" /></a>
             </div>
             <div class="nine columns">
              <a href="#"><h3>Lorem Ipsum</h3></a>
              <p> Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet consectetur orci. Mauris pharetra congue enim, et sagittis lectus congue ut. Cum sociis natoque penatibus.</p>
              <div class="post_meta">
                 <span class="lsf-icon" title="calender">20th oct 2013</span> 
                 <span class="lsf-icon" title="user" style="margin-left:15px"><a href="#">Dr. Prasad Modak</a></span> 
             </div> 
               <input style="float:right" type="submit" value="Explore" class="button success" />
              </div>
              
          </article>
          
          <article class="blog_post">
          
             <div class="three columns">
             <a href="#" class="th"><img src="images/thumb2.jpg" alt="desc" /></a>
             </div>
             <div class="nine columns">
              <a href="#"><h3>Lorem Ipsum</h3></a>
              <p> Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet consectetur orci. Mauris pharetra congue enim, et sagittis lectus congue ut. Cum sociis natoque penatibus.</p>
              <div class="post_meta">
                 <span class="lsf-icon" title="calender">20th oct 2013</span> 
                 <span class="lsf-icon" title="user" style="margin-left:15px"><a href="#">Dr. Prasad Modak</a></span> 
             </div> 
             <input style="float:right" type="submit" value="Explore" class="button success" />
              </div>
              
          </article>
          
          
          <article class="blog_post">
          
             <div class="three columns">
             <a href="#" class="th"><img src="images/pin2.jpg" alt="desc" /></a>
             </div>
             <div class="nine columns">
              <a href="#"><h3>Lorem Ipsum</h3></a>
              <p> Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet consectetur orci. Mauris pharetra congue enim, et sagittis lectus congue ut. Cum sociis natoque penatibus. Vivamus torut. Cum sociis natoque penatibus.</p>
              <div class="post_meta">
                 <span class="lsf-icon" title="calender">20th oct 2013</span> 
                 <span class="lsf-icon" title="user" style="margin-left:15px"><a href="#">Dr. Prasad Modak</a></span> 
             </div> 
             <input style="float:right" type="submit" value="Explore" class="button success" />
              </div>
              
          </article>
          
          </section>
          
          <section class="four columns"> 
          <div style="margin:20px 0px"></div>
             <div class="panel">
             <h3>Most Popular Courses</h3>
               <p> Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet consectetur orci. Mauris pharetra congue enim, et sagittis lectus congue ut. Cum sociis natoque penatibus. Vivamus tortor tellus, rutrum sit amet mollis vel.</p> 
               
              <h3>What We Offer</h3>

            <ul class="accordion">
              <li class="active">
                <div class="title">
                  <h5>Feature 1</h5>
                </div>
                <div class="content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
              </li>
              <li>
                <div class="title">
                  <h5>Feature 2</h5>
                </div>
                <div class="content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
              </li>
              <li>
                <div class="title">
                  <h5>feature 3</h5>
                </div>
                <div class="content">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                </div>
              </li>
            </ul>


               
             </div>
          </section>
          
      </div>
      
    </div>
      
</section>

 

<?php 
include ('include/footer.php');

?>
</body>
</html>