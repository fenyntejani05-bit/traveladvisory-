<?php

/**
 * Formatter Helper Class
 * 
 * Provides utility methods for formatting various data types
 * such as currency, dates, and status badges.
 * 
 * @package Helpers
 * @author TravelAdvisor Development Team
 * @version 1.0.0
 */
class Formatter
{
    /**
     * Formats a numeric value as Indian Rupee currency
     * 
     * @param float|int $amount Amount to format
     * @return string Formatted currency string (e.g., "₹ 1,00,000")
     */
    public static function currency($amount): string
    {
        $amountStr = (string) floor($amount);
        $lastThree = substr($amountStr, -3);
        $restUnits = substr($amountStr, 0, -3);
        
        if ($restUnits != '') {
            $lastThree = ',' . $lastThree;
            $restUnits = preg_replace("/\B(?=(\d{2})+(?!\d))/", ",", $restUnits);
        }
        
        return '₹ ' . $restUnits . $lastThree;
    }

    /**
     * Formats a date string to Indonesian date format
     * 
     * @param string $date Date string (any format parseable by strtotime)
     * @param string $format Output format (default: 'd M Y')
     * @return string Formatted date string
     */
    public static function date(string $date, string $format = 'd M Y'): string
    {
        $timestamp = strtotime($date);
        if ($timestamp === false) {
            return $date;
        }
        return date($format, $timestamp);
    }

    /**
     * Formats a date and time string
     * 
     * @param string $dateTime DateTime string
     * @param string $format Output format (default: 'd M Y H:i')
     * @return string Formatted date and time string
     */
    public static function dateTime(string $dateTime, string $format = 'd M Y H:i'): string
    {
        return self::date($dateTime, $format);
    }

    /**
     * Gets the CSS badge class name for a payment status
     * 
     * @param string $status Payment status
     * @return string Badge CSS class name
     */
    public static function getStatusBadge(string $status): string
    {
        $badges = [
            'paid' => 'success',
            'pending' => 'warning',
            'failed' => 'danger',
            'cancelled' => 'secondary'
        ];

        return $badges[strtolower($status)] ?? 'secondary';
    }

    /**
     * Formats a number with thousand separators
     * 
     * @param int|float $number Number to format
     * @param int $decimals Number of decimal places
     * @return string Formatted number string
     */
    public static function number($number, int $decimals = 0): string
    {
        return Formatter::currency((float)$number);
    }

    /**
     * Truncates a string to a specified length
     * 
     * @param string $string String to truncate
     * @param int $length Maximum length
     * @param string $suffix Suffix to append if truncated
     * @return string Truncated string
     */
    public static function truncate(string $string, int $length = 50, string $suffix = '...'): string
    {
        if (mb_strlen($string) <= $length) {
            return $string;
        }

        return mb_substr($string, 0, $length) . $suffix;
    }
}

