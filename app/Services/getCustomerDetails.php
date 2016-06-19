<?php
require_once '../Model/QueueAppModel.php';

$result = getCustomers();
echo json_encode($result);