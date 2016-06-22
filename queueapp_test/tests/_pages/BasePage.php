<?php
namespace QueueApp;

class BasePage
{
    const VERYLOWWAIT = 5;
    const LOWWAIT     = 15;
    const MIDWAIT     = 30;
    const HIWAIT      = 120;

    public static $navigationLink = ".btn-primary";


    protected static $db;

    protected static function init()
    {
        if (!static::$db) {
            static::$db = new \PDO('mysql:host=localhost;dbname=devtest_cdb', 'root', 'root');
        }
    }

    /**
     * Function for dynamic data
     */
    protected static function get()
    {
        static::init();
        $st = static::$db->prepare(
            "SELECT `id` FROM `self_pages_configs` WHERE `name` = ?"
        );
        $st->execute(array(static::$name));
        $result = $st->fetch(\PDO::FETCH_ASSOC);
        return $result['id'];
    }

    /**
     * Getting container name for widget
     */
    public static function container()
    {
        if (!static::$container) {
            static::$container = 'external-templated-' . static::get();
        }
        return static::$container;
    }
}