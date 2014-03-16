<?php 
if(isset($_POST['course_id'])){
  $course_id = $_POST['course_id'];
  }else{
    header('Location: courses.php');
}
session_start();
include ('API/efront_api.php');
include ('include/header.php');




if(!isset($_SESSION['courses'])){
  $_SESSION['courses'] = get_courses();
}  
$course_data =  course_html_wrapper($course_id);  
?>

      
   <!-- ######################## Section ######################## -->
      
      <section class="section_light">
      <div class="row">




<?php echo $course_data; ?>
  


      </div>

        </section>
        
		<!-- end section -->
        
<?php 
include ('include/footer.php');

?>
</body>
</html>
