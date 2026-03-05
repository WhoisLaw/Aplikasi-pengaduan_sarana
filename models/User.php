<?php
class User
{
    private $conn;
    private $table_name = "users";

    public $id_user;
    public $nama;
    public $username;
    public $password;
    public $role;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && md5($password) === $user['password']) {
            return $user;
        }
        return false;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_user = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getSiswa()
    {
        $query = "SELECT id_user, nama FROM " . $this->table_name . " WHERE role = 'siswa' ORDER BY nama ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register($nama, $username, $password)
    {
        return $this->create($nama, $username, $password, 'siswa');
    }

    public function create($nama, $username, $password, $role)
    {
        // Check if username already exists
        $checkQuery = "SELECT id_user FROM " . $this->table_name . " WHERE username = ? LIMIT 1";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->execute([$username]);
        if ($checkStmt->fetch()) {
            return false;
        }

        $query = "INSERT INTO " . $this->table_name . " (nama, username, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nama, $username, md5($password), $role]);
    }

    public function update($id, $nama, $username, $role, $password = null)
    {
        if ($password) {
            $query = "UPDATE " . $this->table_name . " SET nama = ?, username = ?, role = ?, password = ? WHERE id_user = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$nama, $username, $role, md5($password), $id]);
        }
        else {
            $query = "UPDATE " . $this->table_name . " SET nama = ?, username = ?, role = ? WHERE id_user = ?";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$nama, $username, $role, $id]);
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_user = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>
