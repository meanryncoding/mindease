<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        $settings = $this->fetchTable('Settings');
        $config = $settings->find('all')->first();
        $this->set('system_name', $config->get('system_name'));
        $this->set('system_abbr', $config->get('system_abbr'));
        $this->set('system_slogan', $config->get('system_slogan'));
        $this->set('organization_name', $config->get('organization_name'));
        $this->set('domain_name', $config->get('domain_name'));
        $this->set('email', $config->get('email'));
        $this->set('notification_email', $config->get('notification_email'));
        $this->set('meta_title', $config->get('meta_title'));
        $this->set('meta_keyword', $config->get('meta_keyword'));
        $this->set('meta_subject', $config->get('meta_subject'));
        $this->set('meta_copyright', $config->get('meta_copyright'));
        $this->set('meta_desc', $config->get('meta_desc'));
        $this->set('timezone', $config->get('timezone'));
        $this->set('author', $config->get('author'));
        $this->set('user_reg', $config->get('user_reg'));
        $this->set('hcaptcha_sitekey', $config->get('hcaptcha_sitekey'));
        $this->set('config_2', $config->get('config_2'));
        $this->set('config_3', $config->get('config_3'));
        $this->set('version', $config->get('version'));
        $this->set('notification', $config->get('notification'));
        $this->set('notification_status', $config->get('notification_status'));
        $this->set('ribbon_title', $config->get('ribbon_title'));
        $this->set('ribbon_link', $config->get('ribbon_link'));
        $this->set('ribbon_status', $config->get('ribbon_status'));
        $this->set('recrud', '2.1.3');
        $this->set('telegram_bot_token', $config->get('telegram_bot_token'));
        $this->set('telegram_chat_id', $config->get('telegram_chat_id'));
        $this->set('metaTitle', $config->get('meta_title'));
        $this->set('metaKeywords', $config->get('meta_keyword'));
        $this->set('metaSubject', $config->get('meta_subject'));
        $this->set('metaCopyright', $config->get('meta_copyright'));
        $this->set('metaDescription', $config->get('meta_desc'));

        // ── MindEase Role Control ──────────────────────
        $identity = $this->Authentication->getIdentity();
        if ($identity) {
            $userGroupId = $identity->get('user_group_id');
            $this->set('user_group_id', $userGroupId);
            $controllerName = $this->request->getParam('controller');

            if ($userGroupId == 3) {
                $allowed = ['Assessments', 'Dashboards', 'Users', 'Faqs', 'Contact', 'Contacts'];
                if (!in_array($controllerName, $allowed)) {
                    $this->Flash->error('You do not have permission to access that page.');
                    return $this->redirect(['controller' => 'Assessments', 'action' => 'add']);
                }
            }

            if ($userGroupId == 2) {
                $allowed = ['Assessments', 'CounselorNotes', 'Dashboards', 'Users', 'Responses', 'Faqs', 'Contact', 'Contacts'];
                if (!in_array($controllerName, $allowed)) {
                    $this->Flash->error('You do not have permission to access that page.');
                    return $this->redirect(['controller' => 'Assessments', 'action' => 'index']);
                }
            }
        }
    }

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Authentication.Authentication');
        $this->loadComponent('Flash');
    }
}