<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Enforcement Helper Functions
 * 
 * Helper functions for enforcement offence catalog management,
 * including period ranking and highest period calculation.
 */

/**
 * Get numeric rank for a suspension period text
 * 
 * Maps period text to a numeric rank for comparison.
 * Handles various text formats by normalizing (lowercase, trim, remove dots).
 * 
 * @param string $period_text The suspension period text (e.g., "2 weeks", "1 Month", "NIL")
 * @return int Rank value (0=NIL, 1=2 weeks, 2=1 month, 3=2 months, 4=4 months, 5=6 months, 6=12 months, 7=Under Investigation, 8=Terminated and Blacklisted), or -1 if unknown
 */
if (!function_exists('get_period_rank')) {
    function get_period_rank($period_text) {
        // Normalize text: lowercase, trim, remove trailing dots
        $normalized = strtolower(trim(rtrim($period_text, '.')));
        
        // Period ranking map
        $rank_map = [
            'nil' => 0,
            '2 weeks' => 1,
            '1 month' => 2,
            '2 months' => 3,
            '4 months' => 4,
            '6 months' => 5,
            '12 months' => 6,
            'under investigation' => 7,  // Special case - highest priority
            'terminated and blacklisted' => 8,  // Special case - highest priority
            'released' => 0,  // Special case - no suspension
        ];
        
        // Return rank, or -1 if period text is unknown
        return isset($rank_map[$normalized]) ? $rank_map[$normalized] : -1;
    }
}

/**
 * Get the highest suspension period from an array of periods
 * 
 * Compares multiple suspension periods and returns the highest one.
 * Used when multiple offences are selected to determine the final suspension period.
 * 
 * @param array $periods_array Array of period text strings
 * @return array Associative array with 'period_text', 'rank', and 'is_suspendable'
 */
if (!function_exists('get_highest_period')) {
    function get_highest_period($periods_array) {
        // Handle empty input
        if (empty($periods_array)) {
            return [
                'period_text' => 'NIL',
                'rank' => 0,
                'is_suspendable' => false
            ];
        }
        
        $highest_rank = -1;
        $highest_period = 'NIL';
        
        // Find the period with the highest rank
        foreach ($periods_array as $period) {
            $rank = get_period_rank($period);
            
            // Log warning for unknown periods but continue processing
            if ($rank === -1) {
                log_message('warning', 'Unknown period text encountered in get_highest_period: ' . $period);
                continue;
            }
            
            if ($rank > $highest_rank) {
                $highest_rank = $rank;
                $highest_period = $period;
            }
        }
        
        // If all periods were unknown, default to NIL
        if ($highest_rank === -1) {
            $highest_rank = 0;
            $highest_period = 'NIL';
        }
        
        return [
            'period_text' => $highest_period,
            'rank' => $highest_rank,
            'is_suspendable' => ($highest_rank > 0)
        ];
    }
}

/**
 * Get offence table name by revision year
 * 
 * Helper function to map revision year to the correct database table.
 * 
 * @param string $revision Revision year ('2019', '2020', '2025')
 * @return string Table name
 */
if (!function_exists('get_offence_table_by_revision')) {
    function get_offence_table_by_revision($revision) {
        $tables = [
            '2019' => 'offendlist',
            '2020' => 'offendlist_2020',
            '2025' => 'offendlist_2025'
        ];
        
        return isset($tables[$revision]) ? $tables[$revision] : 'offendlist';
    }
}

/**
 * Validate revision year
 * 
 * Ensures the revision year is one of the supported values.
 * Falls back to '2019' if invalid.
 * 
 * @param string $revision Revision year to validate
 * @return string Valid revision year
 */
if (!function_exists('validate_revision_year')) {
    function validate_revision_year($revision) {
        $supported = ['2019', '2020', '2025'];
        return in_array($revision, $supported, true) ? $revision : '2019';
    }
}

/**
 * Convert suspension period text to number of days
 * 
 * Converts period text like "2 weeks", "1 month", etc. to days for date calculations.
 * Uses approximate day counts for months (30 days per month).
 * 
 * @param string $period_text The suspension period text (e.g., "2 weeks", "1 month", "2 months")
 * @return int Number of days (0 if period is NIL, Released, or unknown)
 */
if (!function_exists('convert_period_to_days')) {
    function convert_period_to_days($period_text) {
        // Normalize text: lowercase, trim, remove trailing dots
        $normalized = strtolower(trim(rtrim($period_text, '.')));
        
        // Period to days conversion map
        $days_map = [
            'nil' => 0,
            'released' => 0,
            '2 weeks' => 14,
            '1 month' => 30,
            '2 months' => 60,
            '4 months' => 120,
            '6 months' => 180,
            '12 months' => 365,
            'under investigation' => 0,  // No specific end date
            'terminated and blacklisted' => 0,  // No specific end date
        ];
        
        // Return days, or 0 if period text is unknown
        return isset($days_map[$normalized]) ? $days_map[$normalized] : 0;
    }
}

/**
 * Calculate suspension end date based on created date and suspension period
 * 
 * @param string $created_date Date in any valid format (e.g., "2025-11-04 10:30:00")
 * @param string $period_text Suspension period text (e.g., "2 weeks", "1 month")
 * @return string Formatted suspension end date (d-m-Y) or empty string if not applicable
 */
if (!function_exists('calculate_suspension_end_date')) {
    function calculate_suspension_end_date($created_date, $period_text) {
        // Convert period to days
        $days = convert_period_to_days($period_text);
        
        // If no suspension period or zero days, return empty string
        if ($days <= 0) {
            return '';
        }
        
        // Calculate end date
        $start_timestamp = strtotime($created_date);
        $end_timestamp = strtotime("+{$days} days", $start_timestamp);
        
        // Format as d-m-Y (e.g., 04-11-2025)
        return date('d-m-Y', $end_timestamp);
    }
}

/* End of file enforcement_helper.php */
/* Location: ./application/helpers/enforcement_helper.php */



