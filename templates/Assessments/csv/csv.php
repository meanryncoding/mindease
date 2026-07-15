<?php
/**
 * MindEase - CSV Export Template
 * Exports all assessment data in CSV format
 */

// CSV Headers
echo implode(',', [
    'No',
    'User ID',
    'PHQ-9 Score',
    'Depression Level',
    'GAD-7 Score',
    'Anxiety Level',
    'PSS-4 Score',
    'Stress Level',
    'Overall Risk',
    'Is Flagged',
    'Crisis Trigger',
    'Status',
    'Submitted At'
]) . "\n";

// CSV Data
$i = 1;
foreach ($assessments as $a) {
    echo implode(',', [
        $i++,
        $a->user_id,
        $a->phq9_score,
        '"' . ucwords(str_replace('_', ' ', $a->depression_level)) . '"',
        $a->gad7_score,
        '"' . ucwords($a->anxiety_level) . '"',
        $a->pss4_score,
        '"' . ucwords(str_replace('_', ' ', $a->stress_level)) . '"',
        '"' . strtoupper($a->overall_risk) . '"',
        $a->is_flagged ? 'YES' : 'NO',
        $a->crisis_trigger ? 'YES' : 'NO',
        $a->status,
        '"' . date('d/m/Y h:i A', strtotime($a->submitted_at)) . '"'
    ]) . "\n";
}