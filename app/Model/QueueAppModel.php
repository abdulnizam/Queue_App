<?php
require_once '../Config/AppConfig.php';
global $con;
$con = mysql_connect($_CONFIG['DBConfig']['host'],$_CONFIG['DBConfig']['user'],$_CONFIG['DBConfig']['password']);
mysql_select_db($_CONFIG['DBConfig']['database'], $con);


/*
 * addCustomer function is used for inserting new customer to the system.
 * $data - array(). details of customer received from UI.
 * returns id of the new customer which is inserted in last transaction
 * 
*/
function addCustomer($data){
	mysql_query("insert into `customers` (`service_type`,`customer_type`, `name`, `processed_on`) values ('".mysql_real_escape_string($data['service_type'])."','".mysql_real_escape_string($data['customer_type'])."','".mysql_real_escape_string($data['name'])."', now())") or die(mysql_error()); // insert the new customer data into the database. mysql_real_escape_string is used to prevent the sql injection hacking method.
	$inserted_id = mysql_insert_id();
	return $inserted_id;
}


/*
* serveCustomer function is used for set the customer is served in the queue.
* $id - integer. id of the customer to be served.
* returns true if update statement executed successfully. otherwise false
*
*/
function serveCustomer($id){
	$updateFlag = mysql_query("update `customers` set `is_served` = 1,`processed_on`= now() where `id` = '".mysql_real_escape_string($id)."'");
	return $updateFlag;
}



/*
 * setPriority function is used for move the customer forward/backward in the queue.
* $id - integer. id of the customer to be served.
* $priority - integer. 0-low, 1-medium, 2-high
* returns true if update record executed successfully. otherwise false
*
*/
function setPriority($id, $priority){
	$updateFlag = mysql_query("update `customers` set `priority` = '".mysql_real_escape_string($priority)."' where `id` = '".mysql_real_escape_string($id)."'");
	return $updateFlag;
}


/*
 * 
 * getCustomers function is used for retriving the customer details which is yet to be served in the queue
 * return array(), list of the customers in the queue. 
 * 
*/
function getCustomers(){
	$query = mysql_query("select * from `customers` where `is_served` = 0 order by `priority` desc, `id` asc");
	$result = array();
	while($row = mysql_fetch_assoc($query)){
		$result[] = $row;
	}
	return $result;
}