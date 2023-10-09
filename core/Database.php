<?php
class Database {
    private static $instance = null;

    private function __construct() {}

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new PDO('sqlite:database/db.sqlite');
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
?>