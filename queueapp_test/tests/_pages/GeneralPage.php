<?php
namespace QueueApp;


class GeneralPage {

    // include url of current page
    static $URL = '/';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     */

    public static $brand = ".navbar-brand";

    public static $service_type = ".form-group > .radio.ng-scope:nth-child(1) > label > input";

    public static $customer_type = ".form-group > .btn-group > button:nth-child(0)";

    public static $select_title = "select option:nth-child(1)";

    public static $firstname = "input[ng-model = 'formData.firstName']";

    public static $firstname_value = "Test";

    public static $lastname = "input[ng-model = 'formData.lastName']";

    public static $lastname_value = "Testt";

    public static $submitbutton = "input[type = 'submit']";

    public static $result = "tbody > tr";

    public static $servebutton = "tbody > tr > button.btn-small";


 }