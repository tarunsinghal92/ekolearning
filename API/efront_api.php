<?php  
define(EFRONTGLOBALURL, "http://ekolearning.s3.efrontlearning.com");
error_reporting(1);
initialize_api();

function updateUser($userData){
	$newPass=randomPassword();
	$url = EFRONTGLOBALURL.'/api2.php?action=update_user&login'.$userData['username'].'&password='.$newPass.'&name='.$userData['firstname'].'&surname='.$userData['lastname'].'&email='.$userData['email'].'languages=english&token='.TOKEN;

	$xml=simplexml_load_file($url);
	$status = $xml->status;
	if($status == "ok"){
		return $status;
	}else{
		$_SESSION['error_box_msg'] = $xml->message;
	}
}


function get_autologin_key($username){ 
	$url = EFRONTGLOBALURL.'/api2.php?action=get_user_autologin_key&token='.TOKEN.'&login='.$username;
	//dump($url);
	$xml=simplexml_load_file($url); 
	$temp = $xml->autologin_key;
	//dump($temp);
	return $temp;
	
}
function set_autologin_key($username){
	$url = EFRONTGLOBALURL.'/api2.php?action=set_user_autologin_key&token='.TOKEN.'&login='.$username;
	$xml=simplexml_load_file($url);
}

function update_login_key_to_db($key,$user_id){
	$db = db_connect(); 
	$stmt = $db->prepare("UPDATE `users` SET `auto_login_key`=:auto_login_key WHERE id=".$user_id);
	$stmt->execute(array(
			':auto_login_key' => $key 
		));
}

function createUser($userData){
	//dump($userData);
	$result = insert_user_to_db($userData);
	if(!$result){
		$_SESSION['error_box_msg'] = "User Already Exist";
	}else{
		//add user to efront
		$url = EFRONTGLOBALURL.'/api2.php?action=create_user&login='.$userData['username'].'&password='.$userData['password'].'&name='.$userData['firstname'].'&surname='.$userData['lastname'].'&email='.$userData['email'].'&languages=english&token='.TOKEN;
		$xml=simplexml_load_file($url);
		$status = $xml->status;
		//dump($status);
		//logging in
		$db = db_connect();
		$stmt = $db->prepare("SELECT * FROM users where username='".$userData['username']."' and password='".$userData['password']."'");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

		if($status == "ok"){
			//do other stuff
			set_autologin_key($userData['username']);
			$key = get_autologin_key($userData['username']);
			update_login_key_to_db($key,$result[0]['id']);

			$db = db_connect();
			$stmt = $db->prepare("SELECT * FROM users where username='".$userData['username']."' and password='".$userData['password']."'");
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$_SESSION['user'] = $result[0];
			//new_user_mail($userData);
		}else{
			//rollback
			user_rollback($result[0]);
			$_SESSION['error_box_msg'] =  $xml->message;
		}
	}
}
function login_into_system(){ 
	$url = EFRONTGLOBALURL.'/api2.php?action=login&token='.TOKEN.'&username=admin&password=ekolearning%!5';
	$xml=simplexml_load_file($url);
	//echo "<script>var dummy = '".$url."';</script>";
	$status = $xml->status;
	if($status == "ok"){
		//echo $status;
	}else{
		//trigger error modal
		//echo "<script>$('.error_message_modal').</script>";
		$_SESSION['error_box_msg'] =  $xml->message;
	}

}
function get_professor_info(){ 
	//http://efront/api2.php?action=user_info&token=IQwwIuvXlLbwjjNXNf7XHMJh2DfBEe&login=john
	$url = EFRONTGLOBALURL.'/api2.php?action=user_info&token='.TOKEN.'&login='.$username.'&course='.$course_id.'&type=student';
	$xml=simplexml_load_file($url);
	$status = $xml->status;
	if($status == "ok"){
		//echo $status;
	}else{
		$_SESSION['error_box_msg'] = $xml->message;
	}
}

