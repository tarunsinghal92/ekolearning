<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php  
	error_reporting(1);
	session_start(); 
	include 'include/paymentfunction.php';
	include 'include/config.php';
	include 'API/efront_api.php';

	$postData = $_POST;
   // dump($postData);
	$merchantId = MERCHANTID;
	$workingKey = WORKINGKEY;
	
	$amount = $postData['Amount'];
	$orderId = $postData['Order_Id'];

	//dump($_SESSION);
   
  
	/*

Array
(
    [return_url] => http://www.tedxiitd.com/emc/recievepayment.php
    [Order_Id] => 146
    [Amount] => 1.00
    [Merchant_Id] => M_emcentre_6915
    [billing_cust_name] => Tarun Kumar Singhal
    [billing_cust_address] => B-25, Karakoram Hostel
    [billing_cust_state] => delhi
    [billing_zip_code] => 110016
    [billing_cust_city] => delhi
    [billing_cust_country] => India
    [billing_cust_tel] => 9891279606
    [billing_cust_email] => tarunsinghaliitd@gmail.com
    [Notes] => 
    [delivery_cust_name] => N/A
    [delivery_cust_address] => N/A
    [delivery_cust_state] => N/A
    [delivery_cust_city] => N/A
    [delivery_cust_country] => N/A
    [delivery_zip_code] => N/A
    [delivery_cust_tel] => N/A
    [AuthDesc] => Y
    [Checksum] => 1658918133
    [Merchant_Param] => 
    [nb_bid] => IGL7986405
    [nb_order_no] => CCAAI1RME493
    [card_category] => NETBANKING
    [bank_name] => State Bank of India
    [bankRespCode] => Success
    [bankRespMsg] => Completed Successfully
)

	*/ 
	echo '<div style="width:100%;text-align:center;margin-top:200px;font-size:40px;">Redirecting To Main Page !!!</div>';

	$checkSum = $postData['Checksum'];
	$authDesc = $postData['AuthDesc'];    

   // echo $orderId. '</br>'.$merchantId. '</br>'.$workingKey. '</br>'.$authDesc. '</br>'.$amount. '</br>'.$checkSum;

	$isCheckSumVerified = verifyChecksum($merchantId , $orderId, $amount, $authDesc, $workingKey,  $checkSum);

	insert_all_post_data_into_database($postData,intval($orderId) );
	if(($isCheckSumVerified)&&($authDesc=='Y')){
		// user has paid
    	update_status_of_order(intval($orderId) , 'true'); 
    	 assign_free_course_to_user($_SESSION['user']['username'],$_SESSION['course']['course_id'],$_SESSION['user']['email']);
	}
	else{
		// user has not paid
		echo "not verified";
	}
	
?>	

