<?php
require_once __DIR__ . '/BaseModel.php';

/**
 * Nilai Model
 */
class Nilai extends BaseModel {
    protected $table = 'nilai';
    
    /**
     * Get nilai mahasiswa per KRS
     */
    public function getNilaiByKRS($krsId) {
        $sql = "SELECT * FROM nilai WHERE krs_id = :krs_id ORDER BY komponen";
        return $this->query($sql, ['krs_id' => $krsId]);
    }
    
    /**
     * Input atau update nilai
     */
    public function inputNilai($krsId, $komponen, $nilai, $bobot, $keterangan = null) {
        // Validasi nilai
        if ($nilai < 0 || $nilai > 100) {
            return ['success' => false, 'message' => 'Nilai harus antara 0-100'];
        }
        
        // Cek apakah sudah ada
        $existing = $this->findOneWhere([
            'krs_id' => $krsId,
            'komponen' => $komponen
        ]);
        
        $data = [
            'nilai' => $nilai,
            'bobot' => $bobot,
            'keterangan' => $keterangan
        ];
        
        if ($existing) {
            // Update
            $this->update($existing['id'], $data);
            $message = 'Nilai berhasil diperbarui';
        } else {
            // Insert
            $data['krs_id'] = $krsId;
            $data['komponen'] = $komponen;
            $this->insert($data);
            $message = 'Nilai berhasil ditambahkan';
        }
        
        return ['success' => true, 'message' => $message];
    }
    
    /**
     * Hitung nilai akhir per KRS
     */
    public function hitungNilaiAkhir($krsId) {
        $sql = "SELECT COALESCE(SUM(nilai * bobot / 100), 0) as nilai_akhir
                FROM nilai
                WHERE krs_id = :krs_id";
        
        $result = $this->queryOne($sql, ['krs_id' => $krsId]);
        return $result ? $result['nilai_akhir'] : 0;
    }
    
    /**
     * Get transkrip nilai mahasiswa
     */
    public function getTranskrip($mahasiswaId) {
        $sql = "SELECT 
                    k.tahun_ajaran,
                    k.semester,
                    mk.kode_matkul,
                    mk.nama_matkul,
                    mk.sks,
                    COALESCE(SUM(n.nilai * n.bobot / 100), 0) as nilai_akhir,
                    CASE 
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 85 THEN 'A'
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 80 THEN 'A-'
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 75 THEN 'B+'
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 70 THEN 'B'
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 65 THEN 'B-'
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 60 THEN 'C+'
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 55 THEN 'C'
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 40 THEN 'D'
                        ELSE 'E'
                    END AS grade,
                    CASE 
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 85 THEN 4.0
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 80 THEN 3.7
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 75 THEN 3.3
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 70 THEN 3.0
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 65 THEN 2.7
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 60 THEN 2.3
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 55 THEN 2.0
                        WHEN COALESCE(SUM(n.nilai * n.bobot / 100), 0) >= 40 THEN 1.0
                        ELSE 0
                    END AS bobot_nilai
                FROM krs k
                JOIN kelas kl ON k.kelas_id = kl.id
                JOIN mata_kuliah mk ON kl.matakuliah_id = mk.id
                LEFT JOIN nilai n ON n.krs_id = k.id
                WHERE k.mahasiswa_id = :mahasiswa_id
                AND k.status IN ('aktif', 'selesai')
                GROUP BY k.id, k.tahun_ajaran, k.semester, mk.kode_matkul, mk.nama_matkul, mk.sks
                ORDER BY k.tahun_ajaran, k.semester, mk.kode_matkul";
        
        return $this->query($sql, ['mahasiswa_id' => $mahasiswaId]);
    }
    
    /**
     * Hitung IPK mahasiswa
     */
    public function hitungIPK($mahasiswaId) {
        $transkrip = $this->getTranskrip($mahasiswaId);
        
        if (empty($transkrip)) {
            return 0;
        }
        
        $totalBobotNilai = 0;
        $totalSKS = 0;
        
        foreach ($transkrip as $nilai) {
            $totalBobotNilai += ($nilai['bobot_nilai'] * $nilai['sks']);
            $totalSKS += $nilai['sks'];
        }
        
        if ($totalSKS == 0) {
            return 0;
        }
        
        return round($totalBobotNilai / $totalSKS, 2);
    }
    
    /**
     * Get nilai untuk kelas tertentu (untuk dosen)
     */
    public function getNilaiKelas($kelasId) {
        $sql = "SELECT 
                    p.nim,
                    p.nama_lengkap,
                    k.id as krs_id,
                    GROUP_CONCAT(
                        CONCAT(n.komponen, ':', n.nilai) 
                        ORDER BY n.komponen 
                        SEPARATOR '|'
                    ) as nilai_detail,
                    COALESCE(SUM(n.nilai * n.bobot / 100), 0) as nilai_akhir
                FROM krs k
                JOIN profil p ON k.mahasiswa_id = p.id
                LEFT JOIN nilai n ON n.krs_id = k.id
                WHERE k.kelas_id = :kelas_id
                AND k.status = 'aktif'
                GROUP BY k.id, p.nim, p.nama_lengkap
                ORDER BY p.nim";
        
        return $this->query($sql, ['kelas_id' => $kelasId]);
    }
}