function assign_course_to_user($username,$course_id){ 
	//http://efront/api2.php?action=course_to_user&token=IQwwIuvXlLbwjjNXNf7XHMJh2DfBEe&login=john&course=4&type=student
	$url = EFRONTGLOBALURL.'/api2.php?action=course_to_user&token='.TOKEN.'&login='.$username.'&course='.$course_id.'&type=student';
	$xml=simplexml_load_file($url);
	$status = $xml->status;
	if($status == "ok"){
		//echo $status;
	}else{
		$_SESSION['error_box_msg'] = $xml->message;
	}
}
function insert_user_to_course_mapping($course_id){
	$db = db_connect(); 
	$stmt = $db->prepare("INSERT INTO `user_course_mapping`(`course_id`, `user_id`) VALUES (:course_id,:user_id)");
	$arr = array(
			':course_id' => $course_id,
			':user_id' => $_SESSION['user']['id']
			); 
	$stmt->execute($arr); 
}


function assign_free_course_to_user($username,$course_id,$to_email){ 
	//http://efront/api2.php?action=course_to_user&token=IQwwIuvXlLbwjjNXNf7XHMJh2DfBEe&login=john&course=4&type=student
	$url = EFRONTGLOBALURL.'/api2.php?action=course_to_user&token='.TOKEN.'&login='.$username.'&course='.$course_id.'&type=student';
	$xml=simplexml_load_file($url);
	$status = $xml->status;
	if($status == "ok"){
		//echo $status;
		//mail to user congratulating him
		//add mapping to database

		insert_user_to_course_mapping($course_id);
        $db = db_connect();
        $stmt = $db->prepare("SELECT course_id FROM user_course_mapping where user_id=".$_SESSION['user']['id']);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$list =array();
		foreach ($result as $key => $value) {
			array_push($list, $value['course_id']);
		}
		$_SESSION['user_course_mapping'] = $list;
		mail_to_user($to_email);
	}else{
		if( ($xml->message)=="Assignment already exists" ){
			$_SESSION['error_box_msg'] =  "You have already enrolled for this course";
		}else{
			$_SESSION['error_box_msg'] =  $xml->message;
		}
	}
	if(!isset($_SESSION['error_box_msg'])){echo "<script>window.location='index.php?registration_success=true';</script>";}
  	else{echo "<script>window.location='index.php?W1XD4SXP=".$_SESSION['error_box_msg']."';</script>";}
}

function initialize_api(){	
	get_api_token();
	login_into_system();
}
function logout_from_system(){ 
	$url = EFRONTGLOBALURL.'/api2.php?action=logout&token='.TOKEN;
	$xml=simplexml_load_file($url);
} 

function get_courses(){ 
	$url = EFRONTGLOBALURL.'/api2.php?action=courses&token='.TOKEN; 
	$xml=simplexml_load_file($url);
	$status = $xml->status;
	//dump($xml);
	$courses = $xml->courses;
	$course_arr = array();
	foreach ($courses->course as $key => $courseData) {
		unset($temp_course);
		$temp_course = get_course_1($courseData->id);
		if($temp_course['general_info']['active']){
			array_push($course_arr,$temp_course);
		}		
	}
	//dump($course_arr);
	return $course_arr;
}

function get_course_1($id){
	$url_1 = EFRONTGLOBALURL.'/api2.php?action=course_info&token='.TOKEN.'&course='.$id; 
	$xml_course=simplexml_load_file($url_1);
	return xml2array($xml_course);
}
function get_api_token(){
	$url = EFRONTGLOBALURL.'/api2.php?action=token';
	$xml=simplexml_load_file($url);
	define(TOKEN, $xml->token); 
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, count($alphabet)-1);
        $pass[$i] = $alphabet[$n];
    }
    return $pass;
}


function getCourseFromId($id){	
	//dump($_SESSION['courses']);
	foreach ($_SESSION['courses'] as $key => $value) {
		$course = $value['general_info'];
		$Cid = $course['id']; 
		if(intval($Cid) == intval($id)){
			return $course;
		}
	} 
}

