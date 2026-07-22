<?php
require_once __DIR__ . '/BaseModel.php';

/**
 * Pengumuman Model
 */
class Pengumuman extends BaseModel {
    protected $table = 'pengumuman';
    
    /**
     * Get pengumuman yang published
     */
    public function getPublishedPengumuman($limit = null) {
        $sql = "SELECT p.*, prof.nama_lengkap as author_name
                FROM pengumuman p
                LEFT JOIN profiles prof ON p.author_id = prof.id
                WHERE p.is_published = 1
                ORDER BY p.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        
        return $this->query($sql);
    }
    
    /**
     * Get all pengumuman (untuk admin)
     */
    public function getAllPengumuman() {
        $sql = "SELECT p.*, prof.nama_lengkap as author_name
                FROM pengumuman p
                LEFT JOIN profiles prof ON p.author_id = prof.id
                ORDER BY p.created_at DESC";
        
        return $this->query($sql);
    }
    
    /**
     * Get pengumuman by kategori
     */
    public function getByKategori($kategori, $limit = null) {
        $sql = "SELECT p.*, prof.nama_lengkap as author_name
                FROM pengumuman p
                LEFT JOIN profiles prof ON p.author_id = prof.id
                WHERE p.is_published = 1 AND p.kategori = :kategori
                ORDER BY p.created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        
        return $this->query($sql, ['kategori' => $kategori]);
    }
    
    /**
     * Create pengumuman
     */
    public function createPengumuman($data) {
        $id = $this->insert($data);
        return ['success' => true, 'message' => 'Pengumuman berhasil dibuat', 'id' => $id];
    }
}
