<?php
class Database
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $port;

    public function __construct()
    {
        $this->host = getenv('DB_HOST') ?: "localhost";
        $this->db = getenv('DB_NAME') ?: "db_pengaduan_sekolah";
        $this->user = getenv('DB_USER') ?: "root";
        $this->pass = getenv('DB_PASS') ?: "";
        $this->port = getenv('DB_PORT') ?: "3306";
    }

    public function connect()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->db;port=$this->port;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            // If we are on Aiven or require SSL
            if (getenv('DB_SSL') === 'true') {
                $options[PDO::MYSQL_ATTR_SSL_CA] = getenv('DB_SSL_CA_PATH') ?: null;
                $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
            }

            return new PDO($dsn, $this->user, $this->pass, $options);
        }
        catch (PDOException $e) {
            die("Koneksi Error: " . $e->getMessage());
        }
    }
}
?>

