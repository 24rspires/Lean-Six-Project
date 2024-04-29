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
        $root = __DIR__;
        $dbconfig = parse_ini_file("$root/db.ini");
        $servername = trim($dbconfig["servername"]);
        $username = trim($dbconfig["username"]);
        $password = trim($dbconfig["password"]);
        $db = trim($dbconfig["database"]);

        parent::__construct($servername, $username, $password, $db);
    }

    public function insertPFP(int $account_id, string $fileExtension) : string {

        $this->query("INSERT INTO boker.media (media_type, file_path) VALUES ('image', '$account_id/profile.$fileExtension')");

        $insert_id = $this->insert_id;

        $this->query("INSERT INTO boker.agent_media (agent_id, media_id) VALUES($account_id, $insert_id)");

        return "$account_id/profile.$fileExtension";
    }
}