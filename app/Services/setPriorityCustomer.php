<?php
require_once '../Model/QueueAppModel.php';

if(isset($_REQUEST['id'])){
	$id = $_REQUEST['id'];
	$priority = $_REQUEST['priority'];
	$result = new QueueAppModel();
	$flag = $result->setPriority($id, $priority);
	if($flag){
		$result = array("success"=>1,"message"=>"Customer record updated successfully !!!", "customer_id" => $id);
	}
	else{
		$result = array("success"=>0,"message" => "Error occcured in updating customer record. Please try again later.");
	}
	echo json_encode($result);
}

