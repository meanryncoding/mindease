<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\Http\ServerRequest;
use AuditStash\Meta\ApplicationMetadata;
use Cake\Event\EventManager;
use Cake\ORM\Table;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('UserLogs');
        /* $this->loadComponent('Search.Search', [
            'actions' => ['index'],
        ]); */
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authentication->allowUnauthenticated(['login', 'registration', 'forgotPassword', 'forgotUsername', 'resetPassword', 'verify']);
    }

    public function login()
    {
        $this->set('title', 'Sign-in');
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/dashboard';
            $this->UserLogs->userLoginActivity($this->Authentication->getIdentity('id')->getIdentifier('id'));
            $this->updateLoginFields(); //capture ip and login time
            $session = $this->request->getSession();
            return $this->redirect($target);
        }
        if ($this->request->is('post')) {
            $this->Flash->error('Invalid username or password');
        }
    }

    protected function updateLoginFields()
    {
        //$userTable = TableRegistry::get('Users');
        $userTable = TableRegistry::getTableLocator()->get('Users');
        $user = $this->Authentication->getIdentity();
        $this->request->getSession()->write('User.last_login', date("Y-m-d H:i:s"));
        $this->request->getSession()->write('User.ip_address', $this->request->clientIp());
        $updateData = [
            'last_login' => date("Y-m-d H:i:s"),
            'ip_address' => $this->request->clientIp(),
        ];
        $this->Users->updateQuery()->set($updateData)->where(['id' => $user['id']])->execute();
    }

    public function logout()
    {
        $this->UserLogs->userLogoutActivity($this->Authentication->getIdentity('id')->getIdentifier('id'));
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function forgotUsername()
    {
        $this->set('title', 'Forgot Username');
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            //$userTable = TableRegistry::get('Users');
            //$userTable = TableRegistry::getTableLocator()->get('Users');
            //$userTable = TableRegistry::get('Users');
            $userTable = TableRegistry::getTableLocator()->get('Users');

            if ($email == NULL) {
                $this->Flash->error(__('Please insert your email address'));
            }
            if ($user = $userTable->find('all')->where(['email' => $email])->first()) {
                $fullname = $user->fullname;
                if ($userTable->save($user)) {
                    $mailer = new Mailer('default');
                    $mailer->setTransport('default');
                    $mailer->setFrom(['noreply@codethepixel.com' => 'ReCRUD'])
                        ->setTo($email)
                        ->setEmailFormat('html')
                        ->setSubject('Forgot Username Request')
                        ->deliver('Hi<br/><br/>Your username is ' . $fullname . '</a>');
                }
                $this->Flash->success('Your username is sent to ' . $email . ', please check your email');
            }
            if ($total = $userTable->find('all')->where(['email' => $email])->count() == 0) {
                $this->Flash->error(__('Email is not registered in system'));
            }
        }
    }

    public function forgotPassword()
    {
        $this->set('title', 'Forgot Password');
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            //$token = Security::hash(Security::randomBytes(25));
            $token = Security::hash(Security::randomBytes(32), 'sha256', true);
            //$userTable = TableRegistry::get('Users');
            $userTable = TableRegistry::getTableLocator()->get('Users');
            if ($email == NULL) {
                $this->Flash->error(__('Please insert your email address'));
            }
            if ($user = $userTable->find('all')->where(['email' => $email])->first()) {
                $user->token = $token;
                $user->token_created_at = date('Y-m-d H:i:s');
                if ($userTable->save($user)) {
                    $mailer = new Mailer('default');
                    $mailer->setTransport('default');
                    $mailer->setFrom(['noreply@codethepixel.com' => 'ReCRUD'])
                        ->setTo($email)
                        ->setEmailFormat('html')
                        ->setSubject('Forgot Password Request')
                        ->deliver('Hello<br/>Please click link below to reset your password<br/><br/><a href="http://localhost/recrud/users/reset_password/' . $token . '">Reset Password</a>');
                }
                $this->Flash->success('Reset password link has been sent to your email (' . $email . '), please check your email');
            }
            if ($total = $userTable->find('all')->where(['email' => $email])->count() == 0) {
                $this->Flash->error(__('Email is not registered in system'));
            }
        }
    }

    public function resetPassword($token = null)
    {
        $this->set('title', 'Reset Password');
        if (!$token) {
            $this->Flash->error('Invalid token.');
            return $this->redirect(['action' => 'forgotPassword']);
        }

        $usersTable = TableRegistry::getTableLocator()->get('Users');
        $user = $usersTable->find('all', [
            'conditions' => ['token' => $token, 'token_created_at >' => date('Y-m-d H:i:s', strtotime('-1 hour'))]
        ])->first();

        if (!$user) {
            $this->Flash->error('Invalid or expired token.');
            return $this->redirect(['action' => 'forgotPassword']);
        }

        $user = $this->Users->findByToken($token)->first();
        $password = $this->request->getData('password');

        if ($this->request->is(['post'])) {
            $user->password = $password;
            $user->token = null;
            $user->token_created_at = null;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your password has been successfully updated.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Your password could not be saved. Please, try again.'));
        }
    }

    public function registration()
    {
        $this->set('title', 'User Registration');
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'register']);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups'));
    }

    public function profile($slug = null)
    {
        $this->set('title', 'Account Details');

        $user = $this->Users
            ->findBySlug($slug)
            ->contain(['UserGroups', 'AuditLogs'])
            ->firstOrFail();

        /* $user = $this->Users->get($id, [
            ->contain(['UserGroups'])
        ]); */

        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Edit']);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
                $log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
                $log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
                //$log->setMetaInfo($log->getMetaInfo() + ['slug' => $user]);

            }
        });
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account details updated'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups'));
    }

    public function update($slug = null, $id = null)
    {
        $this->set('title', 'Update Profile');

        $user = $this->Users
            ->findBySlug($slug)
            ->contain(['UserGroups'])
            ->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account details updated'));
                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups'));
    }

    public function removeAvatar($slug = null)
    {
        $this->set('title', 'Remove Profile Picture');

        $user = $this->Users
            ->findBySlug($slug)
            ->contain(['UserGroups'])
            ->firstOrFail();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Account details updated'));
                //return $this->redirect($this->referer());
                return $this->redirect(['action' => 'profile', $user->slug]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups'));
    }

    public function changePassword($slug = null)
    {
        $this->set('title', 'Change Password');
        $user = $this->Users
            ->findBySlug($slug)
            ->contain(['UserGroups'])
            ->firstOrFail();

        //$userSlug = $this->Auth->user('slug');

        /* if($slug != $userSlug){
				$this->Flash->error(__('You are not authorized to view'));
				return $this->redirect(['action' => 'profile', $this->Auth->user('slug')]);
		} */

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData(), ['validate' => 'password']);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your password has been updated.'));

                return $this->redirect(['action' => 'profile', $user->slug]);
            }
            $this->Flash->error(__('Your password could not be update. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'userGroups'));
    }

    public function activity($slug = null)
    {
        $this->set('title', 'User Activities');

        $user = $this->Users
            ->findBySlug($slug)
            ->contain(['UserGroups', 'AuditLogs'])
            ->limit(5)
            ->firstOrFail();

        //$this->userLogs = $this->fetchTable('userLogs');
        $userLogs = $this->fetchTable('UserLogs')->find(
            'all',
            limit: 5,
            order: 'UserLogs.created DESC'
        )
            ->all();

        /* $userLogs = $this->userLogs->find('all')
            ->where(['user_id' => $user->id])
            ->limit(10)
            ->orderBy(['created' => 'DESC']); */


        $this->set(compact('user', 'userLogs'));

        //$this->set(compact('user', 'userGroups'));
    }

    public function profilePdf($slug = null)
    {
        $this->viewBuilder()->enableAutoLayout(false);
        //$user = $this->Users->get($slug);
        $user = $this->Users
            ->findBySlug($slug)
            ->contain(['UserGroups'])
            ->firstOrFail();
        //debug($user);
        //exit;
        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        $this->viewBuilder()->setOption(
            'pdfConfig',
            [
                'orientation' => 'portrait',
                'download' => true, // This can be omitted if "filename" is specified.
                'filename' => 'User_' . $slug . '.pdf' //// This can be omitted if you want file name based on URL.
            ]
        );
        $this->set('user', $user);
    }
    /* 
    public function json()
    {
        $this->viewBuilder()->setLayout('json');
        $this->set('users', $this->paginate());
        $this->viewBuilder()->setOption('serialize', 'users');
    }

    public function csv()
    {
        $this->response = $this->response->withDownload('users.csv');
        $users = $this->Users->find();
        $_serialize = 'users';

        $this->viewBuilder()->setClassName('CsvView.Csv');
        $this->set(compact('users', '_serialize'));
    }

    public function pdfList()
    {
        $this->viewBuilder()->enableAutoLayout(false);
        $this->paginate = [
            'contain' => ['UserGroups'],
            'maxLimit' => 10,
        ];
        $users = $this->paginate($this->Users);
        $this->viewBuilder()->setClassName('CakePdf.Pdf');
        $this->viewBuilder()->setOption(
            'pdfConfig',
            [
                'orientation' => 'portrait',
                'download' => true,
                'filename' => 'users_List.pdf'
            ]
        );
        $this->set(compact('users'));
    }
    
    public function index()
    {
        $this->set('title', 'Users List');
        $this->paginate = [
            'maxLimit' => 10,
        ];
        $query = $this->Users->find('search', search: $this->request->getQueryParams())
            ->contain(['UserGroups']);
        //->where(['title IS NOT' => null])
        $users = $this->paginate($query);

        //count
        $this->set('total_users', $this->Users->find()->count());
        $this->set('total_users_archived', $this->Users->find()->where(['status' => 2])->count());
        $this->set('total_users_active', $this->Users->find()->where(['status' => 1])->count());
        $this->set('total_users_disabled', $this->Users->find()->where(['status' => 0])->count());

        //Count By Month
        $this->set('january', $this->Users->find()->where(['MONTH(created)' => date('1'), 'YEAR(created)' => date('Y')])->count());
        $this->set('february', $this->Users->find()->where(['MONTH(created)' => date('2'), 'YEAR(created)' => date('Y')])->count());
        $this->set('march', $this->Users->find()->where(['MONTH(created)' => date('3'), 'YEAR(created)' => date('Y')])->count());
        $this->set('april', $this->Users->find()->where(['MONTH(created)' => date('4'), 'YEAR(created)' => date('Y')])->count());
        $this->set('may', $this->Users->find()->where(['MONTH(created)' => date('5'), 'YEAR(created)' => date('Y')])->count());
        $this->set('jun', $this->Users->find()->where(['MONTH(created)' => date('6'), 'YEAR(created)' => date('Y')])->count());
        $this->set('july', $this->Users->find()->where(['MONTH(created)' => date('7'), 'YEAR(created)' => date('Y')])->count());
        $this->set('august', $this->Users->find()->where(['MONTH(created)' => date('8'), 'YEAR(created)' => date('Y')])->count());
        $this->set('september', $this->Users->find()->where(['MONTH(created)' => date('9'), 'YEAR(created)' => date('Y')])->count());
        $this->set('october', $this->Users->find()->where(['MONTH(created)' => date('10'), 'YEAR(created)' => date('Y')])->count());
        $this->set('november', $this->Users->find()->where(['MONTH(created)' => date('11'), 'YEAR(created)' => date('Y')])->count());
        $this->set('december', $this->Users->find()->where(['MONTH(created)' => date('12'), 'YEAR(created)' => date('Y')])->count());

        $this->set(compact('users'));
    }

    
    public function view($id = null)
    {
        $this->set('title', 'Users Details');
        $user = $this->Users->get($id, contain: ['UserGroups', 'Contacts', 'Todos', 'UserLogs']);
        $this->set(compact('user'));

        $this->set(compact('user'));
    }

    
    public function add()
    {
        $this->set('title', 'New Users');
        
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', ['limit' => 200])->all();
        $this->set(compact('user', 'userGroups'));
    }

    
    public function edit($id = null)
    {
        $this->set('title', 'Users Edit');
       
        
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $userGroups = $this->Users->UserGroups->find('list', limit: 200)->all();
        $this->set(compact('user', 'userGroups'));
    }

    
    public function delete($id = null)
    {
        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Delete']);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
                $log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
                $log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
                $log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
            }
        });
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function archived($id = null)
    {
        $this->set('title', 'Users Edit');
        EventManager::instance()->on('AuditStash.beforeLog', function ($event, array $logs) {
            foreach ($logs as $log) {
                $log->setMetaInfo($log->getMetaInfo() + ['a_name' => 'Archived']);
                $log->setMetaInfo($log->getMetaInfo() + ['c_name' => 'Users']);
                $log->setMetaInfo($log->getMetaInfo() + ['ip' => $this->request->clientIp()]);
                $log->setMetaInfo($log->getMetaInfo() + ['url' => Router::url(null, true)]);
                $log->setMetaInfo($log->getMetaInfo() + ['slug' => $this->Authentication->getIdentity('slug')->getIdentifier('slug')]);
            }
        });
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->status = 2; //archived
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been archived.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The user could not be archived. Please, try again.'));
        }
        $this->set(compact('user'));
    } */
}