function course_html_wrapper($id){
	$course = getCourseFromId($id);
	//dump($course); 
	$courseName = $course['name'];
	$courseInfo = $course['info'];
	$general_description = $courseInfo['general_description'];
	$assessment = $courseInfo['assessment'];
	$objectives = $courseInfo['objectives'];
	$lesson_topics = $courseInfo['lesson_topics'];
	$resources = $courseInfo['resources'];
	$other_info = $courseInfo['other_info'];
	$courseMeta = $course['metadata'];
	$courseDate = $courseMeta['date'];
	$courseAuthor = $courseMeta['creator'];
	$priceData = $course['price'];  

	if(intval($priceData['value'])==0){
		$price_text = 'FREE';
	}else{
		$price_text = 'Rs. '.$priceData['value'];
	}
	if(preg_match("/http:/", $resources)){
		$b = strpos($resources,"v=");
		$video_html = '<embed style="width:465px;height:260px;"
				src="http://www.youtube.com/v/'.substr($resources,$b+2).'"
				type="application/x-shockwave-flash">
				</embed>';
	}else{
		 $video_html = '<img src="images/course.jpg" alt="Product Image Description">';
	}
	$buttonText = '<input style="float:right" type="submit"  value="Enroll Now" class="button" />';
	foreach ($_SESSION['user_course_mapping'] as $key => $value) {
		if( intval($id)==intval($value) ){			
			$buttonText = '<div  class="active" style="line-height: 25px;margin:5px;float:right"><a style="text-decoration: none;padding: 9px;background: #2ba6cb;" target="_blank" href="http://ekolearning.s3.efrontlearning.com/index.php?autologin='.$_SESSION['user']['auto_login_key'].'"><b>Go to Course</b></a></div>';
			break;
		}
	}
	
	$a= '<div class="row">
			<div class="six columns">
			'.$video_html.'
			</div>';

	$a .=  '<div class="six columns">
		<div class="panel" style="min-height: 260px;">		
		      <h3>'.$courseName.'</h3>
			  <p style="font-style: italic; font-family: Georgia">By <a href="faculty.php">'.$courseAuthor.'</a></p>
		            <!--<p>'.$general_description.'</p>-->
		            <span style="font-style: italic; font-family: Georgia"><strong>Price: </strong>'.$price_text.'</span></br></br>
		            <span style="font-style: italic; font-family: Georgia"><strong>Starting On: </strong>'.$courseDate.' </span>
		          <form action="course_payment.php" method="post"> 
		            <input name="course_id"   value="'.$id.'" type="hidden"> 
		            <input name="price"   value="'.$priceData['value'].'" type="hidden"> 
		            <input name="author"   value="'.$courseAuthor.'" type="hidden"> 
		            <input name="description"   value="'.$general_description.'" type="hidden"> 
		            <input name="name"   value="'.$courseName.'" type="hidden"> '.$buttonText.'
		          </form>
			</div> <!-- end panel -->

		</div>
		</div><!-- end row -->';

   $a .= '<div class="row">
      <div class="twelve columns">

      <dl class="tabs three-up">
        <dd class="active"><a href="#simple1">Course Overview</a></dd>
     <!--   <dd ><a href="#simple2">Faculty</a></dd>
        <dd><a href="#simple3">Mentors</a></dd>-->
      </dl>
      
      <ul class="tabs-content">
        <li class="active" id="simple1Tab">
         <ul>
          <li>'.$general_description.'</li>
          <li>'.$objectives.'</li>
         <!-- <li>'.$lesson_topics.'</li>-->
        </ul>   
        </li>
        <li   id="simple2Tab">
        <article class="blog_post">
          
             <div style="width: 20%;" class="three columns">
             <a href="#" class="th"><img src="images/prasad_modak.jpg" alt="desc"></a>
             </div>
             <div style="width: 80%;" class="nine columns">
              <a href="#"><h3>Dr. Prasad Modak</h3></a>
              <p style="text-align: justify;">Dr Modak has been fortunate to span his career across teaching, research, consulting and implementation ‐
               in the areas of policy, planning, projects and investments. He has worked with almost all key development agencies across the 
               globe such as the UN, The World Bank, Asian Development Bank and has advised various Governments including the Government
                of India and the State governments. Currently, he functions as Dean of IL&FS Academy of Applied Development (focusing on
                 sustainability), directs Environmental Management Centre (a strategic consulting company) and teaches at IIT Bombay as Professor 
                 (Adjunct).</p>     
                 <div style="margin-bottom: 0px;" class="post_meta">
                       <span class="lsf-icon" title="mail" <a href="#">prasad.modak@emcentre.com</a></span>   
                   </div>        
          </article>
          </li>
        <li id="simple3Tab">
		 <article class="blog_post">
          
             <div style="width: 20%;" class="three columns">
             <a href="#" class="th"><img width="162px" height="189px" src="images/rakesh.jpg" alt="desc"></a>
             </div>
             <div style="width: 80%;" class="nine columns">
              <a href="#"><h3>Dr. Rakesh Kumar</h3></a>
              <p style="text-align: justify;">Dr. Rakesh Kumar is Chief Scientist and Head Mumbai Zonal center of National Environmental Engineering Research 
                Institute (NEERI), part of CSIR (Council and Scientific and Industrial Research). He completed his M.Tech in Environmental Science & Engineering
                 from IIT Bombay and a Ph.D. in Environmental Engineering. He is qualified ISO 14001 EMS auditor through RAB UK and EARA, USA. His main area of 
                 expertise is in development of appropriate technology for environmental quality improvement encompassing the field of air pollution, particularly
                  vehicle pollution, hazardous waste management, waste water treatment and disposal besides Climate Change and Health related subjects. 
</p>      
          </article>

          <article class="blog_post">
          
             <div style="width: 20%;" class="three columns">
             <a href="#" class="th"><img width="162px" height="189px" src="images/kedia.jpg" alt="desc"></a>
             </div>
             <div style="width: 80%;" class="nine columns">
              <a href="#"><h3>Mr. Kishore Kavadia</h3></a>
              <p style="text-align: justify;"><i>Ex-Advisor, Sustainability, Ambuja Cement </i><br />Mr. Kavadia has 40 years of experience in the Chemical Industry, specifically cement manufacturing in
               various capacities of Design, manufacturing, R&D, Pollution Management. His special interest lies in Sustainability in Cement Industry 
               and Organizational Design for Sustainability Reporting and Communication. He has also been involved in CSR activities, CDM projects and 
               CDP reporting. Presently, he is engaged in Verification & Assurance of Sustainability Reporting. Mr. Kavadia is a Chemical Engineer and 
               holds an MBA in Operations Management.</p>      
          </article>

          <article class="blog_post">
          
             <div style="width: 20%;" class="three columns">
             <a href="#" class="th"><img width="162px" height="189px" src="images/rahul.jpg" alt="desc"></a>
             </div>
             <div style="width: 80%;" class="nine columns">
              <a href="#"><h3>Mr. Rahul Datar</h3></a>
              <p style="text-align: justify;">Rahul Datar completed his Master of Engineering in Environmental Technology Management from the Asian Institute of 
                Technology (AIT) in 1998. He is responsible for business development and delivery of EMC consulting, training and knowledge management projects.<br />
Rahul has extensive experience in preparation, conduct, reporting and training on environmental, health & safety (EHS) assessments for industrial / infrastructural projects.
 He has also worked on due diligence audits for legal compliance, mergers and acquisition transactions, management systems. He is a qualified auditor for ISO 14001 and OHSAS 
 18001 and is trained in air pollution dispersion modelling using ISC and AERMOD applications from Trinity Consultants, USA.
.</p>      
          </article>

        </li>
      </ul>

      </div>
    </div>';
    return $a;
}



