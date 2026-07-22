<?php
/**
 * Base Model Class
 * Parent class untuk semua model
 */

class BaseModel {
    protected $db;
    protected $table;
    
    public function __construct() {
        $this->db = getDB();
    }
    
    /**
     * Find all records
     */
    public function findAll($orderBy = 'id', $order = 'ASC') {
        $sql = "SELECT * FROM {$this->table} ORDER BY {$orderBy} {$order}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Find by ID
     */
    public function findById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    /**
     * Find with conditions
     */
    public function findWhere($conditions, $orderBy = 'id', $order = 'ASC') {
        $where = [];
        $params = [];
        
        foreach ($conditions as $key => $value) {
            $where[] = "{$key} = :{$key}";
            $params[$key] = $value;
        }
        
        $sql = "SELECT * FROM {$this->table} WHERE " . implode(' AND ', $where) . " ORDER BY {$orderBy} {$order}";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    /**
     * Find one with conditions
     */
    public function findOneWhere($conditions) {
        $where = [];
        $params = [];
        
        foreach ($conditions as $key => $value) {
            $where[] = "{$key} = :{$key}";
            $params[$key] = $value;
        }
        
        $sql = "SELECT * FROM {$this->table} WHERE " . implode(' AND ', $where) . " LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }
    
    /**
     * Insert record
     */
    public function insert($data) {
        $columns = array_keys($data);
        $values = array_values($data);
        
        $placeholders = array_map(function($col) {
            return ":{$col}";
        }, $columns);
        
        $sql = "INSERT INTO {$this->table} (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        
        return $this->db->lastInsertId();
    }
    
    /**
     * Update record
     */
    public function update($id, $data) {
        $set = [];
        $params = ['id' => $id];
        
        foreach ($data as $key => $value) {
            $set[] = "{$key} = :{$key}";
            $params[$key] = $value;
        }
        
        $sql = "UPDATE {$this->table} SET " . implode(', ', $set) . " WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    
    /**
     * Delete record
     */
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
    
    /**
     * Count records
     */
    public function count($conditions = []) {
        if (empty($conditions)) {
            $sql = "SELECT COUNT(*) as total FROM {$this->table}";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } else {
            $where = [];
            $params = [];
            
            foreach ($conditions as $key => $value) {
                $where[] = "{$key} = :{$key}";
                $params[$key] = $value;
            }
            
            $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE " . implode(' AND ', $where);
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
        }
        
        $result = $stmt->fetch();
        return $result['total'];
    }
    
    /**
     * Execute custom query
     */
    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
    
    /**
     * Execute custom query (single result)
     */
    public function queryOne($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    }
}
