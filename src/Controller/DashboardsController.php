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
		$active_user = $users->find()->where(['status' => 1])->count();
		$user_percent = $active_user * 100 / $total_user;

		$contacts = $this->fetchTable('Contacts');
		$total_contact = $contacts->find()->all()->count();
		$pending_contact = $contacts->find()->where(['status' => 0])->count();
		if ($pending_contact == 0) {
			$pending_contact_percent = 0;
		} else
			$pending_contact_percent = $pending_contact * 100 / $total_contact;

		$auditLogs = $this->fetchTable('auditLogs');
		$total_auditlog = $auditLogs->find()->all()->count();

		$todos = $this->fetchTable('Todos');
		$total_todo = $todos->find()->all()->count();
		$pending_todo = $todos->find()->where(['status' => 'Pending'])->count();
		$pending_todo_percent = $pending_todo * 100 / $total_todo;

		$faqs = $this->fetchTable('Faqs');
		$total_faq = $faqs->find()->all()->count();
		$pending_faq = $faqs->find()->where(['status' => 1])->count();
		$pending_faq_percent = $pending_faq * 100 / $total_faq;

		/* $userLogs = $this->fetchTable('userLogs');
		$userLogs = $this->userLogs->find('all')
			->where(['user_id' => $this->Identity->get('id')])
			->limit(10)
			->orderBy(['created' => 'DESC']); */

		//debug($activity);
		//exit;

		$this->set(compact('total_user', 'total_contact', 'total_auditlog', 'total_todo', 'user_percent', 'pending_todo_percent', 'pending_faq_percent', 'pending_contact_percent'));
	}
}
