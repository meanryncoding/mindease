<?php
declare(strict_types=1);

namespace App\Controller;

use AuditStash\Meta\RequestMetadata;
use Cake\Event\EventManager;
use Cake\Routing\Router;

/**
 * CounselorNotes Controller
 *
 * @property \App\Model\Table\CounselorNotesTable $CounselorNotes
 */
class CounselorNotesController extends AppController
{
	public function initialize(): void
	{
		parent::initialize();

		$this->loadComponent('Search.Search', [
			'actions' => ['index'],
		]);
	}
	
	public function beforeFilter(\Cake\Event\EventInterface $event)
	{
		parent::beforeFilter($event);
	}
	
	public function json()
    {
		$this->viewBuilder()->setLayout('json');
        $this->set('counselorNotes', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'counselorNotes');
    }
	
	public function csv()
	{
		$this->response = $this->response->withDownload('counselorNotes.csv');
		$counselorNotes = $this->CounselorNotes->find();
		$_serialize = 'counselorNotes';

		$this->viewBuilder()->setClassName('CsvView.Csv');
		$this->set(compact('counselorNotes', '_serialize'));
	}
	
	public function pdfList()
	{
		$this->viewBuilder()->enableAutoLayout(false); 
        $counselorNotes = $this->CounselorNotes->find()
    ->contain(['Assessments' => ['Users']])
    ->all();
		$this->viewBuilder()->setClassName('CakePdf.Pdf');
		$this->viewBuilder()->setOption(
			'pdfConfig',
			[
				'orientation' => 'portrait',
				'download' => true, 
				'filename' => 'counselorNotes_List.pdf' 
			]
		);
		$this->set(compact('counselorNotes'));
	}

