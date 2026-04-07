<?php
class Feedback
{
    private $conn;
    private $table_name = "feedback";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($id_aspirasi, $isi_feedback, $foto = null)
    {
        $query = "INSERT INTO " . $this->table_name . " (id_aspirasi, isi_feedback, tanggal_feedback, foto) VALUES (?, ?, ?, ?)";
        try {
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([$id_aspirasi, $isi_feedback, date('Y-m-d'), $foto]);
        } catch (PDOException $e) {
            // Auto-heal if the database wasn't migrated to LONGTEXT
            if (strpos($e->getMessage(), '1406') !== false || strpos($e->getMessage(), '22001') !== false) {
                $this->conn->exec("ALTER TABLE " . $this->table_name . " MODIFY COLUMN foto LONGTEXT NULL");
                $stmt = $this->conn->prepare($query);
                return $stmt->execute([$id_aspirasi, $isi_feedback, date('Y-m-d'), $foto]);
            }
            throw $e;
        }
    }

    public function getByAspirasi($id_aspirasi)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_aspirasi = ? ORDER BY tanggal_feedback DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_aspirasi]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
