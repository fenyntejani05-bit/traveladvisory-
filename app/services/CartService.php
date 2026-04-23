<?php

require_once __DIR__ . '/../models/CartModel.php';
require_once __DIR__ . '/../models/HomeModel.php';

/**
 * Cart Service
 * 
 * Handles cart-related business logic including
 * adding products to cart and cart management.
 * 
 * @package Services
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class CartService
{
    /**
     * Cart model instance
     * 
     * @var CartModel
     */
    private $cartModel;

    /**
     * Home model instance
     * 
     * @var HomeModel
     */
    private $homeModel;

    /**
     * CartService constructor
     * 
     * Initializes the cart and home models.
     */
    public function __construct()
    {
        $this->cartModel = new CartModel();
        $this->homeModel = new HomeModel();
    }

    /**
     * Adds a product to cart
     * 
     * Validates product existence and adds it to user's cart.
     * 
     * @param int $userId User ID
     * @param string $productType Product type (tour, hotel, car)
     * @param int $productId Product ID
     * @return array Result array with success status and message
     */
    public function addToCart(int $userId, string $productType, int $productId): array
    {
        $product = $this->getProduct($productType, $productId);

        if (!$product) {
            return [
                'success' => false,
                'message' => 'Product not found'
            ];
        }

        $productName = $this->getProductName($product, $productType);

        $cartData = [
            'user_id' => $userId,
            'product_id' => $product['id'],
            'product_type' => $productType,
            'product_name' => $productName,
            'price' => $product['price'],
            'image_url' => $product['image_url']
        ];

        if ($this->cartModel->addItem($cartData) > 0) {
            return [
                'success' => true,
                'message' => 'Product added to cart'
            ];
        }

        return [
            'success' => false,
            'message' => 'Failed to add product to cart'
        ];
    }

    /**
     * Gets product by type and ID
     * 
     * @param string $productType Product type
     * @param int $productId Product ID
     * @return array|false Product data or false if not found
     */
    private function getProduct(string $productType, int $productId)
    {
        switch ($productType) {
            case 'tour':
                return $this->homeModel->getTourById($productId);
            case 'hotel':
                return $this->homeModel->getHotelById($productId);
            case 'car':
                return $this->homeModel->getCarById($productId);
            default:
                return false;
        }
    }

    /**
     * Gets product name based on product type
     * 
     * @param array $product Product data
     * @param string $productType Product type
     * @return string Product name
     */
    private function getProductName(array $product, string $productType): string
    {
        if ($productType === 'tour') {
            return $product['title'];
        }
        return $product['name'] ?? '';
    }
}

