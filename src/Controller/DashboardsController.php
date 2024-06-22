<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Table;

class DashboardsController extends AppController
{
	public function index()
	{
		$this->set('title', 'Dashboard');

		$users = $this->fetchTable('Users');
		$total_user = $users->find()->all()->count();

		$contacts = $this->fetchTable('Contacts');
		$total_contact = $contacts->find()->all()->count();

		$auditLogs = $this->fetchTable('auditLogs');
		$total_auditlog = $auditLogs->find()->all()->count();

		$todos = $this->fetchTable('Todos');
		$total_todo = $todos->find()->all()->count();

		/* $userLogs = $this->fetchTable('userLogs');
		$userLogs = $this->userLogs->find('all')
			->where(['user_id' => $this->Identity->get('id')])
			->limit(10)
			->orderBy(['created' => 'DESC']); */

		//debug($activity);
		//exit;

		$this->set(compact('total_user', 'total_contact', 'total_auditlog', 'total_todo'));
	}
}
