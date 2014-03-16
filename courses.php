<?php    
  session_start();

include ('API/efront_api.php');
include ('include/header.php');


//if(!isset($_SESSION['courses'])){
  $_SESSION['courses'] = get_courses();
//}
//dump($_SESSION);
?>      
<!-- ######################## Section ######################## -->
 
<section>

  <div class="section_main">
   
      <div class="row">
      
          <section class="eight columns">
          
          <div style="margin:20px 0px"></div>
          
          <?php catalog_html_wrapper(); ?>
          
          
          </section>
          
          <section class="four columns"> 
          <div style="margin:20px 0px"></div>
             <div class="panel">
             <!--<h3>Most Popular Courses</h3>
               <p> Vivamus tortor tellus, rutrum sit amet mollis vel, imperdiet consectetur orci. Mauris pharetra congue enim, et sagittis lectus congue ut. Cum sociis natoque penatibus. Vivamus tortor tellus, rutrum sit amet mollis vel.</p> 
               -->
              <h3>Special Features</h3>

            <ul class="accordion">
              <li class="active">
                <div class="title">
                  <h5>Expert Instructors</h5>
                </div>
                <div class="content">
                  <p>Ekolearning has brought on board eminent academicians and industry-leading experts not just to create and review the course content but also to run the courses and mentor students.</p>
                </div>
              </li>
              <li>
                <div class="title">
                  <h5>Interactive Content</h5>
                </div>
                <div class="content">
                  <p>Powered by a robust e-learning engine, Ekolearning’s courses are enriched with interactive features such as videos, audios, discussion forum, web conferencing, individual assignments as well as group work to foster student participation and collaborative learning.</p>
                </div>
              </li>
              <li>
                <div class="title">
                  <h5>Case-study Based Learning</h5>
                </div>
                <div class="content">
                  <p>Our courses are unique in that they employ a ‘case study’ based approach to highlight the multi-stakeholder, multi-scale and multi-faceted nature of the environmental issues. Cases are used to show-case core principles and strategies so that learning does not remain case study specific.</p>
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