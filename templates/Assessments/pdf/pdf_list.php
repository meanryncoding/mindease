<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\ResultSetInterface $assessments
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MindEase — Wellness Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        h1 { color: #0d6efd; font-size: 20px; margin-bottom: 5px; }
        h2 { font-size: 14px; color: #555; margin-top: 0; }
        .header { text-align: center; border-bottom: 2px solid #0d6efd; padding-bottom: 10px; margin-bottom: 20px; }
        .badge { padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; }
        .critical, .high { background: #f8d7da; color: #842029; }
        .moderate { background: #fff3cd; color: #664d03; }
        .mild { background: #cff4fc; color: #055160; }
        .low { background: #d1e7dd; color: #0a3622; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #0d6efd; color: white; padding: 8px; text-align: left; font-size: 11px; }
        td { padding: 7px 8px; border-bottom: 1px solid #dee2e6; font-size: 11px; }
        tr:nth-child(even) { background: #f8f9fa; }
        .footer { text-align: center; margin-top: 30px; font-size: 10px; color: #aaa; border-top: 1px solid #dee2e6; padding-top: 10px; }
        .flagged { color: #dc3545; font-weight: bold; }
        .summary { display: flex; gap: 10px; margin-bottom: 20px; }
        .summary-box { border: 1px solid #dee2e6; border-radius: 6px; padding: 10px 15px; text-align: center; flex: 1; }
        .summary-box h3 { margin: 0; font-size: 22px; color: #0d6efd; }
        .summary-box p { margin: 3px 0 0; font-size: 10px; color: #777; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1> MindEase — Student Wellness Report</h1>
        <h2>Universiti Teknologi MARA (UiTM)</h2>
        <p>Generated: <?= date('d F Y, h:i A') ?> &nbsp;|&nbsp; Total Records: <?= count($assessments) ?></p>
    </div>

    <!-- Summary -->
    <?php
    $total    = count($assessments);
    $flagged  = 0;
    $critical = 0;
    $high     = 0;
    foreach ($assessments as $a) {
        if ($a->is_flagged)           $flagged++;
        if ($a->overall_risk === 'critical') $critical++;
        if ($a->overall_risk === 'high')     $high++;
    }
    ?>
    <table style="width:100%; border:none; margin-bottom:20px;">
        <tr>
            <td style="text-align:center; border:1px solid #dee2e6; padding:10px; border-radius:6px;">
                <strong style="font-size:22px; color:#0d6efd;"><?= $total ?></strong><br>
                <small>Total Assessments</small>
            </td>
            <td style="text-align:center; border:1px solid #dee2e6; padding:10px; border-radius:6px;">
                <strong style="font-size:22px; color:#dc3545;"><?= $flagged ?></strong><br>
                <small>Flagged Cases</small>
            </td>
            <td style="text-align:center; border:1px solid #dee2e6; padding:10px; border-radius:6px;">
                <strong style="font-size:22px; color:#dc3545;"><?= $critical ?></strong><br>
                <small>Critical Risk</small>
            </td>
            <td style="text-align:center; border:1px solid #dee2e6; padding:10px; border-radius:6px;">
                <strong style="font-size:22px; color:#fd7e14;"><?= $high ?></strong><br>
                <small>High Risk</small>
            </td>
        </tr>
    </table>

    <!-- Table -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>PHQ-9</th>
                <th>Depression</th>
                <th>GAD-7</th>
                <th>Anxiety</th>
                <th>PSS-4</th>
                <th>Stress</th>
                <th>Overall Risk</th>
                <th>Flagged</th>
                <th>Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($assessments as $i => $a): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= h($a->user_id) ?></td>
                <td><?= h($a->phq9_score) ?></td>
                <td><span class="badge <?= h($a->depression_level) ?>"><?= ucwords(str_replace('_', ' ', h($a->depression_level))) ?></span></td>
                <td><?= h($a->gad7_score) ?></td>
                <td><span class="badge <?= h($a->anxiety_level) ?>"><?= ucwords(h($a->anxiety_level)) ?></span></td>
                <td><?= h($a->pss4_score) ?></td>
                <td><span class="badge <?= h($a->stress_level) ?>"><?= ucwords(str_replace('_', ' ', h($a->stress_level))) ?></span></td>
                <td><span class="badge <?= h($a->overall_risk) ?>"><?= strtoupper(h($a->overall_risk)) ?></span></td>
                <td><?= $a->is_flagged ? '<span class="flagged">YES</span>' : 'No' ?></td>
                <td><?= date('d/m/Y h:i A', strtotime($a->submitted_at)) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>MindEase — UiTM Student Mental Wellness Assessment Portal &nbsp;|&nbsp; CONFIDENTIAL</p>
        <p>This report is generated automatically by the system. For clinical use only.</p>
    </div>

</body>
</html>