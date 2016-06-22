<?php
date_default_timezone_set('Europe/London');

class QueueApp extends PHPUnit_Framework_TestCase
{
	
	protected function setUp()
	{
		
		$this->queueapp = new queueAppModel();
		$this->data = array();
		$this->data['service_type']  = 3;
		$this->data['customer_type']  = 0;
		$this->data['name']  = 'Mrs. test test';
		$this->priority = 2;
		
    }
    
    /**
    *@group queueapp
    */
	public function testAddcustomer()
	{
		$add_customer_id = $this->queueapp->addCustomer($this->data);
		// to test add customer in the queue
		$this->assertTrue( !empty( $add_customer_id ), "last insert id should be available" );

		$get_customers = $this->queueapp->getCustomers();
		// to test the list of customers
		$this->assertTrue( !empty($get_customers), "should return the lists" );

		$set_priority  = $this->queueapp->setPriority($add_customer_id, $this->priority );
		// to test the priority set for the customer
		$this->assertTrue( $set_priority, "should be return true" );

		$serve_customer = $this->queueapp->serveCustomer($add_customer_id);
		// to test serve customer in the queue
		$this->assertTrue( $serve_customer, "should be return true" );
	
	}
	
}