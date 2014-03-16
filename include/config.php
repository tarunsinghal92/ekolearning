<?php



define(MERCHANTID, "M_emcentre_6915");

define(WORKINGKEY, "g7gsej28wz4saysq9ugwcivwha43mhfg");

define(REDIRECTURL, "http://www.ekonnect.net/ekolearning/recievepayment.php");

define(ADMIN_EMAIL, "divya.narain@emcentre.net");

define(SERVER_EMAIL, "ekolearning@ekonnect.net");



ini_set("max_execution_time", -1);



function db_connect(){

	$host = "localhost";

	$dbname = "ekonnect_ekolearning";

	$dbpass = "pokemon";

	$user = "ekonnect_tarun2";

	$db = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user , $dbpass);

	return $db;

}



function user_login($userdata){

	$db = db_connect(); 

	$stmt = $db->prepare("SELECT * FROM users where username='".$userdata['username']."' and password='".$userdata['password']."'");

	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if(count($result)>0){

		$_SESSION['user'] = $result[0];

		$db = db_connect();

        $stmt = $db->prepare("SELECT course_id FROM user_course_mapping where user_id=".$_SESSION['user']['id']);

		$stmt->execute();

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$list =array();

		foreach ($result as $key => $value) {

			array_push($list, $value['course_id']);

		}

		$_SESSION['user_course_mapping'] = $list;

	}else{

		echo "No User Found";

	}

}

function user_rollback($user_data){

	$db = db_connect(); 

	$stmt = $db->prepare("DELETE FROM `users` WHERE=".$userdata['id']);

	$stmt->execute();

}



function insert_user_to_db($userdata){

	$db = db_connect();

	$stmt = $db->prepare("SELECT * FROM users where username='".$userdata['username']."' or email='".$userdata['email']."'");

	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	//dump($result);

	if(count($result)==0){

		$stmt = $db->prepare("INSERT INTO users(username,password,firstname,lastname,email) VALUES(:username,:password,:firstname,:lastname,:email)");

		$stmt->execute(array(

							':username' => $userdata['username'],

							':password' => $userdata['password'], 

							':firstname' => $userdata['firstname'], 

							':lastname' => $userdata['lastname'], 

							':email' => $userdata['email']

							));

		return true;

	} 

	return false;

} 

  if(isset($_POST['submit_register'])){

    //register user

    createUser($_POST);

  }



if(isset($_POST['submit_login'])){

    //login user

    user_login($_POST);

  }

function dump($var){

	echo "<pre>";

	print_r($var);

	echo "</pre>";

} 



function xml2array ( $xmlObject, $out = array () )

{

    foreach ( (array) $xmlObject as $index => $node )

        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;



    return $out;

}

function is_course_already_taken($user_id, $course_id){

	$db = db_connect();

	$stmt = $db->prepare("SELECT * FROM `user_course_mapping` WHERE user_id=$user_id and course_id=$course_id");

	$stmt->execute();

	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if(count($result)>0){

		 return true;

	}else{

		return false;

	}

}

function get_order_id($postData){

	$db = db_connect();

	$time = time();

	$stmt = $db->prepare("INSERT INTO orders(users_id,course_id,full_name,email,country,state,city,pincode,contact_no,address,success,time) VALUES(:users_id,:course_id,:full_name,:email,:country,:state,:city,:pincode,:contact_no,:address,:success,:time)");

	$stmt->execute(array(':users_id' => $postData['user_id'], ':course_id' => $postData['course_id'],':full_name' => $postData['full_name'], ':email' => $postData['email_id'], ':country' => $postData['country'], ':state' => $postData['state'], ':city' => $postData['city'], ':pincode' => $postData['pincode'], ':contact_no' => $postData['contact_no'], ':address' => $postData['address'], ':success' => "false", ':time' => $time ));

	$order_id = $db->lastInsertId();

	return $order_id;

}



function update_status_of_order($orderId, $success){

	$db = db_connect();

	$stmt = $db->prepare("UPDATE orders set success = :success where id = :order_id");

	$stmt->execute(array(':success' => $success, ':order_id' => $orderId));	

}



function insert_all_post_data_into_database($postData,$orderId){

	$db = db_connect();

	$stmt = $db->prepare("INSERT INTO `payment_receive` (`orders_id`, `billing_cust_name`, `billing_cust_address`, `billing_cust_state`, `billing_zip_code`, `billing_cust_city`, `billing_cust_country`, `billing_cust_tel`, `billing_cust_email`, `Merchant_Param`, `nb_bid`, `nb_order_no`, `card_category`, `bank_name`, `bankRespCode`, `bankRespMsg`) VALUES (:order_id, :billing_cust_name, :billing_cust_address, :billing_cust_state, :billing_zip_code, :billing_cust_city, :billing_cust_country, :billing_cust_tel, :billing_cust_email, :Merchant_Param, :nb_bid, :nb_order_no, :card_category, :bank_name, :bankRespCode, :bankRespMsg)");



	$stmt->execute(array(':order_id' => $orderId, ':billing_cust_name' => $postData['billing_cust_name'], ':billing_cust_address' => $postData['billing_cust_address'], ':billing_cust_state' => $postData['billing_cust_state'], ':billing_zip_code' => $postData['billing_zip_code'], ':billing_cust_city' => $postData['billing_cust_city'], ':billing_cust_country' => $postData['billing_cust_country'], ':billing_cust_tel' => $postData['billing_cust_tel'], ':billing_cust_email' => $postData['billing_cust_email'], ':Merchant_Param' => $postData['Merchant_Param'], ':nb_bid' => $postData['nb_bid'], ':nb_order_no' => $postData['nb_order_no'], ':card_category' => $postData['card_category'], ':bank_name' => $postData['bank_name'], ':bankRespCode' => $postData['bankRespCode'], ':bankRespMsg' => $postData['bankRespMsg']));

}





function mail_to_user($to_email){ 



	//$to = "tarunsinghaliitd@gmail.com";

	$from = SERVER_EMAIL;

	$headers = "From: " .$from . "\r\n";  

	$headers .= "MIME-Version: 1.0\r\n";

	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$msg = "<html><body><table>

	<tr><td><img src='www.tedxiitd.com/emc/images/logo.png' width='150px' ></td></tr>

	<tr><td>Thanks for buying the Course</td></tr>

	<tr><td>Please Login with your username and password on the URL provided below to get access the course</td></tr>

	<tr><td><strong>http://ekolearning.s3.efrontlearning.com</strong></td></tr>

	</table></body></html>";



	mail($to_email,"Mail",$msg,"FROM: ".$headers);

 

}   

function contact_us_mail($data){

 	$to_email = ADMIN_EMAIL;

 	$from = SERVER_EMAIL; 

	$headers = "From: " .$from . "\r\n";  

	$headers .= "MIME-Version: 1.0\r\n";

	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

	$msg = "<html><body><table>

	<tr><td><img src='www.tedxiitd.com/emc/images/logo.png' width='150px' ></td></tr>

	<tr><td>FROM: '".$data['email']."'</td></tr>

	<tr><td>NAME: '".$data['name']."'</td></tr>

	<tr><td>MESSAGE: '".$data['message']."'</td></tr>

	</table></body></html>";

	mail($to_email,"Mail",$msg,"FROM: ".$headers);

}







?>



