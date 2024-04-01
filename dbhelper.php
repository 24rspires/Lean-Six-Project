<?php

class dbhelper extends mysqli {
    private static dbhelper|NULL $instance = null;

    public static function getInstance(): dbhelper {
        if (dbhelper::$instance === NULL) {
            dbhelper::$instance = new dbhelper();
        }

        return dbhelper::$instance;
    }

    /**
     * Use getInstance instead of constructing new dbhelper
     */
    private function __construct() {
        $dbconfig = parse_ini_file("./db.ini");
        $servername = $dbconfig["servername"];
        $username = $dbconfig["username"];
        $password = $dbconfig["password"];
        $db = $dbconfig["database"];

        $this->connect($servername, $username, $password, $db);
    }
}