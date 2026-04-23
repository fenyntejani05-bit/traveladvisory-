<?php

/**
 * Validator Helper Class
 * 
 * Provides validation methods for common input types
 * such as email, phone numbers, and required fields.
 * 
 * @package Helpers
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Validator
{
    /**
     * Validates an email address
     * 
     * @param string $email Email address to validate
     * @return bool True if valid, false otherwise
     */
    public static function email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validates a required field
     * 
     * @param mixed $value Value to check
     * @return bool True if not empty, false otherwise
     */
    public static function required($value): bool
    {
        if (is_string($value)) {
            return trim($value) !== '';
        }
        return !empty($value);
    }

    /**
     * Validates a phone number (Indonesian format)
     * 
     * @param string $phone Phone number to validate
     * @return bool True if valid, false otherwise
     */
    public static function phone(string $phone): bool
    {
        $phone = preg_replace('/[^0-9+]/', '', $phone);
        return preg_match('/^(\+62|62|0)[0-9]{9,12}$/', $phone) === 1;
    }

    /**
     * Validates minimum string length
     * 
     * @param string $value String to validate
     * @param int $min Minimum length
     * @return bool True if valid, false otherwise
     */
    public static function minLength(string $value, int $min): bool
    {
        return mb_strlen($value) >= $min;
    }

    /**
     * Validates maximum string length
     * 
     * @param string $value String to validate
     * @param int $max Maximum length
     * @return bool True if valid, false otherwise
     */
    public static function maxLength(string $value, int $max): bool
    {
        return mb_strlen($value) <= $max;
    }

    /**
     * Validates a numeric value
     * 
     * @param mixed $value Value to validate
     * @return bool True if numeric, false otherwise
     */
    public static function numeric($value): bool
    {
        return is_numeric($value);
    }

    /**
     * Validates minimum numeric value
     * 
     * @param mixed $value Value to validate
     * @param float $min Minimum value
     * @return bool True if valid, false otherwise
     */
    public static function min($value, float $min): bool
    {
        return is_numeric($value) && (float)$value >= $min;
    }

    /**
     * Validates maximum numeric value
     * 
     * @param mixed $value Value to validate
     * @param float $max Maximum value
     * @return bool True if valid, false otherwise
     */
    public static function max($value, float $max): bool
    {
        return is_numeric($value) && (float)$value <= $max;
    }

    /**
     * Validates multiple rules for a value
     * 
     * @param mixed $value Value to validate
     * @param array $rules Array of validation rules
     * @return array Array of error messages (empty if valid)
     */
    public static function validate($value, array $rules): array
    {
        $errors = [];

        foreach ($rules as $rule => $param) {
            switch ($rule) {
                case 'required':
                    if ($param && !self::required($value)) {
                        $errors[] = 'This field is required';
                    }
                    break;
                case 'email':
                    if ($param && !self::email($value)) {
                        $errors[] = 'Invalid email format';
                    }
                    break;
                case 'min_length':
                    if (!self::minLength($value, $param)) {
                        $errors[] = "Minimum length is {$param} characters";
                    }
                    break;
                case 'max_length':
                    if (!self::maxLength($value, $param)) {
                        $errors[] = "Maximum length is {$param} characters";
                    }
                    break;
                case 'numeric':
                    if ($param && !self::numeric($value)) {
                        $errors[] = 'Must be a number';
                    }
                    break;
                case 'min':
                    if (!self::min($value, $param)) {
                        $errors[] = "Minimum value is {$param}";
                    }
                    break;
                case 'max':
                    if (!self::max($value, $param)) {
                        $errors[] = "Maximum value is {$param}";
                    }
                    break;
            }
        }

        return $errors;
    }
}

