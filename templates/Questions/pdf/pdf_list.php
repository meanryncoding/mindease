<?php
/**
 * Questions PDF Report
 * Path: templates/Questions/pdf/pdf_list.php
 */
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #333;
        margin: 0;
        padding: 0;
    }
    .report-header {
        text-align: center;
        border-bottom: 3px solid #5b2d8e;
        padding-bottom: 12px;
        margin-bottom: 20px;
    }
    .report-header h1 {
        margin: 0;
        font-size: 20px;
        color: #5b2d8e;
    }
    .report-header p {
        margin: 4px 0 0;
        color: #777;
        font-size: 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    th {
        background: #5b2d8e;
        color: #fff;
        padding: 8px 6px;
        font-size: 10px;
        text-align: left;
        text-transform: uppercase;
    }
    td {
        padding: 7px 6px;
        border-bottom: 1px solid #e0e0e0;
        font-size: 10px;
        vertical-align: top;
    }
    tr:nth-child(even) { background: #f8f5ff; }
    .badge {
        display: inline-block;
        padding: 2px 7px;
        border-radius: 8px;
        font-size: 9px;
        font-weight: bold;
    }
    .badge-a { background: #cfe2ff; color: #084298; }
    .badge-b { background: #fff3cd; color: #856404; }
    .badge-c { background: #d1ecf1; color: #0c5460; }
    .badge-d { background: #d4edda; color: #155724; }
    .badge-active   { background: #d4edda; color: #155724; }
    .badge-inactive { background: #e2e3e5; color: #41464b; }
    .badge-crisis   { background: #f8d7da; color: #721c24; }
    .report-footer {
        margin-top: 25px;
        padding-top: 10px;
        border-top: 1px solid #ccc;
        font-size: 9px;
        color: #999;
        text-align: center;
    }
</style>
</head>
<body>

    <div class="report-header">
        <h1>MindEase — Assessment Questions Report</h1>
        <p>UiTM Student Mental Wellness Portal &nbsp;|&nbsp; Generated on <?= date('d M Y, h:i A') ?></p>
    </div>

    <!-- Summary -->
    <table style="margin-bottom:15px; border:1px solid #dee2e6;">
        <tr>
            <th style="text-align:center; background:#0d6efd;">Section A (PHQ-9)</th>
            <th style="text-align:center; background:#f5a623;">Section B (GAD-7)</th>
            <th style="text-align:center; background:#17c1e8;">Section C (PSS-4)</th>
            <th style="text-align:center; background:#1D9E75;">Section D (Wellbeing)</th>
            <th style="text-align:center; background:#5b2d8e;">Total</th>
        </tr>
        <tr>
            <?php
            $secA = $secB = $secC = $secD = 0;
            foreach ($questions as $q) {
                $sec = strtoupper($q->section ?? '');
                if ($sec == 'A') $secA++;
                elseif ($sec == 'B') $secB++;
                elseif ($sec == 'C') $secC++;
                elseif ($sec == 'D') $secD++;
            }
            $total = $secA + $secB + $secC + $secD;
            ?>
            <td style="text-align:center; font-size:16px; font-weight:bold; color:#0d6efd;"><?= $secA ?></td>
            <td style="text-align:center; font-size:16px; font-weight:bold; color:#f5a623;"><?= $secB ?></td>
            <td style="text-align:center; font-size:16px; font-weight:bold; color:#17c1e8;"><?= $secC ?></td>
            <td style="text-align:center; font-size:16px; font-weight:bold; color:#1D9E75;"><?= $secD ?></td>
            <td style="text-align:center; font-size:16px; font-weight:bold; color:#5b2d8e;"><?= $total ?></td>
        </tr>
    </table>

    <!-- Questions List -->
    <table>
        <thead>
            <tr>
                <th width="4%">#</th>
                <th width="8%">Code</th>
                <th width="10%">Section</th>
                <th width="42%">Question</th>
                <th width="12%">Response Type</th>
                <th width="8%" style="text-align:center;">Max Score</th>
                <th width="8%" style="text-align:center;">Crisis?</th>
                <th width="8%" style="text-align:center;">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter = 1; ?>
            <?php foreach ($questions as $question): ?>
            <?php
            $sec = strtoupper($question->section ?? '');
            $secClass = match($sec) {
                'A' => 'badge-a',
                'B' => 'badge-b',
                'C' => 'badge-c',
                'D' => 'badge-d',
                default => ''
            };
            $secLabel = match($sec) {
                'A' => 'A — Depression',
                'B' => 'B — Anxiety',
                'C' => 'C — Stress',
                'D' => 'D — Wellbeing',
                default => $sec
            };
            ?>
            <tr>
                <td><?= $counter++ ?></td>
                <td><strong><?= h($question->question_code) ?></strong></td>
                <td><span class="badge <?= $secClass ?>"><?= $secLabel ?></span></td>
                <td><?= h($question->question_text) ?></td>
                <td><?= h($question->response_type ?? '—') ?></td>
                <td style="text-align:center;"><?= h($question->max_score ?? '—') ?></td>
                <td style="text-align:center;">
                    <?php if ($question->is_crisis_trigger): ?>
                        <span class="badge badge-crisis">Yes</span>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
                <td style="text-align:center;">
                    <?php if ($question->status == 1): ?>
                        <span class="badge badge-active">Active</span>
                    <?php else: ?>
                        <span class="badge badge-inactive">Inactive</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="report-footer">
        MindEase — Confidential Document. For authorized administrators only.<br>
        © <?= date('Y') ?> MindEase, UiTM Student Mental Wellness Portal
    </div>

</body>
</html>