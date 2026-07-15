<?php
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
?>

<!--Header-->
<div class="row text-body-secondary">
    <div class="col-12">
        <h1 class="my-0 page_title"><?php echo $title; ?></h1>
        <h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
    </div>
</div>
<div class="line mb-4"></div>

<style>
.stat-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    padding: 1.75rem 1rem;
    text-align: center;
    height: 100%;
}
.stat-card h2 { font-size: 2.6rem; font-weight: 700; margin: 0; }
.stat-card p { color: #6c757d; margin: 0.25rem 0 0; font-size: 0.9rem; }
.stat-blue h2   { color: #0d6efd; }
.stat-red h2    { color: #dc3545; }
.stat-yellow h2 { color: #f5a623; }
.stat-purple h2 { color: #5b2d8e; }
.chart-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    padding: 1.5rem;
    height: 100%;
}
.chart-card .chart-title {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.09em;
    color: #5b2d8e;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f0eafa;
}
.attention-header {
    background: #dc3545;
    color: #fff;
    border-radius: 12px 12px 0 0;
    padding: 0.9rem 1.25rem;
    font-weight: 700;
}
.welcome-banner {
    background: linear-gradient(135deg, #2d1b69 0%, #5b2d8e 55%, #8b5cf6 100%);
    border-radius: 12px;
    padding: 1.75rem 2rem;
    color: #fff;
    margin-bottom: 1.5rem;
}
.welcome-banner h4 { font-weight: 700; margin: 0; }
.welcome-banner p { margin: 0.25rem 0 0; opacity: 0.85; font-size: 0.9rem; }
.quick-action-btn {
    background: rgba(255,255,255,0.15);
    border: 1.5px solid rgba(255,255,255,0.4);
    color: #fff;
    border-radius: 10px;
    padding: 0.5rem 1.25rem;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.2s;
    display: inline-block;
}
.quick-action-btn:hover { background: rgba(255,255,255,0.3); color: #fff; }
</style>

<?php if ($userGroupId == 3): ?>
<!-- ═══════════════════════════════════════════════ -->
<!-- STUDENT DASHBOARD -->
<!-- ═══════════════════════════════════════════════ -->

<!-- Welcome Banner -->
<div class="welcome-banner d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h4>Hi, <?= h($userFullname) ?> 👋</h4>
        <p>How are you feeling today? Take a moment to check in on your mental wellbeing.</p>
    </div>
    <div>
        <?= $this->Html->link('<i class="fa-solid fa-clipboard-question me-1"></i> New Assessment', ['controller' => 'Assessments', 'action' => 'add'], ['class' => 'quick-action-btn', 'escape' => false]) ?>
    </div>
</div>

<!-- Personal Stats -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card stat-purple">
            <h2><?= $my_total ?></h2>
            <p>My Total Assessments</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-red">
            <h2><?= $my_flagged ?></h2>
            <p>Flagged Results</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-blue">
            <h2>
                <?php if ($latest): ?>
                    <span class="badge bg-<?= match($latest->overall_risk) {
                        'critical', 'high' => 'danger',
                        'moderate' => 'warning',
                        'mild' => 'info',
                        default => 'success'
                    } ?>" style="font-size:1.4rem;"><?= strtoupper(h($latest->overall_risk)) ?></span>
                <?php else: ?>
                    —
                <?php endif; ?>
            </h2>
            <p>Latest Risk Level</p>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <!-- Score Trend Chart -->
    <div class="col-md-7">
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-line me-1"></i> My Score Trend</div>
            <?php if (!empty($trendLabels)): ?>
                <canvas id="trendChart"></canvas>
            <?php else: ?>
                <p class="text-muted fst-italic mb-0">No assessments yet — take your first one today!</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Recent History -->
    <div class="col-md-5">
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-clock-rotate-left me-1"></i> Recent Assessments</div>
            <?php if (!empty($myHistory) && count($myHistory->toArray()) > 0): ?>
                <?php foreach ($myHistory as $h): ?>
                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                    <div>
                        <span style="font-size:0.85rem;"><?= !empty($h->submitted_at) ? $h->submitted_at->format('d M Y, g:i A') : '—' ?></span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-<?= match($h->overall_risk) {
                            'critical', 'high' => 'danger',
                            'moderate' => 'warning',
                            'mild' => 'info',
                            default => 'success'
                        } ?>"><?= strtoupper(h($h->overall_risk)) ?></span>
                        <?= $this->Html->link('View', ['controller' => 'Assessments', 'action' => 'view', $h->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted fst-italic mb-0">No assessments yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (!empty($trendLabels)): ?>
<script>
new Chart(document.getElementById('trendChart'), {
    type: 'line',
    data: {
        labels: <?= json_encode($trendLabels) ?>,
        datasets: [
            { label: 'PHQ-9', data: <?= json_encode($trendPhq9) ?>, borderColor: '#0d6efd', backgroundColor: 'rgba(13,110,253,0.08)', tension: 0.3, fill: true },
            { label: 'GAD-7', data: <?= json_encode($trendGad7) ?>, borderColor: '#f5a623', backgroundColor: 'rgba(245,166,35,0.08)', tension: 0.3, fill: true },
            { label: 'PSS-4', data: <?= json_encode($trendPss4) ?>, borderColor: '#17c1e8', backgroundColor: 'rgba(23,193,232,0.08)', tension: 0.3, fill: true }
        ]
    },
    options: {
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } },
        scales: { y: { beginAtZero: true } }
    }
});
</script>
<?php endif; ?>

<?php else: ?>
<!-- ═══════════════════════════════════════════════ -->
<!-- COUNSELOR / ADMIN DASHBOARD -->
<!-- ═══════════════════════════════════════════════ -->

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="stat-card stat-blue">
            <h2><?= $total_assessments ?></h2>
            <p>Total Assessments</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-red">
            <h2><?= $flagged_cases ?></h2>
            <p>Flagged Cases</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card stat-yellow">
            <h2><?= $critical_risk ?></h2>
            <p>Critical Risk</p>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-pie me-1"></i> Risk Distribution</div>
            <canvas id="riskChart"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-column me-1"></i> Assessments (Last 6 Months)</div>
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>
    <div class="col-md-4">
        <div class="chart-card">
            <div class="chart-title"><i class="fa-solid fa-chart-bar me-1"></i> Average Scores</div>
            <canvas id="avgChart"></canvas>
        </div>
    </div>
</div>

<!-- Cases Requiring Attention -->
<div class="card border-0 shadow mb-4" style="border-radius:12px; overflow:hidden;">
    <div class="attention-header">
        <i class="fa-solid fa-triangle-exclamation me-2"></i>Cases Requiring Attention
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-3">Student</th>
                        <th>Risk Level</th>
                        <th class="text-center">PHQ-9</th>
                        <th class="text-center">GAD-7</th>
                        <th class="text-center">PSS-4</th>
                        <th>Submitted</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($attentionCases) && count($attentionCases->toArray()) > 0): ?>
                        <?php foreach ($attentionCases as $case): ?>
                        <tr>
                            <td class="ps-3"><?= h($case->user->fullname ?? 'User #'.$case->user_id) ?></td>
                            <td>
                                <span class="badge bg-<?= match($case->overall_risk) {
                                    'critical', 'high' => 'danger',
                                    'moderate' => 'warning',
                                    default => 'info'
                                } ?>"><?= strtoupper(h($case->overall_risk)) ?></span>
                            </td>
                            <td class="text-center"><?= h($case->phq9_score) ?></td>
                            <td class="text-center"><?= h($case->gad7_score) ?></td>
                            <td class="text-center"><?= h($case->pss4_score) ?></td>
                            <td><?= h($case->submitted_at) ?></td>
                            <td class="text-center">
                                <?= $this->Html->link('View', ['controller' => 'Assessments', 'action' => 'view', $case->id], ['class' => 'btn btn-sm btn-outline-primary']) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fa-solid fa-circle-check me-2 text-success"></i>No cases requiring attention. All good! 🎉
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
new Chart(document.getElementById('riskChart'), {
    type: 'doughnut',
    data: {
        labels: ['Critical', 'High', 'Moderate', 'Mild', 'Low'],
        datasets: [{
            data: [<?= $riskCritical ?>, <?= $riskHigh ?>, <?= $riskModerate ?>, <?= $riskMild ?>, <?= $riskLow ?>],
            backgroundColor: ['#dc3545', '#fd7e14', '#ffc107', '#0dcaf0', '#198754'],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } },
        cutout: '60%'
    }
});

new Chart(document.getElementById('monthlyChart'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($monthLabels) ?>,
        datasets: [{
            label: 'Assessments',
            data: <?= json_encode($monthCounts) ?>,
            backgroundColor: 'rgba(91,45,142,0.25)',
            borderColor: '#5b2d8e',
            borderWidth: 1.5,
            borderRadius: 6
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});

new Chart(document.getElementById('avgChart'), {
    type: 'bar',
    data: {
        labels: ['PHQ-9', 'GAD-7', 'PSS-4'],
        datasets: [{
            label: 'Average Score',
            data: [<?= $avgPhq9 ?>, <?= $avgGad7 ?>, <?= $avgPss4 ?>],
            backgroundColor: ['rgba(13,110,253,0.5)', 'rgba(245,166,35,0.5)', 'rgba(23,193,232,0.5)'],
            borderColor: ['#0d6efd', '#f5a623', '#17c1e8'],
            borderWidth: 1.5,
            borderRadius: 6
        }]
    },
    options: {
        indexAxis: 'y',
        plugins: { legend: { display: false } },
        scales: { x: { beginAtZero: true } }
    }
});
</script>

<?php endif; ?>