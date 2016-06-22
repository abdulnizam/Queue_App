<?php
namespace QueueApp;


class GeneralControllerPage {

    // include url of current page
    static $URL = '';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     */

    public static function route( $param )
    {
        return static::$URL . $param;
    }

    /**
     * @var WebGuy;
     */
    protected $webGuy;

    public function __construct( WebGuy $I )
    {
        $this->webGuy = $I;
    }

    /**
     * @param WebGuy $I
     * @return GeneralControllerPage
     */
    public static function of( WebGuy $I )
    {
        return new static( $I );
    }

    /**
     * @return GeneralControllerPage
     */
    public function go()
    {
        $I = $this->webGuy;

        $I->amOnPageEx( GeneralPage::$URL );

        return $this;
    }

    /**
     * @return GeneralControllerPage
     */
    public function addcustomer()
    {
        $I = $this->webGuy;

        $I->waitForElement( GeneralPage::$brand, 5 );
        $I->click( GeneralPage::$service_type );
        $I->click( GeneralPage::$customer_type );
        $option = $I->grabTextFrom( GeneralPage::$select_title );
        $I->selectOption("select", $option);
        $I->fillField( GeneralPage::$firstname, GeneralPage::$firstname_value );
        $I->fillField( GeneralPage::$lastname, GeneralPage::$lastname_value );
        
        $I->click( GeneralPage::$submitbutton );

        $I->seeElement( GeneralPage::$result );

        return $this;
    }

    /**
     * @return GeneralControllerPage
     */
    public function servecustomer()
    {
        $I = $this->webGuy;
        
        $I->click( GeneralPage::$servebutton );

        $I->dontSee( GeneralPage::$result );

        return $this;
    }

}
