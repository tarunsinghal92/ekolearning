<?php 

header( 'Location: courses.php' );
include ('API/efront_api.php');
include ('include/header.php');

?>


<section>
       <div class="row" id="wrapper">
         
        <div style="margin-top:10px;" class="slider-wrapper theme-default">        
        <div style="width: 700px;"  class="six columns">
            <img src="images/ekolearning1.jpg" data-thumb="images/ekolearning1.jpg" style="    width: 680px;    margin-left: 4%; " usemap="#planetmap"/> 
        <map name="planetmap">
        <area shape="rect" coords="5,70,210,185" href="courses.php" > 
        </map>    
             </div>

         <div style="width: 250px;" class="four columns">
            <h4><span class="dropcap_red lsf-icon-dropcap" ></span>Announcements<br/></h4>
            <p style="text-align: justify;">The first module <i>'Urban Air Quality Management: Who is the Manager?'</i> is now open for preview.</br> Please feel free to take the 
              first module and send your feedback to <i>divya.narain@emcentre.com.</i></p>
         </div>

    </div>
</section>

<!-- ######################## Section ######################## -->
     
   <section class="section_light">
   
        <div class="row" style="width: 960px;" >
        
         <div style="width: 290px;" class="four columns">
            <h4><span class="dropcap_red lsf-icon-dropcap" title="group"></span>Expert Instructors<br/></h4>
            <p style="text-align: justify;">Ekolearning has brought on board eminent academicians and industry-leading experts not just to create and review the course content but also to run the courses and mentor students.</p>
         </div>
         
      
          <div style="width: 380px;" class="four columns">
            <h4><span class="dropcap_black lsf-icon-dropcap" title="app"></span>Interactive Content<br/></h4>
            <p style="text-align: justify;"> Powered by a robust e-learning engine, Ekolearning’s courses are enriched with interactive features such as videos, audios, discussion forum, web conferencing, individual assignments as well as group work to foster student participation and collaborative learning.</p>
          </div>
          
          
          <div style="width: 290px;" class="four columns">
            <h4><span class="dropcap_black lsf-icon-dropcap" title="album"></span>Case-Studies</h4>
            <p style="text-align: justify;">Our courses are unique in that they employ a ‘case study’ based approach to highlight the multi-stakeholder, multi-scale and multi-faceted nature of the environmental issues.</p>
          </div>
        
        </div>
        
    </section>
  

<?php 
include ('include/footer.php');

?>
</body>
</html>