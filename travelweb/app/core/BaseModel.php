<?php

/**
 * Base Model Class
 * 
 * Abstract base class for all models. Provides common database
 * functionality and ensures consistent model structure.
 * 
 * @package Core
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
abstract class BaseModel
{
    /**
     * Database instance
     * 
     * @var Database
     */
    protected $db;

    /**
     * Table name for the model
     * 
     * @var string
     */
    protected $table;

    /**
     * BaseModel constructor
     * 
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Gets a record by ID
     * 
     * @param int $id Record ID
     * @return array|false Record data or false if not found
     */
    public function findById(int $id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Gets all records
     * 
     * @param string $orderBy Order by clause (default: 'id DESC')
     * @return array Array of records
     */
    public function findAll(string $orderBy = 'id DESC'): array
    {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY {$orderBy}");
        return $this->db->resultSet();
    }

    /**
     * Deletes a record by ID
     * 
     * @param int $id Record ID
     * @return int Number of affected rows
     */
    public function delete(int $id): int
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}

