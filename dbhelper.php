<?php

class dbhelper extends mysqli {
    static dbhelper $instance;

    public function getInstance(): dbhelper {
        if (dbhelper::$instance === null) {
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