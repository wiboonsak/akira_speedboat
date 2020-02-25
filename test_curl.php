<?php
	//API URL
	$url = 'http://dev.spcthailand.com/api/api_push_booking.php'; http://dev.spcthailand.com/api/api_location_list.php 
	
	$access_token ='f3ef9a0aa89a5100b6657b35bfd46058';
	//create a new cURL resource
	$ch = curl_init($url);
    $route_id_depart ='314';
	$route_id_return  ='310';
	$route_name_dapart ='Koh Tarutao - Pakbara Pier';
	$route_name_return  ='Pakbara Pier - Koh Tarutao';
	$depart_date = '2018-07-15 10:00:00';
	$return_date = '2018-07-18 09:00:00';
	$voucher_no  = 'AABBCC0001';
	$voucher  = 'http://www.xxx.com/voucher-xxx-xxxx-xxx.pdf';
	$amount_adult_price = '2000';
	$amount_child_price  = '500';
	$amount_infant_price ='0';
	$transaction_date  = date("Y-m-d H:i:s");
	$number_adults   = '2';
	$number_childs   = '1';
	$number_infants   = '0';
	$customer_name    = 'Customername';
	$customer_lastname     = 'customer_lastname';
	
	$customer_country     = '';
	$customer_email      = 'abc@abc.com';
	$customer_tel       = '0844567890';
	
	//setup request to send json via POST
	$data = array(
		'access_token' => $access_token,
		'type_trip' => '2',
		'route_id_depart'=>$route_id_depart,
		'route_id_return'=>$route_id_return,
		'route_name_dapart'=>$route_name_dapart,
		'route_name_return '=>$route_name_return ,
		'depart_date'=>	$depart_date,	
		'return_date'=>	$return_date,	
		'voucher_no'=>	$voucher_no ,	
		'voucher'=>	$voucher ,	
		'amount_adult_price'=>	$amount_adult_price ,	
		'amount_child_price'=>	$amount_child_price ,	
		'amount_infant_price'=>	$amount_infant_price ,	
		'transaction_date'=>	$transaction_date ,	
		'number_adults'=>	$number_adults ,	
		'number_childs'=>	$number_childs ,	
		'number_infants'=>	$number_infants ,	
		'customer_name'=>	$customer_name ,	
		'customer_lastname'=>$customer_lastname ,	
		'customer_country'=>	$customer_country ,	
		'customer_email'=>	$customer_email ,	
		'customer_tel'=>	$customer_tel
	);
	
	
	$payload = json_encode(array($data));
print_r($payload);
	//attach encoded JSON string to the POST fields
	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

	//set the content type to application/json
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

	//return response instead of outputting
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	//execute the POST request
	$result = curl_exec($ch);
	
    echo '<br><br><b>result=></b>'.$result;
	
	//close cURL resource
	curl_close($ch);
?>