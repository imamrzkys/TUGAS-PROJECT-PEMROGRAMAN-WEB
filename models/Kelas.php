<?php
require_once __DIR__ . '/BaseModel.php';

/**
 * Kelas Model
 */
class Kelas extends BaseModel {
    protected $table = 'kelas';
    
    /**
     * Get kelas dengan detail matakuliah dan dosen
     */
    public function getKelasWithDetails($filters = []) {
        $sql = "SELECT 
                    k.id,
                    k.kode_kelas,
                    k.ruangan,
                    k.hari,
                    k.jam_mulai,
                    k.jam_selesai,
                    k.kuota,
                    k.tahun_ajaran,
                    k.semester,
                    k.aktif,
                    mk.kode_matkul,
                    mk.nama_matkul,
                    mk.sks,
                    p.nama_lengkap as nama_dosen,
                    (SELECT COUNT(*) FROM krs WHERE kelas_id = k.id AND status = 'aktif') as jumlah_mahasiswa
                FROM kelas k
                JOIN mata_kuliah mk ON k.matakuliah_id = mk.id
                JOIN profil p ON k.dosen_id = p.id
                WHERE 1=1";
        
        $params = [];
        
        if (!empty($filters['tahun_ajaran'])) {
            $sql .= " AND k.tahun_ajaran = :tahun_ajaran";
            $params['tahun_ajaran'] = $filters['tahun_ajaran'];
        }
        
        if (!empty($filters['semester'])) {
            $sql .= " AND k.semester = :semester";
            $params['semester'] = $filters['semester'];
        }
        
        if (!empty($filters['dosen_id'])) {
            $sql .= " AND k.dosen_id = :dosen_id";
            $params['dosen_id'] = $filters['dosen_id'];
        }
        
        if (isset($filters['aktif'])) {
            $sql .= " AND k.aktif = :aktif";
            $params['aktif'] = $filters['aktif'];
        }
        
        $sql .= " ORDER BY mk.nama_matkul, k.kode_kelas";
        
        return $this->query($sql, $params);
    }
    
    /**
     * Get detail kelas by ID
     */
    public function getKelasDetail($kelasId) {
        $sql = "SELECT 
                    k.*,
                    mk.kode_matkul,
                    mk.nama_matkul,
                    mk.sks,
                    mk.semester as semester_matkul,
                    p.nama_lengkap as nama_dosen,
                    p.email as email_dosen,
                    (SELECT COUNT(*) FROM krs WHERE kelas_id = k.id AND status = 'aktif') as jumlah_mahasiswa
                FROM kelas k
                JOIN mata_kuliah mk ON k.matakuliah_id = mk.id
                JOIN profil p ON k.dosen_id = p.id
                WHERE k.id = :id";
        
        return $this->queryOne($sql, ['id' => $kelasId]);
    }
}
