<?php
/**
 * Counselor Notes PDF Report
 * Path: templates/CounselorNotes/pdf/pdf_list.php
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
    .badge-active   { background: #d4edda; color: #155724; }
    .badge-closed   { background: #e2e3e5; color: #41464b; }
    .badge-archived { background: #fff3cd; color: #856404; }
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
        <h1>MindEase — Counselor Notes Report</h1>
        <p>UiTM Student Mental Wellness Portal &nbsp;|&nbsp; Generated on <?= date('d M Y, h:i A') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="20%">Assessment</th>
                <th width="25%">Clinical Note</th>
                <th width="13%">Action Taken</th>
                <th width="12%">Follow Up</th>
                <th width="10%">Status</th>
                <th width="15%">Created</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter = 1; ?>
            <?php foreach ($counselorNotes as $note): ?>
            <tr>
                <td><?= $counter++ ?></td>
                <td>
                    <?php if ($note->hasValue('assessment')): ?>
                        Assessment #<?= $note->assessment->id ?>
                        <?php if (isset($note->assessment->user)): ?>
                            <br><?= h($note->assessment->user->fullname) ?>
                        <?php endif; ?>
                    <?php else: ?>
                        —
                    <?php endif; ?>
                </td>
                <td><?= h($note->clinical_note) ?></td>
                <td><?= ucwords(str_replace('_', ' ', h($note->action_taken ?? '—'))) ?></td>
                <td>
                    <?= !empty($note->follow_up_date) ? $note->follow_up_date->format('d M Y') : '—' ?>
                </td>
                <td>
                    <?php if ($note->status == 1): ?>
                        <span class="badge badge-active">Active</span>
                    <?php elseif ($note->status == 2): ?>
                        <span class="badge badge-archived">Archived</span>
                    <?php else: ?>
                        <span class="badge badge-closed">Closed</span>
                    <?php endif; ?>
                </td>
                <td><?= h($note->created) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="report-footer">
        MindEase — Confidential Document. For authorized counseling staff only.<br>
        © <?= date('Y') ?> MindEase, UiTM Student Mental Wellness Portal
    </div>

</body>
</html>