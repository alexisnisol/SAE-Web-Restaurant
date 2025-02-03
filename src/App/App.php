<?php

use Config\ConfigBD;
use App\Database\MySQLDatabase;
use App\Autoloader;
use App\Database\SQLiteDatabase;

class App {

    private $db;
    private static $app;

    public static function getApp(): App
    {
        if (is_null(self::$app)) {
            self::$app = new App();

            session_start();

            require ROOT . '/App/Autoloader.php';

            Autoloader::register();

            self::getApp()->getDB();
        }

        return self::$app;
    }

    public function getDB() {
        if ($this->db === null) {
            $this->db = new SQLiteDatabase(ConfigBD::$SQLITE_FILE);
            $this->db->loadContents();
        }
        return $this->db;
    }
}

?>
