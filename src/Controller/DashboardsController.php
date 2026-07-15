<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dashboards Controller
 * Role-aware dashboard:
 * - Student (3)  : personal stats & own latest assessments
 * - Counselor (2) & Admin (1) : system stats, charts, attention cases
 */
class DashboardsController extends AppController
{
    public function index()
    {
        $this->set('title', 'Dashboard');

        $assessmentsTable = $this->fetchTable('Assessments');

        $identity    = $this->Authentication->getIdentity();
        $userGroupId = $identity->get('user_group_id');
        $userId      = $identity->getIdentifier('id');
        $this->set('userGroupId', $userGroupId);
        $this->set('userFullname', $identity->get('fullname'));

        // ═══════════════ STUDENT DASHBOARD (group 3) ═══════════════
        if ($userGroupId == 3) {

            // Personal stats
            $this->set('my_total', $assessmentsTable->find()->where(['user_id' => $userId])->count());
            $this->set('my_flagged', $assessmentsTable->find()->where(['user_id' => $userId, 'is_flagged' => 1])->count());

            // Latest assessment
            $latest = $assessmentsTable->find()
                ->where(['user_id' => $userId])
                ->orderBy(['submitted_at' => 'DESC'])
                ->first();
            $this->set('latest', $latest);

            // Personal history (last 5)
            $myHistory = $assessmentsTable->find()
                ->where(['user_id' => $userId])
                ->orderBy(['submitted_at' => 'DESC'])
                ->limit(5)
                ->all();
            $this->set('myHistory', $myHistory);

            // Personal score trend (last 6 assessments, oldest first)
            $trendQuery = $assessmentsTable->find()
                ->where(['user_id' => $userId])
                ->orderBy(['submitted_at' => 'DESC'])
                ->limit(6)
                ->all()
                ->toArray();
            $trendQuery = array_reverse($trendQuery);

            $trendLabels = [];
            $trendPhq9   = [];
            $trendGad7   = [];
            $trendPss4   = [];
            foreach ($trendQuery as $t) {
                $trendLabels[] = !empty($t->submitted_at) ? $t->submitted_at->format('d M') : '';
                $trendPhq9[]   = $t->phq9_score;
                $trendGad7[]   = $t->gad7_score;
                $trendPss4[]   = $t->pss4_score;
            }
            $this->set(compact('trendLabels', 'trendPhq9', 'trendGad7', 'trendPss4'));

            return; // Student tak perlu data admin
        }

        // ═══════════ COUNSELOR / ADMIN DASHBOARD (group 1 & 2) ═══════════

        // Stat cards
        $this->set('total_assessments', $assessmentsTable->find()->count());
        $this->set('flagged_cases',     $assessmentsTable->find()->where(['is_flagged' => 1])->count());
        $this->set('critical_risk',     $assessmentsTable->find()->where(['overall_risk' => 'critical'])->count());

        // Cases requiring attention
        $attentionCases = $assessmentsTable->find()
            ->contain(['Users'])
            ->where(['is_flagged' => 1])
            ->orderBy(['Assessments.submitted_at' => 'DESC'])
            ->limit(10)
            ->all();
        $this->set(compact('attentionCases'));

        // Chart 1: Risk Distribution
        $riskCritical = $assessmentsTable->find()->where(['overall_risk' => 'critical'])->count();
        $riskHigh     = $assessmentsTable->find()->where(['overall_risk' => 'high'])->count();
        $riskModerate = $assessmentsTable->find()->where(['overall_risk' => 'moderate'])->count();
        $riskMild     = $assessmentsTable->find()->where(['overall_risk' => 'mild'])->count();
        $riskLow      = $assessmentsTable->find()->where(['overall_risk' => 'low'])->count();
        $this->set(compact('riskCritical', 'riskHigh', 'riskModerate', 'riskMild', 'riskLow'));

        // Chart 2: Assessments per month (last 6 months)
        $monthLabels = [];
        $monthCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $monthStart = date('Y-m-01', strtotime("-$i months"));
            $monthEnd   = date('Y-m-t',  strtotime("-$i months"));
            $monthLabels[] = date('M Y', strtotime("-$i months"));
            $monthCounts[] = $assessmentsTable->find()
                ->where([
                    'created >=' => $monthStart . ' 00:00:00',
                    'created <=' => $monthEnd . ' 23:59:59',
                ])
                ->count();
        }
        $this->set(compact('monthLabels', 'monthCounts'));

        // Chart 3: Average scores
        $avgQuery = $assessmentsTable->find();
        $avgResult = $avgQuery->select([
            'avg_phq9' => $avgQuery->func()->avg('phq9_score'),
            'avg_gad7' => $avgQuery->func()->avg('gad7_score'),
            'avg_pss4' => $avgQuery->func()->avg('pss4_score'),
        ])->first();

        $this->set('avgPhq9', round((float)($avgResult->avg_phq9 ?? 0), 1));
        $this->set('avgGad7', round((float)($avgResult->avg_gad7 ?? 0), 1));
        $this->set('avgPss4', round((float)($avgResult->avg_pss4 ?? 0), 1));
    }
}