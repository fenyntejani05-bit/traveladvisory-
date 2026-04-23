<?php

require_once __DIR__ . '/../models/TransactionModel.php';
require_once __DIR__ . '/../models/CartModel.php';

/**
 * Transaction Service
 * 
 * Handles transaction-related business logic including
 * order creation, payment processing, and transaction statistics.
 * 
 * @package Services
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class TransactionService
{
    /**
     * Transaction model instance
     * 
     * @var TransactionModel
     */
    private $transactionModel;

    /**
     * Cart model instance
     * 
     * @var CartModel
     */
    private $cartModel;

    /**
     * TransactionService constructor
     * 
     * Initializes the transaction and cart models.
     */
    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->cartModel = new CartModel();
    }

    /**
     * Creates a new transaction from cart items
     * 
     * Processes checkout by creating transaction and transaction details,
     * then clears the cart.
     * 
     * @param int $userId User ID
     * @param array $customerData Customer information
     * @return array Result array with success status, order ID, and message
     */
    public function createTransactionFromCart(int $userId, array $customerData): array
    {
        $cartItems = $this->cartModel->getCartByUser($userId);

        if (empty($cartItems)) {
            return [
                'success' => false,
                'message' => 'Cart is empty'
            ];
        }

        $totalAmount = $this->calculateTotal($cartItems);
        $orderId = $this->generateOrderId();

        $transactionData = [
            'order_id' => $orderId,
            'user_id' => $userId,
            'customer_name' => $customerData['customer_name'],
            'customer_email' => $customerData['customer_email'],
            'customer_phone' => $customerData['customer_phone'],
            'total_amount' => $totalAmount,
            'payment_method' => $customerData['payment_method']
        ];

        $transactionId = $this->transactionModel->createTransaction($transactionData);

        if (!$transactionId) {
            return [
                'success' => false,
                'message' => 'Failed to create transaction'
            ];
        }

        foreach ($cartItems as $item) {
            $detailData = [
                'transaction_id' => $transactionId,
                'product_id' => $item['product_id'],
                'product_type' => $item['product_type'],
                'product_name' => $item['product_name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'] ?? 1,
                'subtotal' => $item['price'] * ($item['quantity'] ?? 1)
            ];
            $this->transactionModel->addTransactionDetail($detailData);
        }

        $this->cartModel->clearCartByUser($userId);

        return [
            'success' => true,
            'order_id' => $orderId,
            'message' => 'Transaction created successfully'
        ];
    }

    /**
     * Calculates total amount from cart items
     * 
     * @param array $cartItems Array of cart items
     * @return float Total amount
     */
    private function calculateTotal(array $cartItems): float
    {
        $total = 0;
        foreach ($cartItems as $item) {
            $quantity = $item['quantity'] ?? 1;
            $total += $item['price'] * $quantity;
        }
        return $total;
    }

    /**
     * Generates a unique order ID
     * 
     * @return string Order ID
     */
    private function generateOrderId(): string
    {
        return 'TRV-' . time() . rand(10, 99);
    }

    /**
     * Gets dashboard statistics
     * 
     * @return array Array of statistics
     */
    public function getDashboardStats(): array
    {
        return [
            'total_transactions' => $this->transactionModel->getTotalTransactions(),
            'total_revenue' => $this->transactionModel->getTotalRevenue(),
            'pending_transactions' => $this->transactionModel->getPendingTransactions(),
            'paid_transactions' => $this->transactionModel->getPaidTransactions(),
            'monthly_revenue' => $this->transactionModel->getMonthlyRevenue(),
            'revenue_by_month' => $this->transactionModel->getRevenueByMonth(6),
            'recent_transactions' => $this->transactionModel->getRecentTransactions(5)
        ];
    }
}

