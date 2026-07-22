<?php
require_once __DIR__ . '/BaseModel.php';

/**
 * User Model
 */
class User extends BaseModel {
    protected $table = 'profiles';
    
    /**
     * Login user
     */
    public function login($nim, $password) {
        $sql = "SELECT * FROM profiles WHERE nim = :nim AND is_active = 1 LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['nim' => $nim]);
        $user = $stmt->fetch();
        
        if (!$user) {
            return ['success' => false, 'message' => 'NIM atau password salah'];
        }
        
        if (!password_verify($password, $user['password_hash'])) {
            return ['success' => false, 'message' => 'NIM atau password salah'];
        }
        
        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nim'] = $user['nim'];
        $_SESSION['user_nama'] = $user['nama_lengkap'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_email'] = $user['email'];
        
        return [
            'success' => true,
            'message' => 'Login berhasil',
            'user' => $user
        ];
    }
    
    /**
     * Logout user
     */
    public function logout() {
        session_destroy();
        return ['success' => true, 'message' => 'Logout berhasil'];
    }
    
    /**
     * Get user by NIM
     */
    public function getUserByNim($nim) {
        return $this->findOneWhere(['nim' => $nim]);
    }
    
    /**
     * Get users by role
     */
    public function getUsersByRole($role) {
        return $this->findWhere(['role' => $role, 'is_active' => 1], 'nama_lengkap', 'ASC');
    }
    
    /**
     * Update password
     */
    public function updatePassword($userId, $oldPassword, $newPassword) {
        $user = $this->findById($userId);
        
        if (!$user) {
            return ['success' => false, 'message' => 'User tidak ditemukan'];
        }
        
        if (!password_verify($oldPassword, $user['password_hash'])) {
            return ['success' => false, 'message' => 'Password lama tidak sesuai'];
        }
        
        if (strlen($newPassword) < 8) {
            return ['success' => false, 'message' => 'Password minimal 8 karakter'];
        }
        
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->update($userId, ['password_hash' => $hashedPassword]);
        
        return ['success' => true, 'message' => 'Password berhasil diubah'];
    }
    
    /**
     * Create new user
     */
    public function createUser($data) {
        // Validasi NIM unik
        if ($this->getUserByNim($data['nim'])) {
            return ['success' => false, 'message' => 'NIM sudah terdaftar'];
        }
        
        // Hash password
        if (isset($data['password'])) {
            $data['password_hash'] = password_hash($data['password'], PASSWORD_BCRYPT);
            unset($data['password']);
        }
        
        $userId = $this->insert($data);
        
        return [
            'success' => true,
            'message' => 'User berhasil ditambahkan',
            'id' => $userId
        ];
    }
    
    /**
     * Update user profile
     */
    public function updateProfile($userId, $data) {
        // Remove fields yang tidak boleh diupdate
        unset($data['password_hash'], $data['nim'], $data['role'], $data['id']);
        
        $this->update($userId, $data);
        
        return ['success' => true, 'message' => 'Profil berhasil diperbarui'];
    }
    
    /**
     * Get mahasiswa dengan filter
     */
    public function getMahasiswa($filters = []) {
        $sql = "SELECT * FROM profiles WHERE role = 'mahasiswa' AND is_active = 1";
        $params = [];
        
        if (!empty($filters['jurusan'])) {
            $sql .= " AND jurusan = :jurusan";
            $params['jurusan'] = $filters['jurusan'];
        }
        
        if (!empty($filters['angkatan'])) {
            $sql .= " AND angkatan = :angkatan";
            $params['angkatan'] = $filters['angkatan'];
        }
        
        $sql .= " ORDER BY nim ASC";
        
        return $this->query($sql, $params);
    }
    
    /**
     * Get dosen
     */
    public function getDosen() {
        return $this->getUsersByRole('dosen');
    }
}
