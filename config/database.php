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
        $dbUrl = getenv('DATABASE_URL');
        if ($dbUrl) {
            $url = parse_url($dbUrl);
            $this->host = $url['host'] ?? "localhost";
            $this->port = $url['port'] ?? "3306";
            $this->user = $url['user'] ?? "root";
            $this->pass = $url['pass'] ?? "";
            $this->db = ltrim($url['path'] ?? "", '/') ?: "db_pengaduan_sekolah";
        }
        else {
            $this->host = getenv('DB_HOST') ?: "localhost";
            $this->db = getenv('DB_NAME') ?: "db_pengaduan_sekolah";
            $this->user = getenv('DB_USER') ?: "root";
            $this->pass = getenv('DB_PASS') ?: "";
            $this->port = getenv('DB_PORT') ?: "3306";
        }
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
            if (getenv('DB_SSL') === 'true' || getenv('DATABASE_URL')) {
                $caPath = getenv('DB_SSL_CA_PATH');
                $caContent = getenv('DB_SSL_CA');

                if ($caContent) {
                    $tmpCa = sys_get_temp_dir() . '/aiven-ca.pem';
                    file_put_contents($tmpCa, $caContent);
                    $options[PDO::MYSQL_ATTR_SSL_CA] = $tmpCa;
                }
                elseif ($caPath) {
                    $options[PDO::MYSQL_ATTR_SSL_CA] = $caPath;
                }

                // For Aiven, we often need to disable verification if using a self-signed cert
                $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
            }

            return new PDO($dsn, $this->user, $this->pass, $options);
        }
        catch (PDOException $e) {
            die("Koneksi Error: " . $e->getMessage());
        }
    }
}
