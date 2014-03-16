
<?php 
	error_reporting(0);
	session_start();
	include 'include/paymentfunction.php';
	include 'include/config.php';

	$postData = $_POST;
	//dump($postData);
	$postData['full_name'] = validate_input($postData['full_name']);
	$postData['country'] = validate_input($postData['country']);
	$postData['contact_no'] = validate_input($postData['contact_no']);
	$postData['email_id'] = validate_input($postData['email_id']);
	$postData['address'] = validate_input($postData['address']);

	$merchantId = MERCHANTID;
	$workingKey = WORKINGKEY;
	$redirectUrl = REDIRECTURL;

	$amount = $_SESSION['course']['price'];  
	$orderId = get_order_id($postData); 

	$checkSum = getChecksum($merchantId, $orderId, $amount, $redirectUrl, $workingKey);
	//echo $orderId. '</br>'.$merchantId. '</br>'.$workingKey. '</br>'.$redirectUrl. '</br>'.$amount. '</br>'.$checkSum;	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">	
<form action="https://www.ccavenue.com/shopzone/cc_details.jsp" method="post" name="payment_ccavenue_form" style="display:none;" >
	<input type="hidden" name="Order_Id" value="<?php echo $orderId;?>">
	<input type="hidden" name="Amount" value="<?php echo $amount;?>">
	<input type="hidden" name="Merchant_Id" value="<?php echo $merchantId;?>">
	<input type="hidden" name="Redirect_Url" value="<?php echo $redirectUrl;?>">
	<input type="hidden" name="Checksum" value="<?php echo $checkSum;?>">
	<input type="hidden" name="billing_cust_name" value="<?php echo $postData['full_name'];?>">
	<input type="hidden" name="billing_cust_address" value="<?php echo $postData['address'];?>">
	<input type="hidden" name="billing_cust_country" value="<?php echo $postData['country'];?>">
	<input type="hidden" name="billing_cust_tel" value="<?php echo $postData['contact_no'];?>">
	<input type="hidden" name="billing_cust_email" value="<?php echo $postData['email'];?>">
	<input type="hidden" name="delivery_cust_name" value="<?php echo $postData['full_name'];?>">
	<input type="hidden" name="delivery_cust_address" value="<?php echo $postData['address'];?>">
	<input type="hidden" name="delivery_cust_tel" value="<?php echo $postData['contact_no'];?>">
	<input type="submit" value="Proceed To Buy Now">
</form>	
<div style="width:100%;text-align:center;margin-top:200px;font-size:40px;">Redirecting To Payment Gateway !!!</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		document.payment_ccavenue_form.submit();
	});	
</script>