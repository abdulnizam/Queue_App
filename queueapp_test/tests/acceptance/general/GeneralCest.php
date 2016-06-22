<?php

use QueueApp\LoginControllerPage;


/**
 * @group S1
 */
class GeneralCest {

    /**
     * @param \QueueApp\WebGuy $I
     * @group C001
     */
    public function addcustomer( QueueApp\WebGuy $I )
    {
        $I->wantTo( "C001" );
        GeneralControllerPage::of( $I )
                           ->addcustomer()
                           ->servecustomer();
    }

}