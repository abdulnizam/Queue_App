<?php
require_once '../Model/QueueAppModel.php';


// $result = getCustomers();
$result = new queueAppModel(); 
$result = $result->getCustomers();
echo json_encode($result);