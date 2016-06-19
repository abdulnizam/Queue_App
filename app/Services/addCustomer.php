<?php
require_once '../Model/QueueAppModel.php';

if(isset($_REQUEST['service_type'])){
	$data = array();
	$data['service_type']  = $_REQUEST['service_type'];
	$data['customer_type']  =$_REQUEST['customer_type'];
	$data['name']  = $_REQUEST['name'];
	
	$customerId = addCustomer($data);
	if($customerId){
		$result = array("success"=>1,"message"=>"Customer record added successfully !!!", "customer_id" => $customerId);
	}
	else{
		$result = array("success"=>0,"message" => "Error occcured in adding new customer record. Please try again later.");
	}
	echo json_encode(array("success"=>1,"message"=>"Customer record added successfully !!!", "customer_id" => $customerId));
}