    public function index()
    {
		$this->set('title', 'CounselorNotes List');
		$this->paginate = [
			'maxLimit' => 10,
        ];
       $query = $this->CounselorNotes->find('search', search: $this->request->getQueryParams())
    ->contain(['Assessments' => ['Users'], 'Counselors']);
$counselorNotes = $this->paginate($query);

$this->set('total_counselorNotes', $this->CounselorNotes->find()->count());
		
		$this->set('total_counselorNotes', $this->CounselorNotes->find()->count());
		$this->set('total_counselorNotes_archived', $this->CounselorNotes->find()->where(['status' => 2])->count());
		$this->set('total_counselorNotes_active', $this->CounselorNotes->find()->where(['status' => 1])->count());
		$this->set('total_counselorNotes_disabled', $this->CounselorNotes->find()->where(['status' => 0])->count());
		
		$this->set('january', $this->CounselorNotes->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
		$this->set('february', $this->CounselorNotes->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
		$this->set('march', $this->CounselorNotes->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
		$this->set('april', $this->CounselorNotes->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
		$this->set('may', $this->CounselorNotes->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
		$this->set('jun', $this->CounselorNotes->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
		$this->set('july', $this->CounselorNotes->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
		$this->set('august', $this->CounselorNotes->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
		$this->set('september', $this->CounselorNotes->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
		$this->set('october', $this->CounselorNotes->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
		$this->set('november', $this->CounselorNotes->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
		$this->set('december', $this->CounselorNotes->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

		$query = $this->CounselorNotes->find();
        $expectedMonths = [];
        for ($i = 11; $i >= 0; $i--) {
            $expectedMonths[] = date('M-Y', strtotime("-$i months"));
        }
        $query->select([
            'count' => $query->func()->count('*'),
            'date' => $query->func()->date_format(['created' => 'identifier', "%b-%Y"]),
            'month' => 'MONTH(created)',
            'year' => 'YEAR(created)'
        ])
            ->where([
                'created >=' => date('Y-m-01', strtotime('-11 months')),
                'created <=' => date('Y-m-t')
            ])
            ->groupBy(['year', 'month'])
            ->orderBy(['year' => 'ASC', 'month' => 'ASC']);

        $results = $query->all()->toArray();
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
        $totalByMonth = json_encode($totalByMonth);
        $dataArray = json_decode($totalByMonth, true);
        $monthArray = [];
        $countArray = [];
        foreach ($dataArray as $data) {
            $monthArray[] = $data['month'];
            $countArray[] = $data['count'];
        }
        $this->set(compact('counselorNotes', 'monthArray', 'countArray'));
    }

    public function view($id = null)
    {
		$this->set('title', 'CounselorNotes Details');
        $counselorNote = $this->CounselorNotes->get($id, contain: ['Assessments']);
        $this->set(compact('counselorNote'));
    }

    public function add()
    {
		$this->set('title', 'New CounselorNotes');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Add']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'CounselorNotes']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $counselorNote = $this->CounselorNotes->newEmptyEntity();
        if ($this->request->is('post')) {
            $counselorNote = $this->CounselorNotes->patchEntity($counselorNote, $this->request->getData());
            if ($this->CounselorNotes->save($counselorNote)) {
                $this->Flash->success(__('The counselor note has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The counselor note could not be saved. Please, try again.'));
        }

        // ── Load assessments dengan nama student & tarikh ─────────
        $assessmentsQuery = $this->CounselorNotes->Assessments->find()
            ->contain(['Users'])
            ->orderBy(['Assessments.created' => 'DESC'])
            ->limit(200)
            ->all();

        $assessmentOptions = [];
        foreach ($assessmentsQuery as $a) {
            $studentName = $a->user->fullname ?? 'Unknown Student';
            $date = !empty($a->submitted_at)
                ? $a->submitted_at->format('d M Y')
                : $a->created->format('d M Y');
            $risk = strtoupper($a->overall_risk ?? '');
            $assessmentOptions[$a->id] = $studentName . ' — ' . $date . ' [' . $risk . ']';
        }

        // ── Auto-set counselor = user yang login ──────────────────
        $counselorId = $this->Authentication->getIdentity()->getIdentifier('id');
        $counselorName = $this->Authentication->getIdentity()->get('fullname');

       $preselectedAssessment = $this->request->getQuery('assessment_id');
$this->set(compact('counselorNote', 'assessmentOptions', 'counselorId', 'counselorName', 'preselectedAssessment'));
    }

    public function edit($id = null)
    {
		$this->set('title', 'CounselorNotes Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'CounselorNotes']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $counselorNote = $this->CounselorNotes->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $counselorNote = $this->CounselorNotes->patchEntity($counselorNote, $this->request->getData());
            if ($this->CounselorNotes->save($counselorNote)) {
                $this->Flash->success(__('The counselor note has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The counselor note could not be saved. Please, try again.'));
        }

        // Load assessments dengan nama student untuk edit juga
        $assessmentsQuery = $this->CounselorNotes->Assessments->find()
            ->contain(['Users'])
            ->orderBy(['Assessments.created' => 'DESC'])
            ->limit(200)
            ->all();

        $assessmentOptions = [];
        foreach ($assessmentsQuery as $a) {
            $studentName = $a->user->fullname ?? 'Unknown Student';
            $date = !empty($a->submitted_at)
                ? $a->submitted_at->format('d M Y')
                : $a->created->format('d M Y');
            $risk = strtoupper($a->overall_risk ?? '');
            $assessmentOptions[$a->id] = $studentName . ' — ' . $date . ' [' . $risk . ']';
        }

        $counselorId = $this->Authentication->getIdentity()->getIdentifier('id');
        $counselorName = $this->Authentication->getIdentity()->get('fullname');

        $this->set(compact('counselorNote', 'assessmentOptions', 'counselorId', 'counselorName'));
    }

    public function delete($id = null)
    {
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'CounselorNotes']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $this->request->allowMethod(['post', 'delete']);
        $counselorNote = $this->CounselorNotes->get($id);
        if ($this->CounselorNotes->delete($counselorNote)) {
            $this->Flash->success(__('The counselor note has been deleted.'));
        } else {
            $this->Flash->error(__('The counselor note could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	public function archived($id = null)
    {
		$this->set('title', 'CounselorNotes Edit');
		EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
			foreach ($logs as $log) {
				$log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
				$log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'CounselorNotes']);
				$log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
				$log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
				$log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
			}
		});
        $counselorNote = $this->CounselorNotes->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $counselorNote = $this->CounselorNotes->patchEntity($counselorNote, $this->request->getData());
			$counselorNote->status = 2;
            if ($this->CounselorNotes->save($counselorNote)) {
                $this->Flash->success(__('The counselor note has been archived.'));
				return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The counselor note could not be archived. Please, try again.'));
        }
        $this->set(compact('counselorNote'));
    }
}