<?php
declare(strict_types=1);

namespace App\Controller;

use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
use Cake\Routing\Router;

/**
 * AssessmentsController
 * 
 * Handles all wellness assessment operations for MindEase system.
 * Includes clinical scoring (PHQ-9, GAD-7, PSS-4), risk detection,
 * crisis flagging, and PDF/CSV export functionality.
 * 
 * @property \App\Model\Table\AssessmentsTable $Assessments
 */
class AssessmentsController extends AppController
{
    /**
     * initialize()
     * Load Search component for filtering assessments in index page
     */
    public function initialize(): void
    {
        parent::initialize();

        // Load Search plugin — enables filter/search on index action
        $this->loadComponent('Search.Search', [
            'actions' => ['index'],
        ]);
    }
    
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
    }

    /**
     * json()
     * Returns all assessments in JSON format for API use
     */
    public function json()
    {
        $this->viewBuilder()->setLayout('json');
        $this->set('assessments', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'assessments');
    }
    
    /**
     * csv()
     * Exports all assessments as a downloadable CSV file
     */
    public function csv()
    {
        $this->response = $this->response->withDownload('assessments.csv');
        $assessments = $this->Assessments->find();
        $_serialize = 'assessments';

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('assessments', '_serialize'));
    }
    
    /**
     * pdfList()
     * Generates and downloads a PDF wellness report for all assessments
     * Uses CakePDF plugin in landscape orientation
     */
    public function pdfList()
    {
        // Disable default layout — PDF uses its own template
        $this->viewBuilder()->enableAutoLayout(false);

        // Fetch all assessments with student (user) data
        $assessments = $this->Assessments->find()->contain(['Users'])->all();

        // Use CakePDF renderer
        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        $this->viewBuilder()->setOption(
            'pdfConfig',
            [
                'orientation' => 'landscape',   // Landscape for wide table
                'download'    => true,           // Force download instead of display
                'filename'    => 'MindEase_Wellness_Report.pdf'
            ]
        );
        $this->set(compact('assessments'));
    }

    /**
     * index()
     * Lists assessments with search/filter and pagination.
     * - Student (group 3) : sees only their own assessments
     * - Counselor (group 2) & Admin (group 1) : sees all assessments
     */
    public function index()
    {
        $this->set('title', 'Assessments List');

        // Limit to 10 records per page
        $this->paginate = [
            'maxLimit' => 10,
        ];

        // Get current logged-in user info
        $identity    = $this->Authentication->getIdentity();
        $userGroupId = $identity->get('user_group_id');
        $userId      = $identity->getIdentifier('id');

        // Apply search filter from URL query params, include student data
        $query = $this->Assessments->find('search', search: $this->request->getQueryParams())
    ->contain(['Users', 'CounselorNotes']);

// Filter by review status
$reviewFilter = $this->request->getQuery('review_status');
if ($reviewFilter === 'reviewed') {
    $query->matching('CounselorNotes');
} elseif ($reviewFilter === 'pending') {
    $query->notMatching('CounselorNotes');
}

        // ── Student: tapis rekod milik dia sahaja ─────────────────
        if ($userGroupId == 3) {
            $query->where(['Assessments.user_id' => $userId]);
        }

        $assessments = $this->paginate($query);
        
        // ── Status counts for Report tab ──────────────────────────
        $this->set('total_assessments',          $this->Assessments->find()->count());
        $this->set('total_assessments_archived', $this->Assessments->find()->where(['status' => 2])->count());
        $this->set('total_assessments_active',   $this->Assessments->find()->where(['status' => 1])->count());
        $this->set('total_assessments_disabled', $this->Assessments->find()->where(['status' => 0])->count());

        // ── Risk distribution untuk chart ─────────────────────────
$this->set('risk_critical', $this->Assessments->find()->where(['overall_risk' => 'critical'])->count());
$this->set('risk_high',     $this->Assessments->find()->where(['overall_risk' => 'high'])->count());
$this->set('risk_moderate', $this->Assessments->find()->where(['overall_risk' => 'moderate'])->count());
$this->set('risk_mild',     $this->Assessments->find()->where(['overall_risk' => 'mild'])->count());
$this->set('risk_low',      $this->Assessments->find()->where(['overall_risk' => 'low'])->count());
        
        // ── Monthly count for bar chart ───────────────────────────
        $this->set('january',   $this->Assessments->find()->where(['MONTH(created)' => date('1'),  'YEAR(created)' => date('Y')])->count());
        $this->set('february',  $this->Assessments->find()->where(['MONTH(created)' => date('2'),  'YEAR(created)' => date('Y')])->count());
        $this->set('march',     $this->Assessments->find()->where(['MONTH(created)' => date('3'),  'YEAR(created)' => date('Y')])->count());
        $this->set('april',     $this->Assessments->find()->where(['MONTH(created)' => date('4'),  'YEAR(created)' => date('Y')])->count());
        $this->set('may',       $this->Assessments->find()->where(['MONTH(created)' => date('5'),  'YEAR(created)' => date('Y')])->count());
        $this->set('jun',       $this->Assessments->find()->where(['MONTH(created)' => date('6'),  'YEAR(created)' => date('Y')])->count());
        $this->set('july',      $this->Assessments->find()->where(['MONTH(created)' => date('7'),  'YEAR(created)' => date('Y')])->count());
        $this->set('august',    $this->Assessments->find()->where(['MONTH(created)' => date('8'),  'YEAR(created)' => date('Y')])->count());
        $this->set('september', $this->Assessments->find()->where(['MONTH(created)' => date('9'),  'YEAR(created)' => date('Y')])->count());
        $this->set('october',   $this->Assessments->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
        $this->set('november',  $this->Assessments->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
        $this->set('december',  $this->Assessments->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

        // ── Build last 12 months array for chart labels ───────────
        $query = $this->Assessments->find();
        $expectedMonths = [];
        for ($i = 11; $i >= 0; $i--) {
            $expectedMonths[] = date('M-Y', strtotime("-$i months"));
        }

        // Group submissions by year and month
        $query->select([
            'count' => $query->func()->count('*'),
            'date'  => $query->func()->date_format(['created' => 'identifier', "%b-%Y"]),
            'month' => 'MONTH(created)',
            'year'  => 'YEAR(created)'
        ])
        ->where([
            'created >=' => date('Y-m-01', strtotime('-11 months')),
            'created <=' => date('Y-m-t')
        ])
        ->groupBy(['year', 'month'])
        ->orderBy(['year' => 'ASC', 'month' => 'ASC']);

        $results = $query->all()->toArray();

        // Match results to expected months (fill 0 for months with no data)
        $totalByMonth = [];
        foreach ($expectedMonths as $expectedMonth) {
            $count = 0;
            foreach ($results as $result) {
                if ($expectedMonth === $result->date) {
                    $count = $result->count;
                    break;
                }
            }
            $totalByMonth[] = ['month' => $expectedMonth, 'count' => $count];
        }

        $this->set(['results' => $totalByMonth, '_serialize' => ['results']]);

        // Convert to separate arrays for Chart.js
        $totalByMonth = json_encode($totalByMonth);
        $dataArray    = json_decode($totalByMonth, true);
        $monthArray   = [];
        $countArray   = [];
        foreach ($dataArray as $data) {
            $monthArray[] = $data['month'];
            $countArray[] = $data['count'];
        }

        $this->set(compact('assessments', 'monthArray', 'countArray'));
    }

    /**
     * view()
     * Shows full detail of a single assessment
     * Includes related counselor notes and individual question responses
     * (Responses now contain Questions so question text can be displayed)
     * 
     * @param string|null $id Assessment ID
     */
    public function view($id = null)
    {
        $this->set('title', 'Assessments Details');

        // Load assessment with student info, counselor notes, and responses + questions
        $assessment = $this->Assessments->get($id, contain: ['Users', 'CounselorNotes', 'Responses' => ['Questions']]);
        $this->set(compact('assessment'));
    }

    /**
     * add()
     * Handles new wellness assessment submission
     */
    public function add()
    {
        $this->set('title', 'New Assessments');

        // Log this action to audit trail
        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Assessments']);
                $log->setMetaInfo($log->getMetaInfo() + ['ip'     => $this->request->clientIp()]);
                $log->setMetaInfo($log->getMetaInfo() + ['url'    => Router::url(null, true)]);
                $log->setMetaInfo($log->getMetaInfo() + ['slug'   => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
            }
        });

        // Create empty assessment entity
        $assessment = $this->Assessments->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // ── STEP 1: Calculate PHQ-9 Score (Depression) ────────
            $phq9 = (int)($data['A1'] ?? 0) + (int)($data['A2'] ?? 0) +
                    (int)($data['A3'] ?? 0) + (int)($data['A4'] ?? 0) +
                    (int)($data['A5'] ?? 0) + (int)($data['A6'] ?? 0) +
                    (int)($data['A7'] ?? 0) + (int)($data['A8'] ?? 0) +
                    (int)($data['A9'] ?? 0);

            // ── STEP 2: Calculate GAD-7 Score (Anxiety) ───────────
            $gad7 = (int)($data['B1'] ?? 0) + (int)($data['B2'] ?? 0) +
                    (int)($data['B3'] ?? 0) + (int)($data['B4'] ?? 0) +
                    (int)($data['B5'] ?? 0) + (int)($data['B6'] ?? 0) +
                    (int)($data['B7'] ?? 0);

            // ── STEP 3: Calculate PSS-4 Score (Stress) ────────────
            $pss4 = (int)($data['C1'] ?? 0) + (int)($data['C2'] ?? 0) +
                    (int)($data['C3'] ?? 0) + (int)($data['C4'] ?? 0);

            // ── STEP 4: Determine Depression Level (PHQ-9 Matrix) ─
            if ($phq9 <= 4)      $depressionLevel = 'minimal';
            elseif ($phq9 <= 9)  $depressionLevel = 'mild';
            elseif ($phq9 <= 14) $depressionLevel = 'moderate';
            elseif ($phq9 <= 19) $depressionLevel = 'moderately_severe';
            else                 $depressionLevel = 'severe';

            // ── STEP 5: Determine Anxiety Level (GAD-7 Matrix) ────
            if ($gad7 <= 4)      $anxietyLevel = 'minimal';
            elseif ($gad7 <= 9)  $anxietyLevel = 'mild';
            elseif ($gad7 <= 14) $anxietyLevel = 'moderate';
            else                 $anxietyLevel = 'severe';

            // ── STEP 6: Determine Stress Level (PSS-4 Matrix) ─────
            if ($pss4 <= 4)      $stressLevel = 'low';
            elseif ($pss4 <= 8)  $stressLevel = 'moderate';
            elseif ($pss4 <= 12) $stressLevel = 'high';
            else                 $stressLevel = 'very_high';

            // ── STEP 7: Check Crisis Trigger (Question A9) ────────
            $crisisTrigger = ((int)($data['A9'] ?? 0) > 0) ? 1 : 0;

            // ── STEP 8: Determine Overall Risk Level ──────────────
            if ($crisisTrigger) {
                $overallRisk = 'critical';
                $isFlagged   = 1;
            } elseif ($phq9 >= 15 || $gad7 >= 15) {
                $overallRisk = 'high';
                $isFlagged   = 1;
            } elseif ($phq9 >= 10 || $gad7 >= 10 || $pss4 >= 9) {
                $overallRisk = 'moderate';
                $isFlagged   = 1;
            } elseif ($phq9 >= 5 || $gad7 >= 5 || $pss4 >= 5) {
                $overallRisk = 'mild';
                $isFlagged   = 0;
            } else {
                $overallRisk = 'low';
                $isFlagged   = 0;
            }

            // ── STEP 9: Save assessment with computed scores ───────
            $assessment = $this->Assessments->patchEntity($assessment, [
                'user_id'          => $this->Authentication->getIdentity()->getIdentifier('id'),
                'phq9_score'       => $phq9,
                'gad7_score'       => $gad7,
                'pss4_score'       => $pss4,
                'depression_level' => $depressionLevel,
                'anxiety_level'    => $anxietyLevel,
                'stress_level'     => $stressLevel,
                'overall_risk'     => $overallRisk,
                'is_flagged'       => $isFlagged,
                'crisis_trigger'   => $crisisTrigger,
                'status'           => 1,
                'submitted_at'     => date('Y-m-d H:i:s'),
            ]);

            if ($this->Assessments->save($assessment)) {

                // ── STEP 10: Save individual question responses ────
                // (responses table now only stores: assessment_id, question_id, response_value)
                $questions = $this->fetchTable('Questions')->find()
                    ->where(['status' => 1])
                    ->orderBy(['order_num' => 'ASC'])
                    ->all();

                $responsesTable = $this->fetchTable('Responses');

                foreach ($questions as $question) {
                    $code  = $question->question_code;
                    $value = $data[$code] ?? null;

                    $response = $responsesTable->newEmptyEntity();
                    $responsesTable->patchEntity($response, [
                        'assessment_id'  => $assessment->id,
                        'question_id'    => $question->id,
                        'response_value' => is_numeric($value) ? (int)$value : 0,
                    ]);
                    $responsesTable->save($response);
                }

                // ── STEP 11: Redirect based on risk level ─────────
                if ($crisisTrigger) {
                    $this->Flash->error(__('⚠️ Crisis alert detected! Please seek help immediately. Talian Kasih: 15999 | Befrienders KL: 03-76272929'));
                } else {
                    $this->Flash->success(__('Assessment submitted successfully!'));
                }

                return $this->redirect(['action' => 'view', $assessment->id]);
            }

            $this->Flash->error(__('The assessment could not be saved. Please try again.'));
        }

        $users = $this->Assessments->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('assessment', 'users'));
    }

    /**
     * edit()
     * Allows admin to edit an existing assessment record
     * 
     * @param string|null $id Assessment ID
     */
    public function edit($id = null)
    {
        $this->set('title', 'Assessments Edit');

        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Assessments']);
                $log->setMetaInfo($log->getMetaInfo() + ['ip'     => $this->request->clientIp()]);
                $log->setMetaInfo($log->getMetaInfo() + ['url'    => Router::url(null, true)]);
                $log->setMetaInfo($log->getMetaInfo() + ['slug'   => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
            }
        });

        $assessment = $this->Assessments->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());
            if ($this->Assessments->save($assessment)) {
                $this->Flash->success(__('The assessment has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The assessment could not be saved. Please, try again.'));
        }

        $users = $this->Assessments->Users->find('list', limit: 200)->all();
        $this->set(compact('assessment', 'users'));
    }

    /**
     * delete()
     * Permanently deletes an assessment record
     * 
     * @param string|null $id Assessment ID
     */
    public function delete($id = null)
    {
        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Assessments']);
                $log->setMetaInfo($log->getMetaInfo() + ['ip'     => $this->request->clientIp()]);
                $log->setMetaInfo($log->getMetaInfo() + ['url'    => Router::url(null, true)]);
                $log->setMetaInfo($log->getMetaInfo() + ['slug'   => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
            }
        });

        $this->request->allowMethod(['post', 'delete']);

        $assessment = $this->Assessments->get($id);
        if ($this->Assessments->delete($assessment)) {
            $this->Flash->success(__('The assessment has been deleted.'));
        } else {
            $this->Flash->error(__('The assessment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * archived()
     * Soft-deletes an assessment by setting status to 2 (archived)
     * 
     * @param string|null $id Assessment ID
     */
    public function archived($id = null)
    {
        $this->set('title', 'Assessments Edit');

        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Assessments']);
                $log->setMetaInfo($log->getMetaInfo() + ['ip'     => $this->request->clientIp()]);
                $log->setMetaInfo($log->getMetaInfo() + ['url'    => Router::url(null, true)]);
                $log->setMetaInfo($log->getMetaInfo() + ['slug'   => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
            }
        });

        $assessment = $this->Assessments->get($id, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $assessment = $this->Assessments->patchEntity($assessment, $this->request->getData());
            
            // Set status to 2 = archived (soft delete, data preserved)
            $assessment->status = 2;

            if ($this->Assessments->save($assessment)) {
                $this->Flash->success(__('The assessment has been archived.'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The assessment could not be archived. Please, try again.'));
        }

        $this->set(compact('assessment'));
    }
}