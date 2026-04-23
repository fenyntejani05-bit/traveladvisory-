<?php

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/BaseModel.php';
require_once __DIR__ . '/../helpers/Security.php';

/**
 * User Model
 * 
 * Handles all database operations related to users including
 * registration, authentication, profile management, and password updates.
 * 
 * @package Models
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class UserModel extends BaseModel
{
    /**
     * Table name for users
     * 
     * @var string
     */
    protected $table = 'users';

    /**
     * Registers a new user
     * 
     * Creates a new user account with hashed password.
     * Default role is set to 'user'.
     * 
     * @param array $data User data containing name, email, and password
     * @return int Number of affected rows (1 on success, 0 on failure)
     */
    public function register(array $data): int
    {
        $query = "INSERT INTO {$this->table} (name, email, password, role) 
                  VALUES (:name, :email, :password, 'user')";
        
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', Security::hashPassword($data['password']));

        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Gets a user by email address
     * 
     * @param string $email User email address
     * @return array|false User data or false if not found
     */
    public function getUserByEmail(string $email)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE email = :email");
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    /**
     * Gets a user by ID
     * 
     * @param int $id User ID
     * @return array|false User data or false if not found
     */
    public function getUserById(int $id)
    {
        return $this->findById($id);
    }

    /**
     * Updates user profile information
     * 
     * Updates name and email for a specific user.
     * 
     * @param int $id User ID
     * @param string $name New name
     * @param string $email New email
     * @return int Number of affected rows
     */
    public function updateProfile(int $id, string $name, string $email): int
    {
        $query = "UPDATE {$this->table} 
                  SET name = :name, email = :email 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('name', $name);
        $this->db->bind('email', $email);
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    /**
     * Updates user password
     * 
     * Hashes the new password before storing it in the database.
     * 
     * @param int $id User ID
     * @param string $newPassword New password (plain text)
     * @return int Number of affected rows
     */
    public function updatePassword(int $id, string $newPassword): int
    {
        $query = "UPDATE {$this->table} 
                  SET password = :password 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('password', Security::hashPassword($newPassword));
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    /**
     * Verifies user password
     * 
     * @param int $id User ID
     * @param string $password Plain text password to verify
     * @return bool True if password matches, false otherwise
     */
    public function verifyPassword(int $id, string $password): bool
    {
        $user = $this->getUserById($id);
        
        if (!$user) {
            return false;
        }

        return Security::verifyPassword($password, $user['password']);
    }

    /**
     * Updates user profile image
     * 
     * @param int $id User ID
     * @param string $fileName Image file name
     * @return int Number of affected rows
     */
    public function updateImage(int $id, string $fileName): int
    {
        $query = "UPDATE {$this->table} 
                  SET image_url = :image 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->bind('image', $fileName);
        $this->db->execute();
        
        return $this->db->rowCount();
    }
}
