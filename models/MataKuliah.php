<?php
require_once __DIR__ . '/BaseModel.php';

/**
 * MataKuliah Model
 */
class MataKuliah extends BaseModel {
    protected $table = 'mata_kuliah';
    
    /**
     * Get all mata kuliah dengan filter
     */
    public function getAllMataKuliah($filters = []) {
        $sql = "SELECT * FROM mata_kuliah WHERE 1=1";
        $params = [];
        
        if (!empty($filters['semester'])) {
            $sql .= " AND semester = :semester";
            $params['semester'] = $filters['semester'];
        }
        
        if (!empty($filters['jenis'])) {
            $sql .= " AND jenis = :jenis";
            $params['jenis'] = $filters['jenis'];
        }
        
        $sql .= " ORDER BY semester, kode_matkul";
        
        return $this->query($sql, $params);
    }
    
    /**
     * Get mata kuliah by kode
     */
    public function getByKode($kodeMatkul) {
        return $this->findOneWhere(['kode_matkul' => $kodeMatkul]);
    }
    
    /**
     * Validasi kode mata kuliah unik
     */
    public function isKodeUnique($kodeMatkul, $excludeId = null) {
        $sql = "SELECT COUNT(*) as total FROM mata_kuliah WHERE kode_matkul = :kode";
        $params = ['kode' => $kodeMatkul];
        
        if ($excludeId) {
            $sql .= " AND id != :id";
            $params['id'] = $excludeId;
        }
        
        $result = $this->queryOne($sql, $params);
        return $result['total'] == 0;
    }
    
    /**
     * Create mata kuliah
     */
    public function createMataKuliah($data) {
        if (!$this->isKodeUnique($data['kode_matkul'])) {
            return ['success' => false, 'message' => 'Kode mata kuliah sudah digunakan'];
        }
        
        $id = $this->insert($data);
        return ['success' => true, 'message' => 'Mata kuliah berhasil ditambahkan', 'id' => $id];
    }
    
    /**
     * Update mata kuliah
     */
    public function updateMataKuliah($id, $data) {
        if (isset($data['kode_matkul']) && !$this->isKodeUnique($data['kode_matkul'], $id)) {
            return ['success' => false, 'message' => 'Kode mata kuliah sudah digunakan'];
        }
        
        $this->update($id, $data);
        return ['success' => true, 'message' => 'Mata kuliah berhasil diperbarui'];
    }
}
