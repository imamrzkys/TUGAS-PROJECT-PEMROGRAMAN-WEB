<?php
require_once __DIR__ . '/BaseModel.php';

/**
 * KRS Model
 */
class KRS extends BaseModel {
    protected $table = 'krs';
    
    /**
     * Get KRS mahasiswa dengan detail kelas dan matakuliah
     */
    public function getKRSMahasiswa($mahasiswaId, $tahunAjaran = null, $semester = null) {
        $sql = "SELECT 
                    k.id as krs_id,
                    k.status as krs_status,
                    k.tahun_ajaran,
                    k.semester,
                    kl.id as kelas_id,
                    kl.kode_kelas,
                    kl.ruangan,
                    kl.hari,
                    kl.jam_mulai,
                    kl.jam_selesai,
                    mk.id as matakuliah_id,
                    mk.kode_matkul,
                    mk.nama_matkul,
                    mk.sks,
                    p.nama_lengkap as nama_dosen
                FROM krs k
                JOIN kelas kl ON k.kelas_id = kl.id
                JOIN mata_kuliah mk ON kl.matakuliah_id = mk.id
                JOIN profiles p ON kl.dosen_id = p.id
                WHERE k.mahasiswa_id = :mahasiswa_id";
        
        $params = ['mahasiswa_id' => $mahasiswaId];
        
        if ($tahunAjaran) {
            $sql .= " AND k.tahun_ajaran = :tahun_ajaran";
            $params['tahun_ajaran'] = $tahunAjaran;
        }
        
        if ($semester) {
            $sql .= " AND k.semester = :semester";
            $params['semester'] = $semester;
        }
        
        $sql .= " ORDER BY kl.hari, kl.jam_mulai";
        
        return $this->query($sql, $params);
    }
    
    /**
     * Tambah KRS
     */
    public function tambahKRS($mahasiswaId, $kelasId, $tahunAjaran, $semester) {
        // Cek apakah sudah terdaftar
        $existing = $this->findOneWhere([
            'mahasiswa_id' => $mahasiswaId,
            'kelas_id' => $kelasId
        ]);
        
        if ($existing) {
            return ['success' => false, 'message' => 'Anda sudah terdaftar di kelas ini'];
        }
        
        // Cek kuota kelas
        $sql = "SELECT k.kuota, COUNT(kr.id) as terisi 
                FROM kelas k 
                LEFT JOIN krs kr ON k.id = kr.kelas_id AND kr.status = 'aktif'
                WHERE k.id = :kelas_id
                GROUP BY k.id, k.kuota";
        
        $kelas = $this->queryOne($sql, ['kelas_id' => $kelasId]);
        
        if ($kelas && $kelas['terisi'] >= $kelas['kuota']) {
            return ['success' => false, 'message' => 'Kuota kelas sudah penuh'];
        }
        
        // Insert KRS
        $data = [
            'mahasiswa_id' => $mahasiswaId,
            'kelas_id' => $kelasId,
            'tahun_ajaran' => $tahunAjaran,
            'semester' => $semester,
            'status' => 'aktif'
        ];
        
        $krsId = $this->insert($data);
        
        return [
            'success' => true,
            'message' => 'Berhasil menambah KRS',
            'id' => $krsId
        ];
    }
    
    /**
     * Hapus KRS
     */
    public function hapusKRS($krsId, $mahasiswaId) {
        $krs = $this->findById($krsId);
        
        if (!$krs || $krs['mahasiswa_id'] != $mahasiswaId) {
            return ['success' => false, 'message' => 'KRS tidak ditemukan'];
        }
        
        $this->delete($krsId);
        
        return ['success' => true, 'message' => 'Berhasil menghapus KRS'];
    }
    
    /**
     * Get total SKS yang diambil mahasiswa
     */
    public function getTotalSKS($mahasiswaId, $tahunAjaran, $semester) {
        $sql = "SELECT COALESCE(SUM(mk.sks), 0) as total_sks
                FROM krs k
                JOIN kelas kl ON k.kelas_id = kl.id
                JOIN mata_kuliah mk ON kl.matakuliah_id = mk.id
                WHERE k.mahasiswa_id = :mahasiswa_id 
                AND k.tahun_ajaran = :tahun_ajaran 
                AND k.semester = :semester
                AND k.status = 'aktif'";
        
        $result = $this->queryOne($sql, [
            'mahasiswa_id' => $mahasiswaId,
            'tahun_ajaran' => $tahunAjaran,
            'semester' => $semester
        ]);
        
        return $result ? $result['total_sks'] : 0;
    }
    
    /**
     * Get daftar mahasiswa di kelas
     */
    public function getMahasiswaKelas($kelasId) {
        $sql = "SELECT 
                    k.id as krs_id,
                    p.id as mahasiswa_id,
                    p.nim,
                    p.nama_lengkap,
                    p.program_studi,
                    p.semester_aktif,
                    k.status
                FROM krs k
                JOIN profiles p ON k.mahasiswa_id = p.id
                WHERE k.kelas_id = :kelas_id
                ORDER BY p.nim";
        
        return $this->query($sql, ['kelas_id' => $kelasId]);
    }
}
