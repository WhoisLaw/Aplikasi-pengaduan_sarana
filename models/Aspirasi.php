<?php
class Aspirasi
{
    private $conn;
    private $table_name = "aspirasi";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($id_user, $id_kategori, $judul, $deskripsi, $foto = null)
    {
        $query = "INSERT INTO " . $this->table_name . " (id_user, id_kategori, judul, deskripsi, tanggal, status, foto) VALUES (?, ?, ?, ?, ?, 'baru', ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id_user, $id_kategori, $judul, $deskripsi, date('Y-m-d'), $foto]);
    }

    public function getBySiswa($id_user)
    {
        $query = "SELECT a.*, k.nama_kategori 
                  FROM " . $this->table_name . " a
                  JOIN kategori k ON a.id_kategori = k.id_kategori
                  WHERE a.id_user = ?
                  ORDER BY a.tanggal DESC LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll($filters = [])
    {
        $query = "SELECT a.*, k.nama_kategori, u.nama as nama_siswa
                  FROM " . $this->table_name . " a
                  JOIN kategori k ON a.id_kategori = k.id_kategori
                  JOIN users u ON a.id_user = u.id_user";

        $conditions = [];
        $params = [];

        if (isset($filters['status']) && $filters['status'] != '') {
            $conditions[] = "a.status = ?";
            $params[] = $filters['status'];
        }
        if (isset($filters['tanggal']) && $filters['tanggal'] != '') {
            $conditions[] = "a.tanggal = ?";
            $params[] = $filters['tanggal'];
        }
        if (isset($filters['kategori']) && $filters['kategori'] != '') {
            $conditions[] = "a.id_kategori = ?";
            $params[] = $filters['kategori'];
        }
        if (isset($filters['id_user']) && $filters['id_user'] != '') {
            $conditions[] = "a.id_user = ?";
            $params[] = $filters['id_user'];
        }
        if (isset($filters['bulan']) && $filters['bulan'] != '') {
            $conditions[] = "MONTH(a.tanggal) = ?";
            $params[] = $filters['bulan'];
        }

        if (count($conditions) > 0) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }

        $query .= " ORDER BY a.tanggal DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id_aspirasi, $status)
    {
        $query = "UPDATE " . $this->table_name . " SET status = ? WHERE id_aspirasi = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$status, $id_aspirasi]);
    }

    public function getDetail($id_aspirasi)
    {
        $query = "SELECT a.*, k.nama_kategori, u.nama as nama_siswa
                  FROM " . $this->table_name . " a
                  JOIN kategori k ON a.id_kategori = k.id_kategori
                  JOIN users u ON a.id_user = u.id_user
                  WHERE a.id_aspirasi = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_aspirasi]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getStats()
    {
        $stats = [];
        $query = "SELECT status, COUNT(*) as count FROM " . $this->table_name . " GROUP BY status";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stats[$row['status']] = $row['count'];
        }
        return $stats;
    }

    public function delete($id_aspirasi)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_aspirasi = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id_aspirasi]);
    }
}
?>
