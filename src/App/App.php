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

            if (strpos(ROOT, 'src') !== false) {
                require ROOT . '/App/Autoloader.php';
            } else {
                require ROOT . 'src/App/Autoloader.php';
            }
            

            Autoloader::register();

            self::getApp()->getDB();
        }

        return self::$app;
    }

    public function getDB() {
        if ($this->db === null) {
            $this->db = new SQLiteDatabase(ConfigBD::$SQLITE_FILE);
            // $this->db->loadContents();
        }
        return $this->db;
    }

    public function setDB($path) {
        $this->db = new SQLiteDatabase($path);
    }
}

?>
