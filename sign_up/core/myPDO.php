<?PHP
class myPDO{
     private static $connection = NULL;
     
     function __construct() {
          $dns = sprintf("mysql:host=%s:%s;dbname=%s", Config::$db['host'], Config::$db['port'], Config::$db['dbname']);
          self::$connection = new PDO($dns, Config::$db['username'], Config::$db['password']);
          self::$connection->exec("SET CHARACTER SET utf8");
     }
     
     function getConnection(){
          return self::$connection;
     }
     
     
     function closeConnection(){
          self::$connection = NULL;
     }
}
?>
