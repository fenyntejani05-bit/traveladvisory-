<?php

require_once __DIR__ . '/../core/BaseModel.php';

class ProfileModel extends BaseModel
{
    public function getPlanHistory(int $user_id): array
    {
        $this->db->query('SELECT * FROM plan_history WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function savePlanHistory(int $user_id, string $climate, string $budget, string $activity, string $date_range): bool
    {
        $this->db->query('INSERT INTO plan_history (user_id, climate, budget, activity, date_range) VALUES (:user_id, :climate, :budget, :activity, :date_range)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':climate', $climate);
        $this->db->bind(':budget', $budget);
        $this->db->bind(':activity', $activity);
        $this->db->bind(':date_range', $date_range);
        
        return $this->db->execute();
    }

    public function getWishlistTours(int $user_id): array
    {
        $this->db->query('
            SELECT t.*, w.created_at as wishlist_added 
            FROM wishlists w 
            JOIN tours t ON w.item_id = t.id 
            WHERE w.user_id = :user_id AND w.item_type = "tour"
            ORDER BY w.created_at DESC
        ');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function getWishlistHotels(int $user_id): array
    {
        $this->db->query('
            SELECT h.*, w.created_at as wishlist_added 
            FROM wishlists w 
            JOIN hotels h ON w.item_id = h.id 
            WHERE w.user_id = :user_id AND w.item_type = "hotel"
            ORDER BY w.created_at DESC
        ');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }

    public function addWishlist(int $user_id, int $item_id, string $item_type): bool
    {
        // First check if it exists
        if ($this->checkWishlist($user_id, $item_id, $item_type)) {
            return true; // Already exists
        }

        $this->db->query('INSERT INTO wishlists (user_id, item_id, item_type) VALUES (:user_id, :item_id, :item_type)');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':item_id', $item_id);
        $this->db->bind(':item_type', $item_type);
        
        return $this->db->execute();
    }

    public function removeWishlist(int $user_id, int $item_id, string $item_type): bool
    {
        $this->db->query('DELETE FROM wishlists WHERE user_id = :user_id AND item_id = :item_id AND item_type = :item_type');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':item_id', $item_id);
        $this->db->bind(':item_type', $item_type);
        
        return $this->db->execute();
    }

    public function checkWishlist(int $user_id, int $item_id, string $item_type): bool
    {
        $this->db->query('SELECT id FROM wishlists WHERE user_id = :user_id AND item_id = :item_id AND item_type = :item_type');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':item_id', $item_id);
        $this->db->bind(':item_type', $item_type);
        
        $this->db->execute();
        return $this->db->rowCount() > 0;
    }
}
