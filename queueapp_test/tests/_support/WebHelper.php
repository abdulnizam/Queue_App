<?php
namespace QueueApp\Codeception\Module;

// here you can define custom functions for WebGuy
use \Codeception\SuiteManager;
use \Codeception\TestCase;
use \Codeception\Util\Debug;
use \Codeception\Util\Fixtures;


class WebHelper extends \Codeception\Module
{
    /**
     * @var \Codeception\Module\WebDriver
     */
    public $webDriver;

    public function _initialize()
    {
        $this->webDriver = SuiteManager::$modules['WebDriver'];
        $this->webDriver->webDriver->manage()->window()->maximize();
    }

    public function _before(TestCase $test) {
        Fixtures::cleanup();
        if(isset($this->webDriver)){
            $this->webDriver->webDriver->manage()->window()->maximize();
            Debug::debug('Selenium/Browserstack Session ID: ' . $this->webDriver->webDriver->getSessionID());
        }
    }

    public function amOnPageEx($page) {
        $this->webDriver->wait(1);
        $this->webDriver->amOnPage($page);
        $this->webDriver->wait(10);
    }

    public function waitForTextAjax($selector, $text, $timeout = null) {
        try {
            $this->webDriver->waitForElementChange($selector, function(\WebDriverElement $el) use($text){
                    return $el->getText() == $text;
                },
                $timeout
            );
        } catch (\Exception $e) {
            // nothing
        }
        $this->webDriver->seeInField($selector, $text);
    }

    public function switchToIFrameEx($name = null) {
        $this->webDriver->wait(1);
        $this->webDriver->switchToIFrame($name);
        $this->webDriver->wait(10);
    }
}