function catalog_html_wrapper(){
	foreach ($_SESSION['courses'] as $key => $value) {
		//dump($value);
              $course = $value['general_info'];
              $id = $course['id'];
              $courseName = $course['name'];
              $courseInfo = $course['info'];
              $courseDesc = $courseInfo['general_description'];
              $courseMeta = $course['metadata'];
              $courseDate = $courseMeta['date'];
              $courseAuthor = $courseMeta['creator'];
              $is_course_already_taken = is_course_already_taken($_SESSION['user']['id'],$id);
              if($is_course_already_taken){
              	$explore_text = '<input style="float:right" type="submit"  value="Go to Course" class="button success" />';
              }else{
              	$explore_text = '<input style="float:right" type="submit"  value="Explore" class="button success" />';
              }

              echo '<article course_id="'.$id.'" class="blog_post">          
                    <!--  <div class="three columns">
                         <a href="#" class="th"><img src="images/thumb1.jpg" alt="desc" /></a>
                      </div>
                    <div class="nine columns">-->
                    <div class="columns">
                    <h3>'.$courseName.'</h3>
                    <p>'.$courseDesc.'</p>
                    <div style="margin-bottom: 0px;" class="post_meta">
                       <span class="lsf-icon" title="calendar">'.$courseDate.'</span> 
                       <span class="lsf-icon" title="user" style="margin-left:15px"><a title="Faculty Member" href="faculty.php">'.$courseAuthor.'</a></span>   
                   </div> 

                   <form action="course_info.php" method="post">
					 <input type="hidden" name="course_id" value="'.$course['id'].'">					
					 '.$explore_text.'
					</form>
					                    
                    </div>
            </article>';

          }  
}




?>	