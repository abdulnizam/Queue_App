<?php
require_once dirname(__DIR__) . '/Config/AppConfig.php';

class queueAppModel
{
    
    private $_db;
    
    function __construct()
    {
        global $_CONFIG;
        $this->_db = new PDO('mysql:host=' . $_CONFIG['DBConfig']['host'] . ';dbname=' . $_CONFIG['DBConfig']['database'], $_CONFIG['DBConfig']['user'], $_CONFIG['DBConfig']['password']);
    }
    
    /*
     * addCustomer function is used for inserting new customer to the system.
     * $data - array(). details of customer received from UI.
     * returns id of the new customer which is inserted in last transaction
     * 
     */
    function addCustomer($data)
    {
        $sql  = "insert into `customers` (`service_type`,`customer_type`, `name`, `processed_on`) values (:service_type, :customer_type, :name, now() )";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(":service_type", intval($data['service_type']), PDO::PARAM_INT);
        $stmt->bindParam(":customer_type", intval($data['customer_type']), PDO::PARAM_INT);
        $stmt->bindParam(":name", $data['name'], PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->_db->lastInsertId();
    }
    
    /*
     * serveCustomer function is used for set the customer is served in the queue.
     * $id - integer. id of the customer to be served.
     * returns true if update statement executed successfully. otherwise false
     *
     */
    function serveCustomer($id)
    {
        $sql  = "update `customers` set `is_served` = 1,`processed_on`= now() where `id` = :id";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(":id", intval($id), PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    
    /*
     * setPriority function is used for move the customer forward/backward in the queue.
     * $id - integer. id of the customer to be served.
     * $priority - integer. 0-low, 1-medium, 2-high
     * returns true if update record executed successfully. otherwise false
     *
     */
    function setPriority($id, $priority)
    {
        $sql  = "update `customers` set `priority` = :priority where `id` = :id ";
        $stmt = $this->_db->prepare($sql);
        $stmt->bindParam(":priority", intval($priority), PDO::PARAM_INT);
        $stmt->bindParam(":id", intval($id), PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }
    
    /*
     * 
     * getCustomers function is used for retriving the customer details which is yet to be served in the queue
     * return array(), list of the customers in the queue. 
     * 
     */
    function getCustomers()
    {
        $sql  = "select * from `customers` where `is_served` = 0 order by `priority` desc, `id` asc";
        $stmt = $this->_db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
